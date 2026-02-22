<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SSOController extends Controller
{
    public function index()
    {
        return view('notice');
    }
    public function ssoLogin(Request $request)
    {
        try {

            $payload = JWTAuth::setToken($request->token)->getPayload();

            $email = $payload['email'];
            $name  = $payload['name'];

            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $name,
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
        if (!Auth::check()) {
            return redirect('/')->with('error', 'Please login via Ecommerce first.');
        }

        return view('dashboard');
    }
    public function ssoLogout(Request $request)
    {
        $email = $request->input('email');

        $user = User::where('email', $email)->first();
        if ($user && Auth::check() && Auth::user()->id === $user->id) {
            Auth::logout();
        }

        return redirect('http://127.0.0.1:8000/login')->with('success', 'You have been logged out successfully.');
    }
}
