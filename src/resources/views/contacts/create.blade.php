@extends('layouts.app')

@section('content')
<div class="container">
  <form action="{{ route('contacts.confirm') }}" method="GET">
    
    <div class="form-group mt-5">
      <div class="content_annoucement_title">
          <label for="title" class="">件名(必須)</label>
          <input type="text" class="form-control" name="title" autocomplete="title" autofocus>

          @error('title')
            <strong class="red-text">{{ $message }}</strong>
          @enderror
      </div>
    </div>

    <div class="mt-5">
      <div class="form-group content_annoucement_title">
        <label for="content">お問い合わせ内容（必須）</label>
        <textarea class="form-control" name="content" rows="10"></textarea>

        @error('content')
            <strong class="red-text">{{ $message }}</strong>
        @enderror
      </div>
    </div>

    <button type="submit" class="btn btn-primary btn-block mt-5">確認画面へ</button>

  </form>
</div>
@endsection
