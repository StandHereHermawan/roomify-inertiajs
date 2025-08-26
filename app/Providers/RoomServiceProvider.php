<?php

namespace App\Providers;

use App\Services\RoomService;
use Illuminate\Support\ServiceProvider;

class RoomServiceProvider extends ServiceProvider
{
    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        RoomService::class => RoomService::class,
    ];
    
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(RoomService::class, function () {
            return new RoomService();
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
