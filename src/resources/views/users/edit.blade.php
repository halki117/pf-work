@extends('layouts.app')

@section('content')
    <div class="container">
      
      <form action="{{ route('users.update', $user->id) }}" method="POST" enctype='multipart/form-data'>
        @csrf
        
        <div class="form-group mt-5">
          <div class="content_user_name">
              <label for="name" class="">ユーザー名</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

              @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
        </div>

        <div class="form-group row pref_form">
          <label for="prefecture">{{ __('Prefecture') }}</label>

          <select type="text" class="form-control" name="prefecture" >
              <option hidden class="text-center">{{ $user->prefecture }}</option>
              @foreach(config('pref') as $key => $score)
                  <option value="{{ $score }}">{{ $score }}</option>
              @endforeach
          </select>
        </div>

        <div class="mt-5">
          <label for="profile_photo">プロフィール写真</label>
          <div class="content_profile_photo">
            <div id="profile_photo" class="profile_photo__space">
              @if (app()->isLocal())
                @if ($user->profile_photo)
                  <img src="{{ asset('storage/'.$user->profile_photo ) }}" alt="" style="width: 250px;height: 250px;border-radius: 50%;">
                @endif
              @else
                @if ($user->profile_photo)
                  <img src="{{ $user->profile_photo }}" alt="" style="width: 250px;height: 250px;border-radius: 50%;">
                @endif
              @endif
            </div>
            <input class="btn btn-success btn-block btn-profile-photo" id="profile_photo__input" type="file" name="profile_photo">
          </div>
        </div>

        <div class="mt-5">
          <div class="form-group">
            <label for="profile_introduction">プロフィール文</label>
            <textarea class="form-control" name="profile_introduction" rows="10">{{ $user->profile_introduction }}</textarea>

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
