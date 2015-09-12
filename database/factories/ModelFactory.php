<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => str_random(10),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Letter::class, function ($faker) {
    return [
      'name' => $faker->word,
      'asciitranslit' => $faker->word,
      'letter' => $faker->randomLetter,
      'transliteration' => $faker->randomLetter,
    ];
});

$factory->define(App\Root::class, function ($faker) {
    return [
      'root' => $faker->word,
      'historical_root' => $faker->word,
      'root_slug' => (string) $faker->word,
      'homonym_number' => $faker->randomNumber([0,1,2]),
      'display' => (string) $faker->randomLetter,
      'basic_definition' => $faker->word,
    ];
});
