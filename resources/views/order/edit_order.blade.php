@extends('layouts.dashboard_layout')

@section('dashboard_content')

    <div class="row justify-content-center my-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Order</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('update_order', $order) }}">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        @if(session('cart_private'))
                            <div class="row justify-content-center">
                                <div class="col-6 mb-3">
                                    <h5>Customer Name: {{ $order->user->name }}</h5>
                                </div>
                            </div>
                            <div class="form-group row justify-content-center">
                                <label for="order_status" class="col-md-3 col-form-label ">Order Status:</label>
                                <div class="col-md-6">
                                    <select id="order_status" class="form-control select2"  name="order_status">
                                        @foreach(\App\Enums\OrderStatus::asSelectArray() as $value => $name)
                                            <option value="{{ $value }}" @if($order->status == $value) selected @endif>{{ $name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <div class="form-group row justify-content-center">
                                <label for="delivery_date" class="col-md-3 col-form-label ">Delivery Date:</label>
                                <div class="col-md-6">
                                    <input id="delivery_date" type="text" class="form-control datetimepicker"
                                           name="delivery_date" value="{{ $order->delivery_date !=null ? \Carbon\Carbon::create($order->delivery_date)->format('d/m/Y') : "" }}"  autofocus>

                                </div>
                            </div>

                            <div class="form-group row justify-content-center">
                                <label for="add_product" class="col-md-3 col-form-label ">Add Product:</label>
                                <div class="col-md-6">
                                    <select id="add_product" class="form-control select2"  name="add_product">
                                        <option value="-1" selected>--Select Product--</option>
                                    </select>

                                </div>
                            </div>
                            <hr>

                            @foreach(session('cart_private.products') as $product)

                                <div class="row cart-detail justify-content-center">
                                    <div class="col-lg-3 col-sm-3 col-3 cart-detail-img">
                                        <img src="{{ asset($product['image_url'] !=null ? $product['image_url'] : 'images/image.png')}}" class="pl-0">
                                    </div>
                                    <div class="col-lg-7 col-sm-7 col-7 offset-1 cart-detail-product">
                                        <p>{{ $product['name'] }}</p>
                                        <span class="price text-info">{{ __('currency.code') }} {{ $product['price'] }}</span>
                                        <span class="count"> Quantity: </span>
                                        <input type="number" step="1" min="1" id="product_quantity" class="d-inline w-25" name="quantity" value="{{ $product['quantity'] }}" onchange="updatePrivateProduct({{ $product['id'] }}, this.value)" >

                                        <a href="#" class="btn btn-outline-danger border-0 ml-2 my-0"
                                           onclick="deletePrivateProduct({{$product['id']}})">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                            <hr>
                            <div class="row justify-content-center">
                                <div class="col-8">
                                    <ul class="list-unstyled mb-4">
                                        <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                                    class="text-muted">Order
                                                Subtotal </strong><strong>{{ __('currency.code') }} {{ session('cart_private.total_price') }}</strong>
                                        </li>
                                        <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                                    class="text-muted">Shipping Cost</strong><strong>{{ __('currency.code') }} {{ session('cart_private.delivery_charges') }}</strong></li>
                                        <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                                    class="text-muted">Total</strong>
                                            <h5 class="font-weight-bold">{{ __('currency.code') }} {{ session('cart_private.grand_total') }}</h5>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary btn-block py-2">Save Order</button>
                                </div>
                            </div>

                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>

        $('.datetimepicker').datetimepicker({
            sideBySide: true,
            format: 'DD/MM/yyyy',
        });

        function deletePrivateProduct(productId){
            bootbox.confirm("Are you sure you want to remove this product from the order?", function (result) {
                if (result === true) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        }
                    });
                    $.ajax({
                        url:"{{ route('delete_from_cart') }}",
                        type: "POST",
                        data: {
                            'product_id' : productId,
                            'private_cart': true,
                        },
                        success: function (response){
                            if(response[0] === 'info' ){
                                //bootbox.alert(response[1]);
                                location.reload();

                            }

                        },
                    });
                }
            });

        }

        function updatePrivateProduct(productId, quantity){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                url:"{{ route('update_product_quantity') }}",
                type: "POST",
                data: {
                    'product_id' : productId,
                    'quantity' : quantity,
                    'private_cart': true,
                },
                success: function (response){
                    console.log(response);
                    if(response[0] === 'info' ){
                        location.reload();
                    }

                },
            });
        }

        // Initialize select2
        $('.select2').select2({
            width: '100%',

        });

        // Add all the products as options in add product select tag
        @foreach($all_products as $product)
            var option = new Option('{{$product->name}}', {{ $product->id }}, false, false);
            $('#add_product').append(option).trigger('change');
        @endforeach

        $('#add_product').change(function (){
            console.log('function called');
            let productId = this.value;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                url:"{{ route('add_to_cart') }}",
                type: "POST",
                data: {
                    'product_id' : productId,
                    'private_cart': true,
                },
                success: function (response){
                    console.log(response);
                    if(response[0] === 'info' ){
                        location.reload();
                    }

                },
            });
        });

    </script>


@endsection
