<?php


namespace App\Models;
use Illuminate\Database\Capsule\Manager as Capsule;


class Database
{
    function __construct()
    {
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'eloquent',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}