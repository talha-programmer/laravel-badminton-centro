<form class="club_form" method="POST" action="{{ route('add_club') }}">
    @csrf

    @if($club)
        <input type="hidden" value="{{ $club->id }}" name="club_id">
    @endif

    @if($clubOwners)       {{--Only admin or director can select different club owners--}}
        <div class="form-group row">
            <label for="club_owner" class="col-md-3 offset-1 col-form-label">Select Owner</label>
            <div class="col-md-6">
                <select id="club_owner" class="form-control" name="club_owner">
                    @foreach($clubOwners as $club_owner)
                        <option value="{{ $club_owner->id }}"  @if($club->id != null && $isSelected($club->clubOwner->id)) selected="selected" @endif>
                            {{ $club_owner->user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif

    <div class="form-group row">
        <label for="name" class="col-md-3 offset-1 col-form-label">Club Name</label>
        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name"
                   value="{{ $club? $club->name : ""  }}" required autofocus>

        </div>
    </div>

    <div class="form-group row">
        <label for="city" class="col-md-3 offset-1 col-form-label">City</label>

        <div class="col-md-6">
            <input id="city" type="text" class="form-control" name="city"
                   value="{{ $club? $club->city : "" }}" required>

        </div>
    </div>

    <div class="form-group row">
        <label for="address" class="col-md-3 offset-1 col-form-label">Address</label>

        <div class="col-md-6">
            <input id="address" type="text" class="form-control" name="address"
                   value="{{ $club? $club->address : "" }}" autofocus>
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
        $("form[class='club_form']").each(function (){
            $(this).validate({
                // Specify validation rules
                rules: {
                    @if($clubOwners)
                    club_owner: "required",
                    @endif
                    name: "required",
                    city: "required",
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