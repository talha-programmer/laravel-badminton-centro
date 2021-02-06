@extends('layouts.app')

@section('content')
    {{--Header Image--}}
    @include('public.layouts.header')

    {{--Teams--}}
    <div class="container-fluid pt-4 pb-5 text-white bg-primary">
        <h1 class="text-center">Teams</h1>
        <hr>
        <!-- Swiper -->
        <div class="swiper-container mt-5">

            <div class="swiper-wrapper">
                @foreach($teams as $team)
                    <div class="swiper-slide border-right">
                        <div class="d-flex align-content-center">
                            <div class="flex-column mx-auto text-center">
                                <img src="{{ asset('images/TeamLogo.png') }}" height="100" alt="">
                                <h3 class="mt-3 text-center">{{ $team->name }}</h3>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </div>

    {{--Upcoming Matches--}}
    <div class="container-fluid py-4" style="background-color: #e4e4e4">
        <h1 class="text-center text-primary">Matches</h1>
        <hr>

        <div class="row row-cols-1 mt-5 row-cols-md-2 px-md-5 justify-content-center">

            @foreach($matches as $match)
                <div class="p-4">
                    <div class="col shadow bg-primary" style="min-height: 250px; border-radius: 10% 30%;">
                        <div class="text-white pt-4">
                            <h5 class="float-left"><i class="fas fa-calendar"></i>
                                {{ \Carbon\Carbon::create($match->match_time)->format('jS F Y') }}
                            </h5>
                            <h5 class="float-right pr-3 pr-md-5">{{ \Carbon\Carbon::create($match->match_time)->format('h:i A') }}
                                <i class="fas fa-clock"></i></h5>
                            <br> <br>
                            <h4 class="text-center  text-uppercase"
                                style="line-height: 1.6;">{{ $match->teamOne->name }} <br> vs
                                <br> {{ $match->teamTwo->name }}</h4>
                            <br>
                            <h5 style="font-style: italic;" class="text-center"><i
                                        class="fas fa-map-marker-alt"></i> {{ $match->venue }} </h5>
                        </div>
                    </div>
                </div>
            @endforeach

            <a href="{{ route('public_matches') }}" class="btn btn-primary btn-block rounded-pill py-3 mt-4"> View All Matches</a>
        </div>

    </div>

{{--Clubs--}}{{--

    <div class="container-fluid pt-4 pb-5 text-white bg-primary">
        <h1 class="text-center">Clubs</h1>
        <hr>
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @foreach($clubs as $club)
                <div class="p-4 swiper-slide">
                    <div class="col shadow bg-white" style="border-radius: 5%; min-height: 250px;">
                        <div class="text-primary pt-4">
                            <h4>{{ $club->name }}</h4>
                            <br>
                            <h5>Total Teams: {{ $club->teams()->count() }}</h5>
                            <h5>Total Players: {{ $club->players()->count() }}</h5>
                            <h5>City: {{ $club->city }}</h5>


                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>


    </div>
--}}

    {{--Products--}}
    <div class="container-fluid py-4 bg-primary" >
        <h1 class="text-center text-white">Products</h1>
        <hr>

        <div class="row row-cols-1 mt-5 row-cols-xl-4 row-cols-lg-3 row-cols-md-2 px-md-5 justify-content-center">

            @foreach($products as $product)
                <div class="col mb-4 " >
                    <div class="card" style="border-radius: 5%;">
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
        <div class="row justify-content-center">
            <div class="col-6">
                <a href="{{ route('public_products') }}" class="btn btn-light btn-block rounded-pill py-3 mt-4"> View All Products</a>

            </div>
        </div>


    </div>


    <script>

        <!-- Initialize Swiper -->
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 3,
            spaceBetween: 30,

        });

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
