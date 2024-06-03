@extends("layouts.app")
<head>
    <title>Restaurant Pos</title>
    @vite("resources/css/app.css")
</head>

@section("content")
    <div class="py-5">
        <h1 class="text-4xl font-black">Your favorite dishes</h1>
        <div class="carousel carousel-center md:w-full w-full rounded-box flex gap-2 text-center py-5 cursor-pointer">
            @foreach ($favDishes as $dish)
                <div class="carousel-item flex flex-col px-3 py-5 overflow-hidden">
                    <img
                        src="{{ asset($dish["image"]) }}"
                        alt="foods"
                        class="size-28 rounded-full"
                    />
                    <h5 class="font-medium">{{ $dish["name"] }}</h5>
                </div>
            @endforeach
        </div>

        <h1 class="text-4xl font-black">All Menu</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-5 gap-3 py-5">
            @foreach ($menuItems as $item)
                <div
                    class="flex flex-col justify-between overflow-hidden rounded-md bg-orange-50 p-3"
                >
                    <img
                        src="{{ asset($item["image"]) }}"
                        class="h-52 transform overflow-hidden rounded-lg transition duration-300 ease-in-out hover:scale-105 object-cover"
                        alt="{{ $item["name"] }}"
                    />
                    <div class="flex justify-between p-3">
                        <div class="flex flex-col">
                            <h4 class="font-semibold max-w-36">{{ $item["name"] }}</h4>
                            <p>{{ $item["price"] }}</p>
                        </div>
                        <p class="text-xs">{{ $item["rating"] }}/5</p>
                    </div>
                    <button
                        class="2/3 cursor-pointer rounded-lg bg-orange-400 p-3 text-center hover:bg-orange-400/70"
                    >
                        Order
                    </button>
                </div>
            @endforeach
        </div>
    </div>
@endsection
