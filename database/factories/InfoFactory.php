<?php

/** @var Factory $factory */

    use App\Models\Asset;
    use App\Models\Info;
    use Cviebrock\EloquentSluggable\Services\SlugService;
    use Faker\Generator as Faker;
    use Illuminate\Database\Eloquent\Factory;
    use Illuminate\Support\Facades\Config;

    $factory->define(Info::class, function (Faker $faker) {
        $bug_name = $faker->randomElement($array = array ('Coding Error', 'Design error', 'Documentation issue'));
        $report_slug = SlugService::createSlug(Info::class, 'report_slug', $bug_name);
        $data = Config::get('staticData.vulnerabilityDefaultData');
    return [
        'asset_id' => $faker->numberBetween(1,12),
        'triage_status' => $faker->randomElement($array = array ('0', '1')),
        'report_slug' => $report_slug,
        'reporter_name' => $faker->name,
        'assetURL' => $faker->randomElement($array = array ('https://www.youtube.com', 'https://www.apple.com', 'https://www.rekta.com')),
        'weakness' => $faker->randomElement($array = array ('Array Index Underflow', 'Brute Force', 'Buffer Over-read')),
        'otherWeakness' => '',
        'severity' => $faker->randomElement($array = array ('Low', 'Medium', 'High', 'Critical')),
        'severity_calc' => '',
        'bug_name' => $bug_name,
        'desc' => $data,
        'impact' => $data,
        'steps_of_reproduce' => $data,
        'exploitation' => $data,
        'fixation' => $data,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
