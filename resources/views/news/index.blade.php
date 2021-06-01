@extends('layouts.dashboard_layout')

@section('dashboard_content')
    <div class="container">

        <div class="row mb-3 mx-3">
            <div class="col-6">
                <button class="btn btn-secondary btn-block" data-toggle="modal" data-target="#addNewsModel">
                New News
                    <i class="fas fa-plus"></i>
                </button>
                <!-- Modal -->
                <div class="modal fade" id="addNewsModel" tabindex="-1"
                     aria-labelledby="modalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel">Add New News</h5>
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <x-news-form/>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="row row-cols-1 row-cols-md-2 mx-3">
            @foreach($news as $single_news)
                <div class="col mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ \Illuminate\Support\Str::limit($single_news->title, 50, '...') }}</h5>
                            <p class="card-subtitle text-secondary">{{ $single_news->created_at->diffForHumans() }}</p>

                            <p class="card-text">{{ \Illuminate\Support\Str::limit($single_news->details, 150, '...' )}}</p>

                                <a class="btn btn-secondary "
                                   href="{{ route('single_news', $single_news) }}">
                                    Read More
                                </a>


                            <hr>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <p class="font-weight-bold">Actions:</p>
                                    <div class="action-buttons">
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <form action="{{ route('destroy_news', $single_news) }}" method="post"
                                                      class="action-form form-inline">
                                                    @csrf
                                                    @method('DELETE') {{--Will call the delete method of route--}}
                                                    <button class="btn btn-outline-danger border-0" type="button"
                                                            onclick="deleteNews(this)" data-toggle="tooltip"
                                                            data-placement="bottom" title="Delete News">
                                                        <i class="fas fa-trash fa-2x"></i>
                                                    </button>
                                                </form>
                                            </li>

                                            <li class="list-inline-item">
                                                <button class="btn btn-outline-secondary border-0 d-flex" type="button"
                                                        onclick="$(this).siblings('#addNewsModel').modal('show')"
                                                        data-toggle="tooltip" data-placement="bottom" title="Edit News">
                                                    <i class="fas fa-edit fa-2x"></i>
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="addNewsModel" tabindex="-1"
                                                     aria-labelledby="modalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalLabel">Edit News</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <x-news-form :news="$single_news"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </li>

                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


        <div class="d-flex justify-content-center">
            {{--links for pagination--}}

        </div>




    </div>

    <script>
        function deleteNews(buttonObject) {
            // Display confirmation dialog for deleting the product
            bootbox.confirm("Are you sure you want to delete this News?", function (result) {

                // Submit the form if user selects to delete the product
                if (result === true) {
                    $(buttonObject).parents('.action-form').submit();
                }
            });
        }




    </script>

    {{--These styles will be added in the style tag inside <head>--}}
    @push('style_tag')

    @endpush
@endsection
