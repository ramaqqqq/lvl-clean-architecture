<?php

namespace App\Http\Controllers\Api;

use App\Services\EmailLoginService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class Login extends Controller
{
    protected $loginSvc;

    public function __construct(EmailLoginService $loginSvc)
    {
        $this->loginSvc = $loginSvc;
    }

    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['error' => $validator->errors()]);
            return response()->json(['error' => $validator->errors()], 422);
        }

        try {
            $credentials = $validator->validated();
            $result = $this->loginSvc->EmailloginSvc($credentials);
            return response()->json($result, 200);
        } catch (\Exception $err) {
            Log::error('Login failed', ['error' => $err->getMessage()]);
            return response()->json(['error' => 'Login failed'], 500);
        }
    }
}
