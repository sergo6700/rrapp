<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Acl\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

/*
|---------------------------------------------------------------------------
| User factory state 'admin'
| --------------------------------------------------------------------------
*/

$factory->state(User::class, 'admin', function(Faker $faker) {
    return [];
});
$factory->afterCreatingState(User::class, 'admin', function(User $user, Faker $faker) {
//    $user->syncRoles('admin');
});

/*
|---------------------------------------------------------------------------
| User factory state 'moderator'
| --------------------------------------------------------------------------
*/

$factory->state(User::class, 'moderator', function(Faker $faker) {
    return [];
});
$factory->afterCreatingState(User::class, 'moderator', function(User $user, Faker $faker) {
//    $user->syncRoles('moderator');
});

/*
|---------------------------------------------------------------------------
| User factory state 'user'
| --------------------------------------------------------------------------
*/

$factory->state(User::class, 'user', function(Faker $faker) {
    return [];
});
$factory->afterCreatingState(User::class, 'user', function(User $user, Faker $faker) {
//    $user->syncRoles('user');
});
