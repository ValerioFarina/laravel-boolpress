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

    public function generateToken() {
        $api_token = Str::random(80);
        $api_token_found = User::where('api_token', $api_token)->first();
        while ($api_token_found) {
            $api_token = Str::random(80);
            $api_token_found = User::where('api_token', $api_token)->first();
        }
        $user = Auth::user();
        $user->api_token = $api_token;
        $user->save();
        return redirect()->route('admin.profile');
    }
}
