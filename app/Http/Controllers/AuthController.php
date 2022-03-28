<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\AuthUser;
use App\Http\Requests\CreateUser;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    protected $tokenName;

    protected function setTokenName()
    {
        return $this->tokenName = config('app.name') . '-Admin';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(AuthUser $request)
    {
        $this->setTokenName();

        $credentials = $request->validated();

        (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']]))
            ? $token = auth()->user()->createToken($this->tokenName)->plainTextToken
            : $errors = trans('auth.failed');



        $responseBody = [
            'user' => auth()->user(),
            'token' => ($token) ?? $this->tokenName
        ];

        return response()->json([
            'status' => 200,
            'message' => ($errors) ?? 'User Create Successfully',
            'body' => $responseBody
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(CreateUser $request)
    {
        $this->setTokenName();

        $credentials = $request->validated();

        $user = User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => $credentials['password']
        ]);

        Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password']
        ]);

        $userType = User::where('id', $user->id)->first();

        $token = $user->createToken($this->tokenName)->plainTextToken;

        $responseBody = [
            'user' => $userType,
            'token' => $token
        ];

        return response()->json([
            'status' => 200,
            'message' => 'User Create Successfully',
            'body' => $responseBody
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        // Auth::logout();

        // $request->session()->invalidate();

        // $request->session()->regenerateToken();

        return response()->json([
            'message' => 'Logged Out'
        ]);
    }
}
