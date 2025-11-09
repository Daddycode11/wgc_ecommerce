@if($biddingItems->count() > 0)
<section class="bidding-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">🔥 Live Bidding Items</h2>
            <p class="text-muted">Place your bids before time runs out!</p>
        </div>

        <div class="row g-4">
            @foreach($biddingItems as $item)
                <div class="col-md-4">
                    <div class="card shadow-sm h-100 border-0">
                        <img src="{{ RvMedia::getImageUrl($item->product->image, 'medium', false, RvMedia::getDefaultImage()) }}" 
                             class="card-img-top" 
                             alt="{{ $item->product->name }}">

                        <div class="card-body d-flex flex-column">
                            <h5 class="fw-bold mb-1">{{ $item->product->name }}</h5>
                            <p class="text-muted small flex-grow-1">{{ Str::limit($item->product->description, 80) }}</p>

                            <div class="mt-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-semibold text-success">
                                        ₱{{ number_format($item->starting_price, 2) }}
                                    </span>
                                    <span class="text-danger small">
                                        ⏰ <span id="timer-{{ $item->id }}">Loading...</span>
                                    </span>
                                </div>
                            </div>

                            <a href="{{ route('public.bidding.show', $item->product->slug) }}" 
                               class="btn btn-primary btn-sm w-100 mt-3">
                               Place Bid
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function() {
    @foreach($biddingItems as $item)
        const endDate{{ $item->id }} = new Date("{{ $item->end_date->format('Y-m-d H:i:s') }}").getTime();
        const timerEl{{ $item->id }} = document.getElementById("timer-{{ $item->id }}");

        function updateTimer{{ $item->id }}() {
            const now = new Date().getTime();
            const distance = endDate{{ $item->id }} - now;

            if (distance <= 0) {
                timerEl{{ $item->id }}.innerText = "Ended";
                timerEl{{ $item->id }}.classList.add("text-danger");
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            timerEl{{ $item->id }}.innerText = 
                `${days}d ${hours}h ${minutes}m ${seconds}s`;
        }

        updateTimer{{ $item->id }}();
        setInterval(updateTimer{{ $item->id }}, 1000);
    @endforeach
});
</script>
@endif
