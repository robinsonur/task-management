<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run(): void {

        $roles = [
            ['guard_name' => 'api', 'name' => 'Administrator'],
            ['guard_name' => 'api', 'name' => 'User']
        ];

        foreach($roles as $role)
            Role::create($role)
        ;

    }

}
