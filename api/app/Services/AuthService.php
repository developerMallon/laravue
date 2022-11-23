<?php

namespace App\Services;

use App\Events\ForgotPassword;
use App\Exceptions\LoginInvalidException;
use App\Exceptions\UserHasBeenTakenException;
use Illuminate\Support\Str;
use App\Events\UserRegistered;
use App\Exceptions\VerifyEmailTokenInvalidException;
use App\Models\PasswordReset;
use Exception;

class AuthService
{
    /**
     * Login function
     *
     * @param string $email
     * @param string $password
     * @return void
     */
    public function login(string $email, string $password)
    {
        $login = [
            'email' => $email,
            'password' => $password
        ];

        if (!$token = auth()->attempt($login)) {
            throw new LoginInvalidException('Email ou senha inválidos.');
        }

        return [
            'access_token' => $token,
            'token_type' => 'Bearer',
        ];
    }

    public function register(string $first_name, string $last_name, string $branche, string $email, string $phone, string $password)
    {
        $user = \App\Models\User::where('email', $email)->exists();

        if (!empty($user)) {
            throw new UserHasBeenTakenException('Email já cadastrado.');
        }

        $userPassword = bcrypt($password);

        $user = \App\Models\User::create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'branche' => $branche,
            'email' => $email,
            'phone' => $phone,
            'password' => $userPassword,
            'confirmation_token' => Str::random(60)
        ]);
        
        event(new UserRegistered($user));

        return $user;
    }

    public function verifyEmail(string $token)
    {
        $user = \App\Models\User::where('confirmation_token', $token)->first();

        if (empty($user)) {
            throw new VerifyEmailTokenInvalidException();
        }

        $user->confirmation_token = null;
        $user->email_verified_at = now();
        $user->save();

        return $user;
    }

    public function forgotPassword(string $email)
    {
        $user = \App\Models\User::where('email', $email)->firstOrFail();

        $token = Str::random(60);

        PasswordReset::create([
            'email' => $user->email,
            'token' => $token,
        ]);

        event(new ForgotPassword($user, $token));

        return "";
    }

    public function resetPassword(string $email, string $password, string $token)
    {   
        $passReset = PasswordReset::where('email', $email)->where('token', $token)->first();

        if (empty($passReset)) {
            throw new \App\Exceptions\ResetPasswordTokenInvalidException();
        }

        $user = \App\Models\User::where('email', $email)->firstOrFail();
        $user->password = bcrypt($password);
        $user->save();

        PasswordReset::where('email', $email)->delete();

        return response()->json(['message' => 'Senha atualizada com sucesso.']);
    }

    public function logout()
    {
        // Pass true to force the token to be blacklisted "forever"
        auth()->logout(true);

        return response()->json([
            "message" => "Logout efetuado com sucesso"
        ], 200);
    }
}
