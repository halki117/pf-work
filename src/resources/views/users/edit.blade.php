@extends('layouts.app')

@section('content')
    <div class="container">
      
      <form action="{{ route('users.update', $user->id) }}" method="POST" >
        @csrf
        
        <div class="form-group mt-5">
          <div class="input_user__name">
              <label for="name" class="">ユーザー名</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

              @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
        </div>

        <div class="form-group row">
          <label for="prefecture">{{ __('Prefecture') }}</label>

          <select type="text" class="form-control" name="prefecture" >
              <option hidden class="text-center">{{ $user->prefecture}}</option>
              @foreach(config('pref') as $key => $score)
                  <option value="{{ $score }}">{{ $score }}</option>
              @endforeach
          </select>
        </div>

        <div class="place_image mt-5">
          <label for="profile_photo">プロフィール写真</label>
          <div id="profile_photo" class="profile_photo" style="display:none"></div>
          
          <input class="btn btn-success" id="profile_photo" type="file" name="profile_photo" onchange="OnFileSelect( this );">
        </div>

        <div class="mt-5">
          <div class="form-group">
            <label for="profile_introduction">プロフィール文</label>
            <textarea class="form-control" name="profile_introduction" rows="10"></textarea>
  
            @error('profile_introduction')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
        </div>

        {{ method_field('put') }}
        <button type="submit" class="btn btn-success btn-block mt-5">ユーザー情報更新</button>

      </form>
    </div>

@endsection 

{{-- @section('content')
    <div class="container">
      編集画面
      
      <div id="header" class="mt-5"><b>Google Maps - 場所検索</b></div>
      <div>住所もしくは施設名で称検索</div>
      <input type="text" id="keyword" class="form-control"><button class="btn btn-primary m-2" id="search">検索実行</button>
      <button class="btn btn-warning m-2" id="clear">結果クリア</button>
      <div id="target"></div>

      
      <form action="{{ route('spots.update', $spot->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="spots_place mt-5">
          <label for="address" class="">■所在地表示</label>
          <div class="place_input">
            <div class="form-group row">
              <div class="col-8">
                  <input id="input_address" type="text" class="form-control @error('name') is-invalid @enderror" name="address" value="{{ $spot->address }}" required autocomplete="name" autofocus>
  
                  @error('address')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
            </div>
          </div>
  
          
        </div>
        
        <div class="latlng_form">
          緯度<input type="text" id="input_latitude" value="{{ $spot->latitude }}" name="latitude">  
          経度<input type="text" id="input_longitude" value="{{ $spot->longitude }}" name="longitude">
        </div>
  
        <div class="place_review mt-5">
          <div class="form-group">
            <label for="review">■レビュー</label>
            <textarea id="review" class="form-control" name="review" rows="10">{{ $spot->review }}</textarea>
  
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
  
        <div class="form-group mt-5">
          <label for="tags">■タグの追加</label>
          <spot-tags-input
            :initial-tags='@json($tagNames ?? [])'
            :autocomplete-items='@json($allTagNames ?? [])'
          >
          </spot-tags-input>
        </div>
        
        <div class="spots_public mt-5">
          <label for="public" class="">■投稿の公開・非公開</label>
          <div class="form-group d-flex">
            <div class="radio">
              <input type="radio" name="public" value="1" @if( $spot->public == true ) checked @endif >
              <label for="public">公開</label>
            </div>
            <div class="radio ml-5">
              <input type="radio" name="public" value="0" @if( $spot->public == false ) checked @endif >
              <label for="public">非公開</label>
            </div>
          </div>
        </div>

        {{ method_field('put') }}
        <button type="submit" class="btn btn-success btn-block">投稿する</button>
      </form> 

    </div>

@endsection --}}
