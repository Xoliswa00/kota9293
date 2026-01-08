<div class="p-4">
    @if (session()->has('message'))
        <div class="bg-green-100 p-2 mb-2">{{ session('message') }}</div>
    @endif

    <input type="text" wire:model="name" placeholder="Item name" class="border p-1 mb-2 w-full">
    <input type="text" wire:model="category" placeholder="Category" class="border p-1 mb-2 w-full">
    <input type="number" wire:model="price" placeholder="Price" class="border p-1 mb-2 w-full">

    <button wire:click="save" class="bg-blue-600 text-white px-3 py-1 rounded">Add Item</button>
</div>
