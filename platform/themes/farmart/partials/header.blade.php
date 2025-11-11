<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        :root {
            --primary-color: {{ theme_option('primary_color', '#fab528') }};
            --heading-color: {{ theme_option('heading_color', '#000') }};
            --text-color: {{ theme_option('text_color', '#000') }};
            --primary-button-color: {{ theme_option('primary_button_color', '#000') }};
            --primary-button-background-color: {{ theme_option('primary_button_background_color') ?: theme_option('primary_color', '#fab528') }};
            --top-header-background-color: {{ theme_option('top_header_background_color', '#f7f7f7') }};
            --top-header-text-color: {{ theme_option('top_header_text_color') ?: theme_option('header_text_color', '#000') }};
            --middle-header-background-color: {{ theme_option('middle_header_background_color', '#fff') }};
            --middle-header-text-color: {{ theme_option('middle_header_text_color') ?: theme_option('header_text_color', '#000') }};
            --bottom-header-background-color: {{ theme_option('bottom_header_background_color', '#fff') }};
            --bottom-header-text-color: {{ theme_option('bottom_header_text_color') ?: theme_option('header_text_color', '#000') }};
            --header-text-color: {{ theme_option('header_text_color', '#000') }};
            --header-text-secondary-color: {{ BaseHelper::hexToRgba(theme_option('header_text_color', '#000'), 0.5) }};
            --header-deliver-color: {{ BaseHelper::hexToRgba(theme_option('header_deliver_color', '#000'), 0.15) }};
            --footer-text-color: {{ theme_option('footer_text_color', '#555') }};
            --footer-heading-color: {{ theme_option('footer_heading_color', '#555') }};
            --footer-hover-color: {{ theme_option('footer_hover_color', '#fab528') }};
            --footer-border-color: {{ theme_option('footer_border_color', '#dee2e6') }};
        }
    </style>

    @php
        Theme::asset()->remove('language-css');
        Theme::asset()->container('footer')->remove('language-public-js');
        Theme::asset()->container('footer')->remove('simple-slider-owl-carousel-css');
        Theme::asset()->container('footer')->remove('simple-slider-owl-carousel-js');
        Theme::asset()->container('footer')->remove('simple-slider-css');
        Theme::asset()->container('footer')->remove('simple-slider-js');
    @endphp

    {!! Theme::header() !!}
    {{-- Sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body {!! Theme::bodyAttributes() !!}>
    @if (theme_option('preloader_enabled', 'yes') == 'yes')
        {!! Theme::partial('preloader') !!}
    @endif

    {!! Theme::partial('svg-icons') !!}
    {!! apply_filters(THEME_FRONT_BODY, null) !!}

    <header class="header header-js-handler"
        data-sticky="{{ theme_option('sticky_header_enabled', 'yes') == 'yes' ? 'true' : 'false' }}">
        <div @class([
            'header-top d-none d-lg-block',
            'header-content-sticky' =>
                theme_option('sticky_header_content_position', 'middle') == 'top',
        ])>
            <div class="container-xxxl">
                <div class="header-wrapper">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <div class="header-info">
                                {!! Menu::renderMenuLocation('header-navigation', ['view' => 'menu-default']) !!}
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="header-info header-info-right">
                                @if (auth('customer')->check())
                                    <span class="mr-4 pe-auto" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" id="points">₱0.00</span>
                                    <!-- Button trigger modal -->
                                    <input type="hidden" name="customer_id" id="customer_id"
                                        value="{{ auth('customer')->user()->id }}">

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Top Up form</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form id="topup-form">
                                                    <div class="modal-body">
                                                        <div class="input-group input-group-sm mb-3">
                                                            <span class="input-group-text">Amount</span>
                                                            <input type="text" class="form-control"
                                                            required placeholder="Enter Amount"
                                                                aria-label="Sizing example input" id="amount">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <ul>
                                    @if (is_plugin_active('language'))
                                        {!! Theme::partial('language-switcher') !!}
                                    @endif
                                    @if (is_plugin_active('ecommerce'))
                                        @if (count($currencies) > 1)
                                            <li>
                                                <a class="language-dropdown-active" href="#">
                                                    <span>{{ get_application_currency()->title }}</span>
                                                    <span class="svg-icon">
                                                        <svg>
                                                            <use href="#svg-icon-chevron-down"
                                                                xlink:href="#svg-icon-chevron-down"></use>
                                                        </svg>
                                                    </span>
                                                </a>
                                                <ul class="language-dropdown">
                                                    @foreach ($currencies as $currency)
                                                        @if ($currency->id !== get_application_currency_id())
                                                            <li>
                                                                <a
                                                                    href="{{ route('public.change-currency', $currency->title) }}">
                                                                    <span>{{ $currency->title }}</span>
                                                                </a>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endif
                                        @if (auth('customer')->check())
                                            <li>
                                                <a
                                                    href="{{ route('customer.overview') }}">{{ auth('customer')->user()->name }}</a>
                                                <span class="d-inline-block ms-1">(<a class="color-primary"
                                                        href="{{ route('customer.logout') }}">{{ __('Logout') }}</a>)</span>
                                            </li>
                                        @else
                                            <li><a href="{{ route('customer.login') }}">{{ __('Login') }}</a></li>
                                            <li><a href="{{ route('customer.register') }}">{{ __('Register') }}</a>
                                            </li>
                                        @endif
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div @class([
            'header-middle',
            'header-content-sticky' =>
                theme_option('sticky_header_content_position', 'middle') == 'middle',
        ])>
            <div class="container-xxxl">
                <div class="header-wrapper">
                    <div class="header-items header__left">
                        @if ($logo = theme_option('logo'))
                            @php
                                $height = theme_option('logo_height', 45);

                                $attributes = [
                                    'style' => sprintf('max-height: %s', is_numeric($height) ? "{$height}px" : $height),
                                    'loading' => false,
                                ];
                            @endphp
                            <div class="logo">
                                <a href="{{ BaseHelper::getHomepageUrl() }}">
                                    {{ RvMedia::image($logo, theme_option('site_title'), attributes: $attributes) }}
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="header-items header__center">
                        @if (is_plugin_active('ecommerce'))
                            <x-plugins-ecommerce::fronts.ajax-search class="form--quick-search">
                                <div class="form-group--icon" style="display: none">
                                    <div class="product-category-label">
                                        <label for="product-category-select"
                                            class="text">{{ __('All Categories') }}</label>
                                        <span class="svg-icon">
                                            <svg>
                                                <use href="#svg-icon-chevron-down" xlink:href="#svg-icon-chevron-down">
                                                </use>
                                            </svg>
                                        </span>
                                    </div>
                                    <x-plugins-ecommerce::fronts.ajax-search.categories-dropdown
                                        class="form-control product-category-select" id="product-category-select" />
                                </div>
                                <x-plugins-ecommerce::fronts.ajax-search.input type="text"
                                    class="form-control input-search-product" />
                                <button class="btn" type="submit" aria-label="Submit">
                                    <span class="svg-icon">
                                        <svg>
                                            <use href="#svg-icon-search" xlink:href="#svg-icon-search"></use>
                                        </svg>
                                    </span>
                                </button>
                            </x-plugins-ecommerce::fronts.ajax-search>
                        @endif
                    </div>
                    <div class="header-items header__right">
                        @if (theme_option('hotline'))
                            <div class="header__extra header-support">
                                <div class="header-box-content">
                                    <span>{{ theme_option('hotline') }}</span>
                                    <p>{{ __('Support 24/7') }}</p>
                                </div>
                            </div>
                        @endif

                        @if (is_plugin_active('ecommerce'))
                            @if (EcommerceHelper::isCompareEnabled())
                                <div class="header__extra header-compare">
                                    <a class="btn-compare" href="{{ route('public.compare') }}">
                                        <i class="icon-repeat"></i>
                                        <span
                                            class="header-item-counter">{{ Cart::instance('compare')->count() }}</span>
                                    </a>
                                </div>
                            @endif
                            @if (EcommerceHelper::isWishlistEnabled())
                                <div class="header__extra header-wishlist">
                                    <a class="btn-wishlist" href="{{ route('public.wishlist') }}">
                                        <span class="svg-icon">
                                            <svg>
                                                <use href="#svg-icon-wishlist" xlink:href="#svg-icon-wishlist"></use>
                                            </svg>
                                        </span>
                                        <span class="header-item-counter">
                                            {{ auth('customer')->check() ? auth('customer')->user()->wishlist()->count() : Cart::instance('wishlist')->count() }}
                                        </span>
                                    </a>
                                </div>
                            @endif
                            @if (EcommerceHelper::isCartEnabled())
                                <div class="header__extra cart--mini" role="button" tabindex="0">
                                    <div class="header__extra">
                                        <a class="btn-shopping-cart" href="{{ route('public.cart') }}">
                                            <span class="svg-icon">
                                                <svg>
                                                    <use href="#svg-icon-cart" xlink:href="#svg-icon-cart"></use>
                                                </svg>
                                            </span>
                                            <span
                                                class="header-item-counter">{{ Cart::instance('cart')->count() }}</span>
                                        </a>
                                        <span class="cart-text">
                                            <span class="cart-title">{{ __('Your Cart') }}</span>
                                            <span class="cart-price-total">
                                                <span class="cart-amount">
                                                    <bdi>
                                                        <span>{{ format_price(Cart::instance('cart')->rawSubTotal() + Cart::instance('cart')->rawTax()) }}</span>
                                                    </bdi>
                                                </span>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="cart__content" id="cart-mobile">
                                        <div class="backdrop"></div>
                                        <div class="mini-cart-content">
                                            <div class="widget-shopping-cart-content">
                                                {!! Theme::partial('cart-mini.list') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div @class([
            'header-bottom',
            'header-content-sticky' =>
                theme_option('sticky_header_content_position', 'middle') == 'bottom',
        ])>
            <div class="header-wrapper">
                <nav class="navigation">
                    <div class="container-xxxl">
                        <div class="navigation__left">
                            @if (is_plugin_active('ecommerce') && theme_option('enabled_product_categories_on_header', 'yes') == 'yes')
                                <div class="menu--product-categories">
                                    <div class="menu__toggle">
                                        <span class="svg-icon">
                                            <svg>
                                                <use href="#svg-icon-list" xlink:href="#svg-icon-list"></use>
                                            </svg>
                                        </span>
                                        <span class="menu__toggle-title">{{ __('Shop by Category') }}</span>
                                    </div>
                                    <div class="menu__content" data-bb-toggle="init-categories-dropdown"
                                        data-bb-target=".menu--dropdown"
                                        data-url="{{ route('public.ajax.categories-dropdown') }}">
                                        <ul class="menu--dropdown"></ul>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div @class([
                            'navigation__center',
                            'ps-0' =>
                                theme_option('enabled_product_categories_on_header', 'yes') != 'yes',
                        ])>
                            {!! Menu::renderMenuLocation('main-menu', [
                                'view' => 'menu',
                                'options' => ['class' => 'menu'],
                            ]) !!}
                        </div>
                        <div class="navigation__right">
                            @if (is_plugin_active('ecommerce') && EcommerceHelper::isEnabledCustomerRecentlyViewedProducts())
                                <div class="header-recently-viewed"
                                    data-url="{{ route('public.ajax.recently-viewed-products') }}" role="button">
                                    <h3 class="recently-title">
                                        <span class="svg-icon recent-icon">
                                            <svg>
                                                <use href="#svg-icon-refresh" xlink:href="#svg-icon-refresh"></use>
                                            </svg>
                                        </span>
                                        {{ __('Recently Viewed') }}
                                    </h3>
                                    <div class="recently-viewed-inner container-xxxl">
                                        <div class="recently-viewed-content">
                                            <div class="loading--wrapper">
                                                <div class="loading"></div>
                                            </div>
                                            <div class="recently-viewed-products"></div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="header-mobile header-js-handler"
            data-sticky="{{ theme_option('sticky_header_mobile_enabled', 'yes') == 'yes' ? 'true' : 'false' }}">
            <div class="header-items-mobile header-items-mobile--left">
                <div class="menu-mobile">
                    <div class="menu-box-title">
                        <div class="icon menu-icon toggle--sidebar" href="#menu-mobile">
                            <span class="svg-icon">
                                <svg>
                                    <use href="#svg-icon-list" xlink:href="#svg-icon-list"></use>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-items-mobile header-items-mobile--center">
                @if ($logo)
                    <div class="logo">
                        <a href="{{ BaseHelper::getHomepageUrl() }}">
                            {{ RvMedia::image($logo, theme_option('site_title'), attributes: $attributes) }}
                        </a>
                    </div>
                @endif
            </div>
            <div class="header-items-mobile header-items-mobile--right">
                <div class="search-form--mobile search-form--mobile-right search-panel">
                    <a class="open-search-panel toggle--sidebar" href="#search-mobile" title="{{ __('Search') }}">
                        <span class="svg-icon">
                            <svg>
                                <use href="#svg-icon-search" xlink:href="#svg-icon-search"></use>
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function() {
                fetch('api/get-wallet-amount?customer_id={{ auth('customer')->id() }}')
                .then(response => response.json())
                .then(data => {
                    // Update the wallet balance display
                    $("#points").text(`₱${data.balance}`);
                })
                .catch(error => {
                    console.error('Error fetching wallet amount:', error);
                });
            });
            $("#topup-form").on("submit",async function(e) {
                e.preventDefault();
                $("#exampleModal").modal('hide');
              await  Swal.fire({
                    title: "Gcash Qr!",
                    text: "Send exact amount.",
                    imageUrl: "{{ asset('images/images.webp') }}",
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: "Gcash QR Code",
                    
                    confirmButtonText: "send"
                }).then(async(result) => {
                    console.log(result);
                    
                    if (result.isConfirmed) {
                        const { value: reference } = await Swal.fire({
                            title: "Input reference",
                            input: "email",
                            inputLabel: "Enter your reference number",
                            inputPlaceholder: "Enter your reference number",
                            showCancelButton: true,
                            inputValidator: (value) => {
                                if (!value) {
                                return "You need to write something!";
                                }
                            }
                            });
                            if (reference) {
                               await fetch('api/add-money-to-wallet', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify({
                                        amount: document.getElementById('amount').value,
                                        customer_id: document.getElementById('customer_id').value,
                                        reference: reference
                                    })
                                })
                                .then(response => {
                                    if (!response.ok) {
                                        throw new Error(`HTTP error! status: ${response.status}`);
                                    }
                                    $('#exampleModal').modal('hide');
                                    return response.json();
                                })
                                .then(data => {
                                    console.log('Success:', data);
                                    Swal.fire("Success!", "Your wallet has been topped up.", "success");
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    Swal.fire("Error!", "There was an error processing your request.", "error");
                                });
                            }
                    }
                });
            });
        </script>
    </header>
