<!DOCTYPE html>
@include('elements.base')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description', setting('description', ''))">
    <meta name="theme-color" content="{{ theme_config('color', '#00e0ff') }}">
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
    <link href="{{ asset('css/base.css') }}" rel="stylesheet">
    <link href="{{ theme_asset('css/style.css') }}" rel="stylesheet">
    @stack('styles')
    @include('elements.theme-color', ['color' => theme_config('color', '#00e0ff')])
</head>

<body @if(dark_theme(true)) data-bs-theme="dark" @endif>
<div id="app">
    @yield('app')
</div>

<footer class="footer" data-bs-theme="dark">
    <div class="text-body bg-dark-subtle py-5">
        <div class="container">
            <div class="row gy-3">
                <div class="col-md-4 about">
                    <h3 class="text-center">{{ site_name() }}</h3>
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
                    <h3 class="text-center">
                        {{ trans('theme::theme.footer_links_title') }}
                    </h3>

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

    <div class="text-body bg-body-secondary">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-6">
                    {{ setting('copyright') }}
                </div>
                <div class="col-md-6 text-md-end">
                    @lang('messages.copyright')
                </div>
            </div>
        </div>
    </div>
</footer>

@stack('footer-scripts')

</body>
</html>
