<?php

namespace App\Providers;

use App\Repositories\DatabaseRepositoryInterface;
use App\Repositories\EloquentRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(DatabaseRepositoryInterface::class, EloquentRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
