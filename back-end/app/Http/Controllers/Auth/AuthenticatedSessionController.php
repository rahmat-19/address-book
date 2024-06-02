<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Spatie\FlareClient\Api;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {

        $user = User::where('email', $request->email)->first();
 
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
     
        return response()->json([
            'status' => true,
            'message' => 'Success Login',
            'data' => $user->createToken($request->email)->plainTextToken
        ], 201);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy()
    {
        // Auth::guard('web')->logout();

        // $request->session()->invalidate();

        // $request->session()->regenerateToken();
        auth()->user()->tokens()->delete();
        return [
            'message' => 'user logged out'
        ];

        // return response()->json([
        //     'status' => true,
        //     'message' => 'Success Logout',
        // ], 201);
    }
}
