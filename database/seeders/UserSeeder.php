<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run(): void {

        // \App\Models\User::factory()->create([
        //     'name' => 'Administrator',
        //     'email' => 'administrador@domain.com'
        // ]);

        \App\Models\User::factory(20)->create();

        $users = [
            [
                'name' => 'Administrator',
                'email' => 'administrator@domain.com',
                'email_verified_at' => now(),
                'password' => bcrypt('Administrator'),
                'remember_token' => '',
                'guard' => 'api',
                'role' => 'Administrator'
            ],
            [
                'name' => 'User',
                'email' => 'user@domain.com',
                'email_verified_at' => now(),
                'password' => bcrypt('User'),
                'remember_token' => '',
                'guard' => 'api',
                'role' => 'User'
            ]
        ];

        foreach ($users as $user) {

            $guard = $user['guard'];
            $role = $user['role'];

            unset($user['guard']);
            unset($user['role']);

            $userInstance = \App\Models\User::create($user);
            $userInstance->guard_name = $guard;
            $userInstance->assignRole($role);

        }

    }

}
