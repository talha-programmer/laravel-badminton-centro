<form method="POST" class="password_form" action="{{ route('update_user_password', $user) }}">
    @csrf

    <div class="form-group row">
        <label for="current_password" class="col-md-4 col-form-label ">Current Password</label>

        <div class="col-md-6">
            <input id="current_password" type="password" class="form-control" name="current_password" required>

        </div>
    </div>

    <div class="form-group row">
        <label for="new_password" class="col-md-4 col-form-label ">New Password</label>

        <div class="col-md-6">
            <input id="new_password" type="password" class="form-control" name="new_password" required>

        </div>
    </div>

    <div class="form-group row">
        <label for="password-confirm" class="col-md-4 col-form-label ">Confirm Password</label>

        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
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
        $("form[class='password_form']").each(function (){
            $(this).validate({
                // Specify validation rules
                rules: {
                    current_password: "required",
                    new_password: { required: true, minlength: 5,},
                    password_confirmation: {
                        equalTo: "#new_password",
                    },
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
