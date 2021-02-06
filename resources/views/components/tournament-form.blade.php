<form method="POST" class="tournament_form" action="{{ route('add_tournament') }}">
    @csrf

    <input type="hidden" value="{{ $tournament->id }}" name="tournament_id">



    <div class="form-group row">
        <label for="tournament_type" class="col-md-4 offset-1 col-form-label">Tournament Type</label>

        <div class="col-md-6">
            @if(!$isClubOwner())
            <select id="tournament_type" class="form-control" name="tournament_type">
                @foreach(\App\Enums\TournamentTypes::asSelectArray() as $typeValue=>$typeName)
                    <option value="{{ $typeValue }}">{{ $typeName }}</option>
                @endforeach
            </select>
            @else
                <input type="hidden" name="tournament_type" value="{{ \App\Enums\TournamentTypes::SingleClub }}">
                {{ \App\Enums\TournamentTypes::getDescription(\App\Enums\TournamentTypes::SingleClub)}}
            @endif

        </div>
    </div>

    <div class="form-group row">
        <label for="name" class="col-md-4 offset-1 col-form-label">Tournament Name</label>
        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name"
                   value="{{ $tournament->name  }}" required autofocus>
        </div>
    </div>

    <div class="form-group row justify-content-center">
        <label for="start_date" class="col-md-4 col-form-label ">Start Date:</label>
        <div class="col-md-6">
            <input id="start_date" type="text" class="form-control datepicker"
                   name="start_date" value="{{ $tournament->start_date !=null ? \Carbon\Carbon::create($tournament->start_date)->format('d/m/Y') : "" }}"  autofocus>
        </div>
    </div>

    <div class="form-group row justify-content-center">
        <label for="end_date" class="col-md-4 col-form-label ">End Date:</label>
        <div class="col-md-6">
            <input id="end_date" type="text" class="form-control datepicker"
                   name="end_date" value="{{ $tournament->end_date !=null ? \Carbon\Carbon::create($tournament->end_date)->format('d/m/Y') : "" }}"  autofocus>
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

    $('.datepicker').datetimepicker({
        sideBySide: true,
        format: 'DD/MM/yyyy',
    });

    // Wait for the DOM to be ready
    $(function() {
        $("form[class='tournament_form']").each(function (){
            $(this).validate({
                // Specify validation rules
                rules: {
                    name: "required",
                    start_date: "required",
                    end_date: "required",
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

