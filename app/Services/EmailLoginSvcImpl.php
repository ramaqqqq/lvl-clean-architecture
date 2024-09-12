<?php

namespace App\Services;

use Exception;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EmailLoginSvcImpl implements EmailLoginService
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function EmailloginSvc(array $credentials)
    {
        try {
            $user = $this->userRepo->findByCredentials($credentials['email'], $credentials['password']);
            if (!$user) {
                throw new Exception("Invalid credentials");
            }

            // Generate JWT token
            $token = Auth::guard('api')->login($user);

            return ['user' => $user, 'token' => $token];
        } catch (Exception $err) {
            Log::error('Login error: ' . $err->getMessage());
            throw $err;
        }
    }

}

