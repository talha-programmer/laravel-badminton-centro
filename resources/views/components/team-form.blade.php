<form method="POST" action="{{ route('add_team', $club) }}">
    @csrf

    <div class="row">
        <div class="col-md-3 offset-1">
            <strong>Selected Club</strong>
        </div>
        <div class="col-md-6">
            <strong>{{ $club->name }}</strong>
        </div>
    </div>

    <div class="form-group row mt-3">
        <label for="name" class="col-md-3 offset-1 col-form-label">Team Name</label>
        <div class="col-md-6">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                   value="{{ old('name') }}" required autofocus>
            @error('name')
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