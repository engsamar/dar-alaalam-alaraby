<?php

namespace App\Providers;

use App\Repositories\CRUDRepository;
use App\Repositories\ContentRepository;
use App\Repositories\SettingRepository;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\CRUDRepositoryInterface;
use App\Interfaces\ContentRepositoryInterface;
use App\Interfaces\SettingRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(ContentRepositoryInterface::class, ContentRepository::class);
        $this->app->bind(SettingRepositoryInterface::class, SettingRepository::class);
        $this->app->bind(CRUDRepositoryInterface::class, CRUDRepository::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
