<?php

namespace JacobHyde\Tickets;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class TicketsServiceProvider extends ServiceProvider
{
    private $_packageTag = 'tickets';

    /**
     * Bootstrap any application services.
     *
     * @return  void
     */
    public function boot()
    {
        $this->registerRoutes();
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/tickets.php' => config_path('tickets.php'),
                __DIR__ . '/Database/Migrations'      => database_path('migrations')
            ], $this->_packageTag);
            $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
            $this->publishes([
                __DIR__ . '/resources/views' => resource_path('views/vendor/' . $this->_packageTag),
            ], 'views');
        }
        $this->loadViewsFrom(__DIR__ . '/resources/views', $this->_packageTag);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\Spatie\WebhookClient\WebhookClientServiceProvider::class);
        $this->app->register(\Spatie\StripeWebhooks\StripeWebhooksServiceProvider::class);
        $this->mergeConfigFrom(__DIR__ . '/../config/tickets.php', $this->_packageTag);
        // $this->app->bind('payment', function ($app) {
        //     return new Payment();
        // });
    }

    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration('api'), function () {
            $this->loadRoutesFrom(__DIR__ . '/routes/api.php');
        });

        Route::group($this->routeConfiguration('web'), function () {
            $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        });
    }

    protected function routeConfiguration(string $routeType): array
    {
        $routeGroupConfig = [
            'prefix' => config('tickets.routes.' . $routeType . '.prefix'),
            'middleware' => config('tickets.routes.' . $routeType . '.middleware'),
        ];

        if (config('tickets.routes.' . $routeType . '.domain')) {
            $routeGroupConfig['domain'] = config('tickets.routes.' . $routeType . '.domain');
        }

        return $routeGroupConfig;
    }
}
