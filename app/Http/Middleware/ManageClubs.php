<?php

namespace App\Http\Middleware;

use App\Enums\UserTypes;
use Closure;
use Illuminate\Http\Request;

class ManageClubs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user_type = auth()->user()->user_type;

        switch ($user_type)
        {
            // Allow only these types of users to manage clubs
            case UserTypes::ClubOwner:
            case UserTypes::Admin:
            case UserTypes::Director:
                return $next($request);
            default:
                return redirect()->route('home')->with('status', 'You are not allowed to perform this operation');
        }

    }
}
