<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Modules\WebsiteData\Providers\MajesticProvider;
use App\Modules\WebsiteData\Storages\WebsiteDataStorage;
use App\Modules\WebsiteData\Providers\WebsiteDataProvider;
use App\Modules\WebsiteData\Storages\RedisWebsiteDataStorage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public array $bindings = [
        WebsiteDataProvider::class => MajesticProvider::class,
        WebsiteDataStorage::class => RedisWebsiteDataStorage::class
    ];

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
        JsonResource::withoutWrapping();
    }
}
