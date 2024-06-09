@extends("layouts.app")

@section("content")

<div class="container">
    <p class="text-2xl font-bold text-center">Please pickup your order</p>
    <p class="text-xl font-light text-center">when your order is completed</p>
    <div class="flex flex-col m-10 py-4 px-10 border-2 justify-center rounded-lg ">
        <div class="flex flex-col">
        @if($orders->isEmpty())
            <p class="text-center text-slate-500">You have no pending order.</p>
        @else
            @foreach($orders as $order)   
            <div class="card-body mx-auto text-center">
                <h5 class="card-text font-semibold text-xl">Order #{{ $order->id }}</h5>
                <p class="card-text">
                @if(is_string($order->items) && is_array(json_decode($order->items, true)) && (json_last_error() == JSON_ERROR_NONE))
                @php
                    $items = json_decode($order->items, true);
                    $items = array_filter($items, function($quantity, $itemId) {
                        return \App\Models\MenuItem::where('id', $itemId)->exists() ? \App\Models\MenuItem::find($itemId)->name : '';
                    }, ARRAY_FILTER_USE_BOTH);
                    
                @endphp

                @foreach($items as $itemId => $quantity)
                    @if($quantity !== null)
                        @php
                            $menuItem = \App\Models\MenuItem::find($itemId);
                        @endphp
                        @if($menuItem)
                            {{ $quantity }} x {{ $menuItem->name }}<br>
                        @else
                            <p>Item not found</p>
                        @endif
                    @endif
                @endforeach
                    <p>Status: {{ $order->status }}</p>
                @endif
                </p>
                <form action="{{ route('orders.destroy', $order) }}" method="POST" class="mt-2">
                @csrf
                @method('DELETE')
                <button type="submit" class=" bg-blue-500 cursor-pointer hover:bg-blue-700 text-white font-bold mt-10 py-2 px-4 rounded">Pickup Order</button>
                </form>
            </div> 
            @endforeach
        @endif
        <div>
    </div>
</div>



@yield("scripts")
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    setInterval(function(){
        location.reload();
    }, 3000); // Refresh page every 3 seconds
});
</script>


@endsection
