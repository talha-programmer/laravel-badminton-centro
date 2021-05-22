@extends('layouts.dashboard_layout')

@section('dashboard_content')
    <div class="container">

        <div class="row mb-3 mx-3">
            <div class="col-6">

                <button class="btn btn-secondary btn-block" data-toggle="modal" data-target="#addProductModel">
                    New Product
                    <i class="fas fa-plus"></i>
                </button>
                <!-- Modal -->
                <div class="modal fade" id="addProductModel" tabindex="-1"
                     aria-labelledby="modalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel">Add New Product</h5>
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <x-product-form/>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-6">

                <button class="btn btn-secondary btn-block" data-toggle="modal" data-target="#addCategoryModel">
                    New Category
                    <i class="fas fa-plus"></i>
                </button>
                <!-- Modal -->
                <div class="modal fade" id="addCategoryModel" tabindex="-1"
                     aria-labelledby="modalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel">Add New Category</h5>
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <x-category-form/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="row row-cols-1 row-cols-md-2 mx-3">
            @foreach($products as $product)
                <div class="col mb-4">
                    <div class="card">
                        <img src="{{ asset($product->image_url? $product->image_url : 'images/image.png') }}" class="card-img-top" style="object-fit: {{ $product->image_url ? 'contain': 'cover'}}" alt="">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <span class="text-primary">Price: {{ __('currency.code') }} {{ $product->price }}</span>
                            <p>
                                Categories:
                                @foreach($product->categories as $category)
                                    <span class="bg-secondary text-white px-1">{{ $category->name }} </span> &nbsp;
                                @endforeach
                            </p>
                            <h5>Description:</h5>
                            <p class="card-text">{{ $product->description }}</p>

                            <hr>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <p class="font-weight-bold">Actions:</p>
                                    <div class="action-buttons">
                                        <ul class="list-inline">

                                            <li class="list-inline-item">
                                                <form action="{{ route('destroy_product', $product) }}" method="post"
                                                      class="action-form form-inline">
                                                    @csrf
                                                    @method('DELETE') {{--Will call the delete method of route--}}
                                                    <button class="btn btn-outline-danger border-0" type="button"
                                                            onclick="deleteProduct(this)" data-toggle="tooltip"
                                                            data-placement="bottom" title="Delete Product">
                                                        <i class="fas fa-trash fa-2x"></i>
                                                    </button>
                                                </form>
                                            </li>

                                            <li class="list-inline-item">
                                                <button class="btn btn-outline-secondary border-0 d-flex" type="button"
                                                        onclick="$(this).siblings('#addProductModel').modal('show')"
                                                        data-toggle="tooltip" data-placement="bottom" title="Edit Product">
                                                    <i class="fas fa-edit fa-2x"></i>
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="addProductModel" tabindex="-1"
                                                     aria-labelledby="modalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalLabel">Edit Product</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <x-product-form :product="$product"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </li>

                                            @if($product->image_url)
                                                {{--Display the icon to delete the image--}}
                                                <li class="list-inline-item">
                                                    <form action="{{ route('destroy_product_image', $product) }}" method="post"
                                                          class="action-form form-inline">
                                                        @csrf
                                                        @method('DELETE') {{--Will call the delete method of route--}}
                                                        <button class="btn btn-outline-danger border-0" type="button"
                                                                onclick="deleteProductImage(this)" data-toggle="tooltip"
                                                                data-placement="bottom" title="Delete Product Image">
                                                            <i class="fas fa-eraser fa-2x"></i>
                                                        </button>
                                                    </form>
                                                </li>
                                            @endif

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
            {{ $products->links() }}

        </div>




    </div>

    <script>
        function deleteProduct(buttonObject) {
            // Display confirmation dialog for deleting the product
            bootbox.confirm("Are you sure you want to delete this Product?", function (result) {

                // Submit the form if user selects to delete the product
                if (result === true) {
                    $(buttonObject).parents('.action-form').submit();
                }
            });
        }

        function deleteProductImage(buttonObject) {
            // Display confirmation dialog for deleting the product image
            bootbox.confirm("Are you sure you want to delete the image of this product?", function (result) {

                // Submit the form if user selects to delete the product image
                if (result === true) {
                    $(buttonObject).parents('.action-form').submit();
                }
            });
        }



    </script>

    {{--These styles will be added in the style tag inside <head>--}}
    @push('style_tag')
        {{--fixed size for all card images--}}
        .card-img-top {
            width: 100%;
            height: 15vw;
            object-fit: contain;
        }
    @endpush
@endsection
