@extends('layouts.app')

@section('content')

    @include('public.layouts.header')

    <div id="matches_container1" class="container-fluid py-4 " >
        <h1 class="text-center text-white">Players</h1>
        <hr>

        <div class="row row-cols-1 mt-5 row-cols-md-4 row-cols-sm-2 px-md-5 justify-content-center">
            <?php $player_counter =0 ?>
            @foreach($players as $player)
                <?php $player_counter++?>
                <div class="col mb-4" >
                    <div class="card" data-aos="fade-right" style="border-radius: 5%;">
                        <img src="{{ asset($player->user->profile_picture_url) }}" class="card-img-top" alt="">
                        <div class="card-body">

                            <h4 class="card-title">{{ $player->user->name }}</h4>
                            <div class="row border-top border-secondary py-2">
                                <div class="col d-flex justify-content-between">
                                    <div><h5 class="text-muted font-italic">Rank</h5></div>
                                    <div><h5>{{ $player_counter }}</h5></div>
                                </div>
                            </div>
                            <div class="row border-top border-bottom border-secondary py-2">
                                    <div class="col d-flex justify-content-between">
                                    <div><h5 class="text-muted font-italic">Club</h5></div>

                                    <div><h5>{{ $player->clubsJoined() }}</h5></div>

                                </div>

                            </div>

                            <a href="{{ route('public_single_player', $player) }}" class="mt-4 btn btn-primary btn-block">View Complete Profile</a>

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
            height: 280px;
            object-fit: cover;
        }
        #matches_container1 {
            background-image: url("{{ asset('images/main-background.jpg') }}");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }


        @endpush
    </style>



@endsection
