<div class="bidding-catalog container py-4">
    <h2 class="text-center mb-4">🔥 Active Bidding Items aaaa</h2>

    <div class="row">
        @forelse($bids as $bid)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    {{-- Image --}}
                    @if ($bid->image)
                        <img src="{{ Storage::url($bid->image) }}" class="card-img-top" alt="{{ $bid->title }}"
                            style="height:200px; object-fit:cover;">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                            style="height:200px;">
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
                            <strong>Highest Bid:</strong>
                           <span id="highest-bid-{{ $bid->id }}"> ₱{{ number_format(optional($bid->highestBid)->amount ?? 0, 2) }}</span>
                        </p>


                        @if($bid->end_time > now())
                            <p class="card-text mt-auto">
                                <strong>Time Left:</strong>
                                <span class="countdown" data-end="{{ $bid->end_time }}">
                                    <!-- Countdown will be inserted here by JavaScript -->
                                </span>
                            </p>
                            
                        <button data-bs-toggle="modal" data-bid-id="{{ $bid->id }}"
                            data-min="{{ number_format($bid->min_bid_increment, 2) }}"
                            data-highest="{{ number_format(optional($bid->highestBid)->amount ?? 0, 2) }}"
                            data-start = "{{ number_format($bid->starting_price, 2) }}"
                            class="btn btn-primary w-100 rounded-pill btn-edit">
                            <i class="bi bi-hammer"></i> Place a Bid
                        </button>
                        @else
                            <p class="card-text mt-auto text-danger">
                                <strong>Status:</strong> Expired
                            </p>
                            <p class="{{ $bid->winner_id ? 'text-success' : 'text-muted'    }}">
                                @if($bid->winner_id)
                                    <strong>Has a winner</strong> 
                                @elseif(number_format(optional($bid->highestBid)->amount ?? 0, 2)  == 0)
                                    <strong>No Bids Placed</strong>
                                @else
                                    <strong>No Winner Yet</strong>
                                @endif
                                {{-- {{$bid->winner_id ? 'Has a Winner' : number_format(optional($bid->highestBid)->amount ?? 0, 2)  == 0 ? 'No Bids Placed' : 'No Winner Yet' }} --}}

                            </p>
                        @endif
                    </div>
                </div>
            </div>



        @empty
            <div class="col-12 text-center text-muted">
                <p>No active bidding items at the moment.</p>
            </div>
        @endforelse


        <div class="modal fade" id="bid-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Bid Form</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="bid-form">
                        <div class="modal-body">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" ">Amount</span>
                                <input type="number" class="form-control" aria-label="Sizing example input" id="bid-amount">
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
                </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let bidId;

        const modalEdit = (id) => {
            bidId = id
            $("#bid-modal").modal('show');
        }
        $("body").on("click", ".btn-edit", async (e) => {
            modalEdit($(e.currentTarget).data("bid-id"));
            $("#bid-amount").attr("value", $(e.currentTarget).data("highest"))
            const highest = $(e.currentTarget).data("highest").replace(/,/g, "");
            const minString = $(e.currentTarget).data("min").replace(/,/g, "");
            const starting_price = $(e.currentTarget).data("start").replace(/,/g, "");

            const min = parseFloat(minString || 0)
            const startPrice = parseFloat(starting_price)
            const high = parseFloat(highest)
            $("#bid-amount").attr("min", (high + min > startPrice) ? high + min : startPrice);
        });

        $("#bid-form").on("submit", async (e) => {
            e.preventDefault();

            $('#bid-modal').modal('hide');
            const amount = $("#bid-amount").val();
            await fetch("api/bid", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    bidding_system_id: bidId,
                    amount: amount,
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
                $('#points').text(`₱${data.balance}`);
                $('#highest-bid-' + bidId).text(`₱${parseFloat(amount).toFixed(2)}`);
            }).catch((error) => {
                Swal.fire(
                    'Error!',
                    'There was an error processing your bid.',
                    'error'
                )
            });
            // Handle bid submission logic here
        });
        document.querySelectorAll('.countdown').forEach(function(el) {
           const endString = el.dataset.end.replace(' ', 'T'); // make it ISO-ish
           console.log(endString);
           
            const endTime = new Date(endString + '+08:00').getTime(); // adjust manually

            const now = new Date().getTime();
            const distance = endTime - now;
            const tick = setInterval(() => {
                const now = new Date().getTime();
                const diff = endTime - now;
                if (diff <= 0) {
                    clearInterval(tick);
                    span.textContent = "Expired";
                    return;
                }
                const d = Math.floor(diff / (1000 * 60 * 60 * 24));
                const h = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                const s = Math.floor((diff % (1000 * 60)) / 1000);
                el.textContent = `${d}d ${h}h ${m}m ${s}s`;
            }, 1000);
        });
    });
</script>
