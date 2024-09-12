<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepoImpl;
use App\Services\EmailLoginService;
use App\Services\EmailLoginSvcImpl;
use App\Services\RegistrationService;
use App\Services\RegistrationSvcImpl;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Registration 
        $this->app->bind(UserRepository::class, UserRepoImpl::class);
        $this->app->bind(RegistrationService::class, RegistrationSvcImpl::class);
        // Login 
        $this->app->bind(EmailLoginService::class, EmailLoginSvcImpl::class);
    }

    public function boot()
    {
        //
    }
}
