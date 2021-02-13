<form class="challenge_form" method="POST" action="{{ route('save_challenge_request') }}">
    @csrf



    <div class="form-group row">
        <label for="club" class="col-md-3 offset-1 col-form-label">Club</label>
        <div class="col-md-6">
            <select id="club" class="form-control select2" name="club">
                <option value="-1">--Select Club--</option>
                @foreach($clubs as $club)
                    <option value="{{ $club->id }}"  >
                        {{ $club->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="player" class="col-md-3 offset-1 col-form-label">Player</label>
        <div class="col-md-6">
            <select id="player" class="form-control select2" name="player" disabled>
            </select>
        </div>
    </div>


    <div class="form-group row">
        <label for="match_time" class="col-md-3  col-form-label offset-1 ">Match Time</label>

        <div class="col-md-6">
            <input id="match_time" type="text" class="form-control datetimepicker" name="match_time" required>
        </div>
    </div>

    <div class="form-group row mb-0 mt-4 justify-content-center">
        <div class="col-md-6 ">
            <button type="submit" class="btn btn-primary w-100">
                <span class="font-weight-bold" style="font-size: large;">Send Request</span>
            </button>
        </div>
    </div>
</form>

<script>


    $(function () {
        $('.datetimepicker').datetimepicker({
            sideBySide: true,
            format: 'DD/MM/yyyy hh:mm A',
        });
    });

    // Wait for the DOM to be ready
    $(function() {
        $("form[class='challenge_form']").each(function (){
            $(this).validate({
                // Specify validation rules
                rules: {
                    club: { required:true, min:1},
                    player: { required:true, min:1},
                    match_time: "required",
                },
                // Specify validation error messages
                messages: {
                club: "Please select a club",
                    player: "Please select a player",
                },
                // Place errors at the bottom of select2
                errorPlacement: function (error, element) {
                    if (element.hasClass('select2') && element.next('.select2-container').length) {
                        error.insertAfter(element.next('.select2-container'));
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


    $(document).ready(function (){
        $('.select2').select2({
            width: '100%',

        });

        /*Get players through ajax with club id when the value of club changes*/
        $('#club').change(function (){

            var clubId = $(this).val();
            var player = $('#player');
            // Get players of the selected team through ajax and populate them on players' select tags
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                url:"{{ route('get_club_players') }}",
                type: "POST",

                data: {
                    'club_id': clubId,
                },
                success: function (response){
                    // Removing old values of the players from option tag
                    $(player).empty();

                    /*Adding options in the player one select tag*/
                    $.each(response, function (key, value){
                        console.log(key, value);
                        if(key != {{ $current_player_id }}){
                            $(player).append($('<option>', {
                                value: key,
                                text: value,
                            }));

                            $(player).prop('disabled', false);
                        }
                    });
                },
                error: function( xhr,status,error )
                {
                    console.log( xhr, status, error );
                }
            });
        });

    });
</script>