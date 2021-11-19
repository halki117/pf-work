@extends('layouts.app')

@section('content')
  お知らせ一覧
  @if (!($notifications->isEmpty()))
    <div class="card">
      <div class="card-body">
        @foreach ($notifications as $notification)
          <notifications-component
            notifer-name = '{{ $notification->notifer->name }}'
            notice-type = '{{ $notification->notice_type }}'
          ></notifications-component>
        @endforeach
      </div>
    </div>
  @endif
@endsection
