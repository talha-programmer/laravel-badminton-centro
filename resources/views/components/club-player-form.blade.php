<form method="POST" class="club_player_form" action="{{ route('add_club_player') }}">
    @csrf
    <input type="hidden" name="selected_club" value="{{ $club->id }}">


    <div class="form-group row">
        <div class="col-md-4 offset-1">
            <strong>Selected Club</strong>
        </div>
        <div class="col-md-5">
            <strong>{{ $club->name }}</strong>
        </div>
    </div>


    <div class="form-group row">
        <label for="player" class="col-md-4 offset-1 col-form-label">Select Player</label>

        <div class="col-md-5">
            <select id="player" class="form-control" name="player">
                @foreach($players as $player)
                    <option value="{{ $player->id }}" {{ $isPlayer($player->id) }}>{{ $player->user->name }}</option>
                @endforeach
            </select>

        </div>

    </div>

    <div class="form-group row date">
        <label for="contract_start" class="col-md-4 offset-1 col-form-label ">Contract Start Date:</label>
        <div class="col-md-5">
            <input id="contract_start" type="text" class="form-control datepicker"
                   name="contract_start" value="{{ $contract_start }}"  autofocus>
        </div>
    </div>

    <div class="form-group row  date">
        <label for="contract_end" class="col-md-4 offset-1 col-form-label ">Contract End Date:</label>
        <div class="col-md-5">
            <input id="contract_end" type="text" class="form-control datepicker"
                   name="contract_end" value="{{ $contract_end }}"  autofocus>
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
       $('.datepicker').datepicker({
           format: 'dd/mm/yyyy',
       });
    });


    // Wait for the DOM to be ready
    $(function() {
        $("form[class='club_player_form']").each(function (){
            $(this).validate({
                // Specify validation rules
                rules: {
                    player: "required",
                    contract_start: "required",
                    contract_end: "required",
                },
                // Specify validation error messages
                messages: {

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