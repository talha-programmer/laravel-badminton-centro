<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        if(Auth::attempt($request->only('username', 'password'), $request->remember))
        {
            return redirect()->route('home');
        }

        return back()->with('status', 'Invalid Login Details! Please check your username and password!');
    }
}
