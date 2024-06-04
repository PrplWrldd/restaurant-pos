@extends('layouts.app')

@section('content')
<div class="container">
<style>
        .container {
            font-family: Arial, sans-serif;
        }
        h1 {
            color: #333;
        }
        .btn-primary {
        background-color: green;
        color: #ffffff;
        text-decoration: none;
        padding: 10px 20px; /* Add padding */
        border-radius: 5px; /* Rounded corners */
        transition: background-color 0.3s ease; /* Transition effect */
        }
        .btn-primary:hover {
            background-color: darkgreen; /* Darker shade when hovered */
        }
        .table {
            width: 100%;
            margin-top: 20px;
        }
        .table th {
            background-color: #f8f9fa;
            color: #212529;
        }
        .table td {
            padding: 10px;
        }
        .btn-warning, .btn-danger {
        text-decoration: none;
        color: #ffffff; /* White text */
        padding: 10px 20px; /* Add padding */
        border-radius: 5px; /* Rounded corners */
        transition: background-color 0.3s ease; /* Transition effect */
        }
        .btn-warning {
            background-color: #ffc107;
        }
        .btn-warning:hover {
            background-color: #cc8e00; /* Darker shade when hovered */
        }
        .btn-danger {
            background-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #b02a37; /* Darker shade when hovered */
        }
    </style>
    <h1 class="text-2xl font-black ">Menu Items</h1>
<a href="{{ route('menu-items.create') }}" class="btn btn-primary mb-3">Add New Menu Item</a>

@if($menuItems->isEmpty())
    <p>No menu items available.</p>
@else
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($menuItems as $menuItem)
                <tr>
                    <td>{{ $menuItem->name }}</td>
                    <td>{{ $menuItem->price }}</td>
                    <td>{{ $menuItem->description }}</td>
                    <td>
                        @if($menuItem->image_path)
                            <img src="{{ Storage::url($menuItem->image_path) }}" alt="{{ $menuItem->name }}" class="img-thumbnail" style="width: 100px;">
                        @endif
                    </td>
                    <td>
                        <div class="flex flex-col md:flex-row gap-1">
                            <a href="{{ route('menu-items.edit', $menuItem->id) }}" class="btn btn-warning w-24">Edit</a>
                        <form action="{{ route('menu-items.destroy', $menuItem->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-24">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="btn btn-primary">Logout</button>
</form>
        </tbody>
    </table>
@endif
</div>
@endsection
