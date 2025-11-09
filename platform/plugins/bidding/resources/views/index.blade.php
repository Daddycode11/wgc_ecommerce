@extends('core/base::layouts.master')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">🪙 Bidding Systems</h4>
        <a href="{{ route('bidding-system.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Create New
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Product</th>
                        <th>Starting Price</th>
                        <th>Min Increment</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($biddingSystems as $bidding)
                        <tr>
                            <td>
                                @if($bidding->image)
                                    <img src="{{ Storage::url($bidding->image) }}" alt="Bidding Image" style="height:50px; width:auto;">
                                @else
                                    —
                                @endif
                            </td>
                            <td>{{ $bidding->title }}</td>
                            <td>{{ $bidding->product->name ?? '—' }}</td>
                            <td>₱{{ number_format($bidding->starting_price, 2) }}</td>
                            <td>₱{{ number_format($bidding->min_bid_increment, 2) }}</td>
                            <td>
                                <form action="{{ route('bidding-system.update', $bidding->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="is_published" value="{{ $bidding->is_published ? 0 : 1 }}">
                                    <button class="btn btn-sm {{ $bidding->is_published ? 'btn-success' : 'btn-secondary' }}">
                                        {{ $bidding->is_published ? 'Published' : 'Unpublished' }}
                                    </button>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('bidding-system.edit', $bidding->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $bidding->id }}">
                                    <i class="fa fa-trash"></i>
                                </button>

                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="deleteModal{{ $bidding->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirm Delete</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete <strong>{{ $bidding->title }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('bidding-system.destroy', $bidding->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal -->
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No bidding systems found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
