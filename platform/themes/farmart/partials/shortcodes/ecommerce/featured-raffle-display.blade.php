<style>
    
        .spinner-section {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .spinner-container {
            position: relative;
            width: 100%;
            max-width: 450px;
            height: 400px;
            margin: 20px 0;
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .spinner-window {
            position: relative;
            width: 100%;
            height: 120px;
            margin: 60px auto;
            overflow: hidden;
            border: 5px solid #ffd700;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.1);
            box-shadow: inset 0 5px 20px rgba(0, 0, 0, 0.5);
        }

        .spinner-items {
            position: absolute;
            width: 100%;
            transition: transform 0.1s linear;
        }

        .spinner-item {
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2em;
            font-weight: bold;
            color: white;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 2px 0;
            border-radius: 8px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            letter-spacing: 2px;
        }

        .pointer-left,
        .pointer-right {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            z-index: 10;
            filter: drop-shadow(0 3px 5px rgba(0, 0, 0, 0.5));
        }

        .pointer-left {
            left: -15px;
            border-top: 20px solid transparent;
            border-bottom: 20px solid transparent;
            border-left: 30px solid #ff4757;
        }

        .pointer-right {
            right: -15px;
            border-top: 20px solid transparent;
            border-bottom: 20px solid transparent;
            border-right: 30px solid #ff4757;
        }

        .spin-button {
            padding: 20px 60px;
            font-size: 1.5em;
            font-weight: bold;
            background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
            border: none;
            border-radius: 50px;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            transition: all 0.3s;
            color: #333;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .spin-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
        }

        .spin-button:active {
            transform: translateY(-1px);
        }

        .spin-button:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
        }

        .control-panel {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            border: 2px solid #dee2e6;
        }

        .control-group {
            margin-bottom: 25px;
        }

        .control-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 10px;
            color: #495057;
        }

        .control-group input,
        .control-group select,
        .control-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #dee2e6;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        .control-group input:focus,
        .control-group select:focus,
        .control-group textarea:focus {
            outline: none;
            border-color: #667eea;
        }

        .control-group textarea {
            resize: vertical;
            min-height: 100px;
            font-family: monospace;
        }

        .control-group small {
            display: block;
            margin-top: 5px;
            color: #6c757d;
        }

        .button-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 20px;
        }

        button {
            padding: 12px 24px;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-spin {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            grid-column: 1 / -1;
        }

        .btn-spin:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-spin:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
        }

        .btn-update {
            background: #28a745;
            color: white;
        }

        .btn-update:hover {
            background: #218838;
        }

        .btn-random {
            background: #ffc107;
            color: #333;
        }

        .btn-random:hover {
            background: #e0a800;
        }

        .winner-display {
            margin-top: 20px;
            padding: 20px;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border-radius: 10px;
            text-align: center;
            color: white;
            font-size: 1.2em;
            font-weight: bold;
            display: none;
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .entries-list {
            margin-top: 15px;
            padding: 15px;
            background: white;
            border-radius: 8px;
            max-height: 200px;
            overflow-y: auto;
        }

        .entries-list h4 {
            margin-bottom: 10px;
            color: #495057;
        }

        .entry-item {
            padding: 8px;
            margin: 5px 0;
            background: #f8f9fa;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-family: monospace;
        }

        .entry-item .index {
            font-weight: bold;
            color: #667eea;
            min-width: 30px;
        }

        @media (max-width: 968px) {
            .main-content {
                grid-template-columns: 1fr;
            }

            .spinner-container {
                max-width: 100%;
            }
        }

        @media (max-width: 480px) {
            .spinner-item {
                font-size: 1.5em;
            }

            .spin-button {
                padding: 15px 40px;
                font-size: 1.2em;
            }
        }
</style>
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
                            <span id="number_of_tickets-{{ $raf->id }}">{{ $raf->number_of_tickets }}</span> /
                            ₱{{ number_format($raf->ticket_price, 2) }}
                        </p>
                        <p class="card-text mb-1"><strong>{{ __('Draw Date') }}:</strong> {{ $raf->draw_date }}</p>

                        {{-- Countdown Timer --}}
                        <p class="card-text mb-2">
                            <strong>{{ __('Time Left') }}:</strong>
                            <span class="raffle-countdown" data-end="{{ $raf->end_date }}"></span>
                        </p>

                        
                        <p class="card-text mb-2">
                            <strong>{{ __('Draw Countdown') }}:</strong>
                            <span class="spin-countdown" data-end="{{ $raf->draw_date }}"></span>
                        </p>
                        @if($raf->end_date > now())
                        <button class="btn btn-primary mt-auto w-100 btn-edit-raffle" data-id="{{ $raf->id }}"
                            data-tickets="{{ $raf->number_of_tickets }}">{{ __('Join Raffle') }}</button>
                        @else
                        <p class="text-danger mt-auto"><strong>{{ __('Raffle Ended') }}</strong></p>
                        <p class="text-success spin-btn" data-id="{{ $raf->id }}" data-winner="{{ $raf->winner_code }}" >Winner: {{$raf->winner_code}}  ({{$raf->winner_code ? "Click to replay" : "Click to spin"}})</p>
                        @endif
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

{{-- Raffle Modal - Outside the loop --}}
<div class="modal fade" id="raffle-modal" tabindex="-1" aria-labelledby="raffleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="raffle-form">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="raffleModalLabel">Buy Ticket</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Number of Slots</span>
                        <input type="number" class="form-control" aria-label="Number of slots" id="raffle-slot">
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


{{-- Raffle Modal - Outside the loop --}}
<div class="modal fade" id="spin-raffle" tabindex="-1" aria-labelledby="raffleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="raffle-form">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="raffleModalLabel">Buy Ticket</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
            <div class="spinner-section" >
                <div class="spinner-container" id="spinner">
                    <div class="spinner-window" >
                        <div class="pointer-left"></div>
                        <div class="pointer-right"></div>
                        <div class="spinner-items" id="spinnerItems"></div>
                    </div>
                </div>

                <div class="winner-display" id="winnerDisplay"></div>
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
                $('#number_of_tickets-' + raffleId).text(Number($('#number_of_tickets-' +
                    raffleId).text()) - data.slots);
                $('#points').text(`₱${data.balance}`);
            }).catch((error) => {
                Swal.fire(
                    'Error!',
                    'There was an error processing your bid.',
                    'error'
                )
            });
        });

        function updateCountdown() {
            document.querySelectorAll('.spin-countdown').forEach(function(el) {
                const endString = el.dataset.end.replace(' ', 'T');
                const endTime = new Date(endString + '+08:00').getTime();
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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        let entries = ["aa","bb","cc","dd","ee","ff"];
        let prefix = 'raffle_';
        let isSpinning = false;
        let currentPosition = 0;
        let winnerIndex;
        let rafId


        const spinnerItems = document.getElementById('spinnerItems');
        const winnerDisplay = document.getElementById('winnerDisplay');
        let prevNowPlaying;

        async function parseEntries() {
         function updateSpintimer() {
            document.querySelectorAll('.raffle-countdown').forEach(function(el) {
                const endString = el.dataset.end.replace(' ', 'T');
                const endTime = new Date(endString + '+08:00').getTime();
                const now = new Date().getTime();
                const distance = endTime - now;
//                 console.log(distance);
                
//                 if(distance <= 60000 && distance > 0){
// ;
//                     $("#spin-raffle").modal("show")
//                     console.log("end please");                    
//                     spin();
//                 }
                if (distance < 0) {
                    if(prevNowPlaying){

                        clearInterval(prevNowPlaying)
                    }
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

        updateSpintimer();
         prevNowPlaying = setInterval(updateSpintimer, 1000);
            let entries = [
                "aa","bb","cc","dd","ee","ff"
            ]

            if (entries.length < 3) {
                alert('Please enter at least 3 raffle IDs!');
                return false;
            }
            return true;
        }

        function getPrefix() {
            prefix =  '';
        }

        function updateEntriesList() {
            const listDiv = document.getElementById('entriesList');
            listDiv.innerHTML = entries.map((entry, index) =>
                `<div class="entry-item">
                    <span class="index">${index}</span>
                    <span>${prefix}${entry}</span>
                </div>`
            ).join('');
        }

        function createSpinnerItems() {
            // Create a long list with entries repeated for smooth scrolling
            const itemHeight = 124; // 120px + 4px margin
            const repeats = 20; // Repeat entries multiple times
            let html = '';
            
            for (let i = 0; i < repeats; i++) {
                entries.forEach((entry, index) => {
                    html += `<div class="spinner-item" data-index="${index}">${prefix}${entry}</div>`;
                });
            }
            
            spinnerItems.innerHTML = html;
            currentPosition = 0;
            spinnerItems.style.transform = `translateY(${currentPosition}px)`;
        }

        function updateSpinner() {
            if (!parseEntries()) return;
            getPrefix();
            // updateEntriesList();
            createSpinnerItems();
            winnerDisplay.style.display = 'none';
            alert('Spinner updated successfully!');
        }

        function setRandomWinner() {
            document.getElementById('winnerInput').value = '';
            alert('Winner set to random mode!');
        }

        function getWinnerIndex() {
            const winnerInput =  entries.findIndex(e => e === winnerIndex);
            if (winnerInput < 0) {
                // Random winner
                let win =Math.floor(Math.random() * entries.length);
                 fetch(`api/update-raffle-winner`, {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        raffle_id: rafId,
                        winner_code: entries[win],
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
                }).catch((error) => {
                    Swal.fire(
                        'Error!',
                        'There was an error setting the raffle winner.',
                        'error'
                    )
                });
                return win;
            }

            // Check if it's a number (index)
            if (!isNaN(winnerInput)) {
                const index = parseInt(winnerInput);
                if (index >= 0 && index < entries.length) {
                    return index;
                } else {
                    alert(`Invalid index! Must be between 0 and ${entries.length - 1}`);
                    return null;
                }
            }

            // Check if it's a raffle ID
            const index = entries.findIndex(e => e === winnerInput);
            if (index !== -1) {
                return index;
            }

            return Math.floor(Math.random() * entries.length);
        }

        function spin() {
            if (isSpinning) return;
            if (!parseEntries()) return;
            getPrefix();
            createSpinnerItems();

            const winnerIndex = getWinnerIndex();
            if (winnerIndex === null) return;

            isSpinning = true;
            winnerDisplay.style.display = 'none';

            const duration = 4 * 1000;
            const itemHeight = 124;
            
            // Calculate target position
            // We want the winning item to be centered in the window
            // The window center is at 60px (half of 120px height)
            // We need to scroll so that the winner is at position 60px from the top of the window
            
            // Start from middle of repeats to ensure smooth scrolling
            const middleRepeat = 10;
            const targetItemPosition = (middleRepeat * entries.length + winnerIndex) * itemHeight;
            
            // Center the item in the window (window is 120px tall, so center is at 60px)
            const targetPosition = -targetItemPosition + 0; // Adjust for centering
            
            const startTime = Date.now();
            const startPosition = currentPosition;
            const distance = targetPosition - startPosition ;

            function animate() {
                const elapsed = Date.now() - startTime;
                const progress = Math.min(elapsed / duration, 1);

                // Easing function (ease-out cubic)
                const easeOut = 1 - Math.pow(1 - progress, 3);

                currentPosition = startPosition + (distance * easeOut);
                spinnerItems.style.transform = `translateY(${currentPosition}px)`;

                if (progress < 1) {
                    requestAnimationFrame(animate);
                } else {
                    showWinner(winnerIndex);
                    isSpinning = false;
                }
            }

            animate();
        }

        function showWinner(index) {
            const winner = entries[index];
                    $("#spinner").hide();
            winnerDisplay.innerHTML = `
                🎉 <strong>WINNER!</strong> 🎉<br>
                <div style="font-size: 1.5em; margin-top: 10px; font-family: monospace;">${prefix}${winner}</div>
                <div style="font-size: 0.8em; margin-top: 5px; opacity: 0.9;">(Index: ${index})</div>
            `;
            winnerDisplay.style.display = 'block';
        }

        $("body").on("click", ".spin-btn", async (e) => {
            $("#spin-raffle").modal("show")
            $("#spinner").show();
            winnerIndex = $(e.currentTarget).data("winner");
            rafId = $(e.currentTarget).data("id");
            
        await fetch(`api/get-raffle-entries?raffle_promo_id=${$(e.currentTarget).data("id")}`, {
                method: "GET",
                headers: {
                    'Content-Type': 'application/json',
                }
            }).then(response => response.json()).then(res => {
                if (res.error) {
                    Swal.fire(
                        'Error!',
                        data.error,
                        'error'
                    )
                    return;
                }
                
                entries = res?.data?.map(item=> item.entry_code);
                 const itemHeight = 124; // 120px + 4px margin
            const repeats = 20; // Repeat entries multiple times
            let html = '';
            
            for (let i = 0; i < repeats; i++) {
                entries.forEach((entry, index) => {
                    html += `<div class="spinner-item" data-index="${index}">${prefix}${entry}</div>`;
                });
            }
            document.getElementById('winnerDisplay').style.display = 'none';
            
            spinnerItems.innerHTML = html;
            currentPosition = 0;
            spinnerItems.style.transform = `translateY(${currentPosition}px)`;
            spin()
            }).catch((error) => {
                Swal.fire(
                    'Error!',
                    'There was an error fetching raffle entries.',
                    'error'
                )
            });
        });
        // Initialize
        window.addEventListener('load', () => {
            parseEntries();
            getPrefix();
            // updateEntriesList();
            createSpinnerItems();
        });

        // Spin button click

        // Allow Enter key on inputs
        // document.getElementById('entriesInput').addEventListener('keydown', (e) => {
        //     if (e.ctrlKey && e.key === 'Enter') {
        //         updateSpinner();
        //     }
        // });
    });
    </script>