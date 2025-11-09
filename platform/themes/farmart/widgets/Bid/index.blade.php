@extends(Theme::getLayoutName())

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center fw-bold">🛍️ Active Bidding Items</h2>
    <div class="row">
        @forelse($biddingItems as $item)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <img src="{{ RvMedia::getImageUrl($item->product->image, 'medium', false, RvMedia::getDefaultImage()) }}" class="card-img-top" alt="{{ $item->product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->product->name }}</h5>
                        <p class="text-muted mb-1">Current Bid: <strong>₱{{ number_format($item->starting_price, 2) }}</strong></p>
                        <p class="small text-muted mb-2">Ends on: {{ $item->end_date->format('M d, Y h:i A') }}</p>
                        <a href="{{ route('public.bidding.show', $item->product->slug) }}" class="btn btn-primary w-100 mt-2">View & Bid</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">No active bidding items right now. Check back later!</p>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $biddingItems->links() }}
    </div>
</div>
@endsection
