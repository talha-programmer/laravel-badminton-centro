<div class="p-4">
    <div class="col bg-primary pb-2"
         style="min-height: 250px; border-radius: 10% 30%; opacity: 0.9;">
        <div class="text-white pt-4">
            <h5 class="float-left"><i class="fas fa-calendar"></i>
                {{ \Carbon\Carbon::create($match->match_time)->format('jS M y') }}
            </h5>
            <h5 class="float-right pr-3 pr-md-5">{{ \Carbon\Carbon::create($match->match_time)->format('h:i A') }}
                <i class="fas fa-clock"></i></h5>
            <br> <br>

            @if($match->tournament != null)
                <h3 class="text-center text-white py-2">Tournament: {{ $match->tournament->name }}</h3>
            @endif
            <div class="row text-center  text-uppercase mb-2"
                 style="line-height: 1.6;">
                <div class="col-5"><h4>{{ $match->teamOne->name }}</h4></div>
                <div class="col-1"></div>
                <div class="col-5"><h4>{{ $match->teamTwo->name }}</h4></div>

            </div>

            <div class="row">
                <div class="col-5">
                    <div class="row ml-2 justify-content-center">
                        @foreach($match->teamOnePlayers() as $player)
                            <div class="mr-2 text-center" style="max-width: 100px">
                                <a href="{{ route('public_single_player', $player) }}">
                                    <img src="{{ asset($player->user->profile_picture_url) }}" style="object-fit: cover;" width="70" height="70" class="rounded-circle"><br>
                                    <span class="text-white">{{ $player->user->name }}</span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-1">
                    <h2 style="line-height: 3;">VS</h2>
                </div>


                <div class="col-5">
                    <div class="row ml-2  justify-content-center">
                        @foreach($match->teamTwoPlayers() as $player)

                            <div class="mr-2 text-center" style="max-width: 100px">
                                <a href="{{ route('public_single_player', $player) }}">
                                    <img src="{{ asset($player->user->profile_picture_url) }}" style="object-fit: cover;" width="70" height="70"  class="rounded-circle"><br>
                                    <span class="text-white">{{ $player->user->name }}</span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>



            <br>
            <h5 style="font-style: italic;" class="text-center"><i
                    class="fas fa-map-marker-alt"></i> {{ $match->venue }} </h5>
        </div>
    </div>
</div>
