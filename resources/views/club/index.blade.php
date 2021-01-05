@extends('layouts.dashboard_layout')

@section('dashboard_content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Club Details</div>

                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @foreach($clubs as $club)
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        Club Name
                                    </div>
                                    <div class="col-md-4">
                                        {{ $club->name }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        Owner Name
                                    </div>
                                    <div class="col-md-4">
                                        {{ $club->clubOwner->user->name }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        City
                                    </div>
                                    <div class="col-md-4">
                                        {{ $club->city }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        Address
                                    </div>
                                    <div class="col-md-4">
                                        {{ $club->address }}
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                        <a href="{{ route('add_team', $club) }}" >Add new team in this club</a>
                                </div>
                                <div class="row justify-content-center">
                                    <a href="{{ route('add_player_in_club', $club) }}">Add player in this club</a>
                                </div>

                                @if($club->teams)
                                    <h4>Teams:</h4>
                                    @foreach($club->teams as $team)
                                        <div class="row">
                                            <div class="col">
                                                Team Name
                                            </div>
                                            <div class="col">
                                                {{ $team->name }}
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <a href="{{ route('add_player_in_team', $team) }}">Add player in this team</a>
                                        </div>
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
