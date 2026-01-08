<div class="p-4 grid grid-cols-3 gap-4">

    {{-- MENU --}}
    <div class="col-span-2">
        @foreach($items as $category => $categoryItems)
            <h2 class="text-lg font-bold mt-4 capitalize">{{ $category }}</h2>

            <div class="grid grid-cols-3 gap-2">
                @foreach($categoryItems as $item)
                    <button
                        wire:click="addItem({{ $item->id }})"
                        class="p-3 border rounded text-left hover:bg-gray-100"
                    >
                        <div class="font-semibold">{{ $item->name }}</div>
                        <div class="text-sm">R{{ number_format($item->price, 2) }}</div>
                    </button>
                @endforeach
            </div>
        @endforeach
    </div>

    {{-- CART --}}
    <div class="border p-4 rounded">
        <h2 class="font-bold text-lg mb-2">Order</h2>

        @foreach($cart as $itemId => $row)
            @php $item = \App\Models\Item::find($itemId); @endphp
            @if($item)
                <div class="flex justify-between items-center mb-2">
                    <div>
                        {{ $item->name }} × {{ $row['quantity'] }}
                    </div>
                    <div class="flex gap-2">
                        <button wire:click="removeItem({{ $itemId }})">−</button>
                        <button wire:click="addItem({{ $itemId }})">+</button>
                    </div>
                </div>
            @endif
        @endforeach

        <hr class="my-2">

        <div>Subtotal: <strong>R{{ number_format($this->subTotal, 2) }}</strong></div>

        <div class="mt-2">
            <label>
                <input type="radio" wire:model="fulfilment_type" value="COLLECTION">
                Collection
            </label>
            <label class="ml-4">
                <input type="radio" wire:model="fulfilment_type" value="DELIVERY">
                Delivery
            </label>
        </div>

        @if($fulfilment_type === 'DELIVERY')
            <input type="text" wire:model="customer_name" placeholder="Customer Name" class="w-full mt-2 border p-2">
            <input type="text" wire:model="customer_phone" placeholder="Phone" class="w-full mt-2 border p-2">
            <div class="mt-2">Delivery: R{{ number_format($delivery_fee, 2) }}</div>
        @endif

        <hr class="my-2">

        <div class="text-lg">
            Total: <strong>R{{ number_format($this->total, 2) }}</strong>
        </div>

        <button
            wire:click="submit"
            class="mt-4 w-full bg-black text-white py-2 rounded"
        >
            Place Order
        </button>
    </div>
</div>
