@extends('layouts.appadmin')

@section('content')
<div class="container">
    <h1 class="font-black text-2xl text-center">Edit Menu</h1>

    <form class="flex flex-col items-center" action="{{ route('menu-items.update', $menuItem->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="flex flex-col">
            <label for="name">Name</label>
            <input type="text"  name="name" class="w-60 p-1 border-2 border-gray-300 rounded-md" value="{{ $menuItem->name }}" required>
        </div>
        <div class="flex flex-col">
            <label for="price">Price</label>
            <input type="number" name="price" class="w-60 p-1 border-2 border-gray-300 rounded-md" value="{{ $menuItem->price }}" required>
        </div>
        <div class="flex flex-col">
            <label for="description">Description</label>
            <textarea name="description" class="w-60 p-1 border-2 border-gray-300 rounded-md">{{ $menuItem->description }}</textarea>
        </div>
        <div class="flex flex-col">
            <label for="image">Image</label>
            <input type="file" name="image" class="w-60 p-1 border-2 border-gray-300 rounded-md">
            @if($menuItem->image_path)
                <img  src="{{ Storage::url($menuItem->image_path) }}" alt="{{ $menuItem->name }}" class="img-thumbnail p-2 " style="width: 150px;">
            @endif
        </div>
        <button type="submit" class="btn btn-primary w-60">Update</button>
    </form>
</div>
@endsection
