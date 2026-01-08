<div class="p-4">

    <h1 class="text-xl font-bold mb-4">Order Food</h1>

    @foreach($items as $category => $list)
        <h2 class="font-semibold mt-4 capitalize">{{ $category }}</h2>

        @foreach($list as $item)
            <div class="flex justify-between border-b py-2">
                <div>
                    {{ $item->name }}
                    <div class="text-sm">R{{ $item->price }}</div>
                </div>
                <button wire:click="addItem({{ $item->id }})" class="px-3 bg-black text-white">
                    +
                </button>
            </div>
        @endforeach
    @endforeach

    <hr class="my-4">

    <input wire:model="customer_phone" placeholder="Phone number"
           class="w-full border p-2 mb-2">

    <label>
        <input type="radio" wire:model="fulfilment_type" value="COLLECTION">
        Collection
    </label>
    <label class="ml-4">
        <input type="radio" wire:model="fulfilment_type" value="DELIVERY">
        Delivery
    </label>

    <div class="mt-4 font-bold">
        Total: R{{ number_format($this->total, 2) }}
    </div>

    <button wire:click="submit"
            class="mt-4 w-full bg-green-600 text-white py-2">
        Place Order
    </button>

</div>
