<?php

namespace App\Providers;

use App\Repositories\Interfaces\JsonDataRepositoryInterface;
use App\Repositories\JsonDataRepository;
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
        $this->app->bind(JsonDataRepositoryInterface::class, JsonDataRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
