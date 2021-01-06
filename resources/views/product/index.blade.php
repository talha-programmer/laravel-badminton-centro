@extends('layouts.dashboard_layout')

@section('dashboard_content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">All Products</div>

                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @foreach($products as $product)
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        Product Name
                                    </div>
                                    <div class="col-md-4">
                                        {{ $product->name }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        Price
                                    </div>
                                    <div class="col-md-4">
                                        {{ $product->price }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        Description
                                    </div>
                                    <div class="col-md-4">
                                        {{ $product->description }}
                                    </div>
                                </div>



                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
