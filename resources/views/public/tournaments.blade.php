@extends('layouts.app')

@section('content')

    @include('public.layouts.header')

    <div id="matches_container" >
        <div class="image-overlay py-4 container-fluid">
            <h1 class="text-center text-white">Tournaments</h1>
            <hr>
                @foreach($tournaments as $tournament)
                    <div class="row mt-5" data-aos="fade">
                        <div class="col mx-5 ">
                            <h3 class="rounded-pill bg-light p-3 text-center mx-5">{{ $tournament->name }}</h3>

                        </div>
                    </div>
                    <div class="row justify-content-center mb-2" data-aos="fade">
                            <div class="col-5">
                                <div class="text-white">
                                    <div class="row">
                                        <div class="col-md-4">
                                            Start Date
                                        </div>
                                        <div class="col-md-8">
                                            {{ \Carbon\Carbon::create($tournament->start_date)->format('l\, jS F Y') }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            End Date
                                        </div>
                                        <div class="col-md-8">
                                            {{ \Carbon\Carbon::create($tournament->end_date)->format('l\, jS F Y') }}
                                        </div>
                                    </div>
                                    <h5 class="mt-3">Clubs</h5>


                                </div>
                                <div class="overflow-auto matches " style="height: 300px" >
                                    @foreach($tournament->clubs as $club)
                                        <div class="col mb-4" >
                                            <div class="card" style="border-radius: 5%;">
                                                <div class="card-body">

                                                    <h4 class="card-title">{{ $club->name }}</h4>
                                                    <div class="row border-top border-secondary py-2">
                                                        <div class="col d-flex justify-content-between">
                                                            <div><h5 class="text-muted font-italic">Rank</h5></div>
                                                            <div><h5>{{ $club->getRank() }}</h5></div>
                                                        </div>
                                                    </div>


                                                    <div class="row border-top border-secondary py-2">
                                                        <div class="col d-flex justify-content-between">
                                                            <div><h5 class="text-muted font-italic">City</h5></div>
                                                            <div><h5>{{ $club->city }}</h5></div>
                                                        </div>
                                                    </div>

                                                    <div class="row border-top border-bottom border-secondary py-2">
                                                        <div class="col d-flex justify-content-between">
                                                            <div><h5 class="text-muted font-italic">Teams Participating</h5></div>
                                                            <div><h5>{{ $tournament->clubTeams($club) }}</h5></div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>


                                {{--<table class="px-4 table table-bordered text-white">
                                    <thead>
                                    <tr>
                                        <th>Sr.</th>
                                        <th>Club Name</th>
                                        <th>Teams</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $club_counter = 0;?>

                                    @foreach($tournament->clubs as $club)
                                        <?php $club_counter++; ?>
                                        <tr>
                                            <td>{{ $club_counter }}</td>
                                            <td>{{ $club->name }}</td>

                                            <td>
                                                <ul>
                                                    @foreach($tournament->clubTeams($club) as $team)
                                                        <li class="mb-2 ">{{ $team->name }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
--}}

                            </div>



                            <div class="col-5 ">


                                <h5 class="py-2 rounded-pill bg-light text-center">Matches</h5>
                                <div class="overflow-auto matches" style="height: 300px" >
                                    @foreach($tournament->matches as $match)
                                        <x-previous-match :match="$match"/>

                                    @endforeach

                                </div>


                            </div>
                        </div>






                @endforeach

                <div class="d-flex justify-content-center">
                    {{ $tournaments->links() }}
                </div>
        </div>

    </div>

    <style>
        @push('style_tag')


        .matches::-webkit-scrollbar {
            width: 8px;
            background-color: #caefd4;
        }


        .matches::-webkit-scrollbar-track {
            background-color: rgba(0, 0, 0, 0);
            transition: background-color 0.15s ease-out;
        }

        #matches_container {
            background-image: url("{{ asset('images/main-background.jpg') }}");
            background-size: cover;
            background-repeat: no-repeat;
        }

        .matches::-webkit-scrollbar-thumb {
            background-color: #c7c7c7;
            border-radius: 10px;
        }

        .image-overlay{
            background-color: rgba(31, 31, 31, 0.55);
        }

        a {
            color: white;
        }

        @endpush
    </style>



@endsection
