@extends('layouts.app')

@section('content')

  <div class="container-fluid">
    <div class="container">
      <h1>スポットを検索する</h1>

      {{-- 住所から場所検索 --}}
      {{-- <div id="header" class="mt-5"><b>Google Maps - 場所検索</b></div> --}}


      <div class="place_range mt-5">
        <div class="form-group">
          <label for="range"><h4>1.指定箇所を決める</h4></label>

            <div class="mt-3">
              <input type="radio" name="btn1" id="a" checked="checked">住所または施設名から指定
              <div class="text1 text1-1">
                <input type="text" id="keyword" class="form-control"><button class="btn btn-primary m-2" id="search">検索する</button>
                {{-- <button class="btn btn-warning m-2" id="clear">結果クリア</button> --}}
              </div>
            </div>
            
            <div class="mt-3">
              <input type="radio" name="btn1" id="b">地図から直接場所を指定
              <div class="text1 text1-2">
                <div id="target"></div>
              </div>
            </div>
          
          @error('range')
              <strong class="red-text">{{ $message }}</strong>
          @enderror
        </div>
      </div>


{{-- 
      <div>住所もしくは施設名で称検索</div>
      <input type="text" id="keyword" class="form-control"><button class="btn btn-primary m-2" id="search">検索実行</button>
      <button class="btn btn-warning m-2" id="clear">結果クリア</button>
      <div id="target"></div> --}}

      
      <form action="{{ route('spots.searched') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="spots_place mt-5">
          <label for="address" class="">指定箇所の表示</label>
          <div class="place_input">
            <div class="form-group row">
              <div class="col-8">
                  <p id="result_address"></p>

                  {{-- <input id="input_address" type="text" class="form-control @error('name') is-invalid @enderror" name="address" value="{{ old('address') }}" autocomplete="address" autofocus> --}}
  
                  {{-- @error('address')
                    <strong class="red-text">{{ $message }}</strong>
                  @enderror --}}
              </div>
            </div>
          </div>

          {{-- リバースジオコーディング用 --}}
          {{-- <div id="gmap" style="height:400px;width:600px"></div> --}}
          
        </div>
        
        <div class="latlng_form">
          緯度<input type="text" id="input_latitude" value="{{ old('latitude') }}" name="latitude">  
          経度<input type="text" id="input_longitude" value="{{ old('longitude') }}" name="longitude">
        </div>
  
        <div class="place_range mt-5">
          <div class="form-group">
            <label for="range"><h4>2.指定箇所からの範囲</h4></label>

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
            
            @error('range')
                <strong class="red-text">{{ $message }}</strong>
            @enderror
          </div>
        </div>


        <div class="place_range mt-5">
          <div class="form-group">
            <label for="sort"><h4>3.並び替え（任意)</h4></label>
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
            <label for="search_tags"><h4>4.タグで絞り込む（任意）</h4></label>

            <div class="select_contents d-flex">
              @foreach ($tags as $tag)
                <div class="select_content ml-2">
                  <input type="checkbox" name="tags[]" value="{{ $tag->id }}">{{ $tag->hashtag }}
                </div>
              @endforeach
            </div>
            {{-- <select name="search_tags" id="select_tags" class="form-control" >
              <option value="">--Please choose an option--</option>
              @foreach ($tags as $tag)
                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
              @endforeach
            </select>
             --}}
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