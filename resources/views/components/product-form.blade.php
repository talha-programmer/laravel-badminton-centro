<form method="POST" action="{{ route('add_product') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" value="{{ $product->id }}" name="product_id">

    <div class="form-group row">
        <div class="col mx-auto">
            <!-- Uploaded image area-->
            <img style="width: 100%; max-height: 10vw; object-fit: cover;" id="imageResult{{ $displayProductId()}}" src="{{ asset($product->image_url? $product->image_url : '#') }}" alt="" class="img-fluid rounded shadow-sm mx-auto d-block">
        </div>
    </div>

    <div class="form-group row">
        <label for="image{{ $displayProductId()}}" class="col-md-4 col-form-label ">Image</label>
        <div class="col-md-6">
            <input id="image{{ $displayProductId()}}" type="file" accept="image/*" onchange="readURL(this)"
                   class="mw-100 overflow-hidden @error('image') is-invalid @enderror" name="image" value=""  autofocus>
            @error('image')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="name{{ $displayProductId()}}" class="col-md-4 col-form-label ">Product Name</label>
        <div class="col-md-6">
            <input id="name{{ $displayProductId()}}" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $product->name }}" required autofocus>
            @error('name')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="price{{ $displayProductId()}}" class="col-md-4 col-form-label ">Price</label>

        <div class="col-md-6">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">{{ __('currency.code') }}</span>
                </div>
                <input id="price{{ $displayProductId()}}" type="number" step="any"
                       class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $product->price }}" required>
            </div>
            @error('price')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="category{{ $displayProductId()}}" class="col-md-4 col-form-label ">Select Categories</label>

        <div class="col-md-6">
            <select id="category{{ $displayProductId()}}" class="form-control select2" name="categories[]" multiple="multiple">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="description{{ $displayProductId()}}" class="col-md-4 col-form-label ">Description</label>

        <div class="col-md-6">
            <textarea id="description{{ $displayProductId()}}"  class="form-control @error('description')is-invalid @enderror"
                      name="description"  autofocus>{{ $product->description }}</textarea>

            @error('description')
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



    $(document).ready(function (){
        // Initializing all select2 tags
        $('.select2').select2({
            width: '100%'
        });

        @if($product->id !=null)

            // Select the categories of the selected product
            $('#category_product_{{$product->id}}').val({{ json_encode($selectedCategories) }})
        @endif


        // Image upload and display preview
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imageResult{{ $displayProductId()}}')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        var input = document.getElementById( 'image{{ $displayProductId() }}' );
        $(function () {
            $('#image{{ $displayProductId()}}').on('change', function () {
                readURL(input);
            });
        });



    });


</script>