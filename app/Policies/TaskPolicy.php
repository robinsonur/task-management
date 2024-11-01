<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskPolicy {

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response {

        $response =
            $user->hasPermissionTo('view-any-task') ||
            $user->hasPermissionTo('view-own-task')
                ? Response::allow()
                : Response::deny('You don\'t have permission to view all tasks')
        ;

        return $response;

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Task $task): Response {

        $can = $user->hasPermissionTo('view-any-task', 'api');

        if ($can)
            return Response::allow()
        ;

        $can = $user->hasPermissionTo('view-own-task', 'api');

        $response =
            $can &&
            $task->users()->where('users.id', $user->id)->exists()
                ? Response::allow()
                : Response::deny('You don\'t have permission to view users!')
        ;

        return $response;


    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response {

        $response = $user->hasPermissionTo('create-task', 'api')
            ? Response::allow()
            : Response::deny('You don\'t have permission to create tasks!')
        ;

        return $response;

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Task $task): Response {

        $can = $user->hasPermissionTo('update-any-task', 'api');

        if ($can)
            return Response::allow()
        ;

        $can = $user->hasPermissionTo('update-own-task', 'api');

        $response =
            $can && $task->users()->where('users.id', $user->id)->exists()
                ? Response::allow()
                : Response::deny('You don\'t have permission to update tasks!')
        ;

        return $response;

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Task $task): Response {

        $can = $user->hasPermissionTo('delete-any-task', 'api');

        if ($can)
            return Response::allow()
        ;

        $can = $user->hasPermissionTo('delete-own-task', 'api');

        $response =
            $can && $task->users()->where('users.id', $user->id)->exists()
                ? Response::allow()
                : Response::deny('You don\'t have permission to delete tasks!')
        ;

        return $response;

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Task $task): Response {

        $can = $user->hasPermissionTo('restore-any-task', 'api');

        if ($can)
            return Response::allow()
        ;

        $can = $user->hasPermissionTo('restore-own-task', 'api');

        $response =
            $can && $task->users()->where('users.id', $user->id)->exists()
                ? Response::allow()
                : Response::deny('You don\'t have permission to restore tasks!')
        ;

        return $response;

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Task $task): Response {

        $can = $user->hasPermissionTo('delete-any-task', 'api');

        if ($can)
            return Response::allow()
        ;

        $can = $user->hasPermissionTo('delete-own-task', 'api');

        $response =
            $can && $task->users()->where('users.id', $user->id)->exists()
                ? Response::allow()
                : Response::deny('You don\'t have permission to delete tasks!')
        ;

        return $response;

    }

}
