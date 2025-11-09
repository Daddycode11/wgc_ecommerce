@php
use Carbon\Carbon;
@endphp

<section class="section--bidding-products container py-5">
    <h2 class="text-center mb-4 fw-bold text-primary">
        🔥 Active Bidding Items
    </h2>

    <div class="row g-4">
        @foreach ($bids as $bid)
            @php
                $timeLeft = Carbon::parse($bid->end_time)->diffInSeconds(now(), false);
            @endphp
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                <div class="ps-product--standard shadow-sm rounded-3 p-3 position-relative">
                    <div class="ps-product__thumbnail">
                        <a href="{{ route('bidding.details', $bid->id) }}">
                            <img src="{{ RvMedia::getImageUrl($bid->product->image, 'medium') }}"
                                 alt="{{ $bid->product->name }}" class="img-fluid rounded">
                        </a>
                    </div>

                    <div class="ps-product__content mt-3">
                        <h5 class="fw-semibold mb-2 text-dark">
                            <a href="{{ route('bidding.details', $bid->id) }}">{{ $bid->product->name }}</a>
                        </h5>
                        <p class="mb-1 text-muted small">
                            Starting Bid: <strong class="text-success">₱{{ number_format($bid->starting_price, 2) }}</strong>
                        </p>

                        {{-- Live Countdown --}}
                        <p class="mb-2 fw-semibold text-danger countdown-timer"
                           data-end="{{ $bid->end_time }}">
                           ⏰ Ends in: <span>loading...</span>
                        </p>

                        <a href="{{ route('bidding.details', $bid->id) }}" 
                           class="btn btn-primary w-100 rounded-pill">
                           <i class="bi bi-hammer"></i> Place a Bid
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

{{-- 🕒 Countdown Script --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.countdown-timer').forEach(function(timer) {
        const endTime = new Date(timer.dataset.end).getTime();
        const span = timer.querySelector('span');

        const interval = setInterval(() => {
            const now = new Date().getTime();
            const diff = endTime - now;

            if (diff <= 0) {
                clearInterval(interval);
                span.textContent = "Bidding ended";
                return;
            }

            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((diff % (1000 * 60)) / 1000);

            span.textContent = `${days}d ${hours}h ${minutes}m ${seconds}s`;
        }, 1000);
    });
});
</script>
