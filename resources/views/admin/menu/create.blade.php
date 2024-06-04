@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center text-2xl font-black">Add new menu</h1>

    <form  class="space-y-2 flex flex-col items-center" action="{{ route('menu-items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-col">
            <label for="name">Name</label>
            <input type="text" placeholder="Nasi Goreng" name="name" class="w-60 p-1 border-2 border-gray-300 rounded-md" required>
        </div>
        <div class="flex flex-col">
            <label for="price">Price</label>
            <input type="number" placeholder="6" name="price" class="w-60 p-1 border-2 border-gray-300 rounded-md" required>
        </div>
        <div class="flex flex-col">
            <label for="description">Description</label>
            <textarea name="description" placeholder="Sangat sedap" class="w-60 p-1 border-2 border-gray-300 rounded-md"></textarea>
        </div>
        <div class="flex flex-col mx-auto">
            <label for="image">Image</label>
            <input type="file" class="w-60 p-1" name="image" >
        </div>
        <button type="submit" class="btn btn-primary w-60">Create</button>
    </form>
</div>
@endsection
