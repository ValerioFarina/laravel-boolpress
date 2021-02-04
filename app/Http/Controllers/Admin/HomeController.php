<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\User;

class HomeController extends Controller
{
    public function index() {
        return view('admin.home');
    }

    public function profile() {
        return view('admin.profile');
    }

    // this function generates an API token for a registered user
    public function generateToken() {
        // we randomly generate an API token
        $api_token = Str::random(80);
        // we check whether the generated token already exists in the users table
        $api_token_found = User::where('api_token', $api_token)->first();
        while ($api_token_found) {
            // if the generated token is already associated with a registered user, we generates a new token
            $api_token = Str::random(80);
            // we check whether also this newly generated token already exists in the users table
            $api_token_found = User::where('api_token', $api_token)->first();
        }
        // we get the logged in user
        $user = Auth::user();
        // we associate to this user the generated token (this token will certainly be different from those of the other users)
        $user->api_token = $api_token;
        $user->save();
        return redirect()->route('admin.profile');
    }
}
