<?php
include 'database.php';

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('Users', function ($table) {
    $table->increments('id');
    $table->string('name'); //varchar 255
    $table->integer('age'); //varchar 255
    $table->string('email');
    $table->string('password');
    $table->text('description')->nullable();
    $table->string('foto');
    $table->timestamps();
});