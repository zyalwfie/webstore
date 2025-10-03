<?php

namespace App\Models;

use App\States\SalesOrder\SalesOrderState;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\ModelStates\HasStates;

class SalesOrder extends Model
{
    use HasStates;

    protected $with = [
        'items'
    ];

    protected $casts = [
        'status' => SalesOrderState::class,
        'payment_payload' => 'json',
        'due_date_at' => 'datetime',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(SalesOrderItem::class);
    }
}
