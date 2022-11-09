<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Http\Requests\AuthVerifyEmailRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function all()
    {
        $users = \App\Models\User::all();
        return $users;
    }

    /**
     * Login function
     *
     * @param AuthLoginRequest $request
     * @return void
     */
    public function login(AuthLoginRequest $request)
    {
        $input = $request->validated();

        $token = $this->authService->login($input['email'], $input['password']);

        return (new UserResource(auth()->user()))->additional([$token]);
    }

    public function Register(AuthRegisterRequest $request)
    {
        $input = $request->validated();

        $user = $this->authService->register($input['first_name'], $input['last_name'] ?? '', $input['email'], $input['password']);

        return new UserResource($user);
    }

    public function verifyEmail(AuthVerifyEmailRequest $request)
    {
        $input = $request->validated();

        $user = $this->authService->verifyEmail($input['token']);

        return new UserResource($user);
    }

    public function forgotPassword(\App\Http\Requests\AuthForgotPasswordRequest $request)
    {
        $input = $request->validated();

        $user = $this->authService->forgotPassword($input['email']);

        return $user;
    }

    public function resetPassword(\App\Http\Requests\AuthResetPasswordRequest $request)
    {
        $input = $request->validated();

        return $this->authService->resetPassword($input['email'], $input['password'], $input['token']);
    }
}
