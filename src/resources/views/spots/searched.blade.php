@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <h1>検索結果</h1>
    @foreach($spots as $spot)
      @include('templates.spots_template')
    @endforeach
    {{ $spots->links() }}
  </div>
@endsection