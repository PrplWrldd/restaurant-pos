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
        .btn-warning {
            background-color: #ffc107;
        }
        .btn-danger {
            background-color: #dc3545;
        }
    </style>
    <h1>Menu Items</h1>
    <a href="{{ route('menu-items.create') }}" class="btn btn-primary">Add New Item</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
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
                        <a href="{{ route('menu-items.edit', $menuItem) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('menu-items.destroy', $menuItem) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
