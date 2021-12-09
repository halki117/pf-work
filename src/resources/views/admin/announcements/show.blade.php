@extends('layouts.app')

@section('content')
<div class="container">
	<div class="card mt-5">
		<div class="card-body">
			<ul class="list-group">
				<li class="list-group-item">タイトル: {{ $announcement->title }}</li>
				<li class="list-group-item">内容: {{ $announcement->content }}</li>
				<li class="list-group-item">作成日: {{ $announcement->created_at->format('Y/m/d H:i:s') }}</li>
			</ul>
		</div>
	</div>
</div>
@endsection