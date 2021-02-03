<form method="POST" action="{{ route('add_match_result', $match) }}">
    @csrf

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