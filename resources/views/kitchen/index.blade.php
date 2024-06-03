@extends('layouts.app')

@section('content')

<style>
    .card {
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 20px;
        padding: 15px;
    }
    .card-title {
        font-size: 20px;
        font-weight: bold;
    }
    .card-text {
        font-size: 16px;
    }
    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
    }
    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }
    .btn-danger {
        background-color: red;
        border-color: #dc3545;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
    }
    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }
</style>
<div class="container">
    <h1>Orders</h1>
    @if($orders->isEmpty())
        <p>No orders available.</p>
    @else
        @foreach($orders as $order)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Order #{{ $order->id }}</h5>
                    <p class="card-text">
                        @if(is_string($order->items) && is_array(json_decode($order->items, true)) && (json_last_error() == JSON_ERROR_NONE))
                            @foreach(json_decode($order->items, true) as $itemId => $quantity)
                                {{ $quantity }} x {{ \App\Models\MenuItem::find($itemId)->name }}<br>
                            @endforeach
                            <p>Status: {{ $order->status }}</p>
                        @endif
                    </p>
                    <form action="{{ route('orders.update', $order) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success">Mark as Completed</button>
                    </form>
                    <form action="{{ route('orders.destroy', $order) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Order</button>
                </form>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection


@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
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