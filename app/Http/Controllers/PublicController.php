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
        ]);
    }
}
