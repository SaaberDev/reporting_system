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
                'name' => 'Admin',
                'email' => 'admin@demo.com',
                'password' => bcrypt('1234'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];
        foreach ($admins as $admin){
            $user = User::create($admin);
            $role = [
                1 => ['role_id' => 1],
//                2 => ['role_id' => 2]
            ];
            $user->roles()->sync($role);
        }

        $users = [
            [
                'id' => 10,
                'name' => 'User',
                'email' => 'user@demo.com',
                'password' => bcrypt('1234'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];
        foreach ($users as $user){
            $new_user = User::create($user);
            $role = new \App\Models\Role(['id' => 2]);
            $new_user->roles()->sync($role);
        }
    }
}
