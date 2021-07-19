@extends('layouts.app')

@section('content')

    @include('public.layouts.header')

    <div class="container py-4 " >

        <h2>Personal Details</h2>
        <hr>
       <div class="row row-cols-1 my-5 row-cols-md-3 row-cols-sm-2 px-md-5 justify-content-center">
            <div class="col mb-3" data-aos="fade-left">
                <img src="{{ asset($player->user->profile_picture_url) }}"  style=" max-height: 310px; object-fit: contain; width: 100%;" >
            </div>

            <div class="col mb-3 player-personal">

                    <div class="card" data-aos="fade-right" style="border-radius: 5%;">
                        <div class="card-body">

                            <h4 class="card-title">{{ $player->user->name }}</h4>
                            <div class="row border-top border-secondary py-2">
                                <div class="col d-flex justify-content-between">
                                    <div><h5 class="text-muted font-italic">Rank</h5></div>
                                    <div><h5>{{ $player_rank }}</h5></div>
                                </div>
                            </div>

                            <div class="row border-top border-secondary py-2">
                                <div class="col d-flex justify-content-between">
                                    <div><h5 class="text-muted font-italic">Age</h5></div>
                                    <div><h5>{{ $player->age }}</h5></div>
                                </div>
                            </div>

                            <div class="row border-top border-secondary py-2">
                                <div class="col d-flex justify-content-between">
                                    <div><h5 class="text-muted font-italic">Email</h5></div>
                                    <div><h5>{{ $player->user->email }}</h5></div>
                                </div>
                            </div>

                            <div class="row border-top border-secondary py-2">
                                <div class="col d-flex justify-content-between">
                                    <div><h5 class="text-muted font-italic">Club Joined</h5></div>
                                    <div><h5>{{ $player->clubsJoined() }}</h5></div>
                                </div>
                            </div>

                            <div class="row border-top border-bottom border-secondary py-2">
                                <div class="col d-flex justify-content-between">
                                    <div><h5 class="text-muted font-italic">Team Joined</h5></div>
                                    <div><h5>
                                           {{ $player->teamsJoined() }}
                                        </h5></div>
                                </div>
                            </div>

                        </div>
                    </div>

            </div>

        </div>

        <h2>Overall Stats</h2>
        <hr>

        <div class="row my-5 px-md-5 mx-md-5 justify-content-center bg-primary text-white font-italic">
            <div class="col-md-4 p-5 my-auto">
                <h1 class="text-uppercase">Rank</h1>
                <span class="prominent-numbers">{{ $player_rank }}</span>
            </div>

            <div class="col-md-8 p-5">
                <div class="row">
                    <div class="col pb-5">
                        <h4 class="text-uppercase">Played Matches</h4>
                        <span class="prominent-numbers">{{ $player->total_matches }}</span>
                    </div>
                    <div class="col pb-5">
                        <h4 class="text-uppercase">Won Matches</h4>
                        <span class="prominent-numbers">{{ $player->won_matches }}</span>
                    </div>
                </div>

                <div class="row">
                    <div class="col pb-5">
                        <h4 class="text-uppercase">Lost Matches</h4>
                        <span class="prominent-numbers">{{ $player->lost_matches }}</span>
                    </div>
                    <div class="col pb-5">
                        <h4 class="text-uppercase">Tied Matches</h4>
                        <span class="prominent-numbers">{{ $player->tied_matches }}</span>
                    </div>
                </div>
            </div>


        </div>

    </div>

    <style>
        @push('style_tag')

        .prominent-numbers {
        font-size: 60px;
        line-height: 0.8;
        }

        .player-personal > * {
            line-height: 1.5;
        }


        @endpush
    </style>

@endsection
