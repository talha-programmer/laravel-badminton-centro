@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6 ">
                <div class="row justify-content-center mb-3">
                    <div class="col">
                        <button class="btn btn-secondary btn-block" type="button"
                                onclick="$(this).siblings('#updateProfileModal').modal('show')"
                                data-toggle="tooltip" data-placement="bottom" title="Update Profile">
                            Update Profile <i class="fas fa-edit"></i>
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="updateProfileModal" tabindex="-1"
                             aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel">Update Profile</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <x-user-form :user="$user"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col">
                        <button class="btn btn-secondary btn-block" type="button"
                                onclick="$(this).siblings('#updatePasswordModal').modal('show')"
                                data-toggle="tooltip" data-placement="bottom" title="Edit Category">
                            Update Password <i class="fas fa-user-lock"></i>
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="updatePasswordModal" tabindex="-1"
                             aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel">Change Password</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <x-user-password-form :user="$user"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
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
                                Address
                            </div>
                            <div class="col-md-4">
                                {{ $user->address }}
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
