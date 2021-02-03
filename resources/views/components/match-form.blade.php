<form method="POST" action="{{ route('add_match') }}">
    @csrf
    <input type="hidden" name="match_id" value="{{ $match->id }}">
    <div class="form-group row">
        <div class="col-md-4 ">
            Match Type
        </div>
        <div class="col-md-6">
            <div class="form-check-inline">
                <div id="match_type{{ $matchId() }}">
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

    </div>

    <div class="team">
        <div class="form-group row">
            <label for="team_one{{ $matchId() }}" class="col-md-4  col-form-label ">Team
                One</label>
            <div class="col-md-6">
                <select id="team_one{{ $matchId() }}" class="form-control select2" name="team_one">
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


        <div class="form-group row player-one">
            <label for="team_one_players{{ $matchId() }}" class="col-md-4  col-form-label ">Team One Players</label>
            <div class="col-md-6">
                <select id="team_one_players{{ $matchId() }}" class="form-control select2 players" multiple="multiple" name="team_one_players[]" disabled>
                </select>

                @error('team_one_players')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>

        </div>
    </div>

    <div class="team">
        <div class="form-group row">
            <label for="team_two{{ $matchId() }}" class="col-md-4  col-form-label ">Team
                Two</label>
            <div class="col-md-6">
                <select id="team_two{{ $matchId() }}" class="form-control select2" name="team_two">
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
        <div class="form-group row">
            <label for="team_two_players{{ $matchId() }}" class="col-md-4  col-form-label ">Team Two Players</label>
            <div class="col-md-6">
                <select id="team_two_players{{ $matchId() }}" class="form-control select2 players"  multiple="multiple" name="team_two_players[]" disabled>
                </select>

                @error('team_two_players')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror

            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="venue{{ $matchId() }}" class="col-md-4  col-form-label ">Venue</label>
        <div class="col-md-6">
            <input id="venue{{ $matchId() }}" type="text" class="form-control @error('venue') is-invalid @enderror" name="venue" value="{{ old('venue') }}" required autofocus>
            @error('venue')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="match_time{{ $matchId() }}" class="col-md-4  col-form-label ">Time</label>

        <div class="col-md-6">
            <input id="match_time{{ $matchId() }}" type="text" class="form-control datetimepicker @error('match_time') is-invalid @enderror" name="match_time" value="{{ $matchTime() }}" required>

            @error('match_time')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>

    <div class="form-group row mb-0 mt-4">
        <div class="col-md-4 offset-md-4 ">
            <button type="submit" class="btn btn-primary w-100">
                <span class="font-weight-bold" style="font-size: large;">Save</span>
            </button>
        </div>
    </div>
</form>


<script type="text/javascript">
    $(function () {
        $('.datetimepicker').datetimepicker({
            sideBySide: true,
            format: 'DD/MM/yyyy hh:mm A',
        });
    });

    $(document).ready(function() {
        $('.select2').select2({
            width: '100%',

        });

        /** Set the maximum length of players selection according to radio button selected **/
        let matchTypeRadio = $('#match_type{{ $matchId() }}').find('input[name="match_type"]');
        initializeSelect2();        // Call the function on page load

        function initializeSelect2(){
            let selectedMatchType = $('#match_type{{ $matchId() }}').find('input[name="match_type"]:checked');
            let matchTypeValue = $(selectedMatchType).val();

            if(matchTypeValue === {{ \App\Enums\MatchTypes::SinglePlayer }}) {
                $('#team_one_players{{ $matchId() }}, #team_two_players{{ $matchId() }}').select2({
                    maximumSelectionLength: 1,
                    width: '100%',
                });
            } else{
                $('#team_one_players{{ $matchId() }}, #team_two_players{{ $matchId() }}').select2({
                    maximumSelectionLength: 2,
                    width: '100%',

                });
            }
        }

        // Call the function whenever the radio button selecion changes
        $(matchTypeRadio).change(function (){
            initializeSelect2();
        });

    });



    /*Get players through ajax with team id when the value of team changes*/
    $('#team_one{{ $matchId() }}, #team_two{{ $matchId() }}').change(function (e){
        let team = $(this).parents('.team');        // Find .team in parents of the selected tag
        let players = $(team).find('.players');
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
                    $(this).find($('<option>')).remove();
                });

                /*Adding options in the player one select tag*/
                $.each(response, function (key, value){
                    $(players).append($('<option>', {
                        value: key,
                        text: value,
                    }));

                    $(players).prop('disabled', false);
                });
            },
        });
    });


    // Set all the values of select input fields when editing a match
    @if($match->id !=null)
        var matchId = {{ $match->id }};
        var teamOne =  $('#team_one_match_' + matchId);
        var teamTwo = $('#team_two_match_' + matchId);

        teamOne.val([{{ $match->teamOne->id }}]);
        teamTwo.val([{{ $match->teamTwo->id }}]);

        var teamOnePlayers = $('#team_one_players{{ $matchId() }}');
        var teamTwoPlayers = $('#team_two_players{{ $matchId() }}');

        // Add all the player names as options in team one select tag
        @foreach($match->teamOne->players as $player)
            var option = new Option('{{$player->user->name}}', {{ $player->id }}, false, false);
            $(teamOnePlayers).append(option).trigger('change');
        @endforeach
        $(teamOnePlayers).prop('disabled', false);

        // Add all the player names as options in team two select tag
        @foreach($match->teamTwo->players as $player)
            var option = new Option('{{$player->user->name}}', {{ $player->id }}, false, false);
            $(teamTwoPlayers).append(option).trigger('change');
        @endforeach
        $(teamTwoPlayers).prop('disabled', false);

        // Select the already added players of team one and team two
        $(teamOnePlayers).val({{ json_encode($teamOnePlayers) }});
        $(teamTwoPlayers).val({{ json_encode($teamTwoPlayers) }});

        // Set the values of venue and match time
        $('#venue{{ $matchId() }}').val('{{ $match->venue }}');

    @endif

</script>