@extends('layouts.appadmin')

@section('content')
<div class=" mt-5">
    <h1 class="pl-10 text-3xl font-bold mb-6">Orders</h1>
    <div class="pl-10 text-lg mb-4">Total Orders: {{ $orders->count() }}</div>
    <div>
        @if (session()->has('message'))
            <div id="flashmessage" class="flex justify-between p-4 rounded-lg bg-red-500 text-white">
                {{ session('message') }}
                <button id="close-session-message" class="flex pr- text-xl font-bold">&times;</button>
            </div>
            </div>
        @endif
    </div>
    @if($orders->isEmpty())
        <p class="text-gray-500">No orders available.</p>
    @else
        @foreach($orders as $order)
        <div class="flex m-4 px-10 py-2 flex-col rounded-lg border-2 ">
        <ul class="flex justify-around ">
           <li><div class="card-body">
                    <h5 class="card-title text-xl font-bold">Order #{{ $order->id }}</h5>
                    <p class="card-text text-lg mt-2">
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

                            <p class="mt-2">Status: {{ $order->status }}</p>
                        @endif
                    </p>
            </li >
                   <li class="flex flex-col p-10">
                     <form action="{{ route('orders.update', $order) }}" method="POST" >
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn-success w-44 rounded-lg p-2 border-2 border-green-400 hover:bg-green-400 hover:text-white">Mark as Complete</button>
                    </form>
                    <form action="{{ route('orders.destroy', $order) }}" method="POST" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger w-44 rounded-lg p-2 border-2 border-red-400 hover:bg-red-400 hover:text-white">Delete Order</button>
                    </form>
                </li>
                </div>                           
        </ul>       
        @endforeach
    @endif
</div>
</div>


@yield("scripts")
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        // Hide session message after 3 seconds
        setTimeout(function(){
            $('#flashmessage').fadeOut('slow');
        }, 3000); // 3000ms = 3 seconds
        
        $('.complete-order').on('click', function(){
            let orderId = $(this).data('order-id');
            let card = $(this).closest('.order-card');

            $.ajax({
                url: `/orders/${orderId}/complete`,
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if(response.success) {
                        card.remove();
                        alert(response.message);
                    }
                }
            });
        });
    });
</script>

@endsection
