<?php

    use App\Models\Role;
    use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'id' => 1,
                'name' => 'isAdmin',
                'desc' => 'This role is for admin panel access.',
            ],
            [
                'id' => 2,
                'name' => 'isUser',
                'desc' => 'This role is for user panel access.',
            ],
        ];

        foreach ($roles as $role){
            Role::create($role);
        }
    }
}
