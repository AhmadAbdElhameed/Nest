<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;


use App\Http\Interfaces\Admin\SettingInterface;
use App\Http\Repositories\Admin\SettingRepository;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        ########## Admin ###########
        $this->app->bind(
            SettingInterface::class,
            SettingRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
