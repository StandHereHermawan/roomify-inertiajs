<?php

namespace App\Providers;

use App\Services\RoomReservationService;
use Illuminate\Support\ServiceProvider;

class RoomReservationProvider extends ServiceProvider
{
    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        RoomReservationService::class => RoomReservationService::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(RoomReservationService::class, function () {
            return new RoomReservationService();
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
