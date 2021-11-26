@extends('layouts.app')

@section('content')
<div class="container mt-5">
  <div class="btn-group">
    <a href="{{ route('admin.users.index') }}" class="btn btn-light">ユーザー一覧</a>
    <a href="{{ route('admin.spots.index') }}" class="btn btn-light">投稿スポット一覧</a>
    <a href="{{ route('admin.contacts.index') }}" class="btn btn-info active">お問い合わせ一覧</a>
    <a href="{{ route('admin.announcements.index') }}" class="btn btn-light">運営からのお知らせ</a>
  </div>
	<div class="card">
		<div class="card-header">お問い合わせ一覧</div>
		<div class="card-body">

			<ul class="list-group">
        @if (!($contacts->isEmpty()))
          @foreach ($contacts as $contact)
          <li class="list-group-item d-flex">
            <div class="ml-3 mt-3">
              <a href="{{ route('admin.contacts.show', $contact->id) }}">
                <p>{{ $contact->title }}</p>
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