@extends('layouts.app')

@section('content')
    {{--Header Image--}}
{{--
    @include('public.layouts.header')
--}}

    <div class="">
        <div class="swiper-container-full" >

            <div class="swiper-wrapper">
                    <div class="swiper-slide slide-full" >
                        <img src="{{ asset('images/header-image-1.jpg') }}" alt="">
                    </div>

                    <div class="swiper-slide slide-full" >
                        <img src="{{ asset('images/header-image-2.jpg') }}" alt="">
                    </div>
                     <div class="swiper-slide slide-full">
                            <img src="{{ asset('images/header-image-3.jpg') }}" alt="">
                        </div>

            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>

    </div>


    {{--Teams--}}
    <div class="container-fluid pt-4 pb-5 text-white bg-primary ">
        <h1 class="text-center">Teams</h1>
        <hr>
        <!-- Swiper -->
        <div class="swiper-container mt-5 " >

            <div class="swiper-wrapper">
                @foreach($teams as $team)
                    <div class="swiper-slide border-right" data-aos="fade-left">
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
    <div class="container-fluid py-4 " id="matches_container">
        <h1 class="text-center " style= "color: dark-grey">Matches</h1>
        <hr>

        <div id="matches" class="row row-cols-1 row-cols-md-2 px-md-5 justify-content-center overflow-auto" style="height: 300px;">

            @foreach($matches as $match)
                <div class="p-4">
                    <div class="col shadow bg-primary" data-aos="fade-up" style="min-height: 250px; border-radius: 10% 30%;">
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


    {{--<div class="container-fluid pt-4 pb-5 text-white bg-primary" >
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

    <div class="container pt-4 pb-5" >
        <div class="row">
            <div class="col-6">
                <h2>Standings</h2>
                <hr>

                <table class="px-4 table">
                    <thead class="bg-primary text-white">
                    <tr>
                        <th>Pos.</th>
                        <th>Team</th>
                        <th>Matches</th>
                        <th>Won</th>
                        <th>Lost</th>
                        <th>Tied</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $team_counter = 0;?>

                    @foreach($teams as $team)
                        <?php $team_counter++?>
                        <tr>
                            <td>{{ $team_counter }}</td>
                            <td>{{ $team->name }}</td>
                            <td>{{ $team->total_matches  }}</td>
                            <td>{{ $team->won_matches }}</td>
                            <td>{{ $team->lost_matches}}</td>
                            <td>{{ $team->tied_matches }}</td>

                        </tr>
                    @endforeach
                </table>


            </div>

            <div class="col-6">

            </div>
        </div>


    </div>


    {{--Products--}}
    <div class="container-fluid py-4" id="product_container">
        <h1 class="text-center " style= "color: dark-grey">Products</h1>
        <hr>

        <div class="row row-cols-1 mt-5 row-cols-xl-4 row-cols-lg-3 row-cols-md-2 px-md-5 justify-content-center">

            @foreach($products as $product)
                <div class="col mb-4 " data-aos="fade-right" >
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
                <a href="{{ route('public_products') }}" data-aos="fade-up" class="btn btn-light btn-block rounded-pill py-3 mt-4"> View All Products</a>

            </div>
        </div>


    </div>


    <script>

        <!-- Initialize Swiper -->
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 3,
            spaceBetween: 30,

        });

        var swiperFull = new Swiper('.swiper-container-full', {
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },


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

        .slide-full img {
            display: block;
            width: 100%;
            max-height: 500px;
            object-fit: cover;
        }


        #matches_container {
            background-image: url("{{ asset('images/home-background-1.jpg') }}");
            background-size: cover;
            background-repeat: no-repeat;
        }


        #product_container {
            background-image: url("{{ asset('images/home-product-bg.jpg') }}");
            background-size: cover;
            background-repeat: no-repeat;
        }


        #matches::-webkit-scrollbar-track
        {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            border-radius: 10px;
            background-color: transparent;
        }

        #matches::-webkit-scrollbar
        {
            width: 12px;
            background-color: transparent;
        }

        #matches::-webkit-scrollbar-thumb
        {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
            background-color: #555;
        }




        @endpush
    </style>

@endsection
