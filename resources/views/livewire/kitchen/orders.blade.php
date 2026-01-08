<div class="p-4 space-y-4" wire:poll.5s x-data="{ newOrders: [] }" 
     x-init="@this.on('newOrders', ids => { newOrders = ids; })">

    @foreach($orders as $order)
        @php
            $isReady = $order->order_status === 'READY';
        @endphp

        <div 
            x-data="{ flash: {{ $isReady ? 'true' : 'false' }}, highlight: newOrders.includes({{ $order->id }}) }"
            x-init="
                if(flash){ setInterval(() => flash = !flash, 500); }
                if(highlight){ setTimeout(() => highlight = false, 3000); }
                $watch('flash', value => { if(value) $el.scrollIntoView({ behavior: 'smooth', block: 'center' }); })
            "
            :class="flash ? 'bg-green-200' : highlight ? 'bg-yellow-200' : 'bg-white'"
            class="border p-4 rounded transition-colors duration-300"
        >
            <h2 class="font-bold">Order #{{ $order->id }}</h2>
            <div class="text-sm">{{ $order->order_source }} • {{ $order->fulfilment_type }}</div>

            <ul class="mt-2">
                @foreach($order->items as $row)
                    <li>{{ $row->item->name }} × {{ $row->quantity }}</li>
                @endforeach
            </ul>

            <div class="mt-2 flex gap-2">
                @if(auth()->user()->isAdmin() || auth()->user()->isKitchen())
                    @if($order->order_status === 'PENDING')
                        <button wire:click="updateStatus({{ $order->id }}, 'PREPARING')"
                                class="bg-yellow-500 px-2 py-1 text-white">
                            Start
                        </button>
                    @endif

                    @if($order->order_status === 'PREPARING')
                        <button wire:click="updateStatus({{ $order->id }}, 'READY')"
                                class="bg-green-600 px-2 py-1 text-white">
                            Ready
                        </button>
                    @endif
                @endif
            </div>

            <div class="mt-1 text-xs text-gray-500">
                Ordered {{ $order->created_at->diffForHumans() }}
            </div>
        </div>
    @endforeach

</div>
