@extends('layouts.app')

@section('content')
  
  <div class="container-fluid">
    
    <div class="row mypage_content">
      <div class="col-8 mypage_leftcontent">
        <div class="">
          <button type="button" class="btn btn-info">投稿したスポット</button>
          <button type="button" class="btn btn-info">いいねしたスポット</button>
        </div>
        @if (!($spots->isEmpty()))
        @foreach ($spots as $spot)
          <div class="card">
            <a href="{{ route('spots.show', $spot->id) }}">
              <div class="card-body row">
                <div class="col-4">
                  @php
                    $images = $spot->image
                  @endphp
                  <div class="new_spot my-auto">
                    <img class="new_spot__img" src="{{ asset('storage/'.$images[0] )}}" alt="">
                  </div>
                </div>
                <div class="col-8 pt-3">
                  <h5>{{ $spot->address}}</h5>
                  <div class="review mt-3">
                    <p>{{ $spot->review}}</p>
                  </div>
                  <div class="likes">
                    <i class="fas fa-heart"></i>x0
                  </div>
                  <div class="buttons">
                    <a href="{{ route('spots.edit', $spot->id) }}" class="btn btn-success btn-lg px-5">編集</a>
                  </div>
                </div>
              </div> 
            </a>
          </div>
        @endforeach
        @else
          <p>何も投稿がありません</p>
        @endif
      </div>
      <div class="col-4 mypage_rightcontent">
        <div class="mypage_rightcontent__username">
          <h1>{{ $user->name }}</h1>
        </div>
        <div class="mypage_rightcontent__profilephoto">
          <img src="{{ asset('storage/user_icon.png' ) }}" alt="">
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
        <button class="btn btn-warning btn-lg">ユーザー情報編集</button>
      </div>
    </div>
  </div>
  
@endsection