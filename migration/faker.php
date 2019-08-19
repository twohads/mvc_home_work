<?php

use Faker\Factory;

require '../vendor/autoload.php';

new \App\Models\Database();
$faker = Faker\Factory::create('ru_RU');
for($i=0;$i<30;$i++)
{
    $user = new \App\Models\User();
    $user->name = $faker->name;
    $user->password = $faker->password;
    $user->email = $faker->email;
    $user->description = $faker->text;
    $user->created_at = $faker->dateTime;
    $user->age = mt_rand(18, 45);
    $user->save();
}

for($i=0;$i<100;$i++)
{
    $user = new \App\Models\File();
    $user->file = $faker->imageUrl($width = 640, $height = 480);
    $user->created_at = $faker->dateTime;
    $user->user_id = mt_rand(1,100);
    $user->save();
}
