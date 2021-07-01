<form method="POST" class="user_form" action="{{ route('update_user_profile', $user) }}"  enctype="multipart/form-data">
    @csrf


    <div class="form-group row">
        <div class="col mx-auto">
            <!-- Uploaded image area-->
            <img style="width: 40%; height: 175px; object-fit: cover;" id="imageResult" src="{{ $user->profile_picture_url?  asset($user->profile_picture_url) : '#' }}" alt="" class="img-fluid rounded-circle shadow-sm mx-auto d-block">
        </div>
    </div>

    <div class="form-group row">
        <label for="image" class="col-md-4 col-form-label ">Profile Picture</label>
        <div class="col-md-6">
            <input id="image" type="file" accept="image/*" onchange="readURL(this)"
                   class="mw-100 overflow-hidden " name="image" value=""  autofocus>

        </div>
    </div>

    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label ">Name</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>
        </div>
    </div>

    <div class="form-group row">
        <label for="date_of_birth" class="col-md-4 col-form-label ">Date of Birth</label>

        <div class="col-md-6">
            <input id="date_of_birth" type="text" class="form-control datetimepicker " name="date_of_birth" value="{{ $user->date_of_birth }}" required autofocus>
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
        // Form validation
        $("form[class='user_form']").each(function (){
            $(this).validate({
                // Specify validation rules
                rules: {
                    name: "required",
                    date_of_birth: "required",
                    email: { required: true, email: true,},
                },

                // Make sure the form is submitted to the destination defined
                // in the "action" attribute of the form when valid
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });

        $('.datetimepicker').datetimepicker({
            format: 'DD/MM/yyyy',
        });

        // Image upload and display preview
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imageResult')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }


        var input = document.getElementById( 'image' );
        $(function () {
            $('#image').on('change', function () {
                readURL(input);
            });
        });

    });

</script>
