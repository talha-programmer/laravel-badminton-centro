@extends('layouts.dashboard_layout')

@section('dashboard_content')
    <div class="container">

        @foreach($clubs as $club)
            <div class="card p-3 my-2">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title">{{ $club->name }}</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 border-right">
                        <div class="row">
                            <div class="col-md-4">
                                Owner Name:
                            </div>
                            <div class="col-md-8">
                                {{ $club->clubOwner->user->name }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                City:
                            </div>
                            <div class="col-md-8">
                                {{ $club->city }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                Address:
                            </div>
                            <div class="col-md-8">
                                {{ $club->address == "" ? "Not Provided"  : $club->address }}
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <p class="font-weight-bold">Actions:</p>
                                <div class="action-buttons">
                                    <ul class="list-inline">

                                        <li class="list-inline-item">
                                            <form action="{{ route('destroy_club', $club) }}" method="post"
                                                  class="action-form form-inline">
                                                @csrf
                                                @method('DELETE') {{--Will call the delete method of route--}}
                                                <button class="btn btn-outline-danger border-0" type="button"
                                                        onclick="deleteClub(this)" data-toggle="tooltip"
                                                        data-placement="bottom" title="Delete Club">
                                                    <i class="fas fa-trash fa-2x"></i>
                                                </button>
                                            </form>
                                        </li>

                                        <li class="list-inline-item">
                                            <button class="btn btn-outline-secondary border-0 d-flex" type="button"
                                                    onclick="$(this).siblings('#addClubModel').modal('show')"
                                                    data-toggle="tooltip" data-placement="bottom" title="Edit Club">
                                                <i class="fas fa-edit fa-2x"></i>
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="addClubModel" tabindex="-1"
                                                 aria-labelledby="modalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalLabel">Edit Club</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <x-club-form :club="$club"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </li>

                                        <li class="list-inline-item">
                                            <button class="btn btn-outline-secondary border-0 d-flex" type="button"
                                                    onclick="$(this).siblings('#addTeamModel').modal('show')"
                                                    data-toggle="tooltip" data-placement="bottom" title="Add Team">
                                                <i class="fas fa-plus fa-2x"></i>
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="addTeamModel" tabindex="-1"
                                                 aria-labelledby="modalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalLabel">Add New Team</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <x-team-form :club="$club"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </li>

                                        <li class="list-inline-item">
                                            <button class="btn btn-outline-secondary border-0 d-flex" type="button"
                                                    onclick="$(this).siblings('#addPlayerModel').modal('show')"
                                                    data-toggle="tooltip" data-placement="bottom"
                                                    title="Add Player in Club">
                                                <i class="fas fa-user-plus fa-2x"></i>
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="addPlayerModel" tabindex="-1"
                                                 aria-labelledby="modalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalLabel">Edit Club</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <x-club-form :club="$club"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col"><h5>Teams of Club:</h5></div>

                        </div>
                        @foreach($club->teams as $team)
                            <div class="row">
                                <div class="col-md-4">
                                    Team Name
                                </div>
                                <div class="col-md-8">
                                    {{ $team->name }}
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <a href="{{ route('add_player_in_team', $team) }}">Add player in this
                                    team</a>
                            </div>
                            <div class="row">
                                <div class="col"><h5>Players:</h5></div>

                            </div>
                            @foreach($team->players as $player)
                                <div class="row">
                                    <div class="col-md-4">
                                        Player Name
                                    </div>
                                    <div class="col-md-8">
                                        {{ $player->user->name }}
                                    </div>
                                </div>

                            @endforeach
                        @endforeach

                    </div>
                </div>
            </div>

        @endforeach
    </div>




    <script>
        function deleteClub(buttonObject) {
            // Display confirmation dialog for deleting the club
            bootbox.confirm("Are you sure you want to delete this club? It will delete " +
                "all the related teams, matches and players as well!", function (result) {

                // Submit the form if user selects to delete the club
                if (result === true) {
                    $(buttonObject).parents('.action-form').submit();
                }
            });
        }

        $(document).ready(function () {
            /*Initializing Tooltips*/
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        });

        @if(session('info'))
            bootbox.alert("{{ session('info') }}");
        @endif

        @if(session('error'))
            bootbox.alert("<span class = \"text-danger\">{{ session('error') }}</span>");
        @endif

    </script>
@endsection
