<?php

namespace App\Repositories;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class RegistrationRepoImpl implements RegistrationRepository
{
    public function create(array $data)
    {
        try {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
            ]);
            Log::info('Register user success', ['email' => $data['email']]);
            return $user;
        } catch (Exception $err) {
            Log::error('Register user failed', ['error' => $err->getMessage()]);
            return $err->getMessage();
        }
    }
}
