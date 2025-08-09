<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string',
            'password' => 'required|min:8|confirmed'
        ]);

        try {
            $newUser = User::create([
                'email' => $validatedData['email'],
                'name' => $validatedData['name'],
                'password' => Hash::make($validatedData['password']),
            ]);
        } catch (Exception $e) {
            Log::info($e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error in creating a new user',
            ], 500);
        }

        Auth::login($newUser);

        return response()->json([
           'success' => true,
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        // return redirect()->intended(route('dashboard', absolute: false));
    }
}
