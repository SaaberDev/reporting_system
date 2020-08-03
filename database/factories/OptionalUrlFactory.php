<?php

/** @var Factory $factory */

    use App\Models\OptionalUrl;
    use Faker\Generator as Faker;
    use Illuminate\Database\Eloquent\Factory;

    $factory->define(OptionalUrl::class, function (Faker $faker) {
        $customURL = '[{"value":"https://www.youtube.com"},{"value":"https://www.apple.com"}]';

    return [
        'asset_id' => $faker->numberBetween(12,12),
        'inScope_Url' => $customURL,
        'outScope_Url' => $customURL,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
