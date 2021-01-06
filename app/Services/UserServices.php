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
                $routes[5] = ['name' => 'add_product', 'description' => 'Add Product'];
                $routes[7] = ['name' => 'add_product_category', 'description' => 'Add Product Category'];
            case UserTypes::Director:
            case UserTypes::ClubOwner:
                $routes[1] = ['name' => 'clubs', 'description' => 'Clubs'];
                $routes[2] = ['name' => 'add_club', 'description' => 'Add Club'];
            case UserTypes::Player:
            case UserTypes::Customer:
                $routes[0] = ['name' => 'dashboard', 'description' => 'Dashboard'];
                $routes[3] = ['name' => 'players', 'description' => 'All Players'];
                $routes[4] = ['name' => 'products', 'description' => 'All Products'];
                $routes[6] = ['name' => 'product_categories', 'description' => 'Product Categories'];

        }
        ksort($routes);

        //dd($routes);
        return $routes;
    }

}