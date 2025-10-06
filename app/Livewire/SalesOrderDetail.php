<?php

namespace App\Livewire;

use App\Data\SalesOrderData;
use Livewire\Component;
use App\Models\SalesOrder;
use App\Services\PaymentMethodQueryService;

class SalesOrderDetail extends Component
{
    public SalesOrder $sales_order;

    public function render()
    {
        $service = app(PaymentMethodQueryService::class);
        $sales_order_data = SalesOrderData::fromModel($this->sales_order);
        return view('livewire.sales-order-detail', [
            'order' => $sales_order_data,
            'is_redirect' => $service->shouldShowButton($sales_order_data),
            'redirect_url' => $service->getRedirectUrl($sales_order_data)
        ]);
    }
}
