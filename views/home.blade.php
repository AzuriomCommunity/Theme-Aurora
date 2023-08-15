@extends('layouts.base')

@section('title', trans('messages.home'))

@section('app')
    <header class="header">
        @include('elements.navbar')
    </header>

    <div class="home-header z-3" style="background: url('{{ setting('background') ? image_url(setting('background')) : 'https://via.placeholder.com/2000x500' }}') top / cover no-repeat">
        <div class="container h-100">
            <div class="h-100 row align-items-center justify-content-center">
                <div class="col-md-5 z-3 text-center">
                    <h1 class="text-primary fw-bold">{{ site_name() }}</h1>
                    <p class="h5 text-light">{{ theme_config('subtitle') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container content">
        @if($message)
            <div class="card mb-5">
                <div class="card-body">
                    {{ $message }}
                </div>
            </div>
        @endif

        @if(! $servers->isEmpty())
            <h2 class="text-center text-uppercase mb-3">
                {{ trans('messages.servers') }}
            </h2>

            <div class="row gy-3 justify-content-center mb-5">
                @foreach($servers as $server)
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <h3 class="card-title">
                                    {{ $server->name }}
                                </h3>

                                @if($server->isOnline())
                                    <div class="progress mb-1">
                                        <div class="progress-bar" role="progressbar" style="width: {{ $server->getPlayersPercents() }}%">
                                        </div>
                                    </div>

                                    <p class="mb-1">
                                        {{ trans_choice('messages.server.total', $server->getOnlinePlayers(), [
                                            'max' => $server->getMaxPlayers(),
                                        ]) }}
                                    </p>
                                @else
                                    <p>
                                        <span class="badge bg-danger text-white">
                                            {{ trans('messages.server.offline') }}
                                        </span>
                                    </p>
                                @endif

                                @if($server->joinUrl())
                                    <a href="{{ $server->joinUrl() }}" class="btn btn-primary">
                                        {{ trans('messages.server.join') }}
                                    </a>
                                @else
                                    <p class="card-text">{{ $server->fullAddress() }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <h2 class="text-center text-uppercase mb-3">
            {{ trans('messages.news') }}
        </h2>

        <div class="row gy-3">
            @foreach($posts as $post)
                <div class="col-md-6">
                    <div class="card mb-4">
                        @if($post->hasImage())
                            <a href="{{ route('posts.show', $post->slug) }}">
                                <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" class="card-img-top">

                                <div class="card-body">
                                    <h3 class="card-title">{{ $post->title }}</h3>

                                    <div class="text-end">
                                        <a class="btn btn-primary" href="{{ route('posts.show', $post->slug) }}">
                                            {{ trans('messages.posts.read') }} <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </a>
                        @else
                            <div class="card-body">
                                <h3 class="card-title">{{ $post->title }}</h3>
                                <h4 class="card-subtitle">
                                    {{ format_date($post->published_at) }}
                                </h4>

                                <hr>

                                <p class="card-text">
                                    {{ Str::limit(strip_tags($post->content), 400) }}
                                </p>
                                <div class="text-end">
                                    <a class="btn btn-primary" href="{{ route('posts.show', $post->slug) }}">
                                        {{ trans('messages.posts.read') }} <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
