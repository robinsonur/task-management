<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run(): void {

        // Status::factory(10)->create();

        $statuses = [
            ['name' => 'Pending'],
            ['name' => 'Progress'],
            ['name' => 'Hold'],
            ['name' => 'Completed'],
            ['name' => 'Cancelled']
        ];

        foreach ($statuses as $status)
            Status::create($status)
        ;

    }

}
