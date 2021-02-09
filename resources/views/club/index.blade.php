@extends('layouts.dashboard_layout')

@section('dashboard_content')
    <div class="container">
        @if($is_director)
            <div class="row">
            <div class="col-md-12">
                <button class="btn btn-secondary btn-block" data-toggle="modal" data-target="#addClubModel">
                    New Club
                    <i class="fas fa-plus"></i>
                </button>
                <!-- Modal -->
                <div class="modal fade" id="addClubModel" tabindex="-1"
                     aria-labelledby="modalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel">Add New Club</h5>
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <x-club-form/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @foreach( $clubs as $index=>$club )
            <div class="card p-3 my-4">
                <div class="row">
                    <div class="col">
                        <h4 class="card-title">{{ $club->name }}</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 border-right">
                        <div class="row">
                            <div class="col-md-4">
                                <strong>Rank:</strong>
                            </div>
                            <div class="col-md-8">
                                <strong>{{ $index }}</strong>
                            </div>
                        </div>
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
                                @if($club->address != "")
                                    {{ $club->address }}
                                @else
                                    <span class="text-muted">Not provided</span>
                                @endif

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
                                                            <x-player-form :club="$club"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <h5>All Players of Club:</h5>

                                {{--Club Players--}}
                                <table class="px-4 table table-bordered mt-3">
                                    <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>Player Name</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $player_counter = 0;?>

                                    @foreach($club->players()->orderByDesc('ranking')->get() as $player)
                                        <?php $player_counter++?>
                                        <tr>
                                            <td>{{ $player_counter }}</td>
                                            <td>{{ $player->user->name }}</td>
                                            <td>
                                                {{--Action Buttons--}}
                                                <ul class="list-inline">

                                                    <li class="list-inline-item">
                                                        <form action="{{ route('remove_player_from_club', [$club, $player]) }}" method="post"
                                                              class="action-form form-inline">
                                                            @csrf
                                                            @method('DELETE') {{--Will call the delete method of route--}}
                                                            <button class="btn btn-outline-danger border-0" type="button"
                                                                    onclick="removePlayerFromClub(this)" data-toggle="tooltip"
                                                                    data-placement="top" title="Remove player from Club">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </li>

                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>

                            </div>
                        </div>



                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col"><h5>Teams of Club:</h5></div>
                        </div>

                        <table class="table">
                            <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Team Name</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $team_counter = 0;?>

                            @foreach($club->teams as $team)
                                <?php $team_counter++?>
                                <tr>
                                    <td>{{ $team_counter }}</td>
                                    <td>{{ $team->name }}</td>
                                    <td>
                                        {{--Action Buttons--}}
                                        <ul class="list-inline">

                                            <li class="list-inline-item">
                                                <form action="{{ route('destroy_team', $team) }}" method="post"
                                                      class="action-form form-inline">
                                                    @csrf
                                                    @method('DELETE') {{--Will call the delete method of route--}}
                                                    <button class="btn btn-outline-danger border-0" type="button"
                                                            onclick="deleteTeam(this)" data-toggle="tooltip"
                                                            data-placement="bottom" title="Delete Team">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </li>

                                            <li class="list-inline-item">
                                                <button class="btn btn-outline-secondary border-0 d-flex" type="button"
                                                        onclick="$(this).siblings('#editTeamModel').modal('show')"
                                                        data-toggle="tooltip" data-placement="bottom" title="Edit Team">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="editTeamModel" tabindex="-1"
                                                     aria-labelledby="modalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalLabel">Edit Team</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <x-Team-form :club="$club" :team="$team"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </li>

                                            <li class="list-inline-item">
                                                <button class="btn btn-outline-secondary border-0 d-flex" type="button"
                                                        onclick="$(this).siblings('#addPlayerModel').modal('show')"
                                                        data-toggle="tooltip" data-placement="bottom"
                                                        title="Add Player in Team">
                                                    <i class="fas fa-user-plus"></i>
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="addPlayerModel" tabindex="-1"
                                                     aria-labelledby="modalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalLabel">Add Player</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <x-player-form :club="$club" :team="$team"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </li>

                                        </ul>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="3">

                                    {{--Team Players--}}
                                    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#playersCollapse{{ $team_counter }}" aria-expanded="false" aria-controls="playersCollapse">
                                        Team Players <i class="fa fa-sort-down"></i>
                                    </button>

                                    <table class="px-4 collapse table table-bordered mt-3" id="playersCollapse{{ $team_counter }}">
                                        <thead>
                                            <tr>
                                                <th>Rank</th>
                                                <th>Player Name</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $player_counter = 0;?>

                                        @foreach($team->players()->orderBy('ranking')->get() as $player)
                                            <?php $player_counter++?>
                                            <tr>
                                                <td>{{ $player_counter }}</td>
                                                <td>{{ $player->user->name }}</td>
                                                <td>
                                                    {{--Action Buttons--}}
                                                    <ul class="list-inline">

                                                        <li class="list-inline-item">
                                                            <form action="{{ route('remove_player_from_team', [$team, $player]) }}" method="post"
                                                                  class="action-form form-inline">
                                                                @csrf
                                                                @method('DELETE') {{--Will call the delete method of route--}}
                                                                <button class="btn btn-outline-danger border-0" type="button"
                                                                        onclick="removePlayerFromTeam(this)" data-toggle="tooltip"
                                                                        data-placement="top" title="Remove player from this team">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </li>

                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>

                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        @endforeach
        <div class="d-flex justify-content-center mt-3">
            {{ $clubs->links() }}

        </div>


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

        function deleteTeam(buttonObject) {
            // Display confirmation dialog for deleting the club
            bootbox.confirm("Are you sure you want to delete this Team? ", function (result) {

                // Submit the form if user selects to delete the club
                if (result === true) {
                    $(buttonObject).parents('.action-form').submit();
                }
            });
        }

        function removePlayerFromTeam(buttonObject) {

            bootbox.confirm("Are you sure you want to remove the player? It will only remove the player from this team!", function (result) {

                if (result === true) {
                    $(buttonObject).parents('.action-form').submit();
                }
            });
        }

        function removePlayerFromClub(buttonObject) {

            bootbox.confirm("Are you sure you want to remove the player? It will also remove the " +
                "player from the related teams of the selected club!", function (result) {

                if (result === true) {
                    $(buttonObject).parents('.action-form').submit();
                }
            });
        }

    </script>

@endsection