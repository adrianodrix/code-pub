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
$factory->define(\CodeEdu\User\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(\CodeEdu\Book\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => ucfirst($faker->unique()->word),
    ];
});

$factory->define(\CodeEdu\Book\Models\Book::class, function (Faker\Generator $faker) {
    $repo = app(\CodeEdu\User\Repositories\Contracts\UserRepository::class);
    return [
        'title' => $faker->unique()->sentences(1, true),
        'subtitle' => $faker->paragraph(3, true),
        'price' => $faker->randomFloat(2,10,900),
        'author_id' => $repo->all()->random()->id,
    ];
});