<form method="POST" class="category_form" action="{{ route('add_product_category') }}">
    @csrf
    <input type="hidden" name="category" value="{{ $category->id }}">
    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">Category Name</label>
        <div class="col-md-6">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $category->name }}" required autofocus>
            @error('name')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
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
        $("form[class='category_form']").each(function (){
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