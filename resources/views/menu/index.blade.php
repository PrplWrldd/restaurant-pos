@extends("layouts.app")


@section("content")
    <div class="container">
        <h1 class="p-4 text-2xl font-black">All Menu</h1>
        <div class="grid grid-cols-1 gap-3 py-5 md:grid-cols-3 xl:grid-cols-4">
            @foreach ($menuItems as $item)
                <div
                    class="flex flex-col justify-between overflow-hidden rounded-md bg-orange-50 p-3"
                >
                    @if ($item->image_path)
                        <img
                            src="{{ asset('storage/' . $item->image_path) }}"
                            class="h-52 transform overflow-hidden rounded-lg object-cover transition duration-300 ease-in-out hover:scale-105"
                        />
                    @endif

                    <div class="flex justify-between p-3">
                        <div class="flex flex-col">
                            <h4 class="max-w-36 font-semibold">
                                {{ $item->name }}
                            </h4>
                            <p>RM{{ $item->price }}</p>
                        </div>
                        <p class="text-xs">{{ $item->description }}</p>
                    </div>

                    <form
                        action="{{ route('orders.store') }}"
                        method="POST"
                        class="mt-3"
                    >
                        @csrf
                        <input
                            type="number"
                            name="items[{{ $item->id }}]"
                            class='form-control'
                            placeholder="Quantity"
                        />
                    
                </div>
            @endforeach
            
        </div>
        <button
        type="submit"
        class="w-full font-medium cursor-pointer rounded-lg bg-orange-400 p-3 text-center hover:bg-orange-400/70"                                       >
        Place order
        </button>
        </form>

    </div>

@endsection
