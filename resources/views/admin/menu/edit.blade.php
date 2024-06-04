@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Menu Item</h1>

    <form action="{{ route('menu-items.update', $menuItem->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $menuItem->name }}" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" class="form-control" value="{{ $menuItem->price }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control">{{ $menuItem->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control">
            @if($menuItem->image_path)
                <img src="{{ Storage::url($menuItem->image_path) }}" alt="{{ $menuItem->name }}" class="img-thumbnail mt-2" style="width: 150px;">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
