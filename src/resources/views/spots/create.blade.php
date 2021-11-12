@extends('layouts.app')

@section('content')
    <div class="container">

      {{-- 住所から場所検索 --}}
      <div id="header" class="mt-5"><b>Google Maps - 場所検索</b></div>
      <div>住所もしくは施設名で称検索</div>
      <input type="text" id="keyword" class="form-control"><button class="btn btn-primary m-2" id="search">検索実行</button>
      <button class="btn btn-warning m-2" id="clear">結果クリア</button>
      <div id="target"></div>

      
      <form action="{{ route('spots.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="spots_place mt-5">
          <label for="address" class="">■所在地表示</label>
          <div class="place_input">
            <div class="form-group row">
              <div class="col-8">
                  <input id="input_address" type="text" class="form-control @error('name') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="name" autofocus>
  
                  @error('address')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
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
  
        <div class="place_review mt-5">
          <div class="form-group">
            <label for="review">■レビュー</label>
            <textarea id="review" class="form-control" name="review" rows="10"></textarea>
  
            @error('review')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
        </div>
  
  
        <div class="place_image mt-5">
          <label for="place_image">■写真を挿入</label>
          <div class="place_images row mt-3">
            <div id="preview" class="preview" style="display:none"></div>
          </div>
          
          <input class="btn btn-success" id="image" type="file" name="image[]" onchange="OnFileSelect( this );" multiple>
        </div>
  
        {{-- <div class="spots_tag mt-5">
          <label for="tag" class="">■タグ</label>
          <div class="tag_input">
            <div class="form-group row">
              <div class="col-8">
                  <input id="tag" type="text" class="form-control @error('name') is-invalid @enderror" name="address" value="{{ old('tag') }}" required autocomplete="tag" autofocus>
  
                  @error('tag')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
              <div class="col-4">
                <button class="btn btn-primary">タグの登録</button>
              </div>
            </div>
          </div>
        </div> --}}
  
  
        <div class="spots_public mt-5">
          <label for="public" class="">■投稿の公開・非公開</label>
          <div class="form-group d-flex">
            <div class="radio">
              <input type="radio" name="public" value="1" checked="checked">
              <label for="public">公開</label>
            </div>
            <div class="radio ml-5">
              <input type="radio" name="public" value="0">
              <label for="public">非公開</label>
            </div>
          </div>
        </div>
        
        <button type="submit" class="btn btn-success btn-block">投稿する</button>
      </form> 

    </div>

@endsection
