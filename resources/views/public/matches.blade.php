@extends('layouts.app')

@section('content')

    @include('public.layouts.header')
    <div id="matches_container" class="container-fluid">
        {{--Upcoming Matches--}}
        <div class="container py-4" >
            <h1 class="text-center text-white">Upcoming Matches</h1>
            <hr>

            <div class="row row-cols-1 mt-5 row-cols-md-2 px-md-5 justify-content-center">

                @foreach($upcoming_matches as $match)
                   <x-upcoming-match :match="$match" />

                @endforeach

            </div>

        </div>


        {{--Previous Matches--}}
        <div class="container py-4" >
            <h1 class="text-center text-white">Previous Matches</h1>
            <hr>

            <div class="row row-cols-1 mt-5 row-cols-md-2 px-md-5 justify-content-center">

                @foreach($previous_matches as $match)
                    <x-previous-match :match="$match" />

                @endforeach

            </div>

        </div>
    </div>
    <style>
    #matches_container {
            background-image: url("{{ asset('images/main-background.jpg') }}");
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>



@endsection
