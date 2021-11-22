@extends('layouts.app')

@section('content')
<div class="container mt-5">
  <div class="btn-group">
    <a href="{{ route('admin.users.index') }}" class="btn btn-light">ユーザー一覧</a>
    <a href="#" class="btn btn-info active">投稿スポット一覧</a>
  </div>
	<div class="card">
		<div class="card-header">投稿スポット一覧</div>
		<div class="card-body">

			<ul class="list-group">
				@foreach ($spots as $spot)
				<li class="list-group-item d-flex">
          <div>
            <img src="{{ asset('storage/'.$spot->image[0] )}}" alt="" style="width:100px;height:100px;">
          </div>
          <div class="ml-3 mt-3">
            <a href="{{ route('admin.spots.show', $spot->id ) }}">
              <p>{{ $spot->address }}</p>
            </a>
            <a href="{{ route('admin.users.show', $spot->user->id) }}">
              <p>投稿者: {{$spot->user->name }}</p>
            </a>
          </div>
				</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>
@endsection​