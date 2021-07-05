@extends('layouts.app')

@section('content')

    @include('public.layouts.header')

    <div id="matches_container" >
        <div class="image-overlay py-4 container-fluid">
            <h1 class="text-center text-white">Tournaments</h1>
            <hr>
                @foreach($tournaments as $tournament)
                    <div class="row mt-5" data-aos="fade">
                        <div class="col mx-5 ">
                            <h3 class="rounded-pill bg-light p-3 text-center mx-5">{{ $tournament->name }}</h3>

                        </div>
                    </div>
                    <div class="row justify-content-center mb-2" data-aos="fade">
                            <div class="col-5 text-white">
                                <div class="row">
                                    <div class="col-md-4">
                                        Start Date
                                    </div>
                                    <div class="col-md-8">
                                        {{ \Carbon\Carbon::create($tournament->start_date)->format('l\, jS F Y') }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        End Date
                                    </div>
                                    <div class="col-md-8">
                                        {{ \Carbon\Carbon::create($tournament->end_date)->format('l\, jS F Y') }}
                                    </div>
                                </div>
                                <h5 class="mt-3">Clubs</h5>

                                <table class="px-4 table table-bordered text-white">
                                    <thead>
                                    <tr>
                                        <th>Sr.</th>
                                        <th>Club Name</th>
                                        <th>Teams</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $club_counter = 0;?>

                                    @foreach($tournament->clubs as $club)
                                        <?php $club_counter++; ?>
                                        <tr>
                                            <td>{{ $club_counter }}</td>
                                            <td>{{ $club->name }}</td>

                                            <td>
                                                <ul>
                                                    @foreach($tournament->clubTeams($club) as $team)
                                                        <li class="mb-2 ">{{ $team->name }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>


                            </div>



                            <div class="col-5 ">


                                <h5 class="py-2 rounded-pill bg-light text-center">Matches</h5>
                                <div class="overflow-auto matches" style="height: 300px" >
                                    @foreach($tournament->matches as $match)
                                        <x-previous-match :match="$match"/>
                                       {{-- <div class="p-4 text-white">
                                            <div class="col shadow bg-primary pb-4" style="border-radius: 10% 30%;">
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


                                                @if($match->team_one_points != null)    --}}{{--If Match Result is added already--}}{{--
                                                <h4 class="mb-3 mt-4 text-center">Match Result</h4>

                                                <div class="row text-center justify-content-center">
                                                    <div class="col-5 border-right">
                                                        <h5 class="font-weight-bold">{{ $match->teamOne->name }}</h5>
                                                        @foreach($match->teamOnePlayers() as $player)
                                                            <h6><a href="{{ route('public_single_player', $player) }}">{{ $player->user->name }}</a>: {{ $player->pivot->points }} Points</h6>
                                                        @endforeach
                                                        <h6 class="font-weight-bold">Total: {{ $match->team_one_points }} Points</h6>
                                                    </div>
                                                    <div class="col-5">
                                                        <h5 class="font-weight-bold">{{ $match->teamTwo->name }}</h5>
                                                        @foreach($match->teamTwoPlayers() as $player)
                                                            <h6><a href="{{ route('public_single_player', $player) }}">{{ $player->user->name }}</a>: {{ $player->pivot->points }} Points</h6>
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
                                        </div>--}}
                                    @endforeach

                                </div>


                            </div>
                        </div>






                @endforeach

                <div class="d-flex justify-content-center">
                    {{ $tournaments->links() }}
                </div>
        </div>

    </div>

    <style>
        @push('style_tag')


        .matches::-webkit-scrollbar {
            width: 8px;
            background-color: #caefd4;
        }


        .matches::-webkit-scrollbar-track {
            background-color: rgba(0, 0, 0, 0);
            transition: background-color 0.15s ease-out;
        }

        #matches_container {
            background-image: url("{{ asset('images/main-background.jpg') }}");
            background-size: cover;
            background-repeat: no-repeat;
        }

        .matches::-webkit-scrollbar-thumb {
            background-color: #c7c7c7;
            border-radius: 10px;
        }

        .image-overlay{
            background-color: rgba(31, 31, 31, 0.55);
        }

        a {
            color: white;
        }

        @endpush
    </style>



@endsection
