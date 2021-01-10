@extends('layouts.dashboard_layout')

@section('dashboard_content')

    <div class="row justify-content-center my-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Add Match</div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('add_match') }}">
                        @csrf
                        <div class="team">
                            <div class="form-group row">
                                <label for="team_one" class="col-md-4 col-form-label text-md-right">Select Team
                                    One</label>
                                <div class="col-md-6">
                                    <select id="team_one" class="form-control" name="team_one">
                                        <option value="-1">---Select Player---</option>
                                        @foreach($teams as $team)
                                            <option value="{{ $team->id }}">{{ $team->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('team_one')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <h4>Select players of the team</h4>
                            <div class="form-group row">
                                <label for="player_one" class="col-md-4 col-form-label text-md-right">Player One</label>
                                <div class="col-md-6">
                                    <select id="player_one" class="form-control" name="team_one_player_one" disabled>
                                        <option value="-1">---Select Player---</option>
                                    </select>

                                    @error('team_one_player_one')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group row">
                                <label for="player_two" class="col-md-4 col-form-label text-md-right">Player Two</label>
                                <div class="col-md-6">
                                    <select id="player_two" class="form-control" name="team_one_player_two" disabled>
                                        <option value="-1">---Select Player---</option>
                                    </select>

                                    @error('team_one_player_two')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="team">
                            <div class="form-group row">
                                <label for="team_two" class="col-md-4 col-form-label text-md-right">Select Team
                                    Two</label>
                                <div class="col-md-6">
                                    <select id="team_two" class="form-control" name="team_two">
                                        <option value="-1">---Select Team---</option>
                                        @foreach($teams as $team)
                                            <option value="{{ $team->id }}">{{ $team->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('team_two')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <h4>Select players of the team</h4>
                            <div class="form-group row">
                                <label for="player_one" class="col-md-4 col-form-label text-md-right">Player One</label>
                                <div class="col-md-6">
                                    <select id="player_one" class="form-control" name="team_two_player_one" disabled>
                                        <option value="-1">---Select Player---</option>
                                    </select>

                                    @error('team_two_player_one')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="player_two" class="col-md-4 col-form-label text-md-right">Player Two</label>
                                <div class="col-md-6">
                                    <select id="player_two" class="form-control" name="team_two_player_two" disabled>
                                        <option value="-1">---Select Player---</option>
                                    </select>

                                    @error('team_two_player-two')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Venue</label>
                            <div class="col-md-6">
                                <input id="venue" type="text" class="form-control @error('venue') is-invalid @enderror" name="venue" value="{{ old('venue') }}" required autofocus>
                                @error('venue')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="match_time" class="col-md-4 col-form-label text-md-right">Time</label>

                            <div class="col-md-6">
                                <input id="match_time" type="text" class="form-control datetimepicker @error('match_time') is-invalid @enderror" name="match_time" value="{{ old('match_time') }}" required>

                                @error('match_time')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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

    <script type="text/javascript">
        $(function () {
            $('.datetimepicker').datetimepicker();
        });

        /*Get players through ajax with team id when the value of team changes*/
        $('#team_one, #team_two').change(function (e){
            let team = $(this).parents('.team');        // Find .team in parents of the selected tag
            let playerOne = $(team).find('#player_one');
            let playerTwo = $(team).find('#player_two');
            let players = [playerOne, playerTwo]
            let teamId = $(this).val();

            // Get players of the selected team through ajax and populate them on players' select tags
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                url:"{{ route('get_players') }}",
                type: "POST",
                data: {
                    'team_id' : teamId,
                },
                success: function (response){

                    // Removing old values of the players from option tag
                    $(players).each(function (){
                        $(this).find($('option[value != "-1"]')).remove();
                    });

                    /*Adding options in the player one select tag*/
                    $.each(response, function (key, value){
                        $(players).each(function (){
                            $(this).append($('<option>', {
                                value: key,
                                text: value,
                            }));
                            $(this).prop('disabled', false);
                        });
                    });
                },
            });
        });
    </script>


@endsection
