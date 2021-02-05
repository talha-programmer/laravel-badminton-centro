<?php

namespace App\Http\Controllers;

use App\Enums\UserTypes;
use App\Models\Admin;
use App\Models\ClubOwner;
use App\Models\Customer;
use App\Models\Director;
use App\Models\Player;
use App\Models\User;
use App\Services\UserServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        // Only allow logged in users to access profile pages
        $this->middleware(['auth']);

        $this->middleware('admin')->only(['index', 'destroy', 'addUser', 'saveUser']);

    }

    public function index()
    {
        $users = User::all();

        return view('user.index', [
            'users' => $users,
        ]);
    }

    public function profile()
    {
        $user = \auth()->user();
        return view('user.profile',[
            'user' => $user,
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('info', 'User deleted successfully!');
    }

    public function updateProfile(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|max:255|email',
            'address' => 'max:255',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;

        $user->save();

        return back()->with('info', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request, User $user)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);


        if(Hash::check($request->current_password, $user->password)){
            $user->password = Hash::make($request->new_password);
            $user->save();

            return back()->with('info', 'Password updated successfully!');
        }

        return back()->with('error', 'Wrong password provided! Please try again!');
    }

    public function addUser()
    {
        return view('user.add_user');
    }

    public function saveUser(Request $request)
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
            case UserTypes::Director:
                $user_type_model = new Director();
                break;

            case UserTypes::Admin:
                $user_type_model = new Admin();
                break;

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

        return back()->with('info', 'User added successfully!');
    }

    public function dashboard()
    {
        return view('user.dashboard');
    }
}
