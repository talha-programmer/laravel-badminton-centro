@extends('layouts.dashboard_layout')

@section('dashboard_content')

    <div class="row justify-content-center my-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Add Match</div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('add_match') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="team_one" class="col-md-4 col-form-label text-md-right">Select Team One</label>
                            <div class="col-md-6">
                                <select id="team_one" class="form-control" name="team_one">
                                    @foreach($teams as $team)
                                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="team_two" class="col-md-4 col-form-label text-md-right">Select Team Two</label>
                            <div class="col-md-6">
                                <select id="team_two" class="form-control" name="team_two">
                                    @foreach($teams as $team)
                                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Venue</label>
                            <div class="col-md-6">
                                <input id="venue" type="text" class="form-control @error('venue') is-invalid @enderror" name="venue" value="{{ old('venue') }}" required autofocus>
                                @error('venue')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="match_time" class="col-md-4 col-form-label text-md-right">Time</label>

                            <div class="col-md-6">
                                <input id="match_time" type="text" class="form-control datetimepicker @error('match_time') is-invalid @enderror" name="match_time" value="{{ old('match_time') }}" required>

                                @error('match_time')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function () {
            $('.datetimepicker').datetimepicker();
        });
    </script>


@endsection
