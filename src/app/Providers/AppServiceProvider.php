<?php

namespace App\Providers;

use App\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {   
        // 通知のインスタンスは共通画面で使用したいのでAppServiceProviderに定義する
        $notifications = Notification::where('checked', false)->get();
        view()->share('notifications', $notifications);

    }
}
