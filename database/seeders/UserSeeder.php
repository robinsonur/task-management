<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run(): void {

        // User::factory()->create([
        //     'name' => 'Administrator',
        //     'email' => 'administrador@domain.com'
        // ]);

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
            User::create($user)
        ;

    }

}
