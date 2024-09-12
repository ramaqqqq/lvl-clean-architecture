<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use App\Repositories\User\UserRepository;

class RegistrationSvcImpl implements RegistrationService
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo) {
        $this->userRepo = $userRepo;
    }

    public function RegisterSvc(array $req){
        try {
            $user = $this->userRepo->create([
                'name' => $req['name'],
                'email' => $req['email'],
                'password' => bcrypt($req['password']),
            ]);
            if (!$user) {
                throw new Exception("Register user failed");
            }

            return $user;
        } catch (Exception $err) {
            Log::error('emailRegisterSvc err: ' . $err->getMessage());
            throw $err;
        }
    }
}
