@extends('layouts.dashboard_layout')

@section('dashboard_content')

    <div class="row justify-content-center my-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Club</div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('all_player') }}">
                        @csrf

                        @if($selected_club)
                            <div class="form-group row">
                                <div class="col">
                                    Selected Club
                                </div>
                                <div class="col">
                                    {{ $selected_club->name }}
                                </div>
                            </div>
                        @endif
                        @if($selected_team)
                            <div class="form-group row">
                                <div class="col">
                                    Selected Team
                                </div>
                                <div class="col">
                                    {{ $selected_team->name }}
                                </div>
                            </div>
                        @endif
                        <div class="form-group row">
                            <label for="player" class="col-md-4 col-form-label text-md-right">Select Player</label>

                            <div class="col-md-6">

                                <select id="player" class="form-control" name="player">
                                    @foreach($players as $player)
                                        <option value="{{ $player->id }}">{{ $player->user->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




@endsection
