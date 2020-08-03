<?php

    use App\Models\User;
    use Carbon\Carbon;
    use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                'id' => 1,
                'name' => 'Mahfuzur Rahman Saber',
                'email' => 'saaberdev@pentesterspace.com',
                'password' => bcrypt('Sbr54312!!'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 2,
                'name' => 'Ibrahim Khalil',
                'email' => 'ibrahim@pentesterspace.com',
                'password' => bcrypt('ibrahim@pentesterspace.com'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 3,
                'name' => 'Yeasir Arafat',
                'email' => 'arafat@pentesterspace.com',
                'password' => bcrypt('arafat@pentesterspace.com'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 4,
                'name' => 'Mohammad Abdullah',
                'email' => 'abdullah@pentesterspace.com',
                'password' => bcrypt('abdullah@pentesterspace.com'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 5,
                'name' => 'S. M. Zia Ur Rashid',
                'email' => 'ziaur@pentesterspace.com',
                'password' => bcrypt('ziaur@pentesterspace.com'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 6,
                'name' => 'Asadul Islam',
                'email' => 'asadul@pentesterspace.com',
                'password' => bcrypt('asadul@pentesterspace.com'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 7,
                'name' => 'Jesus Arturo Espinoza',
                'email' => 'espinoza@pentesterspace.com',
                'password' => bcrypt('espinoza@pentesterspace.com'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 8,
                'name' => 'Ahsan Khan',
                'email' => 'ahsan@pentesterspace.com',
                'password' => bcrypt('ahsan@pentesterspace.com'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 9,
                'name' => 'Anees Khan',
                'email' => 'anees@pentesterspace.com',
                'password' => bcrypt('anees@pentesterspace.com'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

        ];
        foreach ($admins as $admin){
            User::create($admin);
        }
    }
}
