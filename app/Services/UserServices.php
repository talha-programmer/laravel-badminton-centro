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
                $routes[11] = ['name' => 'users', 'description' => 'Users', 'icon_class' => 'fas fa-users'];
                $routes[8] = ['name' => 'products', 'description' => 'Products', 'icon_class' => 'fas fa-tags'];
                $routes[9] = ['name' => 'product_categories', 'description' => 'Product Categories', 'icon_class' => 'fas fa-bars'];
            case UserTypes::Director:
            case UserTypes::ClubOwner:
                $routes[1] = ['name' => 'clubs', 'description' => 'Clubs', 'icon_class' => 'fas fa-hockey-puck'];
                $routes[5] = ['name' => 'tournaments', 'description' => 'Tournaments', 'icon_class' => 'fas fa-volleyball-ball'];
                $routes[4] = ['name' => 'matches', 'description' => 'Matches', 'icon_class' => 'fas fa-table-tennis'];

            case UserTypes::Player:
            case UserTypes::Customer:
                $routes[0] = ['name' => 'dashboard', 'description' => 'Dashboard', 'icon_class' => 'fas fa-tachometer-alt'];
                $routes[3] = ['name' => 'players', 'description' => 'Players',  'icon_class' => 'fas fa-running'];

                $routes[10] = ['name' => 'orders', 'description' => 'Orders', 'icon_class' => 'fas fa-shopping-bag'];
        }

        // Add only in case of players
        if($user_type == UserTypes::Player){
            $routes[12] = ['name' => 'challenge_requests', 'description' => 'Challenge Requests', 'icon_class' => 'fas fa-futbol'];
        }

        ksort($routes);

        return $routes;
    }

}