@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="d-flex mt-5">
        <h1>詳細画面</h1>
        @can ('admin')
          <div class="buttons d-flex">
            <form action="{{ route('spots.destroy', $spot->id) }}" method="post" class="mr-2">
              @csrf
              {{ method_field('delete') }}
              <input  type="submit" class="btn btn-danger btn-lg px-5 mx-1" value="投稿を削除" onclick="return confirm('投稿を削除してもよろしいですか？')">
            </form>
          </div>
        @endcan
      </div>
      <p>投稿者: {{ $spot->user->name }}</p>
        <div class="spot_show__contant">
          <div class="new_spot">
            <ul class="d-flex">
              @php
                $images = $spot->image
              @endphp
              @foreach ($images as $image)
              <li class="mx-3"><img class="new_spot__img" src="{{ asset('storage/'.$image )}}" alt=""></li>
              @endforeach
            </ul>
          </div>
          <div class="address_likes">
            <p>{{ $spot->address}}</p>
          </div>

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

          <div class="card my-2">
            <p>レビュー</p>
            <div class="card-body">
              <p>{{ $spot->review}}</p>
            </div>
          </div>

          <div id="spot{{$spot->id}}_point"></div>
          <input type="hidden" id="spot_{{$spot->id}}__latitude" value="{{ $spot->latitude }}">
          <input type="hidden" id="spot_{{$spot->id}}__longitude" value="{{ $spot->longitude }}">
        </div>

        <div id="show_{{$spot->id}}_map" style="height:500px">
        </div>
        @if ($spot->user_id === Auth::id())
        @endif

        <div class="comments mt-5">
          <p>コメント一覧</p>
          @if ($spot->comments)
              @foreach ($spot->comments as $comment)
                <div class="comment card mt-3">
                  <div class="card-body">
                    <div class="user_name d-flex">
                      <img src="{{ asset('storage/user_icon.png' ) }}" alt="" width="60" height="50">
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
          @else
            <p>コメントは何もありません</p>
          @endif
        </div>

        <form action="{{ route('comments.store') }}" method="post" class="mt-5">
          @csrf
          <label for="content">コメントをする</label>
          <textarea id="content" class="form-control" name="content" rows="10"></textarea>
          <input type="hidden" name="spot_id" value="{{ $spot->id }}">
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