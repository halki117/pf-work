@extends('layouts.app')

@section('content')
<h1>ユーザーへのお知らせです！！！！！！！！！！！！</h1>
<div class="container">
	<div class="card mt-5">
		<div class="card-header">
			<a href="{{ route('admin.announcements.index') }}">お知らせ一覧</a> &gt; お知らせ詳細
		</div>
		<div class="card-body">

			<ul class="list-group">
				<li class="list-group-item">タイトル: {{ $announcement->title }}</li>
				<li class="list-group-item">内容: {{ $announcement->content }}</li>
				<li class="list-group-item">作成日: {{ $announcement->created_at->format('Y/m/d H:i:s') }}</li>
				<li class="list-group-item">更新日: {{ $announcement->updated_at->format('Y/m/d H:i:s') }}</li>
			</ul>
		</div>
	</div>
</div>
@endsection