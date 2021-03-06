@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="card mt-3">
      <div class="card-body">
        <h2 class="h4 card-title m-0">{{ $tag->hashtag }}</h2>
        <div class="card-text text-right">
          {{ $tag->spots->count() }}件
        </div>
      </div>
    </div>
    @foreach($tag->spots as $spot)
      <div class="content">
          <div class="card mb-3 card_opacity">
            <a href="{{ route('spots.show', $spot->id) }}">
              <div class="card-body row">
                <div class="col-4">
                  @php
                    $images = $spot->image
                  @endphp
                  <div class="new_spot my-auto">
                    @if (app()->isLocal())
                      <img class="new_spot__img" src="{{ asset('storage/'.$images[0] )}}" alt="">
                    @else
                      <img class="new_spot__img" src="{{ $images[0] }}" alt="">
                    @endif
                  </div>
                </div>
                <div class="col-8 pt-3">
                  <h5>{{ $spot->address}}</h5>
                  <div class="review mt-3">
                    <p>{{ $spot->review}}</p>
                  </div>
                  <div class="likes">
                    <p style="opacity: 50%;">「いいね!!」{{ $spot->count_likes }} 件</p>
                  </div>
                  <div class="tags mt-3">
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
              </div> 
            </a>
          </div>
      </div>
    @endforeach
  </div>
@endsection