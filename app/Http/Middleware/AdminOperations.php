<?php

namespace App\Http\Middleware;

use App\Enums\UserTypes;
use Closure;
use Illuminate\Http\Request;

class AdminOperations
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
        $userType = UserTypes::fromValue(auth()->user()->user_type);
        if($userType->is( UserTypes::Admin)){
            return $next($request);
        }
        return redirect()->route('home')->with('status', 'You are not allowed to perform this operation');
    }
}
