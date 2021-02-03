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
            case UserTypes::Director:
            case UserTypes::ClubOwner:
                $routes[1] = ['name' => 'clubs', 'description' => 'Clubs'];
            case UserTypes::Player:
            case UserTypes::Customer:
                $routes[0] = ['name' => 'dashboard', 'description' => 'Dashboard'];
                $routes[3] = ['name' => 'players', 'description' => 'All Players'];
                $routes[4] = ['name' => 'products', 'description' => 'Products'];
                $routes[6] = ['name' => 'product_categories', 'description' => 'Product Categories'];
                $routes[8] = ['name' => 'matches', 'description' => 'Matches'];
                $routes[9] = ['name' => 'orders', 'description' => 'Orders'];
        }
        ksort($routes);

        //dd($routes);
        return $routes;
    }

}