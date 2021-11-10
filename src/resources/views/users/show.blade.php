@extends('layouts.app')

@section('content')
  
  <div class="">
    <div class="row">
      @if (!($spots->isEmpty()))
      @foreach ($spots as $spot)
        <div class="card col-4">
          {{$spot->id}}
          <a href="{{ route('spots.show', $spot->id) }}">
            <div class="card-body">
              @php
                $images = $spot->image
              @endphp
              <div class="new_spot">
                <img class="new_spot__img" src="{{ asset('storage/'.$images[0] )}}" alt="">
              </div>
              <i class="fas fa-heart"></i>
              <p>{{ $spot->address}}</p>
              <p>{{ $spot->review}}</p>
            </div>
            <div>
              <a href="{{ route('spots.edit', $spot->id) }}" class="btn btn-success">編集</a>
              <a class="btn btn-danger">削除</a>
            </div>
          </a>
        </div>
      @endforeach
      @else
        <p>何も投稿がありません</p>
      @endif
    </div>
  
    <h1>{{ $user->name }}</h1>
  
  </div>
  
@endsection