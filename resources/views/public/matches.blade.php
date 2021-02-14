@extends('layouts.app')

@section('content')

    @include('public.layouts.header')
    <div id="matches_container" class="container-fluid">
        {{--Upcoming Matches--}}
        <div class="container py-4" >
            <h1 class="text-center text-white">Upcoming Matches</h1>
            <hr>

            <div class="row row-cols-1 mt-5 row-cols-md-2 px-md-5 justify-content-center">

                @foreach($upcoming_matches as $match)
                    <div class="p-4 text-white" data-aos="fade-right">
                        <div class="col shadow bg-primary pb-4" style="min-height: 310px; border-radius: 10% 30%;">
                            <div class="text-white pt-4">
                                <h5 class="float-left"><i class="fas fa-calendar"></i>
                                    {{ \Carbon\Carbon::create($match->match_time)->format('jS F Y') }}
                                </h5>
                                <h5 class="float-right pr-3 pr-md-5">{{ \Carbon\Carbon::create($match->match_time)->format('h:i A') }}

                                    <i class="fas fa-clock"></i></h5>
                                <br> <br>

                                @if($match->tournament != null)
                                    <h3 class="text-center text-white py-2">Tournament: {{ $match->tournament->name }}</h3>
                                @endif
                                <h4 class="text-center  text-uppercase" style="line-height: 1.6;">{{ $match->teamOne->name }} <br> vs
                                    <br> {{ $match->teamTwo->name }}</h4>
                                <br>
                                <h5 style="font-style: italic;" class="text-center"><i class="fas fa-map-marker-alt"></i> {{ $match->venue }} </h5>
                            </div>


                        </div>
                    </div>
                @endforeach

            </div>

        </div>


        {{--Previous Matches--}}
        <div class="container py-4" >
            <h1 class="text-center text-white">Previous Matches</h1>
            <hr>

            <div class="row row-cols-1 mt-5 row-cols-md-2 px-md-5 justify-content-center">

                @foreach($previous_matches as $match)
                    <div class="p-4 text-white" data-aos="fade-left">
                        <div class="col shadow bg-primary pb-4" style="min-height: 475px; border-radius: 10% 30%;">
                            <div class="text-white pt-4">
                                <h5 class="float-left"><i class="fas fa-calendar"></i>
                                    {{ \Carbon\Carbon::create($match->match_time)->format('jS F Y') }}
                                </h5>
                                <h5 class="float-right pr-5">{{ \Carbon\Carbon::create($match->match_time)->format('h:i A') }}

                                    <i class="fas fa-clock pr-2"></i></h5>
                                <br> <br>

                                @if($match->tournament != null)
                                    <h3 class="text-center text-white py-2">Tournament: {{ $match->tournament->name }}</h3>
                                @endif
                                <h4 class="text-center  text-uppercase" style="line-height: 1.6;">{{ $match->teamOne->name }} <br> vs
                                    <br> {{ $match->teamTwo->name }}</h4>
                                <br>
                                <h5 style="font-style: italic;" class="text-center"><i class="fas fa-map-marker-alt"></i> {{ $match->venue }} </h5>
                            </div>


                            @if($match->team_one_points != null)    {{--If Match Result is added already--}}
                            <h4 class="mb-3 mt-4 text-center">Match Result</h4>

                            <div class="row text-center justify-content-center">
                                <div class="col-5 border-right">
                                    <h5 class="font-weight-bold">{{ $match->teamOne->name }}</h5>
                                    @foreach($match->teamOnePlayers() as $player)
                                        <h6>{{ $player->user->name }}: {{ $player->pivot->points }} Points</h6>
                                    @endforeach
                                    <h6 class="font-weight-bold">Total: {{ $match->team_one_points }} Points</h6>
                                </div>
                                <div class="col-5">
                                    <h5 class="font-weight-bold">{{ $match->teamTwo->name }}</h5>
                                    @foreach($match->teamTwoPlayers() as $player)
                                        <h6>{{ $player->user->name }}: {{ $player->pivot->points }} Points</h6>
                                    @endforeach
                                    <h6 class="font-weight-bold">Total: {{ $match->team_two_points }} Points</h6>

                                </div>
                            </div>
                            <?php
                            $matchResult = "";
                            $winnerTeam = $match->winner_team;
                            $winningPoints = abs($match->team_one_points - $match->team_two_points);
                            if($winnerTeam == -1){
                                $matchResult = "Match Tied!";
                            }else if ($winnerTeam == $match->teamOne->id ){
                                $matchResult = $match->teamOne->name . " won by " . $winningPoints . " points!";
                            }else if ($winnerTeam == $match->teamTwo->id ){
                                $matchResult = $match->teamTwo->name . " won by " . $winningPoints . " points!";
                            }
                            ?>


                            <h5 class="text-center font-weight-bold mt-4">{{ $matchResult }}</h5>

                            @endif
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </div>
    <style>
    #matches_container {
            background-image: url("{{ asset('images/main-background.jpg') }}");
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>



@endsection
