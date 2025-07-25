<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     */
    public function run(): void {

		$this->call([
            RolesSeeder::class,
            PermissionsSeeder::class,
			UserSeeder::class,
			RecordTypeSeeder::class,
			RecordSeeder::class,
            StatusSeeder::class,
			TaskSeeder::class,
            UserTaskSeeder::class
		]);

    }

}
