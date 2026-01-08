<?php

namespace App\Livewire\Customer;

use Livewire\Component;

class OrderMenu extends Component
{
    public function render()
    {
        return view('livewire.customer.order-menu');
    }

     public $items;
    public $cart = [];

    public $fulfilment_type = 'DELIVERY';
    public $customer_name;
    public $customer_phone;
    public $delivery_fee = 20;

    public function mount()
    {
        $this->items = Item::where('active', true)->get()->groupBy('category');

        $this->customer_name = auth()->user()->name ?? null;
    }

    public function addItem($itemId)
    {
        $this->cart[$itemId]['quantity'] =
            ($this->cart[$itemId]['quantity'] ?? 0) + 1;
    }

    public function removeItem($itemId)
    {
        if (isset($this->cart[$itemId])) {
            $this->cart[$itemId]['quantity']--;
            if ($this->cart[$itemId]['quantity'] <= 0) {
                unset($this->cart[$itemId]);
            }
        }
    }

    public function getSubTotalProperty()
    {
        return collect($this->cart)->sum(function ($row, $itemId) {
            return Item::find($itemId)->price * $row['quantity'];
        });
    }

    public function getTotalProperty()
    {
        return $this->subTotal + ($this->fulfilment_type === 'DELIVERY' ? $this->delivery_fee : 0);
    }

    public function submit(OrderService $service)
    {
        $this->validate([
            'customer_phone' => 'required',
        ]);

        $items = collect($this->cart)->map(function ($row, $itemId) {
            return [
                'item_id' => $itemId,
                'quantity' => $row['quantity'],
            ];
        })->values()->toArray();

        $service->create([
            'order_source' => 'ONLINE',
            'fulfilment_type' => $this->fulfilment_type,
            'customer_name' => $this->customer_name,
            'customer_phone' => $this->customer_phone,
            'items' => $items,
        ]);

        $this->reset();
        session()->flash('success', 'Order placed successfully');
    }

}
