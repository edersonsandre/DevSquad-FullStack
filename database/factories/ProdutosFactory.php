<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Produtos;
use Faker\Generator as Faker;

$factory->define(Produtos::class, function (Faker $faker) {
    return [
        'categoria' => function () {
            return factory(\App\Model\Categorias::class)->create()->id;
        },
        'nome' => $faker->name,
        'descricao' => $faker->name,
        'preco' => $faker->numerify("???###,##"),
        'imagem' => "http://www.travellabel.net/wp-content/themes/anderson-lite/images/default-slider-image.png",
    ];
});
