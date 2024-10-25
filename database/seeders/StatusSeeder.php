<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run(): void {

        // \App\Models\Status::factory(10)->create();

        $statuses = [
            ['name' => 'Pending'],
            ['name' => 'Progress'],
            ['name' => 'Hold'],
            ['name' => 'Completed'],
            ['name' => 'Cancelled']
        ];

        foreach ($statuses as $status)
            \App\Models\Status::create($status)
        ;

    }

}
