<div class="raffle-catalog container py-4">
    <h2 class="text-center mb-4">{{ $title ?? __('🎉 Featured Raffles') }}</h2>

    <div class="row">
        @forelse($raffles as $raf)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">

                    {{-- Prize Image --}}
                    @if($raf->prize_image)
                        <img src="{{ Storage::url($raf->prize_image) }}" class="card-img-top" alt="{{ $raf->event_name }}" style="height:200px; object-fit:cover;">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height:200px;">
                            <span class="text-muted">{{ __('No Image') }}</span>
                        </div>
                    @endif

                    {{-- Card Body --}}
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $raf->event_name }}</h5>
                        <p class="card-text mb-1"><strong>{{ __('Prize') }}:</strong> {{ $raf->prize_type }}</p>
                        <p class="card-text mb-1"><strong>{{ __('Tickets / Price') }}:</strong> {{ $raf->number_of_tickets }} / ₱{{ number_format($raf->ticket_price, 2) }}</p>

                        {{-- Countdown Timer --}}
                        <p class="card-text mb-2">
                            <strong>{{ __('Time Left') }}:</strong>
                            <span class="raffle-countdown" data-end="{{ $raf->end_date->timestamp }}"></span>
                        </p>

                        <a href="#" class="btn btn-primary mt-auto w-100">{{ __('Join Raffle') }}</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">
                <p>{{ __('No featured raffles at the moment.') }}</p>
            </div>
        @endforelse
    </div>
</div>

@push('footer')
<script>
document.addEventListener('DOMContentLoaded', function () {
    function updateCountdown() {
        document.querySelectorAll('.raffle-countdown').forEach(function (el) {
            const endTime = parseInt(el.dataset.end) * 1000;
            const now = new Date().getTime();
            const distance = endTime - now;

            if (distance < 0) {
                el.innerHTML = '{{ __("Expired") }}';
            } else {
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                el.innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
            }
        });
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);
});
</script>
@endpush
