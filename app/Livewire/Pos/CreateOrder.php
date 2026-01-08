<?php

namespace App\Livewire\Pos;

use Livewire\Component;

class CreateOrder extends Component
{
 

     public $items;
    public $cart = [];

    public $order_source = 'IN_PERSON';
    public $fulfilment_type = 'COLLECTION';

    public $customer_name;
    public $customer_phone;

    public $delivery_fee = 20;

    public function mount()
    {
        $this->items = Item::where('active', true)->get()->groupBy('category');
    }

    public function addItem($itemId)
    {
        if (!isset($this->cart[$itemId])) {
            $this->cart[$itemId] = [
                'quantity' => 1,
            ];
        } else {
            $this->cart[$itemId]['quantity']++;
        }
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
        $total = 0;

        foreach ($this->cart as $itemId => $row) {
            $item = Item::find($itemId);
            if ($item) {
                $total += $item->price * $row['quantity'];
            }
        }

        return $total;
    }

    public function getTotalProperty()
    {
        return $this->subTotal + ($this->fulfilment_type === 'DELIVERY' ? $this->delivery_fee : 0);
    }

    public function submit(OrderService $service)
    {
        if (empty($this->cart)) {
            $this->addError('cart', 'Cart is empty');
            return;
        }

        if ($this->fulfilment_type === 'DELIVERY' && (!$this->customer_name || !$this->customer_phone)) {
            $this->addError('delivery', 'Customer details required for delivery');
            return;
        }

        $items = [];
        foreach ($this->cart as $itemId => $row) {
            $items[] = [
                'item_id' => $itemId,
                'quantity' => $row['quantity'],
            ];
        }

        $order = $service->create([
            'order_source' => $this->order_source,
            'fulfilment_type' => $this->fulfilment_type,
            'customer_name' => $this->customer_name,
            'customer_phone' => $this->customer_phone,
            'items' => $items,
        ]);

        $this->reset();
        $this->mount();

        session()->flash('success', 'Order #' . $order->id . ' created');
    }

    public function render()
    {
        return view('livewire.pos.create-order');
    }
}
