@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="d-flex mt-5">
        @if ($spot->user_id === Auth::id())
          <div class="buttons d-flex">
            <div class="button">
              <a href="{{ route('spots.edit', $spot->id) }}" class="btn btn-success px-5 mx-1">投稿内容を編集</a>
            </div>
            <form action="{{ route('spots.destroy', $spot->id) }}" method="post" class="mr-2">
              @csrf
              {{ method_field('delete') }}
              <input  type="submit" class="btn btn-danger px-5 mx-1" value="投稿を削除" onclick="return confirm('投稿を削除してもよろしいですか？')">
            </form>
          </div>
        @endif
      </div>
        <div class="spot_show__contant">
          <div class="show_spots__images">
            <ul class="row">
              @php
                $images = $spot->image
              @endphp
              @foreach ($images as $image)
                @if (app()->isLocal())
                  <li class="col-lg-4 col-12  mt-2"><img class="new_spot__img" src="{{ asset('storage/'.$image )}}" alt="" style="width:350px;"></li>
                @else
                  <li class="col-lg-4 col-12  mt-2"><img class="new_spot__img" src="{{ $image }}" alt="" style="width:350px;"></li>
                @endif
              @endforeach
            </ul>
          </div>

          <div id="spot{{$spot->id}}_point"></div>
          <input type="hidden" id="spot_{{$spot->id}}__latitude" value="{{ $spot->latitude }}">
          <input type="hidden" id="spot_{{$spot->id}}__longitude" value="{{ $spot->longitude }}">
        </div>

          <div class="row">
            <div id="show_{{$spot->id}}_map" style="height:500px;width:50%;" class="col-lg-6 col-12"></div>
            <div class="pl-4 col-lg-6 col-12">
              <h2><span class="badge bg-dark text-white mt-4">所在地</span></h2>
              <p>{{ $spot->address}}</p>
              <hr>

              <div class="likes">
                  <spot-like
                  :initial-is-liked-by='@json($spot->isLikedBy(Auth::user()))'
                  :initial-count-likes='@json($spot->count_likes)'
                  :authorized='@json(Auth::check())'
                  endpoint="{{ route('spots.like', $spot->id) }}"
                  ></spot-like>
              </div>

              @foreach($spot->tags as $tag)
                @if($loop->first)
                  <div class="card-body pt-0 pb-4 mt-3">
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

          <div class="d-flex mt-2">
            <p class="mx-3">投稿者: {{ $spot->user->name }}</p>
            <p class="mx-3">投稿日時 {{ $spot->created_at }}</p>
          </div>

        <div class="mt-5">
          <h2><span class="badge bg-dark text-white">レビュー</span></h2>
          <p>{{ $spot->review}}</p>
          <hr>
        </div>

        <div class="comments mt-5">
          <h2><span class="badge bg-dark text-white">コメント一覧</span></h2>
          @if ($spot->comments)
              @foreach ($spot->comments as $comment)
                <div class="comment card mt-3">
                  <div class="card-body">
                    <div class="user_name d-flex">
                      @if (app()->isLocal())
                        @if ($comment->user->profile_photo)
                          <img src="{{ asset('storage/'.$comment->user->profile_photo ) }}" alt="" width="60" height="50">
                        @else
                          <img src="{{ asset('storage/user_icon.png' ) }}" alt="" width="60" height="50">
                        @endif
                      @else
                        @if ($comment->user->profile_photo)
                          <img src="{{ $comment->user->profile_photo }}" alt="" width="60" height="50">
                        @else
                          <img src="https://portfolio-bucket-images.s3.ap-northeast-1.amazonaws.com/uploads/user_icon.png" alt="" width="60" height="50">
                        @endif
                      @endif
                      <p>{{ $comment->user->name }}</p>
                    </div>
                    <div class="comment_content">
                      <p>{{ $comment->content }}</p>
                    </div>
                    @if ($comment->user_id === Auth::id())
                      <form action="{{ route('comments.destroy', $comment->id) }}" method="post" class="mr-2">
                        @csrf
                        {{ method_field('delete') }}
                        <input  type="submit" class="btn btn-danger  mx-1" value="コメントを削除" onclick="return confirm('コメントを削除してもよろしいですか？')">
                      </form>
                    @endif
                  </div>
                </div>
              @endforeach
          @endif
          @if ($spot->comments->isEmpty())
              <p>コメントはありません</p>
          @endif
        </div>

        <form action="{{ route('comments.store') }}" method="post" class="mt-5">
          @csrf
          <label for="content">コメントをする</label>
          <textarea id="content" class="form-control" name="content" rows="10"></textarea>
          <input type="hidden" name="spot_id" value="{{ $spot->id }}">
          @error('content')
            <strong class="red-text">{{ $message }}</strong>
          @enderror
          <button type="submit" class="btn btn-primary mt-2 btn-block px-0">コメントする</button>
        </form>
    </div>
@endsection

<script>
  // googleMapsAPIを持ってくるときに,callback=initMapと記述しているため、initMap関数を作成
  window.onload = function pointMap() {
    // welcome.blade.phpで描画領域を設定するときに、id=mapとしたため、その領域を取得し、mapに格納します。
    map = document.getElementById("show_{{$spot->id}}_map");
    let point = { lat: {{$spot->latitude }}, lng: {{$spot->longitude}} };
    // オプションを設定
    opt = {
        zoom: 13, //地図の縮尺を指定
        center: point,
    };
    // 地図のインスタンスを作成します。第一引数にはマップを描画する領域、第二引数にはオプションを指定
    mapObj = new google.maps.Map(map, opt);

    marker = new google.maps.Marker({
        position: point,
        map: mapObj,
        title: '現在地',
    });
  }
</script>

<script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyAH-4wGibx9deEeUHIyUEiTMqzzoaXgTqA&callback=pointMap" async defer>
</script>