<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;

class TaskSeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run(): void {

        // Task::factory(100)->create();

        $statusId = (new Status)->findByName('Progress')->id;

        $tasks = [
            [
                'name' => 'Task\'s name',
                'description' => 'Task\'s description',
                'due_date' => now(),
                'status_id' => $statusId
            ]
        ];

        foreach ($tasks as $task)
            Task::create($task)
        ;

    }

}
