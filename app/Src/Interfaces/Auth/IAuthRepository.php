<?php

namespace App\Src\Interfaces\Auth;

interface IAuthRepository
{
    public function login(string $email, string $password);
    public function register(array $data);
}
