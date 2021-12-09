@extends('layouts.app')

@section('content')
<div class="container mt-5">
  <div class="btn-group">
    <a href="#" class="btn btn-info  active">ユーザー一覧</a>
    <a href="{{ route('admin.spots.index') }}" class="btn btn-light">投稿スポット一覧</a>
    <a href="{{ route('admin.contacts.index') }}" class="btn btn-light">お問い合わせ一覧</a>
    <a href="{{ route('admin.announcements.index') }}" class="btn btn-light">運営からのお知らせ</a>
  </div>
	<div class="card">
		<div class="card-header">ユーザー一覧</div>
		<div class="card-body">

			<ul class="list-group">
        @if (!($users->isEmpty()))
          @foreach ($users as $user)
            <li class="list-group-item d-flex">
              <div>
                @if ($user->profile_photo)
                  <img src="{{ asset('storage/'.$user->profile_photo )}}" alt="" style="width:50px;height:50px;border-radius:50%;">
                @else
                  <img src="{{ asset('storage/user_icon.png' ) }}" alt="" style="width:50px;height:50px;border-radius:50%;">
                @endif
              </div>
              <a href="{{ route('admin.users.show', $user->id ) }}">
                <p class="mt-3 ml-3">{{ $user->name }}</p>
              </a>
            </li>
          @endforeach
        @endif
			</ul>
		</div>
	</div>
</div>
@endsection​