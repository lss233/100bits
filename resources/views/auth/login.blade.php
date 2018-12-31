@extends('layouts.app')

@section('content')
<div class="container">
    <div class="uk-grid-small uk-child-width-expand@s uk-text-center">
        <div>
            <div class="uk-card uk-card-primary uk-card-body uk-align-center">
                <h3 class="uk-card-title">登录 - 100Bits!</h3>
                <p>通过简单的验证系统来留下您的名字. By Lss233</p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <fieldset class="uk-fieldset">
                        <div class="uk-margin">
                                <div class="uk-inline">
                                        <span class="uk-form-icon" uk-icon="icon: user"></span>
                                        <input
                                            name="email" class="uk-input{{ $errors->has('email') ? ' uk-form-danger' : '' }}" type="email" placeholder="邮箱地址" value="{{ old('email') }}" required autocomplete>
                                </div>
                        </div>

                        <div class="uk-margin">
                                <div class="uk-inline">
                                        <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                        <input
                                            name="password" class="uk-input{{ $errors->has('password') ? ' uk-form-danger' : '' }}" type="password" placeholder="密码" value="{{ old('password') }}" required autocomplete>
                                </div>
                        </div>

                        <div class="uk-margin uk-child-width-auto">
                            <label><input class="uk-checkbox" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> 记住我</label>
                        </div>
                    </fieldset>
                    <button class="uk-button uk-button-primary" type="submit">登录</button>
                    <a class="uk-button uk-button-links" href="{{ route('password.request') }}">忘记密码</a>
                </form>
            </div>
        </div>
        <script>
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
        </script>
    </div>
</div>
@endsection
