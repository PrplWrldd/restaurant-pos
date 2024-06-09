@extends("layouts.app")

@section("content")

<div >
    <div class="container">
        <p class="text-2xl font-bold text-center">Please pickup your order</p>
        <p class="text-xl font-light text-center">when your order is completed</p>
        <div class="flex flex-col m-10 py-4 px-10 border-2 justify-center rounded-lg ">
            <div class="flex flex-col">
            @foreach($orders as $order)   
            <div class="card-body">
                    <h5 class="card-title">Order #{{ $order->id }}</h5>
                    <p class="card-text">
                        @foreach(json_decode($order->items, true) as $itemId => $quantity)
                            {{ $quantity }} x {{ \App\Models\MenuItem::find($itemId)->name }}<br>
                        @endforeach
                    </p>
                </div>
            @endforeach
                <button class=" bg-blue-500 cursor-pointer hover:bg-blue-700 text-white font-bold mt-10 py-2 px-4 rounded">
                                I have picked up my order
                </button> 
                </div>
            </div>
            <div>
        </div>
    </div>
</div>
@endsection