<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Link;
use Faker\Generator as Faker;

$factory->define(Link::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class),
        'name'=> $faker->name,
        'link'=> $faker->name,
        'format'=> 'mp4',
        'proccesed'=> $faker->boolean, 

    ];
});
