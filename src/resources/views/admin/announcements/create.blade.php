@extends('layouts.app')

@section('content')
    <div class="container">
      
      <form action="{{ route('admin.announcements.store') }}" method="POST">
        @csrf
        
        <div class="form-group mt-5">
          <div class="content_annoucement_title">
              <label for="title" class="">タイトル</label>
              <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" autocomplete="title" autofocus>

              @error('title')
                <strong class="red-text">{{ $message }}</strong>
              @enderror
          </div>
        </div>

        <div class="mt-5">
          <div class="form-group content_annoucement_title">
            <label for="content">お知らせ内容</label>
            <textarea class="form-control" name="content" rows="10"></textarea>

            @error('content')
              <strong class="red-text">{{ $message }}</strong>
            @enderror
          </div>
        </div>

        <button type="submit" class="btn btn-success btn-block mt-5">通知する</button>

      </form>
    </div>

@endsection 