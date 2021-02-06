<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Match;
use App\Models\Product;
use App\Models\Team;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home()
    {

        $teams = Team::all();
        $matches = Match::all();
        $clubs = Club::all();
        $products = Product::all();

        return view('public.home',[
            'teams' => $teams,
            'matches' => $matches,
            'clubs' => $clubs,
            'products' => $products,
            'page_name' => '',
        ]);
    }

    public function products()
    {
        $products = Product::all();

        return view('public.products',[
            'products' => $products,
            'page_name' => 'Home/Products',
        ]);
    }

    public function about()
    {
        return view('public.about',[
            'page_name' => 'Home/About'
        ]);
    }

    public function singleProduct(Product $product)
    {
        return view('public.single_product',[
            'product' => $product,
        ]);
    }


    public function matches()
    {
        $upcomingMatches = Match::all()
            ->where('team_one_points' , '=', null)->sortBy('match_time');

        $previousMatches = Match::all()
            ->where('team_one_points' , '!=', null)->sortBy('match_time');

        return view('public.matches',[
            'upcoming_matches' => $upcomingMatches,
            'previous_matches' => $previousMatches,
            'page_name' => 'Home/Matches',
        ]);
    }

    public function clubs()
    {
        $clubs = Club::all();

        return view('public.clubs', [
            'clubs' => $clubs,
            'page_name' => 'Home/Clubs'
        ]);
    }

}
