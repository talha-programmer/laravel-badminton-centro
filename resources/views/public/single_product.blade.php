@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center my-4 " >
            <div class="col-4">
                <img src="{{ asset($product->image_url? $product->image_url : 'images/image.png') }}" class="card-img-top" alt="">
            </div>

            <div class="col-4">
                <div class="card-body">
                    <h3 class="card-title">{{ $product->name }}</h3>
                    <h5 class="text-primary">Price: {{ __('currency.code') }} {{ $product->price }}</h5>
                    <p>
                        Categories:
                        @foreach($product->categories as $category)
                            <span class="bg-secondary text-white px-1">{{ $category->name }} </span> &nbsp;
                        @endforeach
                    </p>

                    <h4>Description</h4>
                    <p>{{ $product->description }}</p>

                    <button class="btn btn-primary btn-block text-white" onclick="addToCart({{ $product->id }})">Add to cart</button>


                </div>
            </div>

        </div>
    </div>



    <script>


        function addToCart(productId) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                url:"{{ route('add_to_cart') }}",
                type: "POST",
                data: {
                    'product_id' : productId,
                },
                success: function (response){
                    if(response[0] === 'info' ){
                        bootbox.alert(response[1]);
                        location.reload();
                    }

                },
            });
        }
    </script>

    <style>
        @push('style_tag')


        {{--fixed size for all card images--}}
        .card-img-top {
            border-radius: 5% 5% 0 0;
            width: 100%;
            height: 22vw;
            object-fit: contain;
        }


        @endpush
    </style>



@endsection
