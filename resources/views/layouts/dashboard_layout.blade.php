@extends('layouts.app')

@section('content')
    <div class="container-fluid" id="dashboard_container">


        <div class="row">
            <div class="col-md-2 min-vh-100 px-0 bg-primary">
                <!-- Sidebar -->
                <div class=" border-right" >
                    <div class="list-group list-group-flush">
                         @foreach(\App\Services\UserServices::getAllowedRoutes() as $routes => $route)
                            <a href="{{ route($route['name']) }}" class="list-group-item list-group-item-action bg-primary pl-3 text-white"><i class="{{ $route['icon_class'] }}"></i> &nbsp;{{ $route['description'] }}</a>
                        @endforeach

                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="row justify-content-center my-4">

                        @yield('dashboard_content')

                </div>
            </div>

        </div>
    </div>

    <style>

    #dashboard_container {
            background-image: url("{{ asset('images/dashboard-bg.png') }}");
            background-size: auto;
            background-repeat: no-repeat;
        }
    
    </style>

    <script>

        $(document).ready(function () {
            /*Initializing Tooltips*/
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        });

    </script>
@endsection
