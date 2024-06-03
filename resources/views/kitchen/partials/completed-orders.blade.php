@if($completedOrders->isEmpty())
    <p>No completed orders available.</p>
@else
    @foreach($completedOrders as $order)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Order #{{ $order->id }}</h5>
                <p class="card-text">
                    @foreach(json_decode($order->items, true) as $itemId => $quantity)
                        {{ $quantity }} x {{ \App\Models\MenuItem::find($itemId)->name }}<br>
                    @endforeach
                </p>
            </div>
        </div>
    @endforeach
@endif
