<?php

namespace App\Policies;

use App\Models\RecordType;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RecordTypePolicy {

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response {

        $response = $user->hasPermissionTo('view-any-recordType', 'api')
            ? Response::allow()
            : Response::deny('You don\'t have permission to view all record types!')
        ;

        return $response;

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, RecordType $recordType): Response {

        $response = $user->hasPermissionTo('view-any-recordType', 'api')
            ? Response::allow()
            : Response::deny('You don\'t have permission to view record types!')
        ;

        return $response;

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response {

        $response = $user->hasPermissionTo('create-recordType', 'api')
            ? Response::allow()
            : Response::deny('You don\'t have permission to create record types!')
        ;

        return $response;

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, RecordType $recordType): Response {

        $response = $user->hasPermissionTo('update-any-recordType', 'api')
            ? Response::allow()
            : Response::deny('You don\'t have permission to update record types!')
        ;

        return $response;

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, RecordType $recordType): Response {

        $response = $user->hasPermissionTo('delete-any-recordType', 'api')
            ? Response::allow()
            : Response::deny('You don\'t have permission to delete record types!')
        ;

        return $response;

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, RecordType $recordType): Response {

        $response = $user->hasPermissionTo('restore-any-recordType', 'api')
            ? Response::allow()
            : Response::deny('You don\'t have permission to restore record types!')
        ;

        return $response;

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, RecordType $recordType): Response {

        $response = $user->hasPermissionTo('delete-any-recordType', 'api')
            ? Response::allow()
            : Response::deny('You don\'t have permission to delete record types!')
        ;

        return $response;

    }

}
