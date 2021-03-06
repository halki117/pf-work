@extends('layouts.app')

@section('content')

  <div class="container-fluid">
    <div class="container">
      <h1 class="mt-5" style="padding: 1rem 2rem;border-left: 6px double #000;">指定箇所から周辺のスポットを検索しよう！！</h1>
      <div class="place_range mt-5">
        <div class="form-group">
          <label for="range">
            <h4><span class="badge bg-dark text-dark mt-4 mr-2">1</span>指定箇所をきめる(必須)</h4>
            <p>・住所、施設名から場所を指定。または、地図から直接場所を指定するか選んでください</p>
          </label>
          @error('latitude')
            <strong class="red-text">{{ $message }}</strong>
          @enderror

            <div class="mt-3">
              <input type="radio" name="btn1" id="a" checked="checked">住所または施設名から指定
              <div class="text1 text1-1">
                <input type="text" id="keyword" class="form-control"><button class="btn btn-primary m-2" id="search">検索する</button>
              </div>
            </div>
            
            <div class="mt-3">
              <input type="radio" name="btn1" id="b">地図から直接場所を指定
              <div class="text1 text1-2">
                <div id="target"></div>
              </div>
            </div>
        </div>
      </div>

      <form action="{{ route('spots.searched') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="spots_place mt-5">
          <label for="address" class="text-info">指定箇所</label>
          <div class="place_input">
            <div class="form-group row">
              <div class="col-8">
                  <p id="result_address"></p>
                  <hr color="#33b5e5">
              </div>
            </div>
          </div>
        </div>
        
        <div class="latlng_form">
          <input type="hidden" id="input_latitude" value="{{ old('latitude') }}" name="latitude">  
          <input type="hidden" id="input_longitude" value="{{ old('longitude') }}" name="longitude">
        </div>

        <div class="place_range mt-5">
          <div class="form-group">
            <label for="range"><h4><span class="badge bg-dark text-dark mt-4 mr-2">2</span>指定箇所からの範囲(必須)</h4></label>
              <p>・徒歩何分以内。または、距離何km以内かを選んでください(半角入力)</p>
              @if ($errors->any())
                @error('range_time')
                  <strong class="red-text">{{ $message }}</strong>
                @enderror
                @error('range_distance')
                  <strong class="red-text">{{ $message }}</strong>
                @enderror
              @endif

              <div class="mt-3">
                <input type="radio" name="btn2" id="c" checked="checked">徒歩何分以内
                <div class="text2 text2-1">
                  <input type="text" name="range_time" id="range_time" class="form-control" ><strong>分</strong>
                </div>
              </div>
              
              <div class="mt-3">
                <input type="radio" name="btn2" id="d">距離何km以内
                <div class="text2 text2-2">
                  <input type="text" name="range_distance" id="range_distance" class="form-control" ><strong>km</strong>
                </div>
              </div>
            
          </div>
        </div>

        <div class="place_range mt-5">
          <div class="form-group">
            <label for="sort"><h4><span class="badge bg-dark text-dark mt-4 mr-2">3</span>並び替え（任意)</h4></label>
            <select name="sort" id="select_sort" class="form-control">
              <option value="">--指定なし--</option>
              <option value="order_new">新着順</option>
              <option value="order_likes">いいねの多い順</option>
            </select>
            
            @error('sort')
                <strong class="red-text">{{ $message }}</strong>
            @enderror
          </div>
        </div>


        <div class="place_range mt-5">
          <div class="form-group">
            <label for="search_tags"><h4><span class="badge bg-dark text-dark mt-4 mr-2">4</span>タグで絞り込む（任意）</h4></label>

            <div class="select_contents d-flex">
              @foreach ($tags as $tag)
                <div class="select_content ml-2">
                  <input type="checkbox" name="tags[]" value="{{ $tag->id }}">{{ $tag->hashtag }}
                </div>
              @endforeach
            </div>
            @error('search_tags')
                <strong class="red-text">{{ $message }}</strong>
            @enderror
          </div>
        </div>
  
        <button type="submit" class="btn btn-success btn-block mt-5">検索する</button>
      </form> 

    </div>
  </div>
    
@endsection

{{-- google map api用js --}}
<script src="{{ asset('/js/result.js') }}"></script>

{{-- 住所から場所検索 --}}
<script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyAH-4wGibx9deEeUHIyUEiTMqzzoaXgTqA&callback=initMap" async defer></script>