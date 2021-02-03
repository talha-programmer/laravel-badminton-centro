@extends('layouts.app')

@section('content')

    <div class="px-2 px-lg-0">
        <div class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 p-5 bg-white rounded shadow-lg mb-5">

                        <!-- Shopping cart table -->
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="p-2 px-3 text-uppercase">Product</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Price</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Quantity</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Remove</div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(session('cart.products') as $product)
                                    <tr>
                                        <th scope="row" class="border-0">
                                            <div class="p-2">
                                                <img src="{{ asset($product['image_url'] !=null ? $product['image_url'] : 'images/image.png')}}"
                                                     alt="" width="70" class="img-fluid rounded shadow-sm">
                                                <div class="ml-3 d-inline-block align-middle">
                                                    <h5 class="mb-0"><a href="#"
                                                                        class="text-dark d-inline-block align-middle">{{ $product['name'] }}</a>
                                                    </h5><span
                                                            class="text-muted font-weight-normal font-italic d-block">Category: Watches</span>
                                                </div>
                                            </div>
                                        </th>
                                        <td class="border-0 align-middle">
                                            <strong>{{ __('currency.code') }} {{ $product['price'] }}</strong></td>
                                        <td class="border-0 align-middle"><strong>{{ $product['quantity'] }}</strong>
                                        </td>
                                        <td class="border-0 align-middle"><a href="#"
                                                                             onclick="deleteProduct({{$product['id']}})"
                                                                             class="text-danger"><i
                                                        class="fas fa-trash"></i></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- End -->
                    </div>
                </div>

                <div class="row py-5 p-4 bg-white rounded shadow-lg">
                    <form action="{{ route('save_order') }}" method="post" class="d-flex">
                        @csrf
                        <div class="col-lg-6">
                            <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Payment Options
                            </div>
                            <div class="p-4">
                                Payment Option: Cash On Delivery
                            </div>
                            <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Shipping Details
                            </div>
                            <div class="p-4">

                                <div class="form-group row">
                                    <label for="customer_name" class="col-md-4 col-form-label">Customer Name</label>
                                    <div class="col-md-8">
                                        <input id="customer_name" type="text" class="form-control" name="customer_name"
                                               value="{{ $user->name }}" disabled autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label">Email</label>
                                    <div class="col-md-8">
                                        <input id="email" type="text" class="form-control" name="email"
                                               value="{{ $user->email }}" disabled  autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="address" class="col-md-4 col-form-label">Address</label>
                                    <div class="col-md-8">
                                        <input id="address" type="text" class="form-control" name="address"
                                               @if($user->address) value="{{ $user->address }}"  @endif required autofocus>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Order summary</div>
                            <div class="p-4">
                                <p class="font-italic mb-4">Shipping and additional costs are calculated based on values you
                                    have entered.</p>
                                <ul class="list-unstyled mb-4">
                                    <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                                class="text-muted">Order
                                            Subtotal </strong><strong>{{ __('currency.code') }} {{ session('cart.total_price') }}</strong>
                                    </li>
                                    <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                                class="text-muted">Shipping Cost</strong><strong>{{ __('currency.code') }} {{ session('cart.delivery_charges') }}</strong></li>
                                    <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                                class="text-muted">Total</strong>
                                        <h5 class="font-weight-bold">{{ __('currency.code') }} {{ session('cart.grand_total') }}</h5>
                                    </li>
                                </ul>
                                <button type="submit" class="btn btn-primary rounded-pill py-2 btn-block">Proceed to checkout</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>



    <style>
        @push('style_tag')


        @endpush
    </style>

@endsection
