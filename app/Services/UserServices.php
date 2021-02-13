<?php


namespace App\Services;


use App\Enums\UserTypes;

class UserServices
{
    public static function getAllowedRoutes()
    {
        $user_type = auth()->user()->user_type;
        $routes = array();
        switch ($user_type)
        {
            case UserTypes::Admin:
                $routes[11] = ['name' => 'users', 'description' => 'Users'];
                $routes[8] = ['name' => 'products', 'description' => 'Products'];
                $routes[9] = ['name' => 'product_categories', 'description' => 'Product Categories'];
            case UserTypes::Director:
            case UserTypes::ClubOwner:
                $routes[1] = ['name' => 'clubs', 'description' => 'Clubs'];
                $routes[5] = ['name' => 'tournaments', 'description' => 'Tournaments'];
                $routes[4] = ['name' => 'matches', 'description' => 'Matches'];

            case UserTypes::Player:
            case UserTypes::Customer:
                $routes[0] = ['name' => 'dashboard', 'description' => 'Dashboard'];
                $routes[3] = ['name' => 'players', 'description' => 'Players'];

                $routes[10] = ['name' => 'orders', 'description' => 'Orders'];
        }

        // Add only in case of players
        if($user_type == UserTypes::Player){
            $routes[12] = ['name' => 'challenge_requests', 'description' => 'Challenge Requests'];
        }

        ksort($routes);

        return $routes;
    }

}