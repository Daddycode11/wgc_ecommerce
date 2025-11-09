<div class="bidding-catalog container py-4">
    <h2 class="text-center mb-4">🔥 Active Bidding Items</h2>

    <div class="row">
        @forelse($bids as $bid)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    {{-- Image --}}
                    @if($bid->image)
                        <img src="{{ Storage::url($bid->image) }}" 
                             class="card-img-top" 
                             alt="{{ $bid->title }}" 
                             style="height:200px; object-fit:cover;">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height:200px;">
                            <span class="text-muted">No Image</span>
                        </div>
                    @endif

                    {{-- Card Body --}}
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $bid->product->name ?? $bid->title }}</h5>
                        <p class="card-text mb-1">
                            <strong>Starting Price:</strong> ₱{{ number_format($bid->starting_price, 2) }}
                        </p>
                        <p class="card-text mb-1">
                            <strong>Min Increment:</strong> ₱{{ number_format($bid->min_bid_increment, 2) }}
                        </p>
                        <p class="card-text mb-2">
                            <strong>Highest Bid:</strong> ₱{{ number_format(optional($bid->highestBid)->amount ?? 0, 2) }}
                        </p>

                     
                        <a href="#" class="btn btn-primary mt-auto w-100">View / Bid</a>
                    </div>
                </div>
            </div>

         

        @empty
            <div class="col-12 text-center text-muted">
                <p>No active bidding items at the moment.</p>
            </div>
        @endforelse
    </div>
</div>
