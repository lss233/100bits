<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '100Bits!') }}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/uikit-rtl.min.css') }}" />

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ asset('js/uikit.min.js') }}"></script>
    <script src="{{ asset('js/uikit-icons.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
</head>
<body>
            <nav class="uk-navbar-container effect2" uk-navbar>
                <div class="uk-navbar-left">

                    <ul class="uk-navbar-nav">
                        <li class="uk-active">
                            <a href="{{ url('/') }}">{{ config('app.name', '100Bits!') }}</a>
                        </li>
                        <li><a href="#">往期作品</a></li>
                        <li><a href="https://lss233.com">Lss233的首页</a></li>
                        <li><a href="#" uk-toggle="target: #about">关于</a></li>
                    </ul>

                </div>
                <div class="uk-navbar-right">
                    <ul class="uk-navbar-nav">
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">登陆</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">注册</a></li>
                        @else
                            <li>
                                <a href="">{{ Auth::user()->name }}</a>
                                <div class="uk-navbar-dropdown">
                                    <ul class="uk-nav uk-navbar-dropdown-nav">
                                        <li>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                                           onclick="event.preventDefault();
                                                                         document.getElementById('logout-form').submit();">
                                                            退出登陆
                                                        </a>

                                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                            @csrf
                                                        </form>
                                                    </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </nav>
        <main class="py-4">
            @yield('content')
        </main>
        <div id="about" uk-modal>
            <div class="uk-modal-dialog uk-modal-body">
                <h2 class="uk-modal-title">关于 100Bits!</h2>
                <p>100Bits 是一个多人作画游戏。每个用户每天可以在画板上绘画 100个点。</p>
                <p>画板下的控制按钮可以追溯最近2个月来这幅画的绘画过程。</p>
                <p>这个项目的创意(Inspired by)来自<a href="https://dan-ball.jp/en/javagame/bit/" target="_blank">Dan-ball</a>，这个网站还有很多好玩的小游戏呢！(我沉迷了好几天)</p>
                <h3>Credits</h3>
                <p>这个项目使用了以下内容: </p>
                <ul>
                    <li><a href="https://laravel.com" target="_blank">Laravel</a> - The PHP Framework For Web Artisans.</li>
                    <li><a href="http://jQuery.com" target="_blank">jQuery</a> - Write less, do more.</li>
                    <li><a href="https://getuikit.com/" target="_blank">UIKit</a> - A lightweight and modular front-end framework.</li>
                    <li>...</li>
                </ul>
                <p style="text-align:right">Made with 💖 by <a href="https://lss233.com" target="_blank"> Lss233</a>!</p>
                <button class="uk-button uk-button-primary uk-modal-close" type="button">确定</button>
            </div>
        </div>
</body>
</html>
