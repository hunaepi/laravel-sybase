<?php

namespace Hunaepi\LaravelSybase;

use Illuminate\Database\Connection as IlluminateConnection;
use Illuminate\Support\ServiceProvider;
use Hunaepi\LaravelSybase\Database\Connection as SybaseConnection;
use Hunaepi\LaravelSybase\Database\Connector;

class SybaseServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        IlluminateConnection::resolverFor('sqlanywhere', function (
            $connection,
            $database,
            $prefix,
            $config
        ) {
            return new SybaseConnection(
                $connection,
                $database,
                $prefix,
                $config
            );
        });

        $this->app->bind('db.connector.sqlanywhere', function ($app) {
            return new Connector();
        });

        // $this->app->bind('db.connection.sqlsrv', function (
        //     $app,
        //     $parameters
        // ) {
        //     list($connection, $database, $prefix, $config) = $parameters;
        //     return new SybaseConnection(
        //         $connection,
        //         $database,
        //         $prefix,
        //         $config
        //     );
        // });
    }
}
