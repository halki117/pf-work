@extends('layouts.app')

@section('content')
    <div class="container">
      <h1>詳細画面</h1>
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
            <i class="fas fa-heart"></i>
          </div>
          <p>{{ $spot->review}}</p>

          <div id="spot{{$spot->id}}_point"></div>
          <input type="hidden" id="spot_{{$spot->id}}__latitude" value="{{ $spot->latitude }}">
          <input type="hidden" id="spot_{{$spot->id}}__longitude" value="{{ $spot->longitude }}">
        </div>

        <div id="show_{{$spot->id}}_map" style="height:500px">
        </div>
        @if ($spot->user_id === Auth::id())
        <div class="buttons d-flex">
          <div class="button">
            <a href="{{ route('spots.edit', $spot->id) }}" class="btn btn-success btn-lg px-5 mx-1">投稿内容を編集</a>
          </div>
          <form action="{{ route('spots.destroy', $spot->id) }}" method="post" class="mr-2">
            @csrf
            {{ method_field('delete') }}
            <input  type="submit" class="btn btn-danger btn-lg px-5 mx-1" value="投稿を削除" onclick="return confirm('投稿を削除してもよろしいですか？')">
          </form>
        </div>
        @endif
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