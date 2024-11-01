<?php

namespace App\Policies;

use App\Models\Status;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class StatusPolicy {

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response {

        $response = $user->hasPermissionTo('view-any-status', 'api')
            ? Response::allow()
            : Response::deny('You don\'t have permission to view all statuses!')
        ;

        return $response;

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Status $status): Response {

        $response = $user->hasPermissionTo('view-any-status', 'api')
            ? Response::allow()
            : Response::deny('You don\'t have permission to view statuses!')
        ;

        return $response;

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response {

        $response = $user->hasPermissionTo('create-status', 'api')
            ? Response::allow()
            : Response::deny('You don\'t have permission to create statuses!')
        ;

        return $response;

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Status $status): Response {

        $response = $user->hasPermissionTo('update-any-status', 'api')
            ? Response::allow()
            : Response::deny('You don\'t have permission to update statuses!')
        ;

        return $response;

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Status $status): Response {

        $response = $user->hasPermissionTo('delete-any-status', 'api')
            ? Response::allow()
            : Response::deny('You don\'t have permission to delete statuses!')
        ;

        return $response;

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Status $status): Response {

        $response = $user->hasPermissionTo('restore-any-status', 'api')
            ? Response::allow()
            : Response::deny('You don\'t have permission to restore statuses!')
        ;

        return $response;

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Status $status): Response {

        $response = $user->hasPermissionTo('delete-any-status', 'api')
            ? Response::allow()
            : Response::deny('You don\'t have permission to delete statuses!')
        ;

        return $response;

    }

}
