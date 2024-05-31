@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Menu</h1>
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div class="row">
            @foreach($menuItems as $menuItem)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $menuItem->name }}</h5>
                            <p class="card-text">{{ $menuItem->description }}</p>
                            <p class="card-text">${{ $menuItem->price }}</p>
                            <input type="number" name="items[{{ $menuItem->id }}]" class="form-control" placeholder="Quantity">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Place Order</button>
    </form>
</div>
@endsection
