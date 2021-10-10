<?php

namespace JacobHyde\Tickets;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use JacobHyde\Tickets\App\Http\Middleware\SupportOnly;

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
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('support', SupportOnly::class);
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
        $this->mergeConfigFrom(__DIR__ . '/../config/tickets.php', $this->_packageTag);
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
