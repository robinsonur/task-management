<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RecordType;

class RecordTypeSeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run(): void {

        // RecordType::factory(10)->create();

        $recordTypes = [
            ['name' => 'Statuses']
        ];

        foreach ($recordTypes as $recordType)
            RecordType::create($recordType)
        ;

    }

}
