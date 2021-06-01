@extends('layouts.app')

@section('content')

@include('public.layouts.header')

{{--Products--}}
<div class="container-fluid py-4 " >

    <div class="row justify-content-center">
        <div class="col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $single_news->title }}</h5>
                        <p class="card-subtitle text-secondary">{{ $single_news->created_at->diffForHumans() }}</p>

                        <p class="card-text">{{ $single_news->details }}</p>


                    </div>
                </div>
            </div>
    </div>

</div>







@endsection
