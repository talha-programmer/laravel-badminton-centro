@extends('layouts.app')

@section('content')

    @include('public.layouts.header')

    <div class="container">


    @foreach( $clubs as $club )

            <div class="row justify-content-center p-3 ">
                <div class="col-10">
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
                                        @if(sizeof( $club->players) > 0)
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
                                        @else
                                            <div class="text-muted">
                                                No Players in this club
                                            </div>
                                        @endif
                                    </div>
                                </div>



                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col"><h5>Teams of Club:</h5></div>
                                </div>

                                @if( sizeof($club->teams) > 0)
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Sr.</th>
                                        <th>Team Name</th>
                                        <th>Players</th>


                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $team_counter = 0;?>

                                    @foreach($club->teams as $team)
                                        <?php $team_counter++?>
                                        <tr>
                                            <td>{{ $team_counter }}</td>
                                            <td>{{ $team->name }}</td>
                                            <td>
                                                <ul>
                                                    @foreach($team->players as $player)
                                                        <li>{{ $player->user->name }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>

                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                                @else
                                    <div class="text-muted">
                                        No Teams in this club
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    @endforeach


        <div class="d-flex justify-content-center">
            {{ $clubs->links() }}

        </div>


    </div>



@endsection
