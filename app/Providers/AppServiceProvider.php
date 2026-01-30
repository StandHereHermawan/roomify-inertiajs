<?php

namespace App\Providers;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $dbListenerEnabled = env('DB_LISTENER') ?? false;
        if ($dbListenerEnabled) {
            DB::listen(function (QueryExecuted $queryExecuted) {
                $context = [
                    "sql" => $queryExecuted->sql,
                    "binding_value" => $queryExecuted->bindings,
                    "millisecond" => $queryExecuted->time
                ];

                # code...
                Log::debug("Closure query listener called", $context);
            });
        }
    }
}
