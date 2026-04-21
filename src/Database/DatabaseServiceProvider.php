<?php

namespace MStaack\LaravelPostgis\Database;

use Illuminate\Database\DatabaseManager;
use Illuminate\Database\DatabaseServiceProvider as IlluminateServiceProvider;
use MStaack\LaravelPostgis\Connectors\ConnectionFactory;

class DatabaseServiceProvider extends IlluminateServiceProvider
{
    public function register()
    {
        $this->app->singleton('db.factory', function ($app) {
            return new ConnectionFactory($app);
        });

        $this->app->singleton('db', function ($app) {
            return new DatabaseManager($app, $app['db.factory']);
        });
    }
}
