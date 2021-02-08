@extends('layouts.dashboard_layout')

@section('dashboard_content')
    <div class="container">

        <div class="row justify-content-center mb-3">
            <div class="col-md-8">
                <button class="btn btn-secondary btn-block" data-toggle="modal" data-target="#addRequestModel">
                    Initiate Request
                    <i class="fas fa-plus"></i>
                </button>
                <!-- Modal -->
                <div class="modal fade" id="addRequestModel" tabindex="-1"
                     aria-labelledby="modalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel">Challenge a Player</h5>
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <x-challenge-form/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Challenge Requests Send</div>

                    <div class="card-body">
                        <div class="overflow-auto">
                            <table class="px-4 table table-bordered mt-3" >
                                <thead>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Send To</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php $request_counter = 0;?>


                                @foreach($requests_send as $request_send)
                                    <?php $request_counter++?>
                                    <tr>
                                        <td>{{ $request_counter }}</td>
                                        <td>{{ $request_send->challengedPlayer->user->name }}</td>
                                        <td>{{ $request_send->created_at }}</td>
                                        <td>{{ \App\Enums\ChallengeStatus::getDescription($request_send->status) }}</td>
                                        <td>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <form action="{{ route('destroy_challenge') }}" method="post"
                                                          class="action-form form-inline">
                                                        @csrf
                                                        <input type="hidden" value="{{ $request_send->id }}" name="challenge_id">

                                                        <button class="btn btn-outline-danger border-0" type="button"
                                                                onclick="deleteChallenge(this)" data-toggle="tooltip"
                                                                data-placement="bottom" title="Delete Request">
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

                <div class="card my-5">
                    <div class="card-header">Challenge Requests Received</div>

                    <div class="card-body">
                        <div class="overflow-auto">
                            <table class="px-4 table table-bordered mt-3" >

                                <thead>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Received From</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $request_counter = 0;?>


                                @foreach($requests_received as $request_received)
                                    <?php $request_counter++?>
                                    <tr>
                                        <td>{{ $request_counter }}</td>
                                        <td>{{ $request_received->challengerPlayer->user->name }}</td>
                                        <td>{{ $request_received->created_at }}</td>
                                        <td>{{ \App\Enums\ChallengeStatus::getDescription($request_received->status) }}</td>
                                        <td>
                                            @if(\App\Enums\ChallengeStatus::fromValue($request_received->status)->is(\App\Enums\ChallengeStatus::Pending))
                                                <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <form action="{{ route('accept_challenge') }}" method="post"
                                                          class="action-form form-inline">
                                                        @csrf
                                                        <input type="hidden" value="{{ $request_received->id }}" name="challenge_id">

                                                        <button class="btn btn-outline-primary border-0" type="submit"
                                                                data-toggle="tooltip"
                                                                data-placement="bottom" title="Accept Challenge">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </form>
                                                </li>

                                                <li class="list-inline-item">
                                                    <form action="{{ route('reject_challenge') }}" method="post"
                                                          class="action-form form-inline">
                                                        @csrf
                                                        <input type="hidden" value="{{ $request_received->id }}" name="challenge_id">
                                                        <button class="btn btn-outline-danger border-0" type="submit"
                                                                data-toggle="tooltip"
                                                                data-placement="bottom" title="Reject Challenge">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                            @endif


                                        </td>

                                    </tr>
                                @endforeach
                            </table>

                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>

    <script>


        function deleteChallenge(buttonObject) {
            bootbox.confirm("Are you sure you want to delete this Challenge Request?", function (result) {

                if (result === true) {
                    $(buttonObject).parents('.action-form').submit();
                }
            });
        }
    </script>


@endsection
