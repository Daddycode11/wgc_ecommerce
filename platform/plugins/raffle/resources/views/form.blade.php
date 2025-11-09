@extends('core/base::layouts.master')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>{{ isset($raffle) ? __('Edit Raffle') : __('Create Raffle') }}</h1>
        <a href="{{ route('raffle.index') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> {{ __('Back') }}</a>
    </div>

    <form action="{{ isset($raffle) ? route('raffle.update', $raffle->id) : route('raffle.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($raffle))
            @method('PUT')
        @endif

        <div class="row">
            {{-- Event Name --}}
            <div class="col-md-6 mb-3">
                <label for="event_name" class="form-label">{{ __('Event Name') }}</label>
                <input type="text" name="event_name" class="form-control" id="event_name" value="{{ old('event_name', $raffle->event_name ?? '') }}" required>
            </div>

            {{-- Prize Type --}}
            <div class="col-md-6 mb-3">
                <label for="prize_type" class="form-label">{{ __('Prize Type') }}</label>
                <input type="text" name="prize_type" class="form-control" id="prize_type" value="{{ old('prize_type', $raffle->prize_type ?? '') }}">
            </div>

            {{-- Prize Description --}}
            <div class="col-md-12 mb-3">
                <label for="prize_description" class="form-label">{{ __('Prize Description') }}</label>
                <textarea name="prize_description" class="form-control" id="prize_description">{{ old('prize_description', $raffle->prize_description ?? '') }}</textarea>
            </div>

            {{-- Prize Image --}}
            <div class="col-md-6 mb-3">
                <label for="prize_image" class="form-label">{{ __('Prize Image') }}</label>
                <input type="file" name="prize_image" class="form-control"  accept="image/*">
                @if(isset($raffle) && $raffle->prize_image)
                    <img src="{{ Storage::url($raffle->prize_image) }}" alt="Prize Image" class="img-fluid mt-2" style="max-height:150px;">
                @endif
            </div>

            {{-- Entry Date --}}
            <div class="col-md-6 mb-3">
                <label for="entry_date" class="form-label">{{ __('Entry Start Date') }}</label>
                <input type="datetime-local" name="entry_date" class="form-control" id="entry_date" value="{{ old('entry_date', isset($raffle) ? $raffle->entry_date->format('Y-m-d\TH:i') : '') }}" required>
            </div>

            {{-- End Date --}}
            <div class="col-md-6 mb-3">
                <label for="end_date" class="form-label">{{ __('Entry End Date') }}</label>
                <input type="datetime-local" name="end_date" class="form-control" id="end_date" value="{{ old('end_date', isset($raffle) ? $raffle->end_date->format('Y-m-d\TH:i') : '') }}" required>
            </div>

            {{-- Draw Date --}}
            <div class="col-md-6 mb-3">
                <label for="draw_date" class="form-label">{{ __('Draw Date') }}</label>
                <input type="datetime-local" name="draw_date" class="form-control" id="draw_date" value="{{ old('draw_date', isset($raffle) && $raffle->draw_date ? $raffle->draw_date->format('Y-m-d\TH:i') : '') }}">
            </div>

            {{-- Number of Tickets --}}
            <div class="col-md-6 mb-3">
                <label for="number_of_tickets" class="form-label">{{ __('Number of Tickets') }}</label>
                <input type="number" name="number_of_tickets" class="form-control" id="number_of_tickets" value="{{ old('number_of_tickets', $raffle->number_of_tickets ?? 0) }}" required>
            </div>

            {{-- Ticket Price --}}
            <div class="col-md-6 mb-3">
                <label for="ticket_price" class="form-label">{{ __('Ticket Price') }}</label>
                <input type="number" step="0.01" name="ticket_price" class="form-control" id="ticket_price" value="{{ old('ticket_price', $raffle->ticket_price ?? 0) }}" required>
            </div>

            {{-- Status --}}
            <div class="col-md-6 mb-3">
                <label for="status" class="form-label">{{ __('Status') }}</label>
                <select name="status" class="form-control" id="status">
                    <option value="draft" {{ isset($raffle) && $raffle->status === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ isset($raffle) && $raffle->status === 'published' ? 'selected' : '' }}>Published</option>
                </select>
            </div>

            {{-- Featured --}}
            <div class="col-md-6 mb-3">
                <label for="is_featured" class="form-label">{{ __('Featured') }}</label>
                <select name="is_featured" class="form-control" id="is_featured">
                    <option value="0" {{ isset($raffle) && !$raffle->is_featured ? 'selected' : '' }}>No</option>
                    <option value="1" {{ isset($raffle) && $raffle->is_featured ? 'selected' : '' }}>Yes</option>
                </select>
            </div>
        </div>

        {{-- Submit --}}
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-save"></i> {{ isset($raffle) ? __('Update Raffle') : __('Create Raffle') }}
            </button>
        </div>
    </form>
</div>
@endsection
