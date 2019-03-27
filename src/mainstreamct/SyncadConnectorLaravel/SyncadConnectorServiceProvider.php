<?php
  namespace mainstreamct\SyncadConnectorLaravel;

  use Illuminate\Support\ServiceProvider;

  class SyncadConnectorServiceProvider extends ServiceProvider
  {
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
      // Publish the config file
      $this->publishes([
        __DIR__.'/config.php' => config_path('syncad.php'),
      ]);

      // Load the package routes
      $this->loadRoutesFrom(__DIR__.'/routes.php');

      // Load the package migrations
      $this->loadMigrationsFrom(__DIR__.'/migrations');

      // Load the package middleware
      $this->app['router']->aliasMiddleware('syncad', \mainstreamct\SyncadConnectorLaravel\syncadGuard::class);
      $this->app['router']->aliasMiddleware('cors', \Barryvdh\Cors\HandleCors::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->singleton(SyncadConnector::class, function () {
        return new SyncadConnector();
      });
      $this->app->alias(SyncadConnector::class, 'syncad-connector');
    }
  }