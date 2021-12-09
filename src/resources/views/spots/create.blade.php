@extends('layouts.app')

@section('content')
    <div class="container">
      <h1 class="mt-5" style="padding: 1rem 2rem;border-left: 6px double #000;">スポットを投稿してみよう！！</h1>
      
      {{-- 住所から場所検索 --}}
      <h4><span class="badge bg-dark text-dark mt-5 mr-2">1</span>所在地を決めましょう(必須)</h4>
      <p>・住所もしくは施設名から住所を検索できます</p>
      <input type="text" id="keyword" class="form-control"><button class="btn btn-primary m-2" id="search">検索実行</button>
      <button class="btn btn-warning m-2" id="clear">結果クリア</button>

      <div class="spots_place mt-4">
        <label for="address" class="text-info">検索住所（以下の住所を登録します）</label>
        @error('address')
          <strong class="red-text">{{ $message }}</strong>
        @enderror
        <div class="place_input">
          <div class="form-group row">
            <div class="col-8">
                <p id="result_address"></p>
                <hr>
            </div>
          </div>
        </div>
      </div>

      <div id="target"></div>

      
      <form action="{{ route('spots.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="spots_place">
          <div class="place_input">
            <div class="form-group row">
              <div class="col-8">
                  <input id="input_address" type="hidden" class="form-control @error('name') is-invalid @enderror" name="address" value="{{ old('address') }}" autocomplete="address" autofocus>
              </div>
            </div>
          </div>
        </div>
        
        <div class="latlng_form">
          <input type="hidden" id="input_latitude" value="{{ old('latitude') }}" name="latitude">  
          <input type="hidden" id="input_longitude" value="{{ old('longitude') }}" name="longitude">
        </div>
  
        <div class="place_review mt-5">
          <div class="form-group">
            <h4><span class="badge bg-dark text-dark mt-5 mr-2">2</span>レビューを書きましょう（必須）</h4>
            @error('review')
              <strong class="red-text">{{ $message }}</strong>
            @enderror
            <textarea id="review" class="form-control" name="review" rows="10">{{ old('review') }}</textarea>
          </div>
        </div>
  
  
        <div class="place_image mt-5">
          <h4><span class="badge bg-dark text-dark mt-5 mr-2">3</span>写真を挿入(必須、3枚まで投稿可能)</h4>
          <div class="place_images mt-3">
            <div id="preview" class="preview d-flex justify-content-around" style="display:none"></div>
          </div>
          
          <input class="btn btn-success" id="image" type="file" name="image[]" onchange="OnFileSelect( this );" multiple>
          @error('image.*')
            <strong class="red-text">{{ $message }}</strong>
          @enderror
          @error('image')
            <strong class="red-text">{{ $message }}</strong>
          @enderror
          
        </div>
  
        <div class="form-group mt-5">
          <h4><span class="badge bg-dark text-dark mt-5 mr-2">4</span>タグの追加（任意）</h4>
          <spot-tags-input
            :autocomplete-items='@json($allTagNames ?? [])'
          >
          </spot-tags-input>
        </div>

        <div class="spots_public mt-5">
          <h4><span class="badge bg-dark text-dark mt-5 mr-2">5</span>投稿の公開・非公開を選んでください</h4>
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
        
        <button type="submit" class="btn btn-success btn-block" id="spots_upload">投稿する</button>
      </form> 

    </div>

@endsection
