<div class="ajax-search-wrapper position-relative">
    <form action="{{ route('public.products') }}" method="GET" id="ajax-search-form" class="d-flex align-items-center">
        <div class="input-group">
            <input type="text"
                   id="ajax-search-input"
                   name="q"
                   class="form-control"
                   placeholder="{{ __('Search for products...') }}"
                   autocomplete="off">

            {{-- Category dropdown --}}
            @includeIf('plugins-ecommerce::fronts.ajax-search.categories-dropdown', ['categories' => $categories ?? []])

            <button type="submit" class="btn btn-primary">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </form>

    {{-- AJAX search result container --}}
    <div id="ajax-search-results" class="position-absolute w-100 bg-white border rounded mt-1 d-none">
        <div class="p-3 text-center text-muted">
            {{ __('Start typing to search...') }}
        </div>
    </div>
</div>
