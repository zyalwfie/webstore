<?php

declare(strict_types=1);

namespace App\Drivers\Payment;

use App\Contract\PaymentDriverInterface;
use App\Data\PaymentData;
use App\Data\SalesOrderData;
use App\Models\SalesOrder;
use Spatie\LaravelData\DataCollection;

class OfflinePaymentDriver implements PaymentDriverInterface
{
    public readonly string $driver;

    public function __construct()
    {
        $this->driver = 'offline';
    }

    /** @return  DataCollection<PaymentData>*/
    public function getMethods(): DataCollection
    {
        return PaymentData::collect([
            PaymentData::from([
                'driver' => $this->driver,
                'method' => 'bca-bank-transfer',
                'label' => 'Bank Transfer BCA',
                'payload' => [
                    'account_number' => '',
                    'account_holder_name' => 'Ziyad Alwafie'
                ]
            ])
        ], DataCollection::class);
    }

    public function process(SalesOrderData $sales_order)
    {
        SalesOrder::where('trx_id', $sales_order->trx_id)->update([
            'payment_payload' => [
                'key' => 'value'
            ]
        ]);
    }

    public function shouldPayNowButton(SalesOrderData $sales_order): bool
    {
        return false;
    }

    public function getRedirectUrl(SalesOrderData $sales_order): ?string
    {
        return null;
    }
}
