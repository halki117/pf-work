@extends('layouts.app')

@section('content')
    <div class="container">
      
      <form action="" method="POST">
        <div class="spots_place mt-5">
          <label for="address" class="">■所在地</label>
          <div class="place_input">
            <div class="form-group row">
              <div class="col-8">
                  <input id="address" type="text" class="form-control @error('name') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="name" autofocus>
  
                  @error('address')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
              <div class="col-4">
                <button class="btn btn-primary"　id="map-search">検索する</button>
              </div>
            </div>
          </div>
  
          {{-- <div class="place_map" id="map">
          </div> --}}

          <iframe id='map' src='https://www.google.com/maps/embed/v1/place?key=AIzaSyAH-4wGibx9deEeUHIyUEiTMqzzoaXgTqA&amp;q=大阪'
            width='100%'
            height='600'
            frameborder='0'>
          </iframe>
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
            <div class="place_image1 col-4">
              <label for="place_image">写真１</label>
              <div class="image">
                <p class="float-right">X</p>
                <img src="" alt="">
              </div>
            </div>
            <div class="place_image2 col-4">
              <label for="place_image">写真２</label>
              <div class="image">
                <p class="float-right">X</p>
                <img src="" alt="">
              </div>
            </div>
            <div class="place_image3 col-4">
              <label for="place_image">写真３</label>
              <div class="image">
                <p class="float-right">X</p>
                <img src="" alt="">
              </div>
            </div>
          </div>
         <button class="btn btn-primary mt-3">写真の追加</button>
        </div>
  
        <div class="spots_tag mt-5">
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
        </div>
  
  
        <div class="spots_public mt-5">
          <label for="public" class="">■投稿の公開・非公開</label>
          <div class="form-group d-flex">
            <div class="radio">
              <input type="radio" name="public" checked="checked">
              <label for="public">公開</label>
            </div>
            <div class="radio ml-5">
              <input type="radio" name="public">
              <label for="public">非公開</label>
            </div>
          </div>
        </div>
        
        <button type="submit" class="btn btn-success btn-block">投稿する</button>
      </form> 

    </div>

@endsection