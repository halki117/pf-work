@extends('layouts.app')

@section('content')
<div class="hero">
  <picture>
    <img src="https://manablog.org/wp-content/uploads/2015/02/f1a9fcfd142669cb8ab064cb90251123.jpg" alt="" >
  </picture>
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
          @if (!($spots->isEmpty()))
            @foreach ($spots as $spot)
              @php
                $images = $spot->image
              @endphp
              <div class="new_spot">
                <img class="new_spot__img" src="{{ asset('storage/'.$images[0] )}}" alt="">
              </div>
              <i class="fas fa-heart"></i>
              <p>{{ $spot->address}}</p>
              <p>{{ $spot->review}}</p>
            @endforeach
          @else
            <p>何も投稿がありません</p>
          @endif
        </div>
      </div>
    </div>
  </div>
  <div class="popular_spot mt-5">
    <h3>人気のスポット</h3>
    <div class="row">
      <div class="card col-4">
        <div class="card-body">
          @if (!($spots->isEmpty()))
            @foreach ($spots as $spot)
              @php
                $images = $spot->image
              @endphp
              <div class="new_spot">
                <img class="new_spot__img" src="{{ asset('storage/'.$images[0] )}}" alt="">
              </div>
              <i class="fas fa-heart"></i>
              <p>{{ $spot->address}}</p>
              <p>{{ $spot->review}}</p>
            @endforeach
          @else
            <p>何も投稿がありません</p>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

@endsection