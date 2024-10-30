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

        $users = User::paginate();

        return new UserCollection($users);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request) {

        //

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user) {

        return new UserResource($user);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user) {

        //

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user) {

        //

    }

}
