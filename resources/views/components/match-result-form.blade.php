<form method="POST" class="match_result_form" action="{{ route('add_match_result', $match) }}">
    @csrf

    <input type="hidden" id="team_one_points_match_{{ $match->id }}"  name="team_one_points" value="{{ $match->team_one_points }}" >
    <input type="hidden" id="team_two_points_match_{{ $match->id }}" name="team_two_points" value="{{ $match->team_two_points }}" >

    <h5>{{ $match->teamOne->name }}</h5>
    @foreach($match->teamOnePlayers() as $player)
        <div class=" row">
            <label for="points_of_player_{{ $player->id }}" class="col-md-4 col-form-label">{{ $player->user->name }}:</label>
            <div class="col-md-4 input-group">
                <input id="points_of_player_{{ $player->id }}" type="number" step="1" class="form-control players_match_{{ $match->id }} team_one_players_match_{{ $match->id }}" name="points_of_player_{{ $player->id }}"
                       value="{{ $player->pivot->points }}" required autofocus>
                <div class="input-group-append">
                    <span class="input-group-text" >Points</span>
                </div>
            </div>
        </div>
    @endforeach

    <div class="row">
        <div class="col font-weight-bold mb-2">
            Total Points: <span id="points_team_one_match_{{ $match->id }}"></span>
        </div>
    </div>
    <hr>

    <h5>{{ $match->teamTwo->name }}</h5>
    @foreach($match->teamTwoPlayers() as $player)
        <div class="row">
            <label for="points_of_player_{{ $player->id }}" class="col-md-4 col-form-label">{{ $player->user->name }}:</label>
            <div class="col-md-4 input-group">
                <input id="points_of_player_{{ $player->id }}" type="number" step="1" class="form-control players_match_{{ $match->id }} team_two_players_match_{{ $match->id }}" name="points_of_player_{{ $player->id }}"
                       value="{{ $player->pivot->points }}" required autofocus>
                <div class="input-group-append">
                    <span class="input-group-text">Points</span>
                </div>
            </div>
        </div>
    @endforeach

    <div class="row">
        <div class="col font-weight-bold mb-2">
            Total Points: <span id="points_team_two_match_{{ $match->id }}"></span>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col font-weight-bold">
            Overall Result:
            <span id="overall_result_match_{{ $match->id }}">
                @if($match->winner_team == -1)
                     Match Tied
                @elseif($match->winner_team == $match->teamOne->id)
                    {{ $match->teamOne->name }} wins
                @elseif($match->winner_team == $match->teamTwo->id)
                    {{ $match->teamTwo->name }} wins
                @endif
            </span>
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


<script>




    $(document).ready(function (){
        var teamOne = '{{ $match->teamOne->name }}';
        var teamTwo = '{{ $match->teamTwo->name }}';
        var teamOnePoints = {{ $match->team_one_points ? $match->team_one_points : 0 }};
        var teamTwoPoints = {{ $match->team_two_points ? $match->team_two_points : 0 }};


        // Adding total points of both teams in case of edit result
        $('#points_team_one_match_{{ $match->id }}').append({{ $match->team_one_points }} + '');
        $('#points_team_two_match_{{ $match->id }}').append({{ $match->team_two_points }} + '');


        // Calculating and displaying total points of the teams
        $('.team_one_players_match_{{ $match->id }}').on('keyup change', function (){
            teamOnePoints = 0;
            $('.team_one_players_match_{{ $match->id }}').each(function (){
                teamOnePoints += parseInt($(this).val());
            });
            $('#points_team_one_match_{{ $match->id }}').empty().append(teamOnePoints);
            $('#team_one_points_match_{{ $match->id }}').val(teamOnePoints);

        });
        $('.team_two_players_match_{{ $match->id }}').on('keyup change', function (){
            teamTwoPoints = 0;
            $('.team_two_players_match_{{ $match->id }}').each(function (){
                teamTwoPoints += parseInt($(this).val());
            });
            $('#points_team_two_match_{{ $match->id }}').empty().append(teamTwoPoints);
            $('#team_two_points_match_{{ $match->id }}').val(teamTwoPoints);

        });

        // Displaying overall result of the match
        $('.players_match_{{ $match->id }}').on('keyup change', function (){

            if(teamOnePoints > teamTwoPoints){
                $('#overall_result_match_{{ $match->id }}').empty().append(teamOne + ' wins!');
            } else if (teamOnePoints === teamTwoPoints){
                $('#overall_result_match_{{ $match->id }}').empty().append("Match Tied!");
            } else if(teamTwoPoints > teamOnePoints){
                $('#overall_result_match_{{ $match->id }}').empty().append(teamTwo + ' wins!');
            }
        });


        // Form validation
        $("form[class='match_result_form']").each(function (){
            $(this).validate({
                // Specify validation rules
                rules: {

                    @foreach($match->players as $player)
                    "points_of_player_{{ $player->id }}": {
                        required: true,
                        number: true,
                        min: 0,
                    },
                    @endforeach
                },
                // Place errors at the bottom of select2
                errorPlacement: function (error, element) {
                    if (element.next('.input-group-append').length) {
                        error.insertAfter(element.next('.input-group-append'));
                    }

                },

                // Make sure the form is submitted to the destination defined
                // in the "action" attribute of the form when valid
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });

    });


</script>