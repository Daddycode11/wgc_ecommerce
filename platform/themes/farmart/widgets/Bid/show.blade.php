@extends(Theme::getLayoutName())

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ RvMedia::getImageUrl($biddingItem->product->image, 'large', false, RvMedia::getDefaultImage()) }}" class="img-fluid rounded shadow-sm" alt="{{ $biddingItem->product->name }}">
        </div>
        <div class="col-md-6">
            <h3>{{ $biddingItem->product->name }}</h3>
            <p class="text-muted">{{ $biddingItem->product->description }}</p>

            <div class="mb-3">
                <span class="badge bg-success">Current Price: ₱{{ number_format($biddingItem->starting_price, 2) }}</span>
                <p>Ends on <strong>{{ $biddingItem->end_date->format('M d, Y h:i A') }}</strong></p>
            </div>

            @auth('customer')
            <form action="{{ route('public.bidding.placeBid', $biddingItem->id) }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input type="number" step="0.01" name="bid_amount" class="form-control" placeholder="Enter your bid amount" required>
                    <button type="submit" class="btn btn-primary">Place Bid</button>
                </div>
            </form>
            @else
                <a href="{{ route('customer.login') }}" class="btn btn-outline-primary">Login to Bid</a>
            @endauth
        </div>
    </div>
</div>
@endsection
