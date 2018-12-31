@extends('layouts.app')
@section('content')
<div class="container">
    <div class="uk-grid-small uk-child-width-expand@s uk-text-center">
        <div>
            <div class="uk-card uk-card-primary uk-card-body uk-align-center">
                <h3 class="uk-card-title">验证你的邮箱 - 100Bits!</h3>
                @if (session('resent'))
                一条新的验证链接已发至您的邮箱，请查收~
                @endif
                我们向您的邮箱发送了一条验证链接的邮件，请打开链接继续下一步。
                如果您没有收到那封邮件，请<a href="{{ route('verification.resend') }}">点击这里让我们重新发送一次</a>.
            </div>
        </div>
    </div>
</div>
@endsection
