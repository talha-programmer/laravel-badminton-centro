@extends('layouts.app')

@section('content')

    @include('public.layouts.header')

    {{--Products--}}
    <div class="container-fluid py-4 " >
        <h1 class="text-center text-primary">Products</h1>
        <hr>

        <div class="row row-cols-1 mt-5 row-cols-xl-4 row-cols-lg-3 row-cols-md-2 px-md-5 justify-content-center">

            @foreach($products as $product)
                <div class="col mb-4 " data-aos="fade-up" >
                    <div class="card" style="border-radius: 5%;" >
                        <img @if(!$product->image_url) style="object-fit: cover;"  @endif src="{{ asset($product->image_url? $product->image_url : 'images/image.png') }}" class="card-img-top" alt="">
                        <div class="card-body">
                            <h4 class="card-title">{{ $product->name }}</h4>
                            <h5 class="text-primary">Price: {{ __('currency.code') }} {{ $product->price }}</h5>
                            <p>
                                @foreach($product->categories as $category)
                                    <span class="bg-secondary text-white px-1">{{ $category->name }} </span> &nbsp;
                                @endforeach
                            </p>

                            <a href="{{ route('public_single_product', $product) }}" class="btn btn-secondary">View more</a>
                            <button class="btn btn-primary float-right text-white" onclick="addToCart({{ $product->id }})">Add to cart</button>




                        </div>
                    </div>
                </div>
            @endforeach

        </div>


        <div class="d-flex justify-content-center">
            {{ $products->links() }}

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
            height: 15vw;
            object-fit: contain;
        }


        @endpush
    </style>



@endsection
