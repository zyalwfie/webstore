<?php

namespace App\Console\Commands;

use App\Models\SalesOrder;
use App\States\SalesOrder\Cancel;
use App\States\SalesOrder\Pending;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class CheckDueSalesOrderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sales-order:check-due';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check sales order due date';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now()->startOfMinute();

        SalesOrder::where('due_date_at', '<=', $now)->where('status', Pending::class)->get()->each(function (SalesOrder $sales_order) {
            $this->info('Due date found: #'.$sales_order->trx_id);

            $sales_order->status->transitionTo(Cancel::class);
        });
    }
}
