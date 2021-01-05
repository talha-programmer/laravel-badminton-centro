@extends('layouts.dashboard_layout')

@section('dashboard_content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">All Players</div>

                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @foreach($players as $player)
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        Player Name
                                    </div>
                                    <div class="col-md-4">
                                        {{ $player->user->name }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        Player Email
                                    </div>
                                    <div class="col-md-4">
                                        {{ $player->user->email }}
                                    </div>
                                </div>


                                @if($player->clubs)
                                    <h4>Clubs Joined:</h4>
                                    @foreach($player->clubs as $club)
                                        <div class="row">
                                            <div class="col">
                                                Club Name
                                            </div>
                                            <div class="col">
                                                {{ $club->name }}
                                            </div>
                                        </div>
                                        <h4>Joined Teams</h4>
                                        @foreach($player->teams()->where('teams.club_id', $club->id)->get() as $team)
                                            <div class="row">
                                                <div class="col">
                                                    Team Name
                                                </div>
                                                <div class="col">
                                                    {{ $team->name }}
                                                </div>
                                            </div>
                                        @endforeach
                                    <hr>
                                    @endforeach
                                @endif
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
