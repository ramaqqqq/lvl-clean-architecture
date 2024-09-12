<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\RegistrationRepository;
use App\Repositories\RegistrationRepoImpl;
use App\Services\RegistrationService;
use App\Services\RegistrationSvcImpl;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(RegistrationRepository::class, RegistrationRepoImpl::class);
        $this->app->bind(RegistrationService::class, RegistrationSvcImpl::class);
    }

    public function boot()
    {
        //
    }
}
