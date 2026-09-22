<?php

use App\Data\SalesOrderData;
use App\Models\Product;
use App\Models\SalesOrder;
use App\Services\SalesOrderService;
use App\States\SalesOrder\Pending;
use App\States\SalesOrder\Progress;

function makeProduct(string $sku, int $stock): Product
{
    return Product::create([
        'name' => "Product {$sku}",
        'sku' => $sku,
        'slug' => strtolower($sku),
        'stock' => $stock,
        'price' => 10_000,
        'weight' => 500,
    ]);
}

function makeOrderWithItems(array $items): SalesOrder
{
    $order = SalesOrder::create([
        'trx_id' => 'TRX-'.uniqid(),
        'status' => Pending::class,
        'customer_full_name' => 'John Doe',
        'customer_email' => 'john@example.test',
        'customer_phone' => '081234567',
        'address_line' => 'Jl. Test No. 1',
        'origin_code' => 'O1', 'origin_province' => 'P', 'origin_city' => 'C',
        'origin_district' => 'D', 'origin_sub_district' => 'S', 'origin_postal_code' => '11111',
        'destination_code' => 'D1', 'destination_province' => 'P', 'destination_city' => 'C',
        'destination_district' => 'D', 'destination_sub_district' => 'S', 'destination_postal_code' => '22222',
        'shipping_driver' => 'offline', 'shipping_receipt_number' => '',
        'shipping_courier' => 'Internal', 'shipping_service' => 'Instant',
        'shipping_estimated_delivery' => '1-2 Jam', 'shipping_cost' => 15_000, 'shipping_weight' => 1000,
        'payment_driver' => 'offline', 'payment_method' => 'cash',
        'payment_label' => 'Cash', 'payment_payload' => [],
        'sub_total' => 100_000, 'shipping_total' => 15_000, 'total' => 115_000,
        'due_date_at' => now()->addDay(),
    ]);

    foreach ($items as $item) {
        $order->items()->create([
            'name' => "Product {$item['sku']}",
            'short_desc' => '-',
            'sku' => $item['sku'],
            'slug' => strtolower($item['sku']),
            'cover_url' => 'https://example.test/cover.png',
            'quantity' => $item['quantity'],
            'price' => 10_000,
            'total' => 10_000 * $item['quantity'],
            'weight' => 500,
        ]);
    }

    return $order;
}

it('returns stock only to the ordered products and leaves others untouched', function () {
    $ordered = makeProduct('SKU-A', 5);
    $alsoOrdered = makeProduct('SKU-B', 2);
    $unrelated = makeProduct('SKU-C', 99);

    $order = makeOrderWithItems([
        ['sku' => 'SKU-A', 'quantity' => 3],
        ['sku' => 'SKU-B', 'quantity' => 4],
    ]);

    app(SalesOrderService::class)->returnStock(SalesOrderData::fromModel($order));

    expect($ordered->fresh()->stock)->toBe(8)   // 5 + 3
        ->and($alsoOrdered->fresh()->stock)->toBe(6) // 2 + 4
        ->and($unrelated->fresh()->stock)->toBe(99); // untouched
});

it('does not approve payment when no matching pending order exists', function () {
    $result = app(SalesOrderService::class)->approvePaymentUsingTrxId('TRX-MISSING', 999_999);

    expect($result)->toBeFalse();
});

it('approves a matching pending order and transitions it to progress', function () {
    $order = makeOrderWithItems([['sku' => 'SKU-X', 'quantity' => 1]]);

    $approved = app(SalesOrderService::class)->approvePaymentUsingTrxId($order->trx_id, 115_000);

    expect($approved)->toBeTrue()
        ->and($order->fresh()->status)->toBeInstanceOf(Progress::class);
});
