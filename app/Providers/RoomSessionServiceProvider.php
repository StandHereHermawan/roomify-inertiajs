<?php

namespace App\Providers;

use App\Services\RoomSessionService;
use Illuminate\Support\ServiceProvider;

class RoomSessionServiceProvider extends ServiceProvider
{
    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        RoomSessionService::class => RoomSessionService::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(RoomSessionService::class, function () {
            return new RoomSessionService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
