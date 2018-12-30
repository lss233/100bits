<!DOCTYPE html>
<html>
    <head>
        <title>Title</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/uikit-rtl.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/drawer.css') }}" />
    </head>
    <body>
        <div class="center">
            <canvas id="drawer"></canvas>
            <div class="toolbar effect2">
                <div uk-grid>
                    <progress id="progressbar" class="uk-progress" value="0" max="100"></progress>

                    <button class="uk-button uk-button-default btn-play"><span uk-icon="icon: play"></span></button>
                    <button class="uk-button uk-button-default btn-next"><span uk-icon="icon: chevron-right"></span></button>
                    <button class="uk-button uk-button-default btn-prev"><span uk-icon="icon: chevron-left"></span></button>
                    <button class="uk-button uk-button-danger btn-toward"><span uk-icon="icon: chevron-double-right"></span></button>
                    <button class="uk-button uk-button-default btn-backward"><span uk-icon="icon: chevron-double-left"></span></button>
                    <div style="margin-left: 50px">
                        <span>User:&nbsp;</span><span data-label="user">Lss233</span>
                    </div>
                    <div class="right">
                    <button class="uk-button uk-button-default btn-reset">重置(充满BUG地)</button>
                    <button class="uk-button uk-button-primary btn-upload">上传</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
        <script src="{{ asset('js/uikit.min.js') }}"></script>
        <script src="{{ asset('js/uikit-icons.min.js') }}"></script>
        <script src="{{ asset('js/drawer.js') }}"></script>
        <script>
            window.user = '游客'
        </script>
    </body>
</html>
