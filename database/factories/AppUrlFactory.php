<?php

/** @var Factory $factory */

    use App\Models\AppUrl;
    use Faker\Generator as Faker;
    use Illuminate\Database\Eloquent\Factory;

    $factory->define(AppUrl::class, function (Faker $faker) {
    return [
        'asset_id' => $faker->numberBetween(12,12),
        'ios' => $faker->url,
        'android' => $faker->url,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
