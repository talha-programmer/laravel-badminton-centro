@extends('layouts.dashboard_layout')

@section('dashboard_content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">All Matches</div>

                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @foreach($matches as $match)
                            <div class="mb-3">
                                <h4>Match:</h4>
                                <div class="row">
                                    <div class="col-md-4">
                                        Team One
                                    </div>
                                    <div class="col-md-4">
                                        {{ $match->teamOne->name }}
                                    </div>
                                </div>

                                <h4>Players of Team One</h4>
                                @foreach($match->teamOnePlayers() as $player)
                                    <div class="row">
                                        <div class="col-md-4">
                                            Player Name
                                        </div>
                                        <div class="col-md-4">
                                            {{ $player->user->name }}
                                        </div>
                                    </div>
                                @endforeach

                                <div class="row">
                                    <div class="col-md-4">
                                        Team Two
                                    </div>
                                    <div class="col-md-4">
                                        {{ $match->teamTwo->name }}
                                    </div>
                                </div>
                                <h4>Players of Team Two</h4>
                                @foreach($match->teamTwoPlayers() as $player)
                                    <div class="row">
                                        <div class="col-md-4">
                                            Player Name
                                        </div>
                                        <div class="col-md-4">
                                            {{ $player->user->name }}
                                        </div>
                                    </div>
                                @endforeach

                                <div class="row">
                                    <div class="col-md-4">
                                        Match Time
                                    </div>
                                    <div class="col-md-4">
                                        {{ $match->match_time }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        Venue
                                    </div>
                                    <div class="col-md-4">
                                        {{ $match->venue }}
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
