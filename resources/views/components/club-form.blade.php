<form method="POST" action="{{ route('add_club') }}">
    @csrf

    @if($club)
        <input type="hidden" value="{{ $club->id }}" name="club_id">
    @endif

    @if($clubOwners)       {{--Only admin or director can select different club owners--}}
        <div class="form-group row">
            <label for="club_owner" class="col-md-3 offset-1 col-form-label">Select Owner</label>
            <div class="col-md-6">
                <select id="club_owner" class="form-control" name="club_owner">
                    @foreach($clubOwners as $club_owner)
                        <option value="{{ $club_owner->id }}" {{ $isSelected($club->clubOwner->id)? 'selected="selected"' : "" }}>
                            {{ $club_owner->user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif

    <div class="form-group row">
        <label for="name" class="col-md-3 offset-1 col-form-label">Club Name</label>
        <div class="col-md-6">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                   value="{{ $club? $club->name : ""  }}" required autofocus>
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="city" class="col-md-3 offset-1 col-form-label">City</label>

        <div class="col-md-6">
            <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city"
                   value="{{ $club? $club->city : "" }}" required autocomplete="email">

            @error('city')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="address" class="col-md-3 offset-1 col-form-label">Address</label>

        <div class="col-md-6">
            <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address"
                   value="{{ $club? $club->address : "" }}" autofocus>

            @error('address')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
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