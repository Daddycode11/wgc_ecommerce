<section class="container py-5">
    <h2 class="text-center mb-4 fw-bold text-primary">🔥 Active Bidding Items</h2>

    @if ($bids->isEmpty())
        <p class="text-center text-muted">No active bids at the moment. Please check back later.</p>
    @else
        <div class="row g-4">
            @foreach ($bids as $bid)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                    <div class="ps-product--standard shadow-sm rounded-3 p-3">
                        <div class="ps-product__thumbnail">
                            <a href="{{ route('bidding.details', $bid->id) }}">
                                <img src="{{ RvMedia::getImageUrl(optional($bid->product)->image, 'medium') }}"
                                     alt="{{ optional($bid->product)->name }}" class="img-fluid rounded">
                            </a>
                        </div>
                        <div class="ps-product__content mt-3">
                            <h5 class="fw-semibold mb-2">
                                <a href="{{ route('bidding.details', $bid->id) }}">
                                    {{ optional($bid->product)->name }}
                                </a>
                            </h5>
                            <p class="mb-1 small text-muted">
                                Starting Price:
                                <strong class="text-success">₱{{ number_format($bid->starting_price, 2) }}</strong>
                            </p>
                            <p class="text-danger countdown" data-end="{{ $bid->end_time }}">
                                ⏰ Ends in: <span>--</span>
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
    @endif
</section>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.countdown').forEach(function(el) {
        const end = new Date(el.dataset.end).getTime();
        const span = el.querySelector('span');
        const tick = setInterval(() => {
            const now = new Date().getTime();
            const diff = end - now;
            if (diff <= 0) {
                clearInterval(tick);
                span.textContent = "Expired";
                return;
            }
            const d = Math.floor(diff / (1000 * 60 * 60 * 24));
            const h = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const s = Math.floor((diff % (1000 * 60)) / 1000);
            span.textContent = `${d}d ${h}h ${m}m ${s}s`;
        }, 1000);
    });
});
</script>