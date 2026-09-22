<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\SalesOrderData;
use App\Data\SalesOrderItemData;
use App\Events\ShippingReceiptNumberUpdateEvent;
use App\Models\Product;
use App\Models\SalesOrder;
use App\States\SalesOrder\Pending;
use App\States\SalesOrder\Progress;
use Illuminate\Support\Facades\DB;

class SalesOrderService
{
    public function updateShippingReceipt(SalesOrderData $sales_order, string $number): SalesOrderData
    {
        $query = SalesOrder::query()->where('trx_id', $sales_order->trx_id)->first();

        $query->update([
            'shipping_receipt_number' => $number,
        ]);

        $data = SalesOrderData::fromModel(
            $query->refresh()
        );

        event(new ShippingReceiptNumberUpdateEvent($data));

        return $data;
    }

    public function updateShippingPayload(SalesOrderData $sales_order, array $payload): SalesOrderData
    {
        SalesOrder::where('trx_id', $sales_order->trx_id)->update([
            'payment_payload' => array_merge($sales_order->payment->payload, $payload),
        ]);

        return SalesOrderData::from(
            SalesOrder::where('trx_id', $sales_order->trx_id)->first()
        );
    }

    public function returnStock(SalesOrderData $sales_order): void
    {
        DB::transaction(function () use ($sales_order) {
            $sales_order->items->toCollection()->each(function (SalesOrderItemData $item) {
                // Return the ordered quantity to the matching product only,
                // incrementing existing stock (never overwriting every row).
                Product::where('sku', $item->sku)
                    ->lockForUpdate()
                    ->increment('stock', $item->quantity);
            });
        });
    }

    public function approvePaymentUsingTrxId(string $trx_id, float $total): bool
    {
        $sales_order = SalesOrder::query()
            ->where('trx_id', $trx_id)
            ->where('total', $total)
            ->where('status', Pending::class)
            ->first();

        // A webhook may arrive with a mismatched trx/total or for an order that
        // is no longer pending — ignore it instead of throwing on null.
        if ($sales_order === null) {
            return false;
        }

        $sales_order->status->transitionTo(Progress::class);

        return true;
    }
}
