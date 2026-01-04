<?php

namespace App\Events;

use App\Data\SalesOrderData;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SalesOrderCreatedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public SalesOrderData $sales_order) {}

    public function broadcastWith(): array
    {
        /** @var SalesOrderItemData $product */
        $product = $this->sales_order->items->toCollection()->random(1)->first();

        return [
            'customer_name' => $this->sales_order->customer->full_name,
            'product' => $product->name,
            'product_qty' => $product->quantity
        ];
    }

    public function broadcastAs(): string
    {
        return 'orders';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('orders'),
        ];
    }
}
