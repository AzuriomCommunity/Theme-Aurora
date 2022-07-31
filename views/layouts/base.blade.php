<!DOCTYPE html>
@include('elements.base')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description', setting('description', ''))">
    <meta name="theme-color" content="#3490DC">
    <meta name="author" content="Azuriom">

    <meta property="og:title" content="@yield('title')">
    <meta property="og:type" content="@yield('type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ favicon() }}">
    <meta property="og:description" content="@yield('description', setting('description', ''))">
    <meta property="og:site_name" content="{{ site_name() }}">
    @stack('meta')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ site_name() }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ favicon() }}">

    <!-- Scripts -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('vendor/axios/axios.min.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}" defer></script>

    <!-- Page level scripts -->
    @stack('scripts')

    <!-- Fonts -->
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ theme_asset('css/style.css') }}" rel="stylesheet">
    @stack('styles')
</head>

<body>
<div id="app">
    @yield('app')
</div>

<footer class="footer">
    <div class="top-footer">
        <div class="container">
            <div class="row gy-3">
                <div class="col-md-4 about">
                    <h3>{{ site_name() }}</h3>
                    <p>{{ theme_config('footer_description') }}</p>
                </div>
                <div class="col-md-4 list-inline text-center social-links pt-3">
                    @foreach(social_links() as $link)
                        <a href="{{ $link->value }}" class="list-inline-item mx-2" title="{{ $link->title }}" data-bs-toggle="tooltip" target="_blank" rel="noopener noreferrer">
                            <i class="{{ $link->icon }} fs-2"></i>
                        </a>
                    @endforeach
                </div>
                <div class="col-md-4 links">
                    <h3>{{ trans('theme::theme.footer_links_title') }}</h3>

                    <ul class="list-unstyled text-center">
                        @foreach(theme_config('footer_links') ?? [] as $link)
                            <li>
                                <a href="{{ $link['value'] }}">{{ $link['name'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="copyright">
        <div class="container text-center">
            <p class="mb-1">{{ setting('copyright') }}</p>
            <p class="small mb-0">
                Designed with <i style="color: orangered;" class="bi bi-heart"></i> by Captain34
                -
                @lang('messages.copyright')
            </p>
        </div>
    </div>
</footer>

@stack('footer-scripts')

</body>
</html>
