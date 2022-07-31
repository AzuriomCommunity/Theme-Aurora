<div class="header-nav @if(Route::is('home')) home-header @endif" @if(Route::is('home')) style="background-position: 0px;background: url('{{ setting('background') ? image_url(setting('background')) : 'https://via.placeholder.com/2000x500' }}') top / cover no-repeat" @endif>
    <div class="top-navbar">
        <div class="container">
            <div class="d-md-flex">
                <div class="flex-grow-0 me-auto">
                    <span class="online-count">
                        @if($server && $server->isOnline())
                            {{ trans_choice('messages.server.online', $server->getOnlinePlayers()) }}
                        @else
                            {{ trans('messages.server.offline') }}
                        @endif
                    </span>
                </div>

                <div class="navbar-expand navbar-dark">
                    <ul class="navbar-nav flex-row">
                        @auth
                            @include('elements.notifications')

                            <li class="nav-item dropdown">
                                <a id="userDropdown" class="nav-link dropdown-toggle user-nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="{{ auth()->user()->getAvatar(150) }}" class="rounded img-fluid" alt="{{ auth()->user()->name }}"> {{ Auth::user()->name }}<span class="me-1"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{ route('profile.index') }}">
                                        {{ trans('messages.nav.profile') }}
                                    </a>

                                    @if(Auth::user()->hasAdminAccess())
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            {{ trans('messages.nav.admin') }}
                                        </a>
                                    @endif

                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ trans('auth.logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">
                                    <i class="bi bi-box-arrow-in-right"></i> {{ trans('auth.login') }}
                                </a>
                            </li>

                            @if(Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">
                                        <i class="bi bi-person-plus-fill"></i> {{ trans('auth.register') }}
                                    </a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-md navbar-dark text-uppercase">
        <div class="container">
            <a class="navbar-brand me-4" href="{{ route('home') }}">
                @if(setting('logo'))
                    <img src="{{ image_url(setting('logo')) }}" alt="Logo">
                @else
                    {{ site_name() }}
                @endif
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="{{ trans('messages.nav.toggle') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbar">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    @foreach($navbar as $element)
                        @if(!$element->isDropdown())
                            <li class="nav-item">
                                <a class="nav-link @if($element->isCurrent()) active @endif" href="{{ $element->getLink() }}" @if($element->new_tab) target="_blank" rel="noopener" @endif>
                                    {{ $element->name }}
                                </a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle @if($element->isCurrent()) active @endif" href="#" id="navbarDropdown{{ $element->id }}" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ $element->name }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown{{ $element->id }}">
                                    @foreach($element->elements as $childElement)
                                        <a class="dropdown-item @if($childElement->isCurrent()) active @endif" href="{{ $childElement->getLink() }}" @if($childElement->new_tab) target="_blank" rel="noopener" @endif>
                                            {{ $childElement->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto flex-row navbar-socials">
                    @foreach(social_links() as $link)
                        <a href="{{ $link->value }}" class="nav-link px-2" title="{{ $link->title }}" data-bs-toggle="tooltip" target="_blank" rel="noopener noreferrer">
                            <i class="{{ $link->icon }}"></i>
                        </a>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>

    @if(Route::is('home'))
        <div class="container home-header-title">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-md-5 text-center">
                    <h1>{{ site_name() }}</h1>
                    <p>{{ theme_config('subtitle') }}</p>
                </div>
            </div>
        </div>
    @endif
</div>
