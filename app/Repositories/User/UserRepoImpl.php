<?php

namespace App\Repositories\User;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserRepoImpl implements UserRepository
{
    public function create(array $data)
    {
        try {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),

            ]);
            return $user;
        } catch (Exception $err) {
            Log::error('Register user failed', ['error' => $err->getMessage()]);
            return $err->getMessage();
        }
    }

    public function get(string $email)
    {
        try {
            return User::where([
                'email' => $email,
            ])->exists();
        } catch (Exception $err) {
            Log::error('Login user failed', ['error' => $err->getMessage()]);
            return $err->getMessage();
        }
    }

    public function findByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }

    public function findByCredentials(string $email, string $password)
    {
        $user = $this->findByEmail($email);
        if ($user && Hash::check($password, $user->password)) {
            return $user;
        }
        return null;
    }
}
