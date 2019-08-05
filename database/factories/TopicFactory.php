<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Topic::class, function (Faker $faker) {
    $date_time = $faker->date.' '.$faker->time;
    $sentence = $faker->sentence();//小段落
    $updated_at = $faker->dateTimeThisMonth();
    $created_at = $faker->dateTimeThisMonth($updated_at);
    return [
        'title' => $sentence,
        'body' => $faker->text(),//大段落
        'excerpt' => $sentence,
        'created_at' => $created_at,
        'updated_at' => $updated_at,
    ];
});
