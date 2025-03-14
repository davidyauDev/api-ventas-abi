<?php

namespace App\Src\Interfaces\Auth;


use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\UserRequestForm;

interface IAuthServices
{
    public function register(UserRequestForm $request);

    public function login(LoginUserRequest $request);

    //public function logout();
}
