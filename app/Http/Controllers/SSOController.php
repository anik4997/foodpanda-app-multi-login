<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SSOController extends Controller
{
    public function ssoLogin(Request $request)
    {
        try {

            $payload = JWTAuth::setToken($request->token)->getPayload();

            $userId = $payload['sub'];

            // Instead of authenticate(), manually find or create user
            $user = User::firstOrCreate(
                ['id' => $userId],
                [
                    'name' => 'SSO User',
                    'email' => 'user'.$userId.'@sso.com',
                    'password' => bcrypt('default123')
                ]
            );

            Auth::login($user);

            return redirect('/dashboard');

        } catch (\Exception $e) {
            return "Invalid Token";
        }
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}
