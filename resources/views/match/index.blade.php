@extends('layouts.dashboard_layout')

@section('dashboard_content')
    <div class="container">
        <div class="row">
            <div class="col-md-7 offset-2">

                <div class="row mb-4">
                    <div class="col-md-8">
                        <button class="btn btn-secondary" data-toggle="modal" data-target="#addMatchModel">
                            New Match
                            <i class="fas fa-plus"></i>
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="addMatchModel" tabindex="-1"
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
                                        <x-match-form/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @foreach($matches as $match)
                    <div class="card p-3 my-2">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title">Between {{ $match->teamOne->name }} &amp; {{ $match->teamTwo->name }}</h5>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                Time
                            </div>
                            <div class="col-md-8">
                                {{ \Carbon\Carbon::create($match->match_time)->format('l jS F Y \\, h:i A') }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                Venue
                            </div>
                            <div class="col-md-8">
                                {{ $match->venue }}
                            </div>
                        </div>


                        <h5 class="mt-3">Players</h5>
                        <table class="px-4 table table-bordered">
                            <thead>
                            <tr>
                                <th>Sr.</th>
                                <th>{{ $match->teamOne->name }}</th>
                                <th>{{ $match->teamTwo->name }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $player_counter = 1;?>
                            <?php
                                $all_players = array();
                                foreach ($match->teamOnePlayers() as $player){
                                    $all_players[$player_counter] = array($player);
                                    $player_counter++;
                                }
                                
                                $player_counter = 1;
                                foreach ($match->teamTwoPlayers() as $player){
                                    array_push($all_players[$player_counter], $player);
                                    $player_counter++;
                                }
                            ?>

                            @foreach($all_players as $index=>$players)
                                <tr>
                                    <td>{{ $index }}</td>
                                    @foreach($players as $player)
                                        <td>{{ $player->user->name }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </table>

                        @if($match->team_one_points != null)    {{--If Match Result is added already--}}
                            <h5 class="mt-3">Match Result</h5>
                            <div class="row text-center">
                                <div class="col-5 border-right">
                                    <strong>{{ $match->teamOne->name }}</strong><br>
                                    @foreach($match->teamOnePlayers() as $player)
                                        {{ $player->user->name }}: {{ $player->pivot->points }} Points <br>
                                    @endforeach
                                </div>
                                <div class="col-5">
                                    <strong>{{ $match->teamTwo->name }}</strong> <br>
                                    @foreach($match->teamTwoPlayers() as $player)
                                        {{ $player->user->name }}: {{ $player->pivot->points }} Points
                                    @endforeach
                                </div>
                            </div>

                        @endif

                        <hr>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <p class="font-weight-bold">Actions:</p>
                                <div class="action-buttons">
                                    <ul class="list-inline">

                                        <li class="list-inline-item">
                                            <form action="{{ route('destroy_match', $match) }}" method="post"
                                                  class="action-form form-inline">
                                                @csrf
                                                @method('DELETE') {{--Will call the delete method of route--}}
                                                <button class="btn btn-outline-danger border-0" type="button"
                                                        onclick="deleteMatch(this)" data-toggle="tooltip"
                                                        data-placement="bottom" title="Delete Match">
                                                    <i class="fas fa-trash fa-2x"></i>
                                                </button>
                                            </form>
                                        </li>

                                        <li class="list-inline-item">
                                            <button class="btn btn-outline-secondary border-0 d-flex" type="button"
                                                    onclick="$(this).siblings('#addMatchModel').modal('show')"
                                                    data-toggle="tooltip" data-placement="bottom" title="Edit Match">
                                                <i class="fas fa-edit fa-2x"></i>
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="addMatchModel" tabindex="-1"
                                                 aria-labelledby="modalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalLabel">Edit Match</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <x-match-form :match="$match"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </li>

                                        <li class="list-inline-item">
                                            <button class="btn btn-outline-secondary border-0 d-flex" type="button"
                                                    onclick="$(this).siblings('#addResultModel').modal('show')"
                                                    data-toggle="tooltip" data-placement="bottom" title="Add/Edit Match Result">
                                                <i class="fas fa-poll fa-2x"></i>
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
                                </div>

                            </div>
                        </div>
                    </div>

                @endforeach

            </div>
        </div>

    </div>


<script>


    function deleteMatch(buttonObject) {
        // Display confirmation dialog for deleting the match
        bootbox.confirm("Are you sure you want to delete this Match?", function (result) {

            // Submit the form if user selects to delete the club
            if (result === true) {
                $(buttonObject).parents('.action-form').submit();
            }
        });
    }



</script>

@endsection
