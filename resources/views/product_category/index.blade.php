@extends('layouts.dashboard_layout')

@section('dashboard_content')
    <div class="container">
        <div class="row justify-content-center mb-3">
            <div class="col-md-8">
                <button class="btn btn-secondary btn-block" data-toggle="modal" data-target="#addCategoryModel">
                    New Product Category
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
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">All Product Categories</div>

                    <div class="card-body">
                        <table class="px-4 table table-bordered mt-3">
                            <thead>
                            <tr>
                                <th>Sr.</th>
                                <th>Category Name</th>
                                <th>Total Products</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $category_counter = 0;?>

                            @foreach($categories as $category)
                                <?php $category_counter++?>
                                <tr>
                                    <td>{{ $category_counter }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->products->count() }}</td>
                                    <td>
                                        {{--Action Buttons--}}
                                        <ul class="list-inline">

                                            <li class="list-inline-item">
                                                <form action="{{ route('destroy_category', $category) }}" method="post"
                                                      class="action-form form-inline">
                                                    @csrf
                                                    @method('DELETE') {{--Will call the delete method of route--}}
                                                    <button class="btn btn-outline-danger border-0" type="button"
                                                            onclick="deleteCategory(this)" data-toggle="tooltip"
                                                            data-placement="bottom" title="Delete Category">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </li>

                                            <li class="list-inline-item">
                                                <button class="btn btn-outline-secondary border-0 d-flex" type="button"
                                                        onclick="$(this).siblings('#addCategoryModel').modal('show')"
                                                        data-toggle="tooltip" data-placement="bottom" title="Edit Category">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="addCategoryModel" tabindex="-1"
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
                                                                <x-category-form :category="$category"/>
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


                <div class="d-flex justify-content-center">
                    {{ $categories->links() }}

                </div>


            </div>
        </div>
    </div>

    <script>
        function deleteCategory(buttonObject) {
            // Display confirmation dialog for deleting the category
            bootbox.confirm("Are you sure you want to delete this category?", function (result) {

                // Submit the form if user selects to delete the category
                if (result === true) {
                    $(buttonObject).parents('.action-form').submit();
                }
            });
        }

    </script>
@endsection
