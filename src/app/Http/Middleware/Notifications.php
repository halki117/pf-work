<?php

namespace App\Http\Middleware;

use Illuminate\View\Factory;
use Illuminate\Support\Facades\Auth;
use App\Notification;
use Closure;

class Notifications
{   

    public function __construct(Factory $viewFactory)
    {
        $this->viewFactory = $viewFactory;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        // 通知のインスタンスは共通画面で使用したいのでmiddlewareに定義する
        $notifications = Notification::where('checked', false)->get();

        $this->viewFactory->share('notifications', $notifications);
        return $next($request);
    }
}
