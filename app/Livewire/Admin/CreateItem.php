<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class CreateItem extends Component
{
    public function render()
    {
        return view('livewire.admin.create-item');
    }


    public $name, $category, $price;

    protected $rules = [
        'name' => 'required|string',
        'category' => 'required|string',
        'price' => 'required|numeric|min:0',
    ];

    public function save()
    {
        $this->validate();

        Item::create([
            'name' => $this->name,
            'category' => $this->category,
            'price' => $this->price,
        ]);

        $this->reset(['name','category','price']);
        $this->emit('itemAdded'); // optional, for Livewire update
        session()->flash('message', 'Item added successfully!');
    }

    public function render()
    {
        return view('livewire.admin.create-item');
    }
}
