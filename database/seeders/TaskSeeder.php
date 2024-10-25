<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run(): void {

        \App\Models\Task::factory(100)->create();

        // $statusId = \App\Models\Status::findByName('Progress')->id;

        // $tasks = [
        //     [
        //         'name' => 'Task\'s name',
        //         'description' => 'Task\'s description',
        //         'due_date' => now(),
        //         'status_id' => $statusId
        //     ]
        // ];

        // foreach ($tasks as $task)
        //     \App\Models\Task::create($task)
        // ;

    }

}
