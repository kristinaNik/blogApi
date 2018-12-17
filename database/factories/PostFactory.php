<?php
/**
 * Created by PhpStorm.
 * User: kristina
 * Date: 12/2/18
 * Time: 5:54 PM
 */

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

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(10),
        'body' => $faker->sentence(50),
    ];
});


//$factory->define(App\Post::class, function(Faker $faker) {
//    return [
//        'title' => $faker->sentence(10),
//        'body' => $faker->sentence(50),
//    ];
//});​