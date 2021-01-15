@extends('layouts.dashboard_layout')

@section('dashboard_content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-2">

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
                            <div class="col-md-3">
                                Match Time
                            </div>
                            <div class="col-md-8">
                                {{ \Carbon\Carbon::create($match->match_time)->format('l jS F Y \\, h:i A') }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                Venue
                            </div>
                            <div class="col-md-8">
                                {{ $match->venue }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <p>Players:</p>
                            </div>
                        </div>

                        <div class="row">
                        @foreach($match->teamOnePlayers() as $player)
                                <div class="col-md-2">
                                    {{ $player->user->name }}
                                </div>
                                <div class="col-md-1">vs</div>
                            @endforeach

                            @foreach($match->teamTwoPlayers() as $player)
                                <div class="col-md-3">
                                    {{ $player->user->name }}
                                </div>
                            @endforeach
                        </div>

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

    $(document).ready(function () {
        /*Initializing Tooltips*/
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    });

    function deleteMatch(buttonObject) {
        // Display confirmation dialog for deleting the match
        bootbox.confirm("Are you sure you want to delete this Match?", function (result) {

            // Submit the form if user selects to delete the club
            if (result === true) {
                $(buttonObject).parents('.action-form').submit();
            }
        });
    }


    @if(session('info'))
    bootbox.alert("{{ session('info') }}");
    @endif

    @if(session('error'))
    bootbox.alert("<span class = \"text-danger\">{{ session('error') }}</span>");
    @endif
</script>

@endsection
