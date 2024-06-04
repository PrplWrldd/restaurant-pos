
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="ml-4 text-3xl font-bold mb-6">Completed Orders</h1>
    
    @if($completedOrders->isEmpty())
        <p>No completed orders available.</p>
    @else
        @foreach($completedOrders as $order)
            @if($order->status == 'completed')
                <div class="card flex m-4 px-20 py-10 flex-col rounded-lg border-2 ">
                    <div class="card-body">
                        <h5 class="card-title font-semibold text-xl">Order #{{ $order->id }}</h5>
                        <p class="card-text">
                        @if(is_string($order->items) && is_array(json_decode($order->items, true)) && (json_last_error() == JSON_ERROR_NONE))
                            @php
                                $items = json_decode($order->items, true);
                                $items = array_filter($items, function($itemId) {
                                    return \App\Models\MenuItem::find($itemId) !== null;
                                });
                            @endphp
                            @foreach($items as $itemId => $quantity)
                                {{ $quantity }} x {{ \App\Models\MenuItem::find($itemId)->name }}<br>
                            @endforeach
                            <p>Status: {{ $order->status }}</p>
                        @endif
                        </p>
                    </div>
                </div>
            @endif
        @endforeach
    @endif

    
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function fetchCompletedOrders() {
        $.ajax({
            url: '{{ route('orders.completed') }}',
            type: 'GET',
            success: function(data) {
                $('#completed-orders').html(data);
            }
        });
    }

    $(document).ready(function(){
        fetchCompletedOrders();
        setInterval(fetchCompletedOrders, 5000); // Refresh every 5 seconds
    });
</script>
@endsection