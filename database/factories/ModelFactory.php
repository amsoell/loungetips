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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Tip::class, function (Faker\Generator $faker) {
    return [
        'tip'          => $faker->word,
        'description'  => '10am',
    ];
});

$factory->define(Riari\Forum\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'title'          => $faker->sentence(5),
        'enable_threads' => true,
    ];
});

$factory->define(Riari\Forum\Models\Thread::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(8),
    ];
});

$factory->define(Riari\Forum\Models\Post::class, function (Faker\Generator $faker) {
    return [
        'content' => $faker->sentence(15),
        'sequence' => 1
    ];
});
