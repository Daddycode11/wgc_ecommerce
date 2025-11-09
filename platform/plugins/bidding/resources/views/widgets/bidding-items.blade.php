@if($bids->count())
<section class="section--bidding py-5">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-uppercase text-primary">🔥 Active Bidding Items</h2>
        </div>

        <div class="row">
            @foreach($bids as $bid)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="{{ RvMedia::getImageUrl(optional($bid->product)->image, 'medium', false, RvMedia::getDefaultImage()) }}"
                             class="card-img-top rounded-top"
                             alt="{{ optional($bid->product)->name }}">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-semibold">{{ optional($bid->product)->name }}</h5>
                            <p class="text-muted small mb-2">
                                Starting at ₱{{ number_format($bid->starting_price, 2) }}
                            </p>
                            <p class="text-muted small">
                                Ends at {{ $bid->end_date ? $bid->end_date->format('M d, Y h:i A') : '—' }}
                            </p>

                            <div class="countdown text-danger fw-bold" data-end="{{ $bid->end_date }}"></div>

                            <a href="{{ route('public.bidding.show', $bid->id) }}" class="btn btn-sm btn-primary mt-3">
                                Place a Bid
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@push('scripts')
<script>
document.querySelectorAll('.countdown').forEach(el => {
    const end = new Date(el.dataset.end).getTime();
    const update = () => {
        const now = new Date().getTime();
        const diff = end - now;
        if (diff <= 0) { el.textContent = 'Bidding Closed'; return; }

        const d = Math.floor(diff / (1000*60*60*24));
        const h = Math.floor((diff % (1000*60*60*24)) / (1000*60*60));
        const m = Math.floor((diff % (1000*60*60)) / (1000*60));
        const s = Math.floor((diff % (1000*60)) / 1000);
        el.textContent = `${d}d ${h}h ${m}m ${s}s`;
    };
    update();
    setInterval(update, 1000);
});
</script>
@endpush
@endif
