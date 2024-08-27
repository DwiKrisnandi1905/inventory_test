@extends('layout.app')

@section('content')
<div class="container">
    <h1>Item Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $item->name }}</h5>
            <p class="card-text">Quantity: {{ $item->quantity }}</p>
            <p class="card-text">Description: {{ $item->description }}</p>
            <p class="card-text">
                Status: 
                <span class="badge {{ $item->status == 'accepted' ? 'bg-success' : ($item->status == 'rejected' ? 'bg-danger' : 'bg-secondary') }}">
                    {{ ucfirst($item->status) }}
                </span>
            </p>
            <a href="{{ route('items.index') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
</div>
@endsection
