<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Psr\Http\Message\ServerRequestInterface;
use Illuminate\Support\Facades\App;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json($user, 201);
    }

    public function login(ServerRequestInterface $serverRequest)
    {
        $modifiedRequest = $serverRequest->withParsedBody([
            'grant_type' => 'password',
            'client_id' => config('services.passport.client_id'),
            'client_secret' => config('services.passport.client_secret'),
            'username' => request('email'),
            'password' => request('password'),
            'scope' => '',
        ]);

        return App::make(AccessTokenController::class)->issueToken($modifiedRequest);
    }

    public function refresh(ServerRequestInterface $serverRequest)
    {
        $request = $serverRequest->withParsedBody([
            'grant_type' => 'refresh_token',
            'refresh_token' => request('refresh_token'),
            'client_id' => config('services.passport.client_id'),
            'client_secret' => config('services.passport.client_secret'),
            'scope' => '',
        ]);

        return App::make(AccessTokenController::class)->issueToken($request);
    }

}
