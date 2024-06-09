@extends("layouts.app")

<head>
    @vite("resources/css/app.css")
</head>

@section("content")
    <div class="mx-auto p-3 text-center">
        <h1 class="text-4xl font-medium">Order Checkout</h1>
        <div class="flex flex-col justify-around gap-5 p-5 md:flex-row">
            <div
                class="flex w-full flex-col items-center gap-2 p-3 md:border-r"
            >
                <h3 class="text-2xl">Order Summary</h3>
                @if ($orders->isEmpty())
                    <p class="text-gray-500">No orders available.</p>
                @else
                    @foreach ($orders as $order)
                        `
                        <div
                            class="flex h-40 w-full justify-around border-b p-5 shadow-sm"
                        >
                            <div class="flex w-full justify-around gap-1">
                                @if (is_string($order->items) && is_array(json_decode($order->items, true)) && json_last_error() == JSON_ERROR_NONE)
                                    @php
                                        $items = json_decode($order->items, true);
                                        $items = array_filter(
                                            $items,
                                            function ($quantity, $itemId) {
                                                return \App\Models\MenuItem::where("id", $itemId)->exists() ? \App\Models\MenuItem::find($itemId)->name : "";
                                            },
                                            ARRAY_FILTER_USE_BOTH,
                                        );
                                    @endphp

                                    @foreach ($items as $itemId => $quantity)
                                        @if ($quantity !== null)
                                            @php
                                                $menuItem = \App\Models\MenuItem::find($itemId);
                                            @endphp

                                            @if ($menuItem)
                                                <div class="flex gap-3">
                                                    <img
                                                    src="{{ asset('storage/' . $menuItem->image_path) }}"
                                                        class="w-40 rounded-lg object-cover"
                                                        alt="order"
                                                    />
                                                    <div
                                                        class="flex flex-col justify-between"
                                                    >
                                                        <p>
                                                            {{ $menuItem->name }}
                                                        </p>
                                                        <p class="italic">
                                                            Qty:
                                                            {{ $quantity }}
                                                        </p>
                                                        <br />
                                                    </div>
                                                </div>
                                            @else
                                                <p>Item not found</p>
                                            @endif
                                        @endif
                                    @endforeach
                                @endif

                                <p>RM{{ $order->total_price }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
                <p class="self-end text-lg font-medium">
                    Total due: RM{{ $orders->sum("total_price") }}
                </p>
            </div>
            <div class="flex w-full flex-col items-center gap-2 p-3">
                <h3 class="text-2xl">Select payment method</h3>
                <a
                    href="{{ route("orders.userOrders") }}"
                    class="flex h-32 w-full cursor-pointer items-center justify-around rounded-lg border"
                >
                    Pay at counter
                    <img
                        class="w-24 rounded-lg"
                        src="/counter.jpg"
                        alt="counter"
                    />
                </a>
                <div
                    class="flex h-32 w-full cursor-pointer items-center justify-around rounded-lg border"
                >
                    FPX payment
                    <img class="w-24 rounded-lg" src="/fpx.jpg" alt="fpx" />
                </div>
            </div>
        </div>
    </div>
@endsection
