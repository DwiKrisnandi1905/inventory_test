@extends('layout.app')

@section('content')
<div class="container">
    <h1>Inventory</h1>
    <a href="{{ route('items.create') }}" class="btn btn-primary">Add New Item</a>
    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-2">
            {{ $message }}
        </div>
    @endif
    <table class="table table-bordered mt-3">
        <tr>
            <th>Name</th>
            <th>Quantity</th>
            <th>Description</th>
            <th>Status</th>
            <th width="380px">Action</th>
        </tr>
        @foreach ($items as $item)
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ $item->description }}</td>
            <td>
                <span class="badge {{ $item->status == 'accepted' ? 'bg-success' : ($item->status == 'rejected' ? 'bg-danger' : 'bg-secondary') }}">
                    {{ ucfirst($item->status) }}
                </span>
            </td>
            <td>
                <a class="btn btn-info" href="{{ route('items.show', $item->id) }}">Show</a>
                <a class="btn btn-primary {{ $item->status == 'accepted' ? 'disabled' : '' }}" href="{{ route('items.edit', $item->id) }}">Edit</a>
                
                <button class="btn btn-danger" onclick="confirmDelete('{{ route('items.destroy', $item->id) }}')">Delete</button>
                
                @if ($item->status != 'accepted')
                <button class="btn btn-success" onclick="confirmAction('{{ route('items.verify', $item->id) }}', 'accepted')">Accept</button>
                @endif
                
                @if ($item->status != 'accepted')
                <button class="btn btn-warning" onclick="confirmAction('{{ route('items.verify', $item->id) }}', 'rejected')">Reject</button>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
</div>
<script>
    function confirmAction(url, status) {
        Swal.fire({
            title: 'Are you sure?',
            text: `You are about to mark this item as ${status}.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, do it!'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.action = url;
                form.method = 'POST';
                form.innerHTML = `
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="${status}">
                `;
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    function confirmDelete(url) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.action = url;
                form.method = 'POST';
                form.innerHTML = `
                    @csrf
                    @method('DELETE')
                `;
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>
@endsection
