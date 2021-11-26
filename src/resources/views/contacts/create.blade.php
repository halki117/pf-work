@extends('layouts.app')

@section('content')
<div class="container">
  <form action="{{ route('contacts.confirm') }}" method="GET">
    
    <div class="form-group mt-5">
      <div class="content_annoucement_title">
          <label for="title" class="">件名</label>
          <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" required autocomplete="title" autofocus>

          @error('title')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
      </div>
    </div>

    <div class="mt-5">
      <div class="form-group content_annoucement_title">
        <label for="content">お問い合わせ内容</label>
        <textarea class="form-control" name="content" rows="10"></textarea>

        @error('content')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
    </div>

    <button type="submit" class="btn btn-primary btn-block mt-5">確認画面へ</button>

  </form>
</div>
@endsection
