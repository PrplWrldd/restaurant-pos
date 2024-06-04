
@extends('layouts.app')

@section('content')
<style>
    .container {
        width: 80%;
        margin: auto;
        padding: 20px;
    }

    .card {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        border-radius: 5px;
    }

    .card-body {
        padding: 20px;
    }
</style>
<div class="container">
    <h1>Completed Orders</h1>
    @if($completedOrders->isEmpty())
        <p>No completed orders available.</p>
    @else
        @foreach($completedOrders as $order)
            @if($order->status == 'completed')
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Order #{{ $order->id }}</h5>
                        <p class="card-text">
                        @if(is_string($order->items) && is_array(json_decode($order->items, true)) && (json_last_error() == JSON_ERROR_NONE))
                            @php
                                $items = json_decode($order->items, true);
                                $items = array_filter($items, function($itemId) {
                                    return \App\Models\MenuItem::find($itemId) !== null;
                                });
                            @endphp
                            @foreach($items as $itemId => $quantity)
                                @php
                                    $menuItem = \App\Models\MenuItem::find($itemId);
                                @endphp
                                @if($menuItem)
                                    {{ $quantity }} x {{ $menuItem->name }}<br>
                                @else
                                    <p>Item not found</p>
                                @endif
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