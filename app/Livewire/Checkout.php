<?php

namespace App\Livewire;

use App\Contract\CartServiceInterface;
use App\Data\CartData;
use App\Data\CheckoutData;
use App\Data\CustomerData;
use App\Data\RegionData;
use App\Data\ShippingData;
use App\Rules\ValidPaymentMethodHash;
use App\Rules\ValidShippingHash;
use App\Services\CheckoutService;
use App\Services\PaymentMethodQueryService;
use App\Services\RegionQueryService;
use App\Services\ShippingMethodService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Number;
use Livewire\Attributes\Title;
use Livewire\Component;
use Spatie\LaravelData\DataCollection;

#[Title('Webstore | Checkout')]
class Checkout extends Component
{
    public array $data = [
        'full_name' => null,
        'email' => null,
        'phone' => null,
        'address_line' => null,
        'destination_region_code' => null,
        'shipping_hash' => null,
        'payment_method_hash' => null,
    ];

    public array $region_selector = [
        'keyword' => null,
        'region_selected' => null,
    ];

    public array $shipping_selector = [
        'shipping_method' => null,
    ];

    public array $payment_method_selector = [
        'payment_method_selected' => null,
    ];

    public array $summaries = [
        'sub_total' => 0,
        'sub_total_formatted' => '-',
        'shipping_total' => 0,
        'shipping_total_formatted' => '-',
        'grand_total' => 0,
        'grand_total_formatted' => '-',
    ];

    // Deferred state for the (slow) external API Kurir rate lookup. These are
    // populated by loadApiShipping(), triggered via wire:init so the initial
    // region-select render never blocks on the upstream HTTP call.
    public bool $api_shipping_loaded = false;

    public bool $api_shipping_failed = false;

    /** @var array<int, string> resolved API Kurir shipping hashes */
    public array $api_shipping_hashes = [];

    public function mount()
    {
        if (! Gate::inspect('is_stock_available')->allowed()) {
            return redirect()->route('cart');
        }

        if ($this->cart->total_quantity <= 0) {
            return redirect()->route('cart');
        }

        $this->calculateTotal();
    }

    public function rules()
    {
        return [
            'data.full_name' => ['required', 'min:3', 'max:255'],
            'data.email' => ['required', 'email', 'max:255'],
            'data.phone' => ['required', 'min:9', 'max:13'],
            'data.address_line' => ['required', 'min:10', 'max:255'],
            'data.destination_region_code' => ['required'],
            'data.shipping_hash' => ['required', new ValidShippingHash],
            'data.payment_method_hash' => ['required', new ValidPaymentMethodHash],
        ];
    }

    public function validationAttributes()
    {
        return [
            'data.full_name' => 'Name',
            'data.email' => 'Email',
            'data.phone' => 'Phone',
            'data.address_line' => 'Address',
            'data.destination_region_code' => 'Region',
            'data.shipping_hash' => 'Shipping',
            'data.payment_method_hash' => 'Payment',
        ];
    }

    public function calculateTotal()
    {
        data_set($this->summaries, 'sub_total', $this->cart->total);
        data_set($this->summaries, 'sub_total_formatted', $this->cart->total_formatted);

        $shipping_cost = $this->shippingMethod?->cost ?? 0;
        data_set($this->summaries, 'shipping_total', $shipping_cost);
        data_set($this->summaries, 'shipping_total_formatted', Number::currency($shipping_cost));

        $grand_total = $this->cart->total + $shipping_cost;
        data_set($this->summaries, 'grand_total', $grand_total);
        data_set($this->summaries, 'grand_total_formatted', Number::currency($grand_total));
    }

    public function getCartProperty(CartServiceInterface $cart): CartData
    {
        return $cart->all();
    }

    public function getRegionsProperty(RegionQueryService $query_service): DataCollection
    {
        if (! data_get($this->region_selector, 'keyword')) {
            return new DataCollection(RegionData::class, []);
        }

        return $query_service->searchRegionByName(
            data_get($this->region_selector, 'keyword')
        );
    }

    public function getRegionProperty(RegionQueryService $query_service): ?RegionData
    {
        $region_selected = data_get($this->region_selector, 'region_selected');
        if (! $region_selected) {
            return null;
        }

        return $query_service->searchRegionByCode($region_selected);
    }

    public function updatedRegionSelectorRegionSelected($value)
    {
        data_set($this->data, 'destination_region_code', $value);

        // Reset any previously selected/loaded shipping when the destination
        // changes so stale rates and the deferred API state don't leak over.
        data_set($this->data, 'shipping_hash', null);
        data_set($this->shipping_selector, 'shipping_method', null);
        $this->api_shipping_loaded = false;
        $this->api_shipping_failed = false;
        $this->api_shipping_hashes = [];
        $this->calculateTotal();
    }

    /**
     * Offline couriers only — instant (no network), safe to resolve on render.
     *
     * @return Collection<string, Collection<int, ShippingData>>
     */
    public function getOfflineShippingMethodsProperty(
        RegionQueryService $region_query,
        ShippingMethodService $shipping_service
    ): Collection {
        $origin = $region_query->searchRegionByCode(config('shipping.shipping_origin_code'));
        $destination = $region_query->searchRegionByCode(data_get($this->data, 'destination_region_code'));

        if (! $origin || ! $destination) {
            return collect();
        }

        return $shipping_service->getOfflineShippingMethods($origin, $destination, $this->cart)
            ->toCollection()
            ->groupBy('service');
    }

    /**
     * Deferred loader for slow external API Kurir rates. Triggered via wire:init
     * so the region-select render returns immediately with offline couriers,
     * then this second request fills in (or gracefully fails) the API couriers.
     */
    public function loadApiShipping(
        RegionQueryService $region_query,
        ShippingMethodService $shipping_service
    ): void {
        if (! data_get($this->data, 'destination_region_code')) {
            return;
        }

        $origin = $region_query->searchRegionByCode(config('shipping.shipping_origin_code'));
        $destination = $region_query->searchRegionByCode(data_get($this->data, 'destination_region_code'));

        if (! $origin || ! $destination) {
            $this->api_shipping_loaded = true;
            $this->api_shipping_failed = true;

            return;
        }

        $result = $shipping_service->getApiShippingMethods($origin, $destination, $this->cart);

        $this->api_shipping_hashes = $result['methods']->toCollection()
            ->map(fn (ShippingData $method) => $method->hash)
            ->all();
        $this->api_shipping_failed = $result['failed'] && empty($this->api_shipping_hashes);
        $this->api_shipping_loaded = true;
    }

    /**
     * Rebuilds the loaded API couriers (from cache, by hash) for rendering.
     *
     * @return Collection<string, Collection<int, ShippingData>>
     */
    public function getApiShippingMethodsProperty(
        ShippingMethodService $shipping_service
    ): Collection {
        return collect($this->api_shipping_hashes)
            ->map(fn (string $hash) => $shipping_service->getShippingMethod($hash))
            ->filter()
            ->groupBy('service');
    }

    public function getShippingMethodProperty(
        ShippingMethodService $shipping_service
    ): ?ShippingData {
        if (empty(data_get($this->data, 'shipping_hash')) || empty(data_get($this->data, 'destination_region_code'))) {
            return null;
        }

        $data = $shipping_service->getShippingMethod(
            data_get($this->data, 'shipping_hash')
        );

        if ($data === null) {
            // Rate expired from cache — clear the selection so the summary
            // resets and the user is forced to re-pick a valid courier.
            $this->addError('shipping_hash', 'Shipping cost error or missing!');
            data_set($this->data, 'shipping_hash', null);
            data_set($this->shipping_selector, 'shipping_method', null);
        }

        return $data;
    }

    public function updatedShippingSelectorShippingMethod($value)
    {
        data_set($this->data, 'shipping_hash', $value);
        $this->calculateTotal();
    }

    public function getPaymentMethodsProperty(PaymentMethodQueryService $query_service): DataCollection
    {
        return $query_service->getPaymentMethods();
    }

    public function updatedPaymentMethodSelectorPaymentMethodSelected($value)
    {
        data_set($this->data, 'payment_method_hash', $value);
    }

    public function placeAnOrder(
        CartServiceInterface $cart
    ) {
        $validated = $this->validate();

        $shipping_method = app(ShippingMethodService::class)->getShippingMethod(data_get($validated, 'data.shipping_hash'));

        $payment_method = app(PaymentMethodQueryService::class)->getPaymentMethodByHash(data_get($validated, 'data.payment_method_hash'));

        $checkout = CheckoutData::from([
            'customer' => CustomerData::from(data_get($validated, 'data')),
            'address_line' => data_get($validated, 'data.address_line'),
            'origin' => $shipping_method->origin,
            'destination' => $shipping_method->destination,
            'cart' => $this->cart,
            'shipping' => $shipping_method,
            'payment' => $payment_method,
        ]);

        $service = app(CheckoutService::class);
        $sales_order = $service->makeAnOrder($checkout);
        $cart->clear();

        return redirect()->route('order-confirmed', $sales_order->trx_id);
    }

    public function render()
    {
        return view('livewire.checkout', [
            'cart' => $this->cart,
        ]);
    }
}
