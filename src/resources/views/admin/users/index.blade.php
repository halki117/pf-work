@extends('layouts.app')

@section('content')
<div class="container mt-5">
  <div class="btn-group">
    <a href="#" class="btn btn-info active">ユーザー一覧</a>
    <a href="#" class="btn btn-light">投稿スポット一覧</a>
  </div>
	<div class="card">
		<div class="card-header">ユーザー一覧</div>
		<div class="card-body">

			<ul class="list-group">
				@foreach ($users as $user)
				<li class="list-group-item">
					<a href="{{ route('admin.users.show', $user->id ) }}">
						{{ $user->name }}
					</a>
				</li>
				@endforeach
			</ul>
			
		</div>
	</div>
</div>
@endsection​