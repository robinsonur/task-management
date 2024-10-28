<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTaskSeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run(): void {

        // \App\Models\UserTask::factory(50)->create();

        $userTasks = [
            ['task_id' => 1, 'user_id' => 1]
        ];

        foreach ($userTasks as $userTask)
            \App\Models\UserTask::create($userTask)
        ;

    }

}
