@extends('layouts.app')

@section('content')
<div class="container">
    <div class="uk-grid-small uk-child-width-expand@s uk-text-center">
        <div>
            <div class="uk-card uk-card-primary uk-card-body uk-align-center">
                <h3 class="uk-card-title">重置密码 - 100Bits!</h3>
                <p>我们已经到达最后一步啦！</p>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <fieldset class="uk-fieldset">

                        <div class="uk-margin">
                                <div class="uk-inline">
                                        <span class="uk-form-icon" uk-icon="icon: user"></span>
                                        <input
                                            name="email" class="uk-input{{ $errors->has('email') ? ' uk-form-danger' : '' }}" type="email" placeholder="邮箱地址" required>
                                </div>
                        </div>

                        <div class="uk-margin">
                                <div class="uk-inline">
                                        <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                        <input
                                            name="password" class="uk-input{{ $errors->has('password') ? ' uk-form-danger' : '' }}" type="password" placeholder="密码" required>
                                </div>
                        </div>
                        <div class="uk-margin">
                                <div class="uk-inline">
                                        <span class="uk-form-icon" uk-icon="icon: refresh"></span>
                                        <input
                                            name="password_confirmation" class="uk-input{{ $errors->has('password_confirmation') ? ' uk-form-danger' : '' }}" type="password" placeholder="确认密码" required>
                                </div>
                        </div>
                    </fieldset>
                    <button class="uk-button uk-button-primary" type="submit">我保证不会忘记这个密码了</button>
                </form>
            </div>
        </div>
        <script>
            @if ($errors->has('name'))
                $(document).ready(function() {
                    UIkit.notification('{{ $errors->first('name') }}');
                })
            @endif
            @if ($errors->has('email'))
                $(document).ready(function() {
                    UIkit.notification('{{ $errors->first('email') }}');
                })
            @endif
            @if ($errors->has('password'))
                $(document).ready(function() {
                    UIkit.notification('{{ $errors->first('password') }}');
                })
            @endif
            @if ($errors->has('password_confirmation'))
                $(document).ready(function() {
                    UIkit.notification('{{ $errors->first('password_confirmation') }}');
                })
            @endif
        </script>
    </div>
</div>
@endsection
