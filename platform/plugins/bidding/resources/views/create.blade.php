@extends('core/base::layouts.master')

@section('content')
<div class="container-fluid">
    <h4 class="fw-bold mb-4">➕ Create Bidding System</h4>

    <form action="{{ route('bidding-system.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card p-4 shadow-sm">
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Product</label>
                <select name="product_id" class="form-select" required>
                    <option value="">Select Product</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Starting Price</label>
                <input type="number" step="0.01" name="starting_price" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Minimum Bid Increment</label>
                <input type="number" step="0.01" name="min_bid_increment" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Upload Image</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" name="is_published" id="is_published">
                <label class="form-check-label" for="is_published">Publish immediately</label>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('bidding-system.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-success">Create</button>
            </div>
        </div>
    </form>
</div>
@endsection
