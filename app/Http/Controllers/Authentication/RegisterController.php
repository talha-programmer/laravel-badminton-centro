<?php

namespace App\Http\Controllers\Authentication;

use App\Enums\UserTypes;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\ClubOwner;
use App\Models\Customer;
use App\Models\Director;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Form validation for all fields
        $this->validate($request, [
            'name' => 'required|max:255',
            'username' => 'required|alpha_dash|max:255|unique:users',
            'email' => 'required|max:255|email|unique:users',
            'password' => 'required|confirmed',
        ]);


        $user = [
            'name'=> $request->name,
            'username'=> $request->username,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
            'user_type' => $request->user_type,
        ];


        $user_type = $request->user_type;

        // Create a model object according to user type. The user type model
        // will have an instance of user type models that are: Admin, Customer etc
        $user_type_model = null;
        switch ($user_type)
        {
            case UserTypes::Player:
                $user_type_model = new Player();
                break;

            case UserTypes::ClubOwner:
                $user_type_model = new ClubOwner();
                break;

            case UserTypes::Customer:
                $user_type_model = new Customer();
                break;

            default:
                return back();
        }

        // Save the user type model and the user model. Firstly, the user type model
        // is saved according to selected user type and then the model of User is
        // saved in the database
        $user_type_model->save();
        $user_type_model->user()->create($user);

        // Login the user
        Auth::attempt($request->only('username', 'password'));


        return redirect()->route('dashboard');
    }
}


