@extends('layouts.dashboard_layout')

@section('dashboard_content')
    <div class="container">
       
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">All Players</div>

                    <div class="card-body">
                        <table class="px-4 table table-bordered mt-3">
                            <thead>
                            <tr>
                                <th>Sr.</th>
                                <th>Player Name</th>
                                <th>Clubs Joined</th>
                                <th>Teams Joined</th>
                                <th>Matches Played</th>
                                <th>Won</th>
                                <th>Lost</th>
                                <th>Tied</th>
                                <th>Total Points</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $player_counter = 0;?>

                            @foreach($players as $player)
                                <?php $player_counter++?>
                                <tr>
                                    <td>{{ $player_counter }}</td>
                                    <td>{{ $player->user->name }}</td>
                                    <td>{{ $player->clubsJoined() }}</td>
                                    <td>{{ $player->teamsJoined() }}</td>

                                    <td>{{ $player->total_matches }}</td>
                                    <td>{{ $player->won_matches }}</td>
                                    <td>{{ $player->lost_matches }}</td>
                                    <td>{{ $player->tied_matches }}</td>
                                    <td>{{ $player->points }}</td>

                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

                <div class="d-flex justify-content-center">
                    {{ $players->links() }}
                </div>


            </div>
        </div>
    </div>
    

@endsection
