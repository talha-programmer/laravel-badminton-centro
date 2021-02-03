@extends('layouts.dashboard_layout')

@section('dashboard_content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">All Orders</div>

                    <div class="card-body">
                        <?php $user = \App\Enums\UserTypes::fromValue(auth()->user()->user_type) ?>

                        <div style=" overflow: auto;">
                            <table class="px-4 table table-bordered mt-3" style="min-width: 1100px;">
                                <thead>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Customer Name</th>
                                    <th>Products</th>
                                    <th>Total Amount</th>
                                    <th>Delivery Date</th>
                                    <th>Shipping Address</th>
                                    <th>Order Status</th>

                                    @if($user->is(\App\Enums\UserTypes::Admin))
                                        <th>Actions</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                <?php $order_counter = 0;?>

                                @foreach($orders as $order)
                                    <?php $order_counter++?>
                                    <tr>
                                        <td>{{ $order_counter }}</td>
                                        <td>{{ $order->user->name }}</td>

                                        <td>
                                            <ul class="ml-n4">
                                                @foreach($order->products as $product)
                                                    <li>{{ $product->name }} <br>
                                                        <span class="text-muted font-italic">Quantity: {{ $product->pivot->quantity }}</span>
                                                            <span class="float-right text-info">Price: {{ __('currency.code') }} {{ $product->price }}</span> </li>
                                                @endforeach
                                            </ul>

                                        </td>
                                        <td>{{ __('currency.code') }} {{ $order->total_amount }}</td>
                                        <td>{{ $order->delivery_date !=null? \Carbon\Carbon::create($order->delivery_date)->Format('l\, jS F Y') : "5-6 working days" }}</td>
                                        <td>{{ $order->user->address }}</td>
                                        <td>{{ \App\Enums\OrderStatus::getDescription($order->status) }}</td>

                                        @if($user->is(\App\Enums\UserTypes::Admin))
                                            <td>
                                            {{--Action Buttons--}}
                                            <ul class="list-inline">

                                                <li class="list-inline-item">
                                                    <form action="{{ route('destroy_order', $order) }}" method="post"
                                                          class="action-form form-inline">
                                                        @csrf
                                                        @method('DELETE') {{--Will call the delete method of route--}}
                                                        <button class="btn btn-outline-danger border-0 mt-0" type="button"
                                                                onclick="deleteOrder(this)" data-toggle="tooltip"
                                                                data-placement="bottom" title="Delete Order">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </li>

                                                <li class="list-inline-item">
                                                    <form action="{{ route('edit_order', $order) }}" method="post"
                                                          class="action-form form-inline">
                                                        @csrf
                                                        <button class="btn btn-outline-secondary border-0 mt-0" type="submit"
                                                                data-toggle="tooltip"
                                                                data-placement="bottom" title="Edit Order">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    </form>
                                                </li>

                                            </ul>
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteOrder(buttonObject) {
            // Display confirmation dialog for deleting the order
            bootbox.confirm("Are you sure you want to delete this order?", function (result) {

                // Submit the form if user selects to delete the category
                if (result === true) {
                    $(buttonObject).parents('.action-form').submit();
                }
            });
        }

    </script>
@endsection
