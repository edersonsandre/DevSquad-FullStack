<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Categorias;
use Faker\Generator as Faker;

$factory->define(Categorias::class, function (Faker $faker) {
    return [
        'nome' => $faker->name
    ];
});
