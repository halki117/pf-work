@extends('layouts.app')

@section('content')
<div class="hero">
  <img src="https://manablog.org/wp-content/uploads/2015/02/f1a9fcfd142669cb8ab064cb90251123.jpg" alt="" >
  <div class="hero_right__contents float-right">
    <h3>自分に最適なスポットを発見しよう!!!</h3>
    <button class="btn btn-success">スポットを検索</button>
  </div>
</div>
<div class="container">
  <div class="new_spot">
    <h3>新着スポット</h3>
    <div class="row">
      <div class="card col-4">
        <div class="card-body">
            <img  class="" src="" alt="">
            <i class="fas fa-heart"></i>
            <p>所在地</p>
            <p>レビュー</p>
        </div>
      </div>
    </div>
  </div>
  <div class="popular_spot">
    <h3>人気のスポット</h3>
  </div>
</div>

@endsection