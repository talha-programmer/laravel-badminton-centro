@extends('layouts.dashboard_layout')

@section('dashboard_content')
    <div class="container">
        <div class="row justify-content-center mb-3">
            <div class="col-md-8">
                <a href="{{ route('add_user') }}" class="btn btn-secondary" >
                    New User
                    <i class="fas fa-user-plus"></i>
                </a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">All Users</div>

                    <div class="card-body">
                        <table class="px-4 table table-bordered mt-3">
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

                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
