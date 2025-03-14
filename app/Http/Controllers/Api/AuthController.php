<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\UserRequestForm;
use App\Src\Interfaces\Auth\IAuthServices;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{

    public function __construct(private readonly IAuthServices $service) {}

    public function register(UserRequestForm $request): JsonResponse
    {
        return $this->service->register($request);
    }

    public function login(LoginUserRequest $request): JsonResponse
    {
        return $this->service->login($request);
    }
}
