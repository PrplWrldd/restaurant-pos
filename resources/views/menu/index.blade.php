@extends('layouts.app')

@section('content')
<div class="container">
<style>
        h1 {
            color: #333;
            font-size: 2em;
            margin-bottom: 20px;
        }
        .card-body{
            padding: 20pxpx;
        }
        .card-body h5, .card-body p {
        margin-bottom: 5px; /* Reduce bottom margin */
     }
        .card {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
        }
        .card-title {
            font-size: 1.5em;
            color: #007bff;
        }
        .card-text {
            color: #333;
        }
        .form-control {
            margin-top: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: #ffffff;
            margin-top: 20px;
        }
    </style>
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
