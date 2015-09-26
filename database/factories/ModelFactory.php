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
    $alpha = ["א", "ב", "ג", "ד", "ה", "ו", "ז", "ח", "ט", "י", "ל", "ס", "ע", "ק", "ר", "שׂ", "שׁ", "ת", ];
    return [
      'root' => $faker->randomElement($alpha) . $faker->randomElement($alpha) . $faker->randomElement($alpha),
      'historical_root' => $faker->randomLetter . $faker->randomLetter . $faker->randomLetter,
      'homonym_number' => $faker->randomElement([0, 0, 0, 0, 0, 0, 1, 1, 2, 2, 3, 4]),
      'display' => $faker->randomLetter . $faker->randomLetter . $faker->randomLetter . $faker->randomLetter . $faker->randomLetter,
      'basic_definition' => $faker->sentence(3),
    ];
});

$factory->define(App\RootTag::class, function($faker){
    return [
        'name' => $faker->unique()->word,
    ];
});

$factory->define(App\Etymology::class, function ($faker) {
    return [
      'discussion' => $faker->word,
      'literature' => $faker->word,
    ];
});
