<?php
  namespace MainstreamCT\SyncadConnectorLaravel;

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
        __DIR__.'/src/config.php' => config_path('syncad.php'),
      ]);

      // Load the package routes
      $this->loadRoutesFrom(__DIR__.'/src/routes.php');

      // Load the package migrations
      $this->loadMigrationsFrom(__DIR__.'/src/migrations');
    }
  }