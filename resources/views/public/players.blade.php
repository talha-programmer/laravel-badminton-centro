@extends('layouts.app')

@section('content')

    @include('public.layouts.header')

    <div class="container-fluid py-4 " >
        <h1 class="text-center text-primary">Players</h1>
        <hr>

        <div class="row row-cols-1 mt-5 row-cols-md-3 px-md-5 justify-content-center">
            <?php $player_counter =0 ?>
            @foreach($players as $player)
                <?php $player_counter++?>
                <div class="col mb-4 " >
                    <div class="card" style="border-radius: 5%;">
                        <img src="{{ asset('images/player-image.jpg') }}" class="card-img-top" alt="">
                        <div class="card-body">
                            <h4 class="card-title">{{ $player->user->name }}</h4>

                            <div class="row">
                                <div class="col-4">
                                    <h6>Clubs Joined:</h6>
                                    <h6>Teams Joined:</h6>

                                    <h6>Total Matches:</h6>
                                    <h6>Won Matches:</h6>
                                    <h6>Lost Matches:</h6>
                                    <h6>Tied Matches:</h6>
                                    <h6>Rank:</h6>
                                    <h6>Total Points:</h6>

                                </div>

                                <div class="col">
                                    <h6>{{ $player->clubsJoined() }}</h6>
                                    <h6>{{ $player->teamsJoined() }}</h6>

                                    <h6>{{ $player->total_matches }}</h6>
                                    <h6>{{ $player->won_matches }}</h6>
                                    <h6>{{ $player->lost_matches }}</h6>
                                    <h6>{{ $player->tied_matches }}</h6>
                                    <h6>{{ $player_counter }}</h6>
                                    <h6>{{ $player->points }}</h6>

                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            @endforeach

        </div>


        <div class="d-flex justify-content-center">
            {{ $players->links() }}

        </div>



    </div>

    <style>
        @push('style_tag')


        {{--fixed size for all card images--}}
        .card-img-top {
            border-radius: 5% 5% 0 0;
            width: 100%;
            height: 25vw;
            object-fit: cover;
        }



        @endpush
    </style>



@endsection
