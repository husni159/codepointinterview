<?php

namespace App\Providers;
// use App\Services\SubjectService;
// use App\Models\subjects;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        // $this->app->bind(SubjectService::class, function ($app) {
        //     return new SubjectService($app->make(subjects::class));
        // });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
