@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-center mt-5">
       <h3>ユーザー新規登録</h3>
    </div>
    <div class="d-flex align-items-center justify-content-center ">
       <a href="{{ route('register') }}"><button class="btn btn-success">新規登録画面へ進む</button></a>
    </div>
    <hr>
    <div class="d-flex align-items-center justify-content-center mt-5">
       <h3>SNS、その他アカウントでの登録も可能です！！</h3>
    </div>
    <div class="d-flex align-items-center justify-content-center ">
      <a href="/login/twitter">
        <button class="btn btn-primary" style="text-transform: none;"><i class="fab fa-twitter fa-2x mr-3"></i>Twitter</button>
      </a>
    </div>
    <div class="d-flex align-items-center justify-content-center ">
      <a href="/login/google">
        <button class="btn btn-danger" style="text-transform: none;"><i class="fab fa-google fa-2x mr-3"></i>Google</button>
      </a>
    </div>
</div>
@endsection
