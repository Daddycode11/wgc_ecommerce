@if (isset($categories) && count($categories))
    <select name="category"
            id="ajax-search-category"
            class="form-select border-end-0"
            style="max-width: 180px;">
        <option value="">{{ __('All Categories') }}</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
@endif
