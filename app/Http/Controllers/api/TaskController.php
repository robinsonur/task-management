<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Http\Resources\TaskCollection;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller {

    /**
     * Display a listing of the resource.
     */
    public function index() {

        $tasks = Task::paginate();

        return new TaskCollection($tasks);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {

        //

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request) {

        $data = $request->validated();

        $userIds = $data['user_ids'] ?? [];

        $response = [
            'message' => 'Task created successfully!',
            'data' => $data
        ];

        unset($data['users']);

        $task = Task::create($data);

        ['message' => &$message] = $response;

        $status = 201;

        if (!$task) {

            $message = 'An unexpected error occurred while trying to create the task!';

            $status = 400;

        }

        $userTasks = $task->users()->sync($userIds);

        if (!$userTasks) {

            $message = 'An unexpected error occurred while trying to assign the task to users!';

            $status = 400;

        }

        return response()->json($response, $status);

    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task) {

        return new TaskResource($task);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task) {

        return new TaskResource($task);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task) {

        $data = $request->validated();

        $task->update($data);

        $response = [
            'message' => 'Task updated successfully!',
            'data' => $data
        ];

        $status = 200;

        return response()->json($response, $status);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task) {

        $data = $task->toArray();

        $response = [
            'message' => 'Task deleted successfully!',
            'data' => $data
        ];

        ['message' => &$message] = $response;

        $status = 200;

        if (!$task) {

            $message = 'An unexpected error occurred while trying to delete the task!';

            $status = 400;

        } else
            $task->delete()
        ;

        return response()->json($response, $status);


    }

}
