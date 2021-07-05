@extends('layouts.app')

@section('content')

    @include('public.layouts.header')

    <div class="container py-4 " >

        <h2 class="text-center">{{ $club->name }}</h2>
        <hr>
        <div class="row row-cols-1 my-5 row-cols-md-2 row-cols-sm-2 px-md-5 justify-content-center">
            <div class="col">
                <div class="card" data-aos="fade-right" style="border-radius: 5%;">
                    <div class="card-body">
                        <h4 class="card-title">General Details</h4>

                        <div class="row border-top border-secondary py-2">
                            <div class="col d-flex justify-content-between">
                                <div><h5 class="text-muted font-italic">Rank</h5></div>
                                <div><h5>{{ $club->getRank() }}</h5></div>
                            </div>
                        </div>

                        <div class="row border-top border-secondary py-2">
                            <div class="col d-flex justify-content-between">
                                <div><h5 class="text-muted font-italic">Owner</h5></div>
                                <div><h5>{{ $club->clubOwner->user->name }}</h5></div>
                            </div>
                        </div>

                        <div class="row border-top border-secondary py-2">
                            <div class="col d-flex justify-content-between">
                                <div><h5 class="text-muted font-italic">City</h5></div>
                                <div><h5>{{ $club->city }}</h5></div>
                            </div>
                        </div>

                        <div class="row border-top border-secondary py-2">
                            <div class="col d-flex justify-content-between">
                                <div><h5 class="text-muted font-italic">Address</h5></div>
                                <div><h5>{{ $club->address }}</h5></div>
                            </div>
                        </div>

                        <div class="row border-top border-secondary py-2">
                            <div class="col d-flex justify-content-between">
                                <div><h5 class="text-muted font-italic">Membership Fee</h5></div>
                                <div><h5>
                                        @if($club->membership_fee != "")
                                            {{ __('currency.code') }} {{ $club->membership_fee }}
                                        @else
                                            <span class="text-muted">Not provided</span>
                                        @endif
                                    </h5></div>
                            </div>
                        </div>

                        <div class="row border-top border-bottom border-secondary py-2">
                            <div class="col d-flex justify-content-between">
                                <div><h5 class="text-muted font-italic">Coach Name</h5></div>
                                <div><h5>
                                        @if($club->coach_name != "")
                                            {{ $club->coach_name }}
                                        @else
                                            <span class="text-muted">Not provided</span>
                                        @endif
                                    </h5></div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <div class="col my-auto card pt-3" data-aos="fade-left" style="border-radius: 5%;">
                <h2>Teams</h2>

                <table class="px-4 table">
                    <thead class="bg-primary text-white">
                    <tr>
                        <th>Pos.</th>
                        <th>Team</th>
                        <th>Matches</th>
                        <th>Won</th>
                        <th>Lost</th>
                        <th>Tied</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $team_counter = 0;?>

                    @foreach($club_teams as $team)
                        <?php $team_counter++?>
                        <tr>
                            <td>{{ $team_counter }}</td>
                            <td>{{ $team->name }}</td>
                            <td>{{ $team->total_matches  }}</td>
                            <td>{{ $team->won_matches }}</td>
                            <td>{{ $team->lost_matches}}</td>
                            <td>{{ $team->tied_matches }}</td>

                        </tr>
                    @endforeach
                </table>


            </div>


        </div>

        <h2 class="text-center">Club Players</h2>
        <hr>

        <div class="row row-cols-1 mt-2 row-cols-md-4 row-cols-sm-2 px-md-5 justify-content-center">
            @foreach($club->players as $player)
                <div class="col mb-4" >
                    <div class="card" data-aos="fade-right" style="border-radius: 5%;">
                        <img src="{{ asset($player->user->profile_picture_url) }}" class="card-img-top" alt="">
                        <div class="card-body">

                            <h4 class="card-title">{{ $player->user->name }}</h4>
                            <div class="row border-top border-secondary py-2">
                                <div class="col d-flex justify-content-between">
                                    <div><h5 class="text-muted font-italic">Rank</h5></div>
                                    <div><h5>{{ $player->getRank() }}</h5></div>
                                </div>
                            </div>
                            <div class="row border-top border-bottom border-secondary py-2">
                                <div class="col d-flex justify-content-between">
                                    <div><h5 class="text-muted font-italic">Team</h5></div>

                                    <div><h5>{{ $player->teamsJoined() }}</h5></div>

                                </div>

                            </div>

                            <a href="{{ route('public_single_player', $player) }}" class="mt-4 btn btn-primary btn-block">View Complete Profile</a>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>




    </div>

    <style>
        @push('style_tag')

        {{--fixed size for all card images--}}
        .card-img-top {
            border-radius: 5% 5% 0 0;
            width: 100%;
            height: 280px;
            object-fit: cover;
        }

        .player-personal > * {
            line-height: 1.5;
        }


        @endpush
    </style>

@endsection
