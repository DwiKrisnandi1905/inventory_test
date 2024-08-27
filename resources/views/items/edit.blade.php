@extends('layout.app')

@section('content')
<div class="container">
    <h1>Edit Item</h1>
    <form action="{{ route('items.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Item Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ $item->name }}" {{ $item->status == 'accepted' ? 'disabled' : '' }} required>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" name="quantity" class="form-control" id="quantity" value="{{ $item->quantity }}" {{ $item->status == 'accepted' ? 'disabled' : '' }} required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="description" {{ $item->status == 'accepted' ? 'disabled' : '' }}>{{ $item->description }}</textarea>
        </div>
        @if($item->status != 'accepted')
        <button type="submit" class="btn btn-primary">Update</button>
        @endif
    </form>
</div>
@endsection
