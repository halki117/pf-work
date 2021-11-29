<div class="notice_mark">
  <a class="nav-link text-light notice_link" href="#"><i class="fas fa-bell text-white fa-2x"></i></a>
  @php
      $notifications = $notifications->filter(function($value){
          return $value->notifer_id !== Auth::id() && ($value->passive_user_id === Auth::id() || $value->notice_type === "announce");
      });
  @endphp

  @if (!($notifications->isEmpty()))
      <div class="new_notice"></div>
  @endif
</div>
@if (!($notifications->isEmpty()))
  {{-- 自分の投稿に対してイイネやコメントした場合はわざわざ通知する必要はないのでnotifer_idがログインユーザーのレコードを取り除いている。
  AppServeseProviderで絞り込みをしようとしたがAuth::id()が使えなかったためビューで処理をした --}}
  <div class="card notice_content">
      <div class="card-body">
          @foreach ($notifications as $notification)
              @if ($notification->notice_type === "like")
                  <a href="{{ route('notifications.checked', $notification->id) }}"><p>{{ $notification->notifer->name }} さんがあなたの投稿にいいねしました！</p></a>
                  <hr>
              @elseif ($notification->notice_type === "comment")
                  <a href="{{ route('notifications.checked', $notification->id) }}"><p>{{ $notification->notifer->name }} さんがあなたの投稿にコメントしました！</p></a>
                  <hr>
              @elseif ($notification->notice_type === "announce")
                  <a href="{{ route('notifications.checked', $notification->id) }}"><p>運営からのお知らせ</p></a>
                  <hr>
              @endif
          @endforeach
      </div>
  </div>
@else
    <div class="card notice_content">
        <div class="card-body">
           <p>お知らせは何もありません</p>
           <hr>
        </div>
    </div>
@endif
