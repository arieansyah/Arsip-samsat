<?php
use Carbon\Carbon;
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
$factory->define(App\Arsip::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'no_reg' => str_random(6),
        'nama' => str_random(10),
        'alamat' => str_random(30),
        'masa_berlaku' => Carbon::parse('2017-10-30'),
        'start' => Carbon::parse('2017-08-30'),
        'end' => Carbon::parse('2017-10-30')
    ];
});
