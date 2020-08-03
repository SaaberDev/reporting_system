<?php

/** @var Factory $factory */

    use App\Models\Asset;
    use Cviebrock\EloquentSluggable\Services\SlugService;
    use Faker\Generator as Faker;
    use Illuminate\Database\Eloquent\Factory;

    $factory->define(Asset::class, function (Faker $faker) {

    $company_name = $faker->company;
    $asset_slug = SlugService::createSlug(Asset::class, 'asset_slug', $company_name);

    return [
        'company_name' => $company_name,
        'company_logo' => $faker->imageUrl(),
        'asset_slug' => $asset_slug,
        'start_date' => $faker->date($format = 'Y-m-d', $max = now()),
        'end_date' => $faker->date($format = 'Y-m-d', $max = now()),
        'url' => $faker->url,
        'program_status' => 1,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
