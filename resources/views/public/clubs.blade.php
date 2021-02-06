@extends('layouts.app')

@section('content')

    @include('public.layouts.header')

    <div class="container">


    @foreach( $clubs as $club )

            <div class="row justify-content-center p-3 ">
                <div class="col-8">
                    <div class="card p-3 my-2">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title">{{ $club->name }}</h5>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 border-right">
                                <div class="row">
                                    <div class="col-md-4">
                                        Owner:
                                    </div>
                                    <div class="col-md-8">
                                        {{ $club->clubOwner->user->name }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        City:
                                    </div>
                                    <div class="col-md-8">
                                        {{ $club->city }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        Address:
                                    </div>
                                    <div class="col-md-8">
                                        @if($club->address != "")
                                            {{ $club->address }}
                                        @else
                                            <span class="text-muted">Not provided</span>
                                        @endif

                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>All Players of Club:</h5>

                                        {{--Club Players--}}
                                        <table class="px-4 table table-bordered mt-3">
                                            <thead>
                                            <tr>
                                                <th>Sr.</th>
                                                <th>Player Name</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $player_counter = 0;?>

                                            @foreach($club->players as $player)
                                                <?php $player_counter++?>
                                                <tr>
                                                    <td>{{ $player_counter }}</td>
                                                    <td>{{ $player->user->name }}</td>
                                                </tr>
                                            @endforeach
                                        </table>

                                    </div>
                                </div>



                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col"><h5>Teams of Club:</h5></div>
                                </div>

                                <table class="table">
                                    <thead>
                                    <tr>
                                        <td>Sr.</td>
                                        <td>Team Name</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $team_counter = 0;?>

                                    @foreach($club->teams as $team)
                                        <?php $team_counter++?>
                                        <tr>
                                            <td>{{ $team_counter }}</td>
                                            <td>{{ $team->name }}</td>
                                        </tr>

                                        <tr>
                                            <td colspan="3">

                                                {{--Team Players--}}
                                                <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#playersCollapse{{ $team_counter }}" aria-expanded="false" aria-controls="playersCollapse">
                                                    Team Players <i class="fa fa-sort-down"></i>
                                                </button>

                                                <table class="px-4 collapse table table-bordered mt-3" id="playersCollapse{{ $team_counter }}">
                                                    <thead>
                                                    <tr>
                                                        <th>Sr.</th>
                                                        <th>Player Name</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php $player_counter = 0;?>

                                                    @foreach($team->players as $player)
                                                        <?php $player_counter++?>
                                                        <tr>
                                                            <td>{{ $player_counter }}</td>
                                                            <td>{{ $player->user->name }}</td>

                                                        </tr>
                                                    @endforeach
                                                </table>

                                            </td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

    @endforeach
    </div>



@endsection
