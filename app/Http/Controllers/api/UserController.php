<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\User;
use App\Http\Resources\UserCollection;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller {

    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index() {

        $this->authorize('viewAny');

        $users = User::paginate();

        return new UserCollection($users);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request) {

        $this->authorize('create');

        $data = $request->validated();

        unset($data['password']);

        $response = [
            'message' => 'User created successfully!',
            'data' => $data
        ];

        $task = User::create($data);

        ['message' => &$message] = $response;

        $status = 201;

        if (!$task) {

            $message = 'An unexpected error occurred while trying to create the user!';

            $status = 400;

        }

        return response()->json($response, $status);

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user) {

        $this->authorize('view');

        return new UserResource($user);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user) {

        $this->authorize('update');

        $data = $request->validated();

        unset($data['password']);

        $response = [
            'message' => 'User updated successfully!',
            'data' => $data
        ];

        ['message' => &$message] = $response;

        $user->update($data);

        $status = 200;

        return response()->json($response, $status);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user) {

        $this->authorize('delete');

        $data = $user->toArray();

        $response = [
            'message' => 'User deleted successfully!',
            'data' => $data
        ];

        ['message' => &$message] = $response;

        $status = 200;

        if (!$user) {

            $message = 'An unexpected error occurred while trying to delete the user!';

            $status = 400;

        } else
            $user->delete()
        ;

        return response()->json($response, $status);

    }

}
