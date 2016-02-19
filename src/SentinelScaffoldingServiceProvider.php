<?php 

namespace Cichowski\SentinelScaffolding;

use Illuminate\Support\ServiceProvider;

class SentinelScaffoldingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {        
        $this->publishes([
            // These overwrite original Sentinel published files
            __DIR__ . '/config/cartalyst.sentinel.php' => config_path('cartalyst.sentinel.php'),
            __DIR__ . '/publishes/database/migrations' => base_path('database/migrations'),
            // These are brand new
            __DIR__ . '/publishes/app/Http/Controllers' => base_path('app/Http/Controllers'),
            __DIR__ . '/publishes/app/Http/Middleware' => base_path('app/Http/Middleware'),
            __DIR__ . '/publishes/app/Http/Models' => base_path('app/Http/Models'),
            __DIR__ . '/publishes/app/Http/Requests' => base_path('app/Http/Requests'),
            __DIR__ . '/publishes/resources' => base_path('resources'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}