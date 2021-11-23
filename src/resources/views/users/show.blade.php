@extends('layouts.app')

@section('content')
  
  <div class="container-fluid">
    
    <div class="row mypage_content">
      <div class="col-8 mypage_leftcontent">
        <div class="btn-group">
          <a href="#!" class="btn btn-info active">投稿したスポット</a>
          <a href="{{ route('spots.favorites') }}" class="btn btn-light">いいねしたスポット</a>
        </div>
        @if (!($spots->isEmpty()))
        @foreach ($spots as $spot)
          <div class="card mb-3">
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
                    <i class="fas fa-heart"></i> x{{ $spot->count_likes }}
                  </div>
                  <div class="tags">
                    @foreach($spot->tags as $tag)
                      @if($loop->first)
                        <div class="card-body pt-0 pb-4 pl-3">
                          <div class="card-text line-height">
                      @endif
                            <a href="{{ route('tags.show', ['name' => $tag->name]) }}" class="border p-1 mr-1 mt-1 text-muted">
                              {{ $tag->hashtag }}
                            </a>
                      @if($loop->last)
                          </div>
                        </div>
                      @endif
                    @endforeach
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
        <div class="mypage_rightcontent__profilephoto mt-2">
          @if ($user->profile_photo)
            <img src="{{ asset('storage/'.$user->profile_photo ) }}" alt="" style="width:250px;height:250px;border-radius:50%;">
          @else
            <img src="{{ asset('storage/user_icon.png' ) }}" alt="">
          @endif
        </div>
        <div class="mypage_rightcontent__prefecture mt-5">
          <p>居住地:{{ $user->prefecture }}</p>
        </div>
        <div class="mypage_rightcontent__profileintroduction mt-5">
          <p>プロフィール</p>
          <div class="profile_content ">
            <p>{{ $user->profile_introduction }}</p>
          </div>
        </div>
        <a href="{{ route('users.edit', $user->id ) }}">
          <button class="btn btn-warning btn-lg mt-5">ユーザー情報編集</button>
        </a>
      </div>
    </div>
  </div>
  
@endsection