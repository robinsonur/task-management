<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecordTypeSeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run(): void {

        // \App\Models\RecordType::factory(10)->create();

        $recordTypes = [
            ['name' => 'Statuses']
        ];

        foreach ($recordTypes as $recordType)
            \App\Models\RecordType::create($recordType)
        ;

    }

}
