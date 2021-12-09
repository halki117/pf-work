@extends('layouts.app')

@section('content')
<div class="container mt-5">
  <div class="btn-group">
    <a href="{{ route('admin.users.index') }}" class="btn btn-light">ユーザー一覧</a>
    <a href="{{ route('admin.spots.index') }}" class="btn btn-light">投稿スポット一覧</a>
    <a href="{{ route('admin.contacts.index') }}" class="btn btn-light">お問い合わせ一覧</a>
    <a href="#" class="btn btn-info active">運営からのお知らせ</a>
  </div>

  <a class="btn btn-success float-right" href="{{ route('admin.announcements.create') }}">お知らせを作成する</a>
  {{-- <button class="btn btn-success float-right">お知らせを作成する</button> --}}
  
	<div class="card">
		<div class="card-header">お知らせ一覧</div>
		<div class="card-body">

			<ul class="list-group">
        @if (!($announcements->isEmpty()))
          @foreach ($announcements as $announcement)
          <li class="list-group-item">
            <div class="ml-3 mt-3">
              <a href="{{ route('admin.announcements.show', $announcement->id) }}">
                <div class="d-flex justify-content-between align-middle">
                  <p>{{ $announcement->title }}</p>
                  <p>{{ $announcement->created_at }}</p>
                </div>
              </a>
            </div>
          </li>
          @endforeach
        @endif
			</ul>
		</div>
	</div>
</div>
@endsection