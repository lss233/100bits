@extends('layouts.app')

@section('content')
        <link rel="stylesheet" href="{{ asset('css/drawer.css') }}" />
        <div class="center">
            <canvas id="drawer" width="1000" height="500"></canvas>
            <div class="toolbar effect2">
                <div uk-grid>
                    <div class="progressbar uk-margin">
                        <span data-label="current-pos">0</span>
                        <input class="uk-range" id="progressbar" type="range" value="0" min="0" max="100" step="1">
                        <span data-label="total-pos">---</span>
                    </div>

                    <button
                        uk-tooltip="播放"
                        class="uk-button uk-button-default btn-play"><span uk-icon="icon: play"></span></button>
                    <button
                        uk-tooltip="下一帧"
                        class="uk-button uk-button-default btn-next"><span uk-icon="icon: chevron-right"></span></button>
                    <button
                        uk-tooltip="上一帧"
                        class="uk-button uk-button-default btn-prev"><span uk-icon="icon: chevron-left"></span></button>
                    <button
                        uk-tooltip="正放 / 加速"
                        class="uk-button uk-button-danger btn-toward"><span uk-icon="icon: chevron-double-right"></span></button>
                    <button
                        uk-tooltip="倒放 / 加速"
                        class="uk-button uk-button-default btn-backward"><span uk-icon="icon: chevron-double-left"></span></button>
                    <div>
                        <span>User:&nbsp;</span><span data-label="user">---</span>
                    </div>
                    <div class="right">
                    <button class="uk-button uk-button-default btn-reset">重置(充满BUG地)</button>
                    @guest
                        <script>
                            window.login = false
                        </script>
                        <a class="uk-button uk-button-primary" href="{{ route('login') }}">登录后才能上传</a>
                    @else
                        @csrf
                        <script>
                            window.login = true
                        </script>
                        <button class="uk-button uk-button-primary btn-upload">上传</button>
                    @endguest
                    </div>
                    @guest
                    @else
                        <div>
                            <span>剩余:&nbsp;</span><span data-label="countLeft">?</span>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
        <script src="{{ asset('js/drawer.js') }}"></script>
        <script>
            window.user = '游客'
        </script>
    </body>
</html>
@endsection
