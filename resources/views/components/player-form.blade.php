<form method="POST" action="{{ route('add_player') }}">
    @csrf
    <input type="hidden" name="selected_club" value="{{ $club->id }}">
    <input type="hidden" name="selected_team" value="{{ $team->id }}">

    <div class="form-group row">
        <div class="col-md-4 offset-1">
            <strong>Selected Club</strong>
        </div>
        <div class="col-md-5">
            <strong>{{ $club->name }}</strong>
        </div>
    </div>



    <div class="form-group row">
        <div class="col-md-4 offset-1">
            <strong>Selected Team</strong>
        </div>
        <div class="col-md-5">
            @if($team->name != "")
                <strong>{{ $team->name }}</strong>
            @else
                <span class="text-muted">No team selected</span>
            @endif
        </div>
    </div>


    <div class="form-group row">
        <label for="player" class="col-md-4 offset-1 col-form-label">Select Player</label>

        <div class="col-md-5">
            <select id="player" class="form-control" name="player">
                @foreach($players as $player)
                    <option value="{{ $player->id }}">{{ $player->user->name }}</option>
                @endforeach
            </select>

        </div>

    </div>

    <div class="form-group row mb-0 mt-4">
        <div class="col-md-4 offset-md-4 ">
            <button type="submit" class="btn btn-primary w-100">
                <span class="font-weight-bold" style="font-size: large;">Save</span>
            </button>
        </div>
    </div>
</form>