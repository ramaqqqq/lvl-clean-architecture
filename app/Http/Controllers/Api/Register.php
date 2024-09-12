<?php

namespace App\Http\Controllers\Api;

use App\Services\RegistrationService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class Register extends Controller
{
    protected $registerSvc;

    public function __construct(RegistrationService $registerSvc){
        $this->registerSvc = $registerSvc;
    }

    public function __invoke(Request $payload) {
        $buildRegisterRequest = Validator::make($payload->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:3|confirmed',
        ]);

        if ($buildRegisterRequest->fails()) {
            Log::error('Validation failed', ['error' => $buildRegisterRequest->errors()]);
            return response()->json([$buildRegisterRequest->errors()], 422);
        }

        try {
            $user = $this->registerSvc->RegisterSvc($buildRegisterRequest->validated());
            return response()->json(['user' => $user], 201);
        } catch (\Exception $err) {
            Log::error('Registration failed', ['error' => $err->getMessage()]);
            return response()->json(['error' => 'Registration failed'], 500);
        }
    }
}
