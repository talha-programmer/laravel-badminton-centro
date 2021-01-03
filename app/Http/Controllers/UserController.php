<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserServices;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        // Only allow logged in users to access profile pages
        $this->middleware(['auth']);

    }

    public function profile(User $user)
    {
        return view('user.profile',[
            'user' => $user,
        ]);
    }

    public function dashboard()
    {
        return view('user.dashboard');
    }
}