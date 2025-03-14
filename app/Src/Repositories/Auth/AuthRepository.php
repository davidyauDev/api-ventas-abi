<?php

namespace App\Src\Repositories\Auth;

use App\Models\User;
use App\Src\Interfaces\Auth\IAuthRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthRepository implements IAuthRepository
{

    public function login(string $email, string $password)
    {
        if (Auth::attempt(["email" => $email, 'password' => $password])) {
            $user = User::firstWhere('email', $email);

            $token = $user->createToken("_token")->plainTextToken;
            return (object) [
                "userData" => [
                    "id" => $user->id,
                    "fullName" => $user->name,
                    "email" => $user->email,
                    "role" => "admin",
                    "accessToken" => $token,
                ],
            ];
        }
        return null;
    }

    public function register(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = $user->createToken("_token")->plainTextToken;

        return (object) [
            "userData" => [
                "id" => $user->id,
                "fullName" => $user->name,
                "username" => $user->name,
                "email" => $user->email,
                "role" => "user",
            ],
            "accessToken" => $token,
            "userAbilityRules" => [
                [
                    "action" => "read",
                    "subject" => "profile",
                ]
            ]
        ];
    }
}
