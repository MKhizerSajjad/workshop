<?php

namespace App\Providers;
use App\Models\Notification;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        View::composer('*', function ($view) {
            if (auth()->check()) {
                $notifications = Notification::where('status', 1)->orderByDesc('created_at')->get();
                $view->with('notifications', $notifications);
            }
        });
        // $notifications = Notification::where('status', 1)->orderByDesc('created_at')->get();
        // View::share('notifications' $notifications);
    }
}
