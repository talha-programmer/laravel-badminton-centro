@extends('layouts.dashboard_layout')

@section('dashboard_content')

    <div class="row justify-content-center my-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Club</div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                        <form method="POST" action="{{ route('add_club') }}">
                            @csrf

                            @if($club_owners)       {{--Only admin or director can select different club owners--}}
                                <div class="form-group row">
                                    <label for="club_owner" class="col-md-4 col-form-label text-md-right">Select Owner</label>
                                    <div class="col-md-6">
                                        <select id="club_owner" class="form-control" name="club_owner">
                                            @foreach($club_owners as $club_owner)
                                                <option value="{{ $club_owner->id }}">{{ $club_owner->user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif

                            <div class="form-group row">
                                <label for="club_name" class="col-md-4 col-form-label text-md-right">Club Name</label>
                                <div class="col-md-6">
                                    <input id="club_name" type="text" class="form-control @error('club_name') is-invalid @enderror" name="club_name" value="{{ old('club_name') }}" required autofocus>
                                    @error('club_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="city" class="col-md-4 col-form-label text-md-right">City</label>

                                <div class="col-md-6">
                                    <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="email">

                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" autofocus>

                                    @error('address')
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




@endsection
