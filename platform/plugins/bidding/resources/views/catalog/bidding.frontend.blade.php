<div class="bidding-catalog container py-4">
    <h2 class="text-center mb-4">🔥 Active Bidding Items</h2>
    <div class="row">
        @forelse($bids as $bid)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    @if($bid->image)
                        <img src="{{ Storage::url($bid->image) }}" class="card-img-top" style="height:200px;object-fit:cover;">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $bid->title }}</h5>
                        <p class="card-text">
                            Product: {{ $bid->product->name ?? 'No Product' }}<br>
                            Starting Price: ₱{{ number_format($bid->starting_price, 2) }}<br>
                            Min Increment: ₱{{ number_format($bid->min_bid_increment, 2) }}
                        </p>
                        @php
                            $highest = $bid->highestBid ? $bid->highestBid->amount : $bid->starting_price;
                        @endphp
                        <p><strong>Current Bid:</strong> ₱{{ number_format($highest, 2) }}</p>
                        <p><strong>Time Left:</strong> <span class="countdown" data-end="{{ $bid->end_time }}"></span></p>
                        <a href="#" class="btn btn-primary mt-auto w-100">Place Bid</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">No active bidding items.</div>
        @endforelse
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    function updateCountdown() {
        document.querySelectorAll('.countdown').forEach(function(span){
            const end = new Date(span.dataset.end);
            const now = new Date();
            const diff = end - now;
            if(diff <= 0){
                span.textContent = "Ended";
            } else {
                const h = Math.floor(diff/3600000);
                const m = Math.floor((diff%3600000)/60000);
                const s = Math.floor((diff%60000)/1000);
                span.textContent = h + "h " + m + "m " + s + "s";
            }
        });
    }
    setInterval(updateCountdown, 1000);
    updateCountdown();
});
</script>
