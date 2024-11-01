<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Task;
use App\Http\Resources\TaskCollection;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller {

    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index() {

        $this->authorize('viewAny', [Task::class]);

        $user = auth()->user();

        if ($user->hasPermissionTo('view-any-task'))
            $tasks = Task::paginate();
        else
            $tasks = $user->tasks()->paginate()
        ;

        return new TaskCollection($tasks);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request) {

        $this->authorize('create', [Task::class]);

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

        $this->authorize('view', [$task]);

        return new TaskResource($task);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task) {

        $this->authorize('update', [$task]);

        $data = $request->validated();

        $userIds = $data['user_ids'] ?? [];

        $response = [
            'message' => 'Task updated successfully!',
            'data' => $data
        ];

        ['message' => &$message] = $response;

        unset($data['user_ids']);

        $task->update($data);

        $status = 200;

        if ($request->method() !== 'PATCH' || $request->has('user_ids')) {

            $userTasks = $task->users()->sync($userIds);

            if (empty($userTasks)) {

                $message = 'An unexpected error occurred while trying to assign the task to users!';

                $status = 400;

            }

        }

        return response()->json($response, $status);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task) {

        $this->authorize('delete', [$task]);

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
