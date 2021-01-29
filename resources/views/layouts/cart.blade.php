
    <a href="#" class="nav-link mr-2" data-toggle="dropdown">
        <i class="fas fa-shopping-cart fa-2x text-primary" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ session('cart.products')!=null ? count(session('cart.products')) : "" }}</span>
    </a>
    <div class="dropdown-menu">
        <div class="row total-header-section">
            <div class="col-lg-6 col-sm-6 col-6">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ session('cart.products')!=null ? count(session('cart.products')) : "" }}</span>
            </div>

            <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                <p>Total: <span class="text-info">
                       {{ __('currency.code') }} {{ session('cart.total_price', 0) }}
                    </span></p>
            </div>
        </div>
        @if(session('cart'))
            @foreach(session('cart.products') as $product)

                <div class="row cart-detail">
                <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                    <img src="{{ asset($product['image_url'] !=null ? $product['image_url'] : 'images/image.png')}}">
                </div>
                <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                    <p>{{ $product['name'] }}</p>
                    <span class="price text-info">{{ __('currency.code') }} {{ $product['price'] }}</span>
                    <span class="count"> Quantity: </span>
                    <input type="number" step="1" min="1" id="product_quantity" class="d-inline w-25" name="quantity" value="{{ $product['quantity'] }}" onchange="updateProduct({{ $product['id'] }}, this.value)" >

                    <a href="#" class="btn btn-outline-danger border-0 ml-2 my-0"
                            onclick="deleteProduct({{$product['id']}})">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
            </div>
            @endforeach
        @endif
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                <a href= "{{ route('checkout') }}" class="btn btn-primary btn-block">Checkout</a>
            </div>
        </div>
    </div>


<style>

    @push('style_tag')
        {{--This code is not working. Unable to add the code in 'style_tag' stack
            through this file. Manually added the same code in app.blade.php style tag--}}

    .main-section{
        background-color: #F8F8F8;
        margin-top:50px;
    }
    #cart{
        float:right;
        padding-right: 30px;
    }
    .btn{
        border:0px;
        margin:10px 0px;
        box-shadow:none !important;
    }
    #cart .dropdown-menu{
        padding: 20px;
        top: 30px !important;
        width: 400px !important;
        left: -150px !important;
        box-shadow: 0px 5px 30px black;
    }
    .total-header-section{
        border-bottom:1px solid #d2d2d2;
    }
    .total-section p{
        margin-bottom:20px;
    }
    .cart-detail{
        padding:15px 0px;
    }
    .cart-detail-img img{
        width:100%;
        height:100%;
        padding-left:15px;
    }
    .cart-detail-product p{
        margin:0px;
        color:#000;
        font-weight:500;
    }
    .cart-detail .price{
        font-size:12px;
        margin-right:10px;
        font-weight:500;
    }
    .cart-detail .count{
        color:#C2C2DC;
    }
    .checkout{
        border-top:1px solid #d2d2d2;
        padding-top: 15px;
    }
    .checkout .btn-primary{
        border-radius:50px;
        height:50px;
    }
    .dropdown-menu:before{
        content: " ";
        position:absolute;
        top:-20px;
        right:50px;
        border:10px solid transparent;
        border-bottom-color:#fff;
    }

    @endpush

</style>

    @include('public.scripts.cart_scripts')

<script>

    /*//Attaching event handler to .dropdown selector.
    $('.dropdown').on({

        //fires after dropdown is shown instance method is called (if you click anywhere else)
        "shown.bs.dropdown": function() { this.close= false; },

        //when dropdown is clicked
        "click": function() { this.close= true; },

        //when close event is triggered
        "hide.bs.dropdown":  function() { return this.close; }
    });*/



</script>
