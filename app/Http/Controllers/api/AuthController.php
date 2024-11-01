<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use App\Http\Requests\SignInRequest;

class AuthController extends Controller {

    public function signUp(SignUpRequest $request) {

        $data = $request->only(['name', 'email', 'password']);

        $user = User::create($data);

        unset($data['password']);

        $response = [
            'message' => 'Successful sign up!',
            'data' => &$data
        ];

        if (!$user) {

            $response['message'] = 'Failed to sign up!';

            return response()->json($response, 400);

        }

        $data = [...$data, ...$this->createToken($user)];

        return response()->json($response, 201);

    }

    public function signIn(SignInRequest $request) {

        $data = $request->only(['email', 'password']);

        $response = [
            'message' => 'Successful sign in!',
            'data' => &$data
        ];

        $authenticated = auth()->attempt($data);

        unset($data['password']);

        if (!$authenticated) {

            $response['message'] = 'Email and/or password not valid!';

            return response()->json($response, 403);

        }

        $data = [...$data, ...$this->createToken(auth()->user())];

        return response()->json($response, 200);

    }

    public function signOut() {

        $user = auth()->user();

        $token = $user->currentAccessToken();

        $token->delete();

        $response = [
            'message' => 'Successful sign out!',
            'data' => [
                ...$user->only(['name', 'email']),
                'token' => [
                    'deleted_at' => now(),
                    ...$token->only(['last_used_at', 'expires_at', 'created_at'])
                ]
            ]
        ];

        return response()->json($response, 200);

    }

    private function createToken(User $user, int $expiresAt = 2): array {

        $expiresAt = now()->addHours(value: $expiresAt);

        $token = $user->createToken('auth', ['*'], $expiresAt);

        return [
            'token' => [
                'value' => $token->plainTextToken,
                ...$token->accessToken->only(['last_used_at', 'expires_at', 'created_at'])
            ]
        ];

    }

}
