<?php

namespace App\Providers;

use App\Src\Interfaces\Auth\IAuthRepository;
use App\Src\Interfaces\Auth\IAuthServices;
use App\Src\Repositories\Auth\AuthRepository;
use App\Src\Services\Auth\AuthService;

use Illuminate\Support\ServiceProvider;

class AuthProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            IAuthRepository::class,
            AuthRepository::class
        );
        $this->app->bind(
            IAuthServices::class,
            AuthService::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
