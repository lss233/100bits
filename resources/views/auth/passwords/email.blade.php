@extends('layouts.app')

@section('content')
<div class="container">
    <div class="uk-grid-small uk-child-width-expand@s uk-text-center">
        <div>
            <div class="uk-card uk-card-primary uk-card-body uk-align-center">
                <h3 class="uk-card-title">重置密码 - 100Bits!</h3>
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <fieldset class="uk-fieldset">
                        <div class="uk-margin">
                                <div class="uk-inline">
                                        <span class="uk-form-icon" uk-icon="icon: user"></span>
                                        <input
                                            name="email" class="uk-input{{ $errors->has('email') ? ' uk-form-danger' : '' }}" type="email" placeholder="邮箱地址" value="{{ old('email') }}" required autocomplete>
                                </div>
                        </div>
                    </fieldset>
                    <button class="uk-button uk-button-primary" type="submit">下一步</button>
                </form>
            </div>
        </div>
        <script>
            @if ($errors->has('email'))
                $(document).ready(function() {
                    UIkit.notification('{{ $errors->first('email') }}');
                })
            @endif
            @if (session('status'))
                $(document).ready(function() {
                    UIkit.notification('{{ session('status') }}');
                })
            @endif
        </script>
    </div>
</div>
@endsection
