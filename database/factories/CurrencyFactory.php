<?php

use Faker\Generator as Faker;

$factory->define(App\Entity\Currency::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
        'rate' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 9999.99),
    ];
});
