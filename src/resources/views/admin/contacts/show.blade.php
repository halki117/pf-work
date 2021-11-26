@extends('layouts.app')

@section('content')
<div class="container">
	<div class="card mt-5">
    <div class="card-header">お問い合わせ一覧</div>
		<div class="card-body">
			<ul class="list-group">
        <li class="list-group-item">ユーザー名: {{ $user->name }}</li>
        <li class="list-group-item">メールアドレス: {{ $user->email }}</li>
				<li class="list-group-item">件名: {{ $contact->title }}</li>
				<li class="list-group-item">お問い合わせ内容: {{ $contact->content }}</li>
				<li class="list-group-item">問い合わせ日時: {{ $contact->created_at->format('Y/m/d H:i:s') }}</li>
			</ul>
		</div>
	</div>
</div>
@endsection