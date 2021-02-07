@extends('layouts.app')

@section('content')
    <div class="container-fluid">


        <div class="row">
            <div class="col-md-3 min-vh-100 px-0 bg-primary">
                <!-- Sidebar -->
                <div class=" border-right" >
                    <div class="list-group list-group-flush">
                         @foreach(\App\Services\UserServices::getAllowedRoutes() as $routes => $route)
                            <a href="{{ route($route['name']) }}" class="list-group-item list-group-item-action bg-primary pl-3 text-white">{{ $route['description'] }}</a>
                        @endforeach

                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="row justify-content-center my-4">

                        @yield('dashboard_content')

                </div>
            </div>

        </div>
    </div>

    <script>

        $(document).ready(function () {
            /*Initializing Tooltips*/
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        });

    </script>
@endsection
