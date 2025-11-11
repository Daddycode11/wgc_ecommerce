@extends('core/base::layouts.master')

@section('content')
<div class="container-fluid">
    <h4 class="fw-bold mb-4">✏️ Edit Bidding System</h4>

    <form action="{{ route('bidding-system.update', $bidding_system->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card p-4 shadow-sm">
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ $bidding_system->title }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Product</label>
                <select name="product_id" class="form-select" required>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ $bidding_system->product_id == $product->id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Starting Price</label>
                <input type="number" step="0.01" name="starting_price" class="form-control" value="{{ $bidding_system->starting_price }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Minimum Bid Increment</label>
                <input type="number" step="0.01" name="min_bid_increment" class="form-control" value="{{ $bidding_system->min_bid_increment }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Upload Image</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                @if($bidding_system->image)
                    <img src="{{ Storage::url($bidding_system->image) }}" alt="Current Image" class="mt-2" style="max-height: 150px;">
                @endif
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" name="is_published" id="is_published" {{ $bidding_system->is_published ? 'checked' : '' }}>
                <label class="form-check-label" for="is_published">Published</label>
            </div>

            
            <div class="form-check mb-3">
                <input type="datetime-local" class="form-control" name="end_time" id="end_time" value="{{ $bidding_system->end_time }}">
                <label class="form-check-label" for="end_time">End Date</label>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('bidding-system.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </div>
    </form>
</div>
@endsection
