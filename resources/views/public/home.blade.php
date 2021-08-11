@extends('layouts.app')

@section('content')
    {{--Header Image--}}
    {{--
        @include('public.layouts.header')
    --}}

    <div class="">
        <div class="swiper-container" id="swiper-full">
            <div class="swiper-wrapper">
                <div class="swiper-slide slide-full">
                    <img src="{{ asset('images/header-image-1.jpg') }}" alt="">
                </div>

                <div class="swiper-slide d-flex slide-full">
                    <img src="{{ asset('images/header-image-2.jpg') }}" alt="">
                </div>
                <div class="swiper-slide d-flex slide-full">
                    <img src="{{ asset('images/header-image-3.jpg') }}" alt="">
                </div>
                <div class="swiper-slide d-flex slide-full">
                    <img src="{{ asset('images/header-image-4.jpg') }}" alt="">
                </div>
                <div class="swiper-slide d-flex slide-full">
                    <img src="{{ asset('images/header-image-5.jpg') }}" alt="">
                </div>

            </div>

            <div class="swiper-pagination"></div>
        </div>

    </div>

    {{--Teams--}}
    <div class="container-fluid pt-4 pb-5  bg-primary ">
        <h1 class="text-center text-white">Clubs</h1>
        <hr>
        <!-- Swiper -->
        <div class="swiper-container mt-5 ">

            <div class="swiper-wrapper">
                <?php $counter = 1; ?>
                @foreach($clubs as $club)
                    <div class="swiper-slide" >
                        <div class="card" data-aos="fade-right" style="border-radius: 5%;">
                            <div class="card-body">

                                <h4 class="card-title">{{ $club->name }}</h4>
                                <div class="row border-top border-secondary py-2">
                                    <div class="col d-flex justify-content-between">
                                        <div><h5 class="text-muted font-italic">Rank</h5></div>
                                        <div><h5>{{ $counter++ }}</h5></div>
                                    </div>
                                </div>

                                <div class="row border-top border-secondary py-2">
                                    <div class="col d-flex justify-content-between">
                                        <div><h5 class="text-muted font-italic">Owner</h5></div>
                                        <div><h5>{{ $club->clubOwner->user->name }}</h5></div>
                                    </div>
                                </div>

                                <div class="row border-top border-secondary py-2">
                                    <div class="col d-flex justify-content-between">
                                        <div><h5 class="text-muted font-italic">City</h5></div>
                                        <div><h5>{{ $club->city }}</h5></div>
                                    </div>
                                </div>

                                <div class="row border-top border-secondary py-2">
                                    <div class="col d-flex justify-content-between">
                                        <div><h5 class="text-muted font-italic">Total Teams</h5></div>
                                        <div><h5>{{ $club->teams()->count() }}</h5></div>
                                    </div>
                                </div>

                                <div class="row border-top border-bottom border-secondary py-2">
                                    <div class="col d-flex justify-content-between">
                                        <div><h5 class="text-muted font-italic">Total Players</h5></div>
                                        <div><h5>{{ $club->players()->count() }}</h5></div>
                                    </div>
                                </div>

                                <a href="{{ route('public_single_club', $club) }}" class="mt-4 btn btn-primary btn-block">View More Details</a>

                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- @foreach($teams as $team)
                     <div class="swiper-slide border-right" data-aos="fade-left">
                         <div class="d-flex align-content-center">
                             <div class="flex-column mx-auto text-center">
                                 <img src="{{ asset('images/TeamLogo.png') }}" height="100" alt="">
                                 <h3 class="mt-3 text-center">{{ $team->name }}</h3>
                             </div>
                         </div>
                     </div>
                 @endforeach
                 --}}
            </div>

            <div class="swiper-pagination mt-3 position-relative"></div>


        </div>
    </div>

    {{--Upcoming Matches--}}
    <div class="container-fluid py-4 " id="matches_container">
        <h1 class="text-center ">Matches</h1>
        <hr>

        <div id="matches" class="row row-cols-1 row-cols-md-2 px-md-5 justify-content-center overflow-auto"
             style="height: 300px;">

            @foreach($matches as $match)
                <x-upcoming-match :match="$match" />
            @endforeach

            <a href="{{ route('public_matches') }}" class="btn btn-primary btn-block rounded-pill py-3 mt-4"> View All
                Matches</a>
        </div>

    </div>

    <div class="container pt-4 pb-5">
        <div class="row row-cols-1 row-cols-md-2">
            <div class="col">
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

            <div class="col">
                <h2>Latest News</h2>
                <hr>
                <marquee style="vertical-align: bottom; margin-top: 4px;" direction="up" scrollamount="1"
                         scrolldelay="5" onmouseover="this.stop();" onmouseout="this.start();" height="300">
                    @foreach($news as $single_news)
                        <a href="{{ route('single_news', $single_news) }}">
                            <span class="font-weight-bold">{{ $single_news->title }}</span><br>
                        </a>
                        {{ \Illuminate\Support\Str::limit($single_news->details, 150, '...') }}

                        <br><br>

                    @endforeach
                </marquee>
            </div>
        </div>


    </div>


    {{--Products--}}
    <div class="container-fluid py-4 bg-primary" id="product_container">
        <h1 class="text-center text-white">Products</h1>
        <hr>

        <div class="row row-cols-1 mt-5 row-cols-xl-4 row-cols-lg-3 row-cols-md-2 px-md-5 justify-content-center">

            @foreach($products as $product)
                <div class="col mb-4 " data-aos="fade-right">
                    <div class="card" style="border-radius: 5%;">
                        <img @if(!$product->image_url) style="object-fit: cover;"
                             @endif src="{{ asset($product->image_url? $product->image_url : 'images/image.png') }}"
                             class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-title" style="font-size: 1.3em">{{ $product->name }}</h5>
                            <h5 class="text-primary">Price: {{ __('currency.code') }} {{ $product->price }}</h5>
                            <p>
                                @foreach($product->categories as $category)
                                    <span class="bg-secondary text-white px-1">{{ $category->name }} </span> &nbsp;
                                @endforeach
                            </p>

                            <a href="{{ route('public_single_product', $product) }}" class="btn btn-secondary">View
                                more</a>
                            <button class="btn btn-primary float-right text-white"
                                    onclick="addToCart({{ $product->id }})">Add to cart
                            </button>


                        </div>
                    </div>
                </div>
            @endforeach


        </div>
        <div class="row justify-content-center">
            <div class="col-6">
                <a href="{{ route('public_products') }}" data-aos="fade-up"
                   class="btn btn-light btn-block rounded-pill py-3 mt-4"> View All Products</a>

            </div>
        </div>


    </div>

    <script>

        <!-- Initialize Swiper -->
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 30,

            breakpoints: {
                640: {
                    slidesPerView: 2,
                },

                900: {
                    slidesPerView: 3,
                }
            },

            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },


        });

        var swiperFull = new Swiper('#swiper-full', {
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
                url: "{{ route('add_to_cart') }}",
                type: "POST",
                data: {
                    'product_id': productId,
                },
                success: function (response) {
                    if (response[0] === 'info') {
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
            height: 200px;
            object-fit: cover;
            object-position: top;
        }


        .slide-full{
            height: auto;
        }
        .slide-full img {
            display: block;
            width: 100%;
            max-height: 500px;
            object-fit: cover;
            height: 100%;
        }


        #matches_container {
            background-image: url("{{ asset('images/home-background-1.jpg') }}");
            background-size: cover;
            background-repeat: no-repeat;
        }


        #matches::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            background-color: transparent;
        }

        #matches::-webkit-scrollbar {
            width: 12px;
            background-color: transparent;
        }

        #matches::-webkit-scrollbar-thumb {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
            background-color: #555;
        }

        @endpush
    </style>

@endsection
