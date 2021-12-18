@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5">
                <div class="card-header">登録するアドレスを確認します</div>

                <div class="card-body">

                    認証メールを送信しました。当メールからアドレスの認証をお願いします。
                    <br>
                    <br>
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('メールが届いてない場合は、こちらをクリックしてメールを再度送信') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
