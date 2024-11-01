<?php

namespace App\Policies;

use App\Models\Record;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RecordPolicy {

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response {

        $response = $user->hasPermissionTo('view-any-record', 'api')
            ? Response::allow()
            : Response::deny('You don\'t have permission to view all records!')
        ;

        return $response;

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Record $record): Response {

        $response = $user->hasPermissionTo('view-any-record', 'api')
            ? Response::allow()
            : Response::deny('You don\'t have permission to view records!')
        ;

        return $response;

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response {

        $response = $user->hasPermissionTo('create-record', 'api')
            ? Response::allow()
            : Response::deny('You don\'t have permission to create records!')
        ;

        return $response;

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Record $record): Response {

        $response = $user->hasPermissionTo('update-any-record', 'api')
            ? Response::allow()
            : Response::deny('You don\'t have permission to update records!')
        ;

        return $response;

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Record $record): Response {

        $response = $user->hasPermissionTo('delete-any-record', 'api')
            ? Response::allow()
            : Response::deny('You don\'t have permission to delete records!')
        ;

        return $response;

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Record $record): Response {

        $response = $user->hasPermissionTo('restore-any-record', 'api')
            ? Response::allow()
            : Response::deny('You don\'t have permission to restore records!')
        ;

        return $response;

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Record $record): Response {

        $response = $user->hasPermissionTo('delete-any-record', 'api')
            ? Response::allow()
            : Response::deny('You don\'t have permission to delete records!')
        ;

        return $response;

    }

}
