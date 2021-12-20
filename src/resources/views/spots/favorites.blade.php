@extends('layouts.app')

@section('content')
  
  <div class="container-fluid">
    
    <div class="row mypage_content">
      <div class="col-8 mypage_leftcontent">
        <div class="btn-group">
          <a href="{{ route('users.show', Auth::id() ) }}" class="btn btn-light ">投稿したスポット</a>
          <a href="{{ route('spots.favorites') }}" class="btn btn-info active">いいねしたスポット</a>
        </div>
        @if (!($spots->isEmpty()))
        @foreach ($spots as $spot)
          @include('templates.spots_template')
        @endforeach
        @else
          <p>何も投稿がありません</p>
        @endif
        {{ $spots->links() }}
      </div>
      <div class="col-4 mypage_rightcontent">
        <div class="mypage_rightcontent__username">
          <h1>{{ $user->name }}</h1>
        </div>
        <div class="mypage_rightcontent__profilephoto">
          @if ($user->profile_photo)
            <img src="{{ asset('storage/'.$user->profile_photo ) }}" alt="" style="width:250px;height:250px;border-radius:50%;">
          @else
            <img src="{{ asset('storage/user_icon.png' ) }}" alt="">
          @endif
        </div>
        <div class="mypage_rightcontent__prefecture">
          <p>居住地:{{ $user->prefecture }}</p>
        </div>
        <div class="mypage_rightcontent__profileintroduction">
          <p>プロフィール</p>
          <div class="profile_content ">
            <p>{{ $user->profile_introduction }}</p>
          </div>
        </div>
        <a href="{{ route('users.edit', $user->id ) }}">
          <button class="btn btn-warning btn-lg">ユーザー情報編集</button>
        </a>
      </div>
    </div>
  </div>
  
@endsection