<?php

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\{Order, Product};

class CancelOrdersCommand extends Command
{
    protected $signature = 'orders:cancel';

    protected $description = 'Cancel orders that have not been paid within 24 hours';

    public function handle()
    {
        $orders = Order::where('status', 1)
            ->where('created_at', '<', Carbon::now()->subHours(24))
            ->get();

        foreach ($orders as $order) {
            foreach (json_decode($order->products) as  $p) {
                $quantity = Product::select('quantity')->where('product_hash', $p->product_hash)->first();
                Product::where('product_hash', $p->product_hash)->update(['quantity' => (int)$quantity->quantity + (int)$p->pcs]);
            }
            $order->status = 0;
            $order->save();

            // Send an email notification to the customer
            // Mail::to($order->customer->email)
            //     ->send(new OrderCanceled($order));
        }
    }
}
