<?php

namespace App\Console\Commands;

use App\Models\Orders;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class check_or_stale_orders extends Command
{

    protected $signature = 'app:check_or_stale_orders';


    protected $description = 'Update order status from new to stale';


    public function handle()
    {
        $orders = Orders::where('status', 'new')->get();

        foreach ($orders as $order) {
            $order->status = 'stale';
            $order->save();
        };
    }
}
