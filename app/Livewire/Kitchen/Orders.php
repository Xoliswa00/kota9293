<?php

namespace App\Livewire\Kitchen;

use Livewire\Component;

class Orders extends Component
{
   

       protected $listeners = ['refreshOrders' => '$refresh'];

    public function updateStatus($orderId, $status)
    {
         $user = auth()->user();

    if ($user->isCashier()) {
        // Cashier cannot update status
        return;
    }
        Order::findOrFail($orderId)->update([
            'order_status' => $status
        ]);


          $order->updateStatus($status);

        $this->emitSelf('refreshOrders');
    }

  public function getOrdersProperty()
    {
        $orders = Order::whereIn('order_status', ['PENDING', 'PREPARING', 'READY'])
            ->with('items.item')
            ->orderBy('created_at')
            ->get();

        return $orders;
    }

    public function render()
    {
        $orders = $this->orders;

        // Store current order IDs for detecting new orders
        $currentIds = $orders->pluck('id')->toArray();
        $this->emit('newOrders', array_diff($currentIds, $this->previousOrderIds));
        $this->previousOrderIds = $currentIds;

        return view('livewire.kitchen.orders', [
            'orders' => $orders
        ]);
    }
}
