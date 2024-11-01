<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy {

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response {

        $response = $user->hasPermissionTo('view-any-user', 'api')
            ? Response::allow()
            : Response::deny('You don\'t have permission to view all users!')
        ;

        return $response;

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): Response {

        $can = $user->hasPermissionTo('view-any-user', 'api');

        if ($can)
            return Response::allow()
        ;

        $can = $user->hasPermissionTo('view-own-user', 'api');

        $response = $can && $user->id === $model->id
            ? Response::allow()
            : Response::deny('You don\'t have permission to view users!')
        ;

        return $response;

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response {

        $response = $user->hasPermissionTo('create-user', 'api')
            ? Response::allow()
            : Response::deny('You don\'t have permission to create users!')
        ;

        return $response;

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): Response {

        $can = $user->hasPermissionTo('update-any-user', 'api');

        if ($can)
            return Response::allow()
        ;

        $can = $user->hasPermissionTo('update-own-user', 'api');

        if ($can)
            $can = $user->id === $model->id
        ;

        $response = $can && $user->id === $model->id
            ? Response::allow()
            : Response::deny('You don\'t have permission to update users!')
        ;

        return $response;

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): Response {

        $can = $user->hasPermissionTo('delete-any-user', 'api');

        if ($can)
            return Response::allow()
        ;

        $can = $user->hasPermissionTo('delete-own-user', 'api');

        $response = $can && $user->id === $model->id
            ? Response::allow()
            : Response::deny('You don\'t have permission to delete users!')
        ;

        return $response;

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): Response {

        $response = $user->hasPermissionTo('restore-any-user', 'api')
            ? Response::allow()
            : Response::deny('You don\'t have permission to restore users!')
        ;

        return $response;

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): Response {

        $can = $user->hasPermissionTo('delete-any-user', 'api');

        if ($can)
            return Response::allow()
        ;

        $can = $user->hasPermissionTo('delete-own-user', 'api');

        $response = $can && $user->id === $model->id
            ? Response::allow()
            : Response::deny('You don\'t have permission to delete users!')
        ;

        return $response;

    }

}
