<div class="raffle-catalog container py-4">
    <h2 class="text-center mb-4">{{ $title ?? __('🎉 Featured Raffles') }}</h2>

    <div class="row">
        @forelse($raffles as $raf)
            <div class="col-md-4 mb-4">

                <div class="card shadow-sm h-100">

                    {{-- Prize Image --}}
                    @if ($raf->prize_image)
                        <img src="{{ Storage::url($raf->prize_image) }}" class="card-img-top" alt="{{ $raf->event_name }}"
                            style="height:200px; object-fit:cover;">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                            style="height:200px;">
                            <span class="text-muted">{{ __('No Image') }}</span>
                        </div>
                    @endif

                    {{-- Card Body --}}
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $raf->event_name }}</h5>
                        <p class="card-text mb-1"><strong>{{ __('Prize') }}:</strong> {{ $raf->prize_type }}</p>
                        <p class="card-text mb-1"><strong>{{ __('Tickets / Price') }}:</strong>
                            <span id="number_of_tickets-{{$raf->id}}">{{ $raf->number_of_tickets }}</span> / ₱{{ number_format($raf->ticket_price, 2) }}</p>

                        {{-- Countdown Timer --}}
                        <p class="card-text mb-2">
                            <strong>{{ __('Time Left') }}:</strong>
                            <span class="raffle-countdown" data-end="{{ $raf->end_date }}"></span>
                        </p>

                        <button class="btn btn-primary mt-auto w-100 btn-edit-raffle" data-id="{{ $raf->id }}"
                            data-tickets="{{ $raf->number_of_tickets }}">{{ __('Join Raffle') }}</button>
                    </div>
                </div>
                <div class="modal fade" id="raffle-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="raffle-form">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Buy Ticket</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text" ">Number of Slots</span>
                                <input type="number" class="form-control" aria-label="Sizing example input" id="raffle-slot">
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                            </form>
                        </div>
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

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        let raffleId;

                                        const modalEditRaffle = (id) => {
                                            raffleId = id
                                            $("#raffle-modal").modal('show');
                                        }

                                        $("body").on("click", ".btn-edit-raffle", async (e) => {
                                            modalEditRaffle($(e.currentTarget).data("id"));

                                            $("#raffle-slot").attr("min", $(e.currentTarget).data("number-of-tickets"))
                                        });

        $("#raffle-form").on("submit", async (e) => {
            e.preventDefault();
            $('#raffle-modal').modal('hide');
            const amount = $("#raffle-slot").val();
            await fetch("api/join-raffle", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    raffle_promo_id: raffleId,
                    slots: amount,
                    customer_id: "{{ auth('customer')->id() }}"
                })

            }).then(response => response.json()).then(data => {
                if (data.error) {
                    Swal.fire(
                        'Error!',
                        data.error,
                        'error'
                    )
                    return;
                }
                Swal.fire(
                    'Success!',
                    data.message,
                    'success'
                )
                $('#number_of_tickets-' + raffleId).text(Number($('#number_of_tickets-' + raffleId).text()) - data.slots);
                $('#points').text(`₱${data.balance}`);
            }).catch((error) => {
                Swal.fire(
                    'Error!',
                    'There was an error processing your bid.',
                    'error'
                )
            });
            // Handle bid submission logic here
        });
                                        function updateCountdown() {
                                            document.querySelectorAll('.raffle-countdown').forEach(function(el) {
                                                const endString = el.dataset.end.replace(' ', 'T'); // make it ISO-ish
                                                const endTime = new Date(endString + '+08:00').getTime(); // adjust manually

                                                const now = new Date().getTime();
                                                const distance = endTime - now;

                                                if (distance < 0) {
                                                    el.innerHTML = '{{ __('Expired') }}';
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
