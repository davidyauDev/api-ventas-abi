<?php

namespace App\Src\Services\Auth;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\UserRequestForm;
use App\Src\Interfaces\Auth\IAuthRepository;
use App\Src\Interfaces\Auth\IAuthServices;
use App\Traits\ApiResponses;
use Illuminate\Support\Facades\Log;

class AuthService implements IAuthServices
{

    use ApiResponses;
    public function __construct(private readonly IAuthRepository $repository) {}
    public function login(LoginUserRequest $request)
    {
        try {
            $result = $this->repository->login($request->email, $request->password);
            if (!empty($result)) {
                return $this->ok('Login successful', $result);
            } else {
                return $this->error('Invalid credentials', 401);
            }
        } catch (\Exception $ex) {
            Log::error($ex);
            return $this->error('An error occurred while processing the login.', 500);
        }
    }
    public function register(UserRequestForm $request)
    {
        try {
            $this->repository->register($request->all());
            return $this->success('Usuario registrado correctamente', [], 201);
        } catch (\Exception $ex) {
            Log::error($ex);
            return $this->error($ex->getMessage(), 500);
        }
    }
}
