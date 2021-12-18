@extends('layouts.app')

@section('content')
<div class="hero">
  
  <picture>
    <h1 class="hero_top">Wellcome to RELIANCE!!!<br>Enjoy Good Discovery!!!</h1>
    <img src="https://manablog.org/wp-content/uploads/2015/02/f1a9fcfd142669cb8ab064cb90251123.jpg" alt="">
  </picture>
  <div class="hero_right__contents float-right">
    <h3>自分に最適なスポットを発見しよう!!!</h3>
    <a href="{{ route('spots.searching') }}" class="btn btn-success">スポットを検索</a>
  </div>
</div>
<div class="container top_contents">

  <div class="new_spot">
    <h3>新着スポット</h3>
    <div class="row">
      @if (!($new_spots->isEmpty()))
      @foreach ($new_spots as $spot)
        @if ($spot->public == true)
          <div class="col-lg-4 col-12">
            <div class="card px-3 spot_card">
              <a href="{{ route('spots.show', $spot->id) }}">
                <div class="">
                  @php
                    $images = $spot->image
                  @endphp
                  <div class="card-header p-0">
                    @if (app()->isLocal())
                      <img class="new_spot__img" src="{{ asset('storage/'.$images[0] )}}" alt="" style="width:100%;height:250px;">
                    @else
                      <img class="new_spot__img" src="{{ $images[0] }}" alt="" style="width:100%;height:250px;">
                    @endif
                  </div>
                  <div class="card-body">
                    <i class="fas fa-heart"></i> x{{ $spot->count_likes }}
                    <p>{{ $spot->address}}</p>
                    <p>{{ $spot->review}}</p>
                    @foreach($spot->tags as $tag)
                      @if($loop->first)
                        <div class="card-body pt-0 pb-4 pl-3">
                          <div class="card-text line-height">
                      @endif
                            <a href="{{ route('tags.show', ['name' => $tag->name]) }}" class="border p-1 mr-1 mt-1 text-muted">
                              {{ $tag->hashtag }}
                            </a>
                      @if($loop->last)
                          </div>
                        </div>
                      @endif
                    @endforeach
                  </div>
                </div>
              </a>
            </div>
          </div>
        @endif
      @endforeach
      @else
        <p>何も投稿がありません</p>
      @endif
    </div>
  </div>
  <div class="popular_spot mt-5">
    <h3>人気のスポット</h3>
    <div class="row">
      @if (!($popular_spots->isEmpty()))
      @foreach ($popular_spots as $spot)
        @if ($spot->public == true)
          <div class="col-lg-4 col-12">
            <div class="card px-3 spot_card">
              <a href="{{ route('spots.show', $spot->id) }}">
                <div class="">
                  @php
                    $images = $spot->image
                  @endphp
                  <div class="card-head">
                    @if (app()->isLocal())
                      <img class="new_spot__img" src="{{ asset('storage/'.$images[0] )}}" alt="" style="width:100%;height:250px;">
                    @else
                      <img class="new_spot__img" src="{{ $images[0] }}" alt="" style="width:100%;height:250px;">
                    @endif
                  </div>
                  <div class="card-body">
                    <i class="fas fa-heart"></i> x{{ $spot->count_likes }}
                    <p>{{ $spot->address}}</p>
                    <p>{{ $spot->review}}</p>
                    @foreach($spot->tags as $tag)
                      @if($loop->first)
                        <div class="card-body pt-0 pb-4 pl-3">
                          <div class="card-text line-height">
                      @endif
                            <a href="{{ route('tags.show', ['name' => $tag->name]) }}" class="border p-1 mr-1 mt-1 text-muted">
                              {{ $tag->hashtag }}
                            </a>
                      @if($loop->last)
                          </div>
                        </div>
                      @endif
                    @endforeach
                  </div>
                </div>
              </a>
            </div>
          </div>
        @endif
      @endforeach
      @else
        <p>何も投稿がありません</p>
      @endif
    </div>
  </div>

  <h3 class="mt-5 announce_head">運営からのお知らせ</h3>
  <div class="card">
    <div class="card-body" style="height:300px;overflow:auto;">
      @if (!($announcements->isEmpty()))
          <ul>
            @foreach ($announcements as $announcement)
            <li>
              <a href="{{ route('notifications.announce', $announcement->id) }}" class="d-flex justify-content-between align-middle">
                <p class="ml-5">{{ $announcement->title }}</p>
                <p class="mr-5">{{ $announcement->created_at }}</p>
              </a>
              <hr>
            </li>
          @endforeach
          </ul>
      @endif
    </div>
  </div>
</div>

@endsection
