<?php

    use App\Models\AppUrl;
    use App\Models\Asset;
    use App\Models\OptionalUrl;
    use Illuminate\Database\Seeder;

    class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        factory(Asset::class, 50)->create()
            ->each(function ($OptionalUrl){
                $OptionalUrl->OptionalUrls()->save(factory(OptionalUrl::class)->make());
        })
            ->each(function ($AppUrl){
                $AppUrl->AppUrls()->save(factory(AppUrl::class)->make());
        });
    }
}
