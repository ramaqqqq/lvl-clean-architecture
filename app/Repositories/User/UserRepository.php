<?php

namespace App\Repositories\User;

interface UserRepository
{
    public function create(array $data);
    public function get(string $email);
    public function findByEmail(string $email);
    public function findByCredentials(string $email, string $password);
}
