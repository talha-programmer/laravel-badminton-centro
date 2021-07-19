@extends('layouts.app')

@section('content')
    {{--Header Image--}}
    @include('public.layouts.header')

    <div class="bg-light" data-aos="fade">
        <div class="container py-5">
            <div class="row h-100 align-items-center py-5">
                <div class="col-lg-6">
                    <h1 class="display-4">Who we are?</h1>
                    <p class="lead text-muted mb-0">A private organization managing all types of activities of badminton
                    in different districts. We manage different clubs, arrange matches and tournaments between them and
                        also sell different sports products
                    </p>
                </div>
                <div class="col-lg-6 d-none d-lg-block"><img src="{{ asset('images/About-page-1.jpeg') }}" alt="" class="img-fluid"></div>
            </div>
        </div>
    </div>

    <div class="bg-white py-5" data-aos="fade">
        <div class="container py-5">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6 order-2 order-lg-1"><i class="fa fa-bar-chart fa-2x mb-3 text-primary"></i>
                    <h2 class="font-weight-light">What we do?</h2>
                    <p class="font-italic text-muted mb-4">We manage badminton matches between different clubs and also
                        organise tournaments. A lot of products are available in our website those you can use to play badminton.</p>
                    <a href="{{ route('public_matches') }}" class="btn btn-light px-5 rounded-pill shadow-sm">Learn More</a>
                </div>
                <div class="col-lg-6 px-5 mx-auto order-1 order-lg-2"><img src="{{ asset('images/About-page-2.jpg') }}" alt="" class="img-fluid mb-4 mb-lg-0"></div>
            </div>
            <div class="row align-items-center" data-aos="fade">
                <div class="col-lg-5 px-5 mx-auto"><img src="{{ asset('images/about-page-3.jpg') }}" alt="" class="img-fluid mb-4 mb-lg-0"></div>
                <div class="col-lg-6"><i class="fa fa-leaf fa-2x mb-3 text-primary"></i>
                    <h2 class="font-weight-light">Our Qualities</h2>
                    <p class="font-italic text-muted mb-4">
                        We provide quality products and provide complete monitoring of the orders if you order
                        something through our website.
                    </p><a href="{{ route('public_products') }}" class="btn btn-light px-5 rounded-pill shadow-sm">Learn More</a>
                </div>
            </div>
        </div>
    </div>



@endsection
