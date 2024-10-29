<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            ]
        ];

        foreach ($users as $user)
            \App\Models\User::create($user)
        ;

    }

}
