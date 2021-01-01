@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User Profile</div>

                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-4">
                                Username
                            </div>
                            <div class="col-md-4">
                                {{ $user->username }}
                            </div>
                        </div>

                         <div class="row">
                            <div class="col-md-4">
                                Full Name
                            </div>
                            <div class="col-md-4">
                                {{ $user->name }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                E-mail Address
                            </div>
                            <div class="col-md-4">
                                {{ $user->email }}
                            </div>
                        </div>

                            <div class="row">
                                <div class="col-md-4">
                                    User Type
                                </div>
                                <div class="col-md-4">
                                    {{ \App\Enums\UserTypes::fromValue($user->user_type )->description }}
                                </div>
                            </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
