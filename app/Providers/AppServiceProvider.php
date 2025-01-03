<?php

namespace App\Providers;
use App\Models\Notification;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use App\Observers\UserObserver;

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

        // View::composer('*', function ($view) {
        //     if (auth()->check()) {
        //         $notifications = Notification::where('status', 1)->orderByDesc('created_at')->get();
        //         $view->with('notifications', $notifications);
        //         View::share('notifications' $notifications);
        //     }
        // });

        // Get all models and observe them
        $this->observeAllModels();
    }


    /**
     * Dynamically observe all models in the application.
     *
     * @return void
     */
    protected function observeAllModels()
    {
        // Get all models within the app directory
        $models = $this->getAllModels();

        // Register the observer for each model that extends Eloquent Model
        foreach ($models as $model) {
            if (is_subclass_of($model, Model::class) && $model != 'App\Models\Log') {
                $model::observe(UserObserver::class);
            }
        }
    }

    /**
     * Get all model classes in the app/Models directory.
     *
     * @return array
     */
    private function getAllModels()
    {
        $models = [];
        $modelPath = app_path('Models');  // Path to your models directory
        $files = glob($modelPath . '/*.php');  // Get all PHP files in the Models directory

        foreach ($files as $file) {
            $class = 'App\\Models\\' . basename($file, '.php');  // Get full class name
            if (class_exists($class)) {
                $models[] = $class;
            }
        }

        return $models;
    }
}
