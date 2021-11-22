@extends('layouts.app')

@section('content')
<div class="container mt-5">
  <div class="btn-group">
    <a href="#" class="btn btn-info active">ユーザー一覧</a>
    <a href="#" class="btn btn-light">投稿スポット一覧</a>
  </div>
	<div class="card">
		<div class="card-header">投稿スポット一覧</div>
		<div class="card-body">

			<ul class="list-group">
				@foreach ($spots as $spot)
				<li class="list-group-item">
					<a href="{{ route('admin.spots.show', $spot->id ) }}">
						{{ $spot->address }}
					</a>
				</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>
@endsection​