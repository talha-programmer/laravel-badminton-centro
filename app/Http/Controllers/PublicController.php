<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Match;
use App\Models\News;
use App\Models\Player;
use App\Models\Product;
use App\Models\Team;
use App\Models\Tournament;
use App\Services\PaginationService;
use App\Services\RankingServices;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home()
    {

        $teams = Team::orderByDesc('ranking')->limit(10)->get();
        $matches = Match::with(['teamOne', 'teamTwo'])->latest()->paginate(4);
        $clubs = Club::all();
        $products = Product::latest()->paginate(4);
        $news = News::latest()->limit(15)->get();


        return view('public.home', [
            'teams' => $teams,
            'matches' => $matches,
            'clubs' => $clubs,
            'products' => $products,
            'page_name' => '',
            'news' => $news,
        ]);
    }

    public function products()
    {
        $products = Product::paginate(20);

        return view('public.products', [
            'products' => $products,
            'page_name' => 'Home/Products',
        ]);
    }

    public function about()
    {
        return view('public.about', [
            'page_name' => 'Home/About'
        ]);
    }

    public function singleProduct(Product $product)
    {
        return view('public.single_product', [
            'product' => $product,
        ]);
    }


    public function matches()
    {
        $upcomingMatches = Match::all()
            ->where('team_one_points', '=', null)->sortBy('match_time');

        $previousMatches = Match::all()
            ->where('team_one_points', '!=', null)->sortBy('match_time');

        return view('public.matches', [
            'upcoming_matches' => $upcomingMatches,
            'previous_matches' => $previousMatches,
            'page_name' => 'Home/Matches',
        ]);
    }

    public function clubs()
    {
        $clubs = Club::with(['teams', 'players', 'players.user'])->orderByDesc('ranking')->get();

        // Converting to array to retain the rank as index for pagination
        $clubArray = array();
        $index = 1;
        foreach ($clubs as $club) {
            $clubArray[$index] = $club;
            $index++;
        }

        $clubArray = PaginationService::paginate($clubArray, 3);


        return view('public.clubs', [
            'clubs' => $clubArray,
            'page_name' => 'Home/Clubs'
        ]);
    }

    public function players()
    {
        $players = Player::OrderByDesc('ranking')->get();
        // Converting to array to retain the rank as index for pagination
        $playersArray = array();
        $index = 1;
        foreach ($players as $player) {
            $playersArray[$index] = $player;
            $index++;
        }

        $playersArray = PaginationService::paginate($playersArray, 12);

        return view('public.players', [
            'players' => $playersArray,
            'page_name' => 'Home/Players'
        ]);
    }

    public function tournaments()
    {
        $tournaments = Tournament::latest()->paginate(3);

        return view('public.tournaments', [
            'tournaments' => $tournaments,
            'page_name' => 'Home/Tournaments'
        ]);
    }

    public function singleNews(News $news)
    {
        return view('public.single_news', [
            'single_news' => $news,
            'page_name' => 'Home/News',
        ]);
    }

    public function singlePlayer(Player $player)
    {

        return view('public.single_player',[
            'player' => $player,
            'page_name' => 'Home/Players',
            'player_rank' => $player->getRank(),
        ]);
    }

}
