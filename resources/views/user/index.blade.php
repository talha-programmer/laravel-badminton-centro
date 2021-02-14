@extends('layouts.dashboard_layout')

@section('dashboard_content')
    <div class="container">
        <div class="row justify-content-center mb-3">

        </div>

        <div class="row">

            <div class="col-md-6">
                <a href="{{ route('add_user') }}" class="btn btn-secondary btn-block" >
                    New User
                    <i class="fas fa-user-plus"></i>
                </a>
            </div>

            <div class="col-md-5 offset-1 ">

                <form action="{{ route('users') }}" id="user_type_form" method="GET">
                <div class="form-group row ">
                    <label for="user-type" class="col-md-4 col-form-label "><strong>User Type</strong></label>

                    <div class="col-md-8">
                        <select id="user-type" class="form-control" name="user_type" onchange="$('#user_type_form').submit()">
                            <option value="-1" @if($user_type == -1) selected @endif>All Users</option>
                            @foreach(\App\Enums\UserTypes::asSelectArray() as $type_value=>$type_name)
                                <option value="{{ $type_value }}" @if($user_type == $type_value) selected @endif>{{ $type_name }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                </form>
            </div>

        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">All Users</div>

                    <div class="card-body">
                        <table class="px-4 chan-1 table table-bordered mt-3">
                            <thead>
                            <tr>
                                <th>Sr.</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>User Type</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $user_counter = 0;?>

                            @foreach($users as $user)
                                <?php $user_counter++?>
                                <tr>
                                    <td>{{ $user_counter }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ \App\Enums\UserTypes::fromValue($user->user_type)->description }}</td>
                                    <td>
                                        {{--Action Buttons--}}
                                        <ul class="list-inline m-0">

                                            <li class="list-inline-item">
                                                <form action="{{ route('destroy_user', $user) }}" method="post"
                                                      class="action-form form-inline">
                                                    @csrf
                                                    @method('DELETE') {{--Will call the delete method of route--}}
                                                    <button class="btn btn-outline-danger border-0 my-0" type="button"
                                                            onclick="deleteUser(this)" data-toggle="tooltip"
                                                            data-placement="bottom" title="Delete User">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </li>

                                            <li class="list-inline-item">
                                                <button class="btn btn-outline-secondary border-0" type="button"
                                                        onclick="$(this).siblings('#updateProfileModal').modal('show')"
                                                        data-toggle="tooltip" data-placement="bottom" title="Edit User">
                                                     <i class="fas fa-edit"></i>
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="updateProfileModal" tabindex="-1"
                                                     aria-labelledby="modalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalLabel">Edit User</h5>
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

                                            </li>

                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>


                <div class="d-flex justify-content-center mt-4">
                    {{ $users->links() }}

                </div>


            </div>
        </div>
    </div>

    <style>
        .chan-1 {
            color: #777;
        }
    </style>

    <script>
        function deleteUser(buttonObject) {
            // Display confirmation dialog for deleting the category
            bootbox.confirm("Are you sure you want to delete this user?", function (result) {

                // Submit the form if user selects to delete the category
                if (result === true) {
                    $(buttonObject).parents('.action-form').submit();
                }
            });
        }

    </script>
@endsection
