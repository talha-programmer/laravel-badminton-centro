<form method="POST" action="{{ route('add_match') }}">
    @csrf
    <div class="form-group row">
        <div class="col-md-3 offset-1">
            Match Type
        </div>
        <div class="col-md-6">
            <div class="form-check-inline">
                <label class="form-check-label mr-1">
                    <input type="radio" class="form-check-input match-type" name="match_type"
                           value="{{ \App\Enums\MatchTypes::SinglePlayer }}" checked>Single Player
                </label>
                <label class="form-check-label">
                    <input type="radio" class="form-check-input match-type" name="match_type"
                           value="{{ \App\Enums\MatchTypes::DoublePlayer }}"
                            {{ $match->match_type == \App\Enums\MatchTypes::DoublePlayer ? "checked" : ""}}>Two Players
                </label>
            </div>
        </div>

    </div>

    <p>Team One</p>
    <div class="team">
        <div class="form-group row">
            <label for="team_one" class="col-md-3 offset-1 col-form-label ">Team
                One</label>
            <div class="col-md-6">
                <select id="team_one{{ $match->id != null ? "_match_" . $match->id : "" }}" class="form-control select2" name="team_one">
                    <option value="-1">---Select Team---</option>
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


        <p>Players</p>
        <div class="form-group row player-one">
            <label for="player_one" class="col-md-3 offset-1 col-form-label ">Player One</label>
            <div class="col-md-6">
                <select id="player_one" class="form-control select2" name="team_one_player_one" disabled>
                    <option value="-1">---Select Player---</option>
                </select>

                @error('team_one_player_one')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>

        </div>
        <div class="form-group row player-two">
            <label for="player_two" class="col-md-3 offset-1 col-form-label ">Player Two</label>
            <div class="col-md-6">
                <select id="player_two" class="form-control select2" name="team_one_player_two" disabled>
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

    <p>Team Two</p>
    <div class="team">
        <div class="form-group row">
            <label for="team_two" class="col-md-3 offset-1 col-form-label ">Team
                Two</label>
            <div class="col-md-6">
                <select id="team_two{{ $match->id != null ? "_match_" . $match->id : "" }}" class="form-control select2" name="team_two">
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
        <p>Players</p>
        <div class="form-group row player-one">
            <label for="player_one" class="col-md-3 offset-1 col-form-label ">Player One</label>
            <div class="col-md-6">
                <select id="player_one" class="form-control select2" name="team_two_player_one" disabled>
                    <option value="-1">---Select Player---</option>
                </select>

                @error('team_two_player_one')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror

            </div>
        </div>
        <div class="form-group row player-two">
            <label for="player_two" class="col-md-3 offset-1 col-form-label ">Player Two</label>
            <div class="col-md-6">
                <select id="player_two" class="form-control select2" name="team_two_player_two" disabled>
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
        <label for="name" class="col-md-3 offset-1 col-form-label ">Venue</label>
        <div class="col-md-6">
            <input id="venue{{ $match->id != null ? "_match_" . $match->id : "" }}" type="text" class="form-control @error('venue') is-invalid @enderror" name="venue" value="{{ old('venue') }}" required autofocus>
            @error('venue')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="match_time" class="col-md-3 offset-1 col-form-label ">Time</label>

        <div class="col-md-6">
            <input id="match_time{{ $match->id != null ? "_match_" . $match->id : "" }}" type="text" class="form-control datetimepicker @error('match_time') is-invalid @enderror" name="match_time" value="{{ old('match_time') }}" required>

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


<script type="text/javascript">
    $(function () {
        $('.datetimepicker').datetimepicker({
            sideBySide: true,

        });
    });

    $(document).ready(function() {
        $('.select2').select2({
            width: '100%',
        });
    });



    /*Get players through ajax with team id when the value of team changes*/
    $('select[name=team_one], select[name=team_two]').change(function (e){
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
                console.log(response);
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

    // Display player two only when double player is selected
    $('.player-two').hide();
    $('.match-type').change(function (){
        let value = $(this).val();
        if(value == {{ \App\Enums\MatchTypes::DoublePlayer }}){
            $('.player-two').show();
        } else{
            $('.player-two').hide();
        }
    });

    // Set all the values of select input fields when editing a match
    @if($match->id !=null)
        let matchId = {{ $match->id }};
        let teamOne =  $('select[id=team_one_match_' + matchId + ']');
        let teamTwo = $('select[id=team_two_match_' + matchId + ']');

        teamOne.val([{{ $match->teamOne->id }}]);
        teamTwo.val([{{ $match->teamTwo->id }}]);

        let team = $(teamOne).parents('.team');        // Find .team in parents of the selected tag
        let playerOne = $(team).find('#player_one');
        let playerTwo = $(team).find('#player_two');
        let players = [playerOne, playerTwo];
        @foreach($match->teamOne->players as $player)
            $(players).each(function (){
                $(this).append($('<option>', {
                    value: {{ $player->id }},
                    text: '{{ $player->user->name }}',
                }));
                $(this).prop('disabled', false);
            });
        @endforeach


    @endif

</script>