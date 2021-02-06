<form method="POST" class="user_form" action="{{ route('update_user_profile', $user) }}">
    @csrf


    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label ">Name</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label ">{{ __('E-Mail Address') }}</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="address" class="col-md-4 col-form-label ">Address</label>

        <div class="col-md-6">
            <input id="address" type="text" class="form-control" name="address" value="{{ $user->address }}">
        </div>
    </div>


    <div class="form-group row mb-0 justify-content-center">
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary btn-block">
                Save
            </button>
        </div>
    </div>
</form>

<script>
    $(document).ready(function (){
        // Form validation
        $("form[class='user_form']").each(function (){
            $(this).validate({
                // Specify validation rules
                rules: {
                    name: "required",
                    email: { required: true, email: true,},
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