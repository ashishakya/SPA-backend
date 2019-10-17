<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

class UserController extends Controller
{
    public function signup(Request $request)
    {
        $this->validate(
            $request,
            [
                'name'     => 'required',
                'email'    => 'required|email|unique:users',
                'password' => 'required',
            ]
        );
        $user = new User(
            [
                'name'     => $request->input('name'),
                'email'    => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ]
        );
        $user->save();

        return response()->json(
            [
                'message' => 'User successfully created.',
            ],
            201
        );
    }

    public function signin(Request $request)
    {
        $this->validate(
            $request,
            [
                'email'    => 'required|email',
                'password' => 'required',
            ]
        );
        $credentials = $request->only('email', 'password');
        try {
            if ( !$token = $this->guard()->attempt($credentials) ) {
                return response()->json(
                    [
                        'error' => 'Invalid credentials',
                    ],
                    401
                );
            }
        } catch ( JWTException $exception ) {
            return response()->json(
                [
                    'error' => 'could not create token.',
                ],
                500
            );
        }

        return response()->json(
            [
                'token' => $token,
            ],
            200
        );
    }

    private function guard()
    {
        return Auth::guard();
    }
}
