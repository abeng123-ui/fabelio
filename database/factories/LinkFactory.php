<?php

use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'url' => 'https://fabelio.com/ip/santiago-mirror?finishing_color=6469',
        'product_name' => $faker->name,
        'price_value' => numberBetween($min = 1000, $max = 1000000),
        'price_currency' => str_random(2),
        'description' => $faker->text,
    ];
});
