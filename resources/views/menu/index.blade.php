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
    @foreach($menuItems as $item)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $item->name }}</h5>
                <p class="card-text">{{ $item->description }}</p>
                <p class="card-text">${{ $item->price }}</p>
                @if($item->image_path)
                    <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" class="img-fluid">
                @endif
                <form action="{{ route('orders.store') }}" method="POST" class="mt-3">
                    @csrf
                    <input type="hidden" name="items[{{ $item->id }}]" value="1">
                    <button type="submit" class="btn btn-primary">Order</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection