@extends('layouts.dashboard_layout')

@section('dashboard_content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-1">
                <div class="row mb-4">
                    <div class="col-md-8">
                        <button class="btn btn-secondary" data-toggle="modal" data-target="#addTournamentModel">
                            New Tournament
                            <i class="fas fa-plus"></i>
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="addTournamentModel" tabindex="-1"
                             aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel">New Match</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <x-tournament-form/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @foreach($tournaments as $tournament)
                    <div class="card p-3 my-2">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title">{{ $tournament->name }}</h5>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                Start Date
                            </div>
                            <div class="col-md-8">
                                {{ \Carbon\Carbon::create($tournament->start_date)->format('l\, jS F Y') }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                End Date
                            </div>
                            <div class="col-md-8">
                                {{ \Carbon\Carbon::create($tournament->end_date)->format('l\, jS F Y') }}
                            </div>
                        </div>


                        <h5 class="mt-3">Clubs</h5>
                        <table class="px-4 table table-bordered">
                            <thead>
                            <tr>
                                <th>Sr.</th>
                                <th>Club Name</th>
                                <th>Teams</th>
                                <th>Actions</th>
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
                                                <li class="mb-2 border-bottom">{{ $team->name }}

                                                    <form action="{{ route('remove_tournament_team', $tournament) }}" method="post"
                                                          class="action-form  d-inline">
                                                        @csrf
                                                        @method('DELETE') {{--Will call the delete method of route--}}
                                                        <input type="hidden" value="{{ $team->id }}" name="team_id">
                                                        <a style="cursor: pointer;" class="text-danger float-right"
                                                                onclick="removeTeam(this)" data-toggle="tooltip"
                                                                data-placement="bottom" title="Remove Team">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </form>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>

                                    <td>
                                        <form action="{{ route('remove_tournament_club', $tournament) }}" method="post"
                                              class="action-form  d-inline">
                                            @csrf
                                            @method('DELETE') {{--Will call the delete method of route--}}
                                            <input type="hidden" value="{{ $club->id }}" name="club_id">
                                            <button class="btn btn-outline-danger border-0  d-flex my-0" type="button"
                                                    onclick="removeClub(this)" data-toggle="tooltip"
                                                    data-placement="bottom" title="Remove Club">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>

                                    </td>


                                </tr>
                            @endforeach
                        </table>

                        <div class="row">
                            <div class="col">
                                <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <button class="btn btn-outline-secondary border-0 " type="button"
                                                    onclick="$(this).siblings('#addClubModel').modal('show')"
                                                    data-toggle="tooltip" data-placement="bottom" title="Add Club">
                                                <i class="fas fa-plus fa-2x"></i>
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="addClubModel" tabindex="-1"
                                                 aria-labelledby="modalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalLabel">Add Club in Tournament</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <x-tournament-club-form :tournament="$tournament" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </li>

                                        <li class="list-inline-item">
                                            <button class="btn btn-outline-secondary border-0 " type="button"
                                                    onclick="$(this).siblings('#addMatchModel').modal('show')"
                                                    data-toggle="tooltip" data-placement="bottom" title="Add Match">
                                                <i class="fas fa-table-tennis fa-2x"></i>
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="addMatchModel" tabindex="-1"
                                                 aria-labelledby="modalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalLabel">Add Match</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <x-match-form :tournament="$tournament" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </li>





                                    <li class="list-inline-item">
                                        <form action="{{ route('destroy_tournament', $tournament) }}" method="post"
                                              class="action-form ">
                                            @csrf
                                            @method('DELETE') {{--Will call the delete method of route--}}
                                            <button class="btn btn-outline-danger border-0" type="button"
                                                    onclick="deleteTournament(this)" data-toggle="tooltip"
                                                    data-placement="bottom" title="Delete Tournament">
                                                <i class="fas fa-trash fa-2x"></i>
                                            </button>
                                        </form>
                                    </li>

                                    <li class="list-inline-item">
                                        <button class="btn btn-outline-secondary border-0" type="button"
                                                onclick="$(this).siblings('#addTournamentModel').modal('show')"
                                                data-toggle="tooltip" data-placement="bottom" title="Edit Match">
                                            <i class="fas fa-edit fa-2x"></i>
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="addTournamentModel" tabindex="-1"
                                             aria-labelledby="modalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalLabel">Edit Tournament</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <x-tournament-form :tournament="$tournament"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </li>

                                </ul>



                            </div>

                        </div>


                        <hr>

                        <h5 class="mt-3">Matches</h5>
                        <div class="overflow-auto">
                            <table style="min-width: 900px;" class="px-4 table table-bordered">
                                <thead>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Team One</th>
                                    <th>Team Two</th>
                                    <th>Time</th>
                                    <th>Venue</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $match_counter = 0;?>

                                @foreach($tournament->matches as $match)
                                    <?php $match_counter++; ?>
                                    <tr>
                                        <td>{{ $match_counter }}</td>
                                        <td>{{ $match->teamOne->name }}</td>
                                        <td>{{ $match->teamTwo->name }}</td>
                                        <td>{{ \Carbon\Carbon::create($match->match_time)->format('d/m/Y h:i A') }}</td>
                                        <td>{{ $match->venue }}</td>

                                        <td>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <form action="{{ route('destroy_match', $match) }}" method="post"
                                                          class="action-form  d-inline">
                                                        @csrf
                                                        @method('DELETE') {{--Will call the delete method of route--}}
                                                        <input type="hidden" value="" name="club_id">
                                                        <button class="btn btn-outline-danger border-0  d-flex my-0" type="button"
                                                                onclick="deleteMatch(this)" data-toggle="tooltip"
                                                                data-placement="bottom" title="Delete Match">
                                                            <i class="fas fa-trash" style="font-size: 18px"></i>
                                                        </button>
                                                    </form>
                                                </li>

                                                <li class="list-inline-item">
                                                    <button class="btn btn-outline-secondary border-0 d-flex" type="button"
                                                            onclick="$(this).siblings('#addResultModel').modal('show')"
                                                            data-toggle="tooltip" data-placement="bottom" title="Add/Edit Match Result">
                                                        <i class="fas fa-poll" style="font-size: 18px"></i>
                                                    </button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="addResultModel" tabindex="-1"
                                                         aria-labelledby="modalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modalLabel">Add/Edit Match Result</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                            aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <x-match-result-form :match="$match"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </li>
                                            </ul>




                                        </td>


                                    </tr>
                                @endforeach
                            </table>

                        </div>


                    </div>

                @endforeach

            </div>
        </div>

    </div>


    <script>


        function deleteTournament(buttonObject) {
            // Display confirmation dialog for deleting the Tournament
            bootbox.confirm("Are you sure you want to delete this Tournament?", function (result) {

                // Submit the form if user selects to delete the Tournament
                if (result === true) {
                    $(buttonObject).parents('.action-form').submit();
                }
            });
        }

        function deleteMatch(buttonObject) {
            // Display confirmation dialog for deleting the match
            bootbox.confirm("Are you sure you want to delete this Match?", function (result) {

                // Submit the form if user selects to delete the club
                if (result === true) {
                    $(buttonObject).parents('.action-form').submit();
                }
            });
        }


        function removeTeam(buttonObject) {
            // Display confirmation dialog for deleting the team
            bootbox.confirm("Are you sure you want to remove this Team from Tournament?", function (result) {

                // Submit the form if user selects to remove the team
                if (result === true) {
                    $(buttonObject).parents('.action-form').submit();
                }
            });
        }

        function removeClub(buttonObject) {
            // Display confirmation dialog for deleting the match
            bootbox.confirm("Are you sure you want to remove this Club from Tournament?", function (result) {

                // Submit the form if user selects to remove the club
                if (result === true) {
                    $(buttonObject).parents('.action-form').submit();
                }
            });
        }



    </script>

@endsection
