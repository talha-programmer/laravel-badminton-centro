<form method="POST" class="product_form" action="{{ route('save_news') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" value="{{ $news->id }}" name="news_id">

    <div class="form-group row">
        <label for="title{{ $displayNewsId()}}" class="col-md-3 col-form-label ">Title</label>
        <div class="col-md-8">
            <input id="title{{ $displayNewsId()}}" type="text" class="form-control" name="title" value="{{ $news->title }}" required autofocus>

        </div>
    </div>

    <div class="form-group row">
        <label for="details{{ $displayNewsId()}}" class="col-md-3 col-form-label ">Details</label>

        <div class="col-md-8">
            <textarea id="details{{ $displayNewsId()}}"  class="form-control" rows="12"
                      name="details"  autofocus>{{ $news->details }}</textarea>

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
        $("form[class='product_form']").each(function (){
            $(this).validate({
                // Specify validation rules
                rules: {
                    title: "required",
                    details: "required",
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
