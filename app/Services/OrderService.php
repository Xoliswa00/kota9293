<?php

namespace App\Services;
use App\Models\order;
use App\Models\order_item;
use App\Models\item;
use App\Models\delivery;
use Illuminate\Support\Facades\DB;

class OrderService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


     public function create(array $data): Order
    {
        return DB::transaction(function () use ($data) {

            $subTotal = 0;

            foreach ($data['items'] as $row) {
                $item = Item::findOrFail($row['item_id']);
                $subTotal += $item->price * $row['quantity'];
            }

            $deliveryFee = ($data['fulfilment_type'] === 'DELIVERY')
                ? ($data['delivery_fee'] ?? 20)
                : 0;

            $order = Order::create([
                'order_source'   => $data['order_source'],
                'fulfilment_type'=> $data['fulfilment_type'],
                'customer_name'  => $data['customer_name'] ?? null,
                'customer_phone' => $data['customer_phone'] ?? null,
                'user_id' => auth()->id(),
'order_source' => auth()->user()?->isCustomer() ? 'ONLINE' : 'IN_PERSON',
                'sub_total'      => $subTotal,
                'delivery_fee'   => $deliveryFee,
                'total_amount'   => $subTotal + $deliveryFee,
                'payment_status' => $data['payment_status'] ?? 'UNPAID',
            ]);

            foreach ($data['items'] as $row) {
                $item = Item::findOrFail($row['item_id']);

                OrderItem::create([
                    'order_id' => $order->id,
                    'item_id'  => $item->id,
                    'quantity' => $row['quantity'],
                    'price'    => $item->price,
                ]);
            }

            if ($order->isDelivery()) {
                Delivery::create([
                    'order_id' => $order->id,
                ]);
            }

            return $order;
        });
    }
}
