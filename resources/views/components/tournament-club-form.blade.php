<form method="POST" action="{{ route('add_tournament_club', $tournament) }}">
    @csrf

    <div class="form-group row">
        <label for="club_tournament_{{ $tournament->id }}" class="col-md-4 offset-1 col-form-label">Select Club</label>

        <div class="col-md-6">

            <select id="club_tournament_{{ $tournament->id }}" class="form-control select2" name="club">
                <option value="-1">--Select Club--</option>
                @foreach($clubs as $club)
                    <option value="{{ $club->id }}">{{ $club->name }}</option>
                @endforeach
            </select>

        </div>
    </div>

    <div class="form-group row">
        <label for="teams_tournament_{{ $tournament->id }}" class="col-md-4 offset-1 col-form-label">Select Teams</label>

        <div class="col-md-6">

            <select id="teams_tournament_{{ $tournament->id }}" class="form-control select2" multiple="multiple" disabled name="teams[]">
            </select>

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

    $('.datetimepicker').datetimepicker({
        sideBySide: true,
        format: 'DD/MM/yyyy',
    });

    $('.select2').select2({
        width: '100%',
    });


    /*Get teams through ajax with club id when the value of club changes*/
    $('#club_tournament_{{ $tournament->id }}').change(function (e){

        var clubId = $(this).val();
        var teams = $('#teams_tournament_{{ $tournament->id }}');
        // Get teams of the selected club through ajax and populate them on teams select tag
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        $.ajax({
            url:"{{ route('get_teams') }}",
            type: "POST",
            data: {
                'club_id' : clubId,
            },
            success: function (response){
                // Removing old values of the teams from option tag
                $(teams).empty();

                /*Adding options in the player one select tag*/
                $.each(response, function (key, value){
                    $(teams).append($('<option>', {
                        value: key,
                        text: value,
                    }));

                    $(teams).prop('disabled', false);
                });
            },
        });
    });



</script>