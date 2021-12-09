@extends('layouts.app')

@section('content')
<div class="container">
  <form action="{{ route('contacts.store') }}" method="POST">
    @csrf
    
    <div class="form-group mt-5">
      <div class="content_annoucement_title">
          <label for="title" class="">件名</label>
          <p>{{ $request->title }}</p> 
          <input type="hidden" name="title" value="{{ $request->title }}">
      </div>
    </div>

    <div class="mt-5">
      <div class="form-group content_annoucement_title">
        <label for="content">お問い合わせ内容</label>
        <p>{{ $request->content }}</p> 
        <input type="hidden" name="content" value="{{ $request->content }}">
      </div>
    </div>

    <button name="action" type="submit" value="return" class="btn btn-warning btn-block mt-5">確認画面へ戻る</button>
    <button name="action" type="submit" value="submit" class="btn btn-success btn-block mt-5">送信</button>
  </form>
</div>
@endsection
