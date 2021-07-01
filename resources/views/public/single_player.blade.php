@extends('layouts.app')

@section('content')

    @include('public.layouts.header')

    <div class="container py-4 " >

        <h2>Personal Details</h2>
        <hr>
       <div class="row row-cols-1 my-5 row-cols-md-3 row-cols-sm-2 px-md-5 justify-content-center">
            <div class="col">
                <img src="{{ asset($player->user->profile_picture_url) }}" width="100%" height="100%">
            </div>

            <div class="col player-personal">
                <h3>{{ $player->user->name }}</h3>
                <h4>Rank: {{ $player_rank }}</h4>
                <h5>Email: <a href="mailto:{{ $player->user->email }}">{{ $player->user->email }}</a></h5>
                <h5>Age: {{ $player->age }}</h5>
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
