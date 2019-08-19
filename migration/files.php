<?php
include 'database.php';

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('Files', function ($table) {
    $table->increments('id');
    $table->string('file');
    $table->timestamps();
});

Capsule::schema()->table('Files', function ($table) {
    $table->integer('user_id');
});