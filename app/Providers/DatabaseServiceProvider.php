<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\DatabaseRepositoryInterface;
use App\Repositories\EloquentRepository;

class DatabaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(DatabaseRepositoryInterface::class, EloquentRepository::class);
    }

}
