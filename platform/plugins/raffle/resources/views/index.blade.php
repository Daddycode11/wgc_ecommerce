@extends('core/base::layouts.master')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>All Raffles</h1>
            <a href="{{ route('raffle.create') }}" class="btn btn-success">Create New Raffle</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Event Name</th>
                        <th>Entry Start</th>
                        <th>Entry End</th>
                        <th>Draw Date</th>
                        <th>Prize Type</th>
                        <th>Winner Code</th>
                        <th>Tickets / Price</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($raffles as $raffle)
                        <tr>
                            <td>{{ $raffle->id }}</td>
                            <td>{{ $raffle->event_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($raffle->entry_date)->format('Y-m-d H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($raffle->end_date)->format('Y-m-d H:i') }}</td>
                            <td>{{ $raffle->draw_date ? \Carbon\Carbon::parse($raffle->draw_date)->format('Y-m-d H:i') : '-' }}</td>
                            <td>{{ ucfirst($raffle->prize_type) }}</td>
                            <td>{{ $raffle->winner_code }}</td>
                            <td>{{ $raffle->number_of_tickets }} / ₱{{ number_format($raffle->ticket_price, 2) }}</td>
                            <td>
                                @if($raffle->status === 'published')
                                    <span class="badge badge-success">Published</span>
                                @else
                                    <span class="badge badge-secondary">{{ ucfirst($raffle->status) }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('raffle.edit', $raffle->id) }}" class="btn btn-sm btn-primary mb-1">
                                    <i class="fa fa-edit"></i> Edit
                                </a>

                               <form action="{{ route('raffle.destroy', $raffle->id) }}" method="POST" style="display:inline-block;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">
        <i class="fa fa-trash"></i> Delete
    </button>
</form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            
        </div>
    </div>
@endsection
