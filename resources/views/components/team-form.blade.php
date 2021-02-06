<form method="POST" class="team_form" action="{{ route('add_team', $club) }}">
    @csrf
    <input type="hidden" name="team_id" value="{{ $team->id }}">
    <div class="row">
        <div class="col-md-3 offset-1">
            <strong>Selected Club</strong>
        </div>
        <div class="col-md-6">
            <strong>{{ $club->name }}</strong>
        </div>
    </div>

    <div class="form-group row mt-3">
        <label for="name" class="col-md-3 offset-1 col-form-label">Team Name</label>
        <div class="col-md-6">
            <input id="name" type="text" class="form-control " name="name"
                   value="{{ $team ? $team->name : "" }}" required autofocus>

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
    // Wait for the DOM to be ready
    $(function() {
        $("form[class='team_form']").each(function (){
            $(this).validate({
                // Specify validation rules
                rules: {
                    name: "required",
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