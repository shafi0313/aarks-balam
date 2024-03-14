@extends('frontend.layouts.app')
@section('content')
    <style>
        #cartTable td {
            vertical-align: middle;
            text-align: center;
        }

        #cartTable th {
            color: #fff;
        }

        .cart_table tr td {
            text-align: right;
        }
    </style>
    <section class="pt-5">
        <div class="container">
            <form action="{{ route('frontend.shipping.multipleStore') }}" method="post">
                @csrf
                <div class="table-responsive" style="overflow-x:auto;overflow-y: hidden;">
                    <h3>List of products</h3>
                    <table id="cartTable" class="table table-bordered">
                        <thead class="bg-primary">
                            <tr class="text-center">
                                <th class="product-name">product</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-subtotal">Price</th>
                                <th class="product-subtotal">Total</th>
                                <th class="product-subtotal">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $cart)
                                <input type="hidden" name="product_id[]" value="{{ $cart->product_id }}">
                                <tr>
                                    <td class="product-name">
                                        <img alt="{{ $cart->product->name }}"
                                            src="{{ imagePath('product', $cart->product->image) }}" height="80px">
                                        <div>
                                            <a href="#">{{ $cart->product->name }}</a>
                                        </div>
                                    </td>
                                    <td class="product-quantity" style="max-width: 100px">
                                        <div class="button-container d-flex justify-content-center">
                                            <button class="btn btn-warning cart-qty-minus p-2" type="button" value="-"
                                                onclick="decrementStore(event, '{{ $cart->id }}')">
                                                <i class="fa-solid fa-minus"></i>
                                            </button>
                                            <input type="text" name="quantity[]" min="1"
                                                class="qty form-control text-center" value="{{ $cart->quantity }}" />
                                            <button class="btn btn-warning cart-qty-plus p-2" type="button" value="+"
                                                onclick="incrementStore(event, '{{ $cart->id }}')">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="product-subtotal">
                                        <span class="woocommerce-Price-amount">
                                            <bdi>
                                                <span class="woocommerce-Price-currencySymbol">&#2547;
                                                </span>{{ $cart->product->price }}
                                            </bdi>
                                        </span>
                                        <input type="hidden" value="{{ $cart->product->price }}" class="price">
                                    </td>
                                    <td class="product-subtotal">
                                        <span>
                                            &#2547; <span id="amount" class="amount">
                                                {{ $cart->quantity * $cart->product->price }}</span>
                                        </span>

                                    </td>
                                    <td data-title="Remove">
                                        <a href="{{ route('frontend.cart.delete', $cart->id) }}" class="text-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="coupon">
                                <td colspan="5">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <a href="{{ route('products') }}" class="btn btn-primary">
                                            Add Item
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        {{-- <div class="coupon-area">
                            <h3>Apply Coupon</h3>
                            <div class="coupon">
                                <input type="text" name="coupon_code" class="input-text" placeholder="Coupon Code">
                                <button type="submit" name="apply_coupon"><span>Apply coupon</span>
                                </button>
                            </div>
                        </div> --}}
                    </div>
                    <div class="col-lg-6">
                        <h4>Cart Totals</h4>
                        <div class="table-responsive">
                            <table class="table table-striped cart_table">
                                <tbody>
                                    <tr class="cart-subtotal">
                                        <th>Sub total:</th>
                                        <td>&#2547; <span id="total" class="total">0</span></td>
                                    </tr>
                                    <tr class="Shipping">
                                        <th>Shipping:</th>
                                        <td>&#2547; 60</td>
                                    </tr>
                                    <tr class="Total">
                                        <th>Total:</th>
                                        <td>&#2547; <span class="totalPay"></span></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Proceed to checkout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    @push('scripts')
        <script>
            $(document).ready(function() {
                update_amounts();
                $('.qty, .price').on('keyup keypress blur change', function(e) {
                    update_amounts();
                });

                $('.update-cart').on('click', function() {
                    location.reload();
                });

                var plusBtn = $(".cart-qty-plus");
                var minusBtn = $(".cart-qty-minus");

                plusBtn.on('click', function() {
                    incrementQty($(this));
                });

                minusBtn.on('click', function() {
                    decrementQty($(this));
                });
            });

            function update_amounts() {
                var sum = 0.0;
                $('#cartTable > tbody > tr').each(function() {
                    var qty = parseFloat($(this).find('.qty').val());
                    var price = parseFloat($(this).find('.price').val());
                    var amount = (qty * price);
                    sum += amount;
                    $(this).find('.amount').text(amount.toFixed(2));
                });
                $('.total').text(sum.toFixed(2));
                $('.totalPay').text((sum + 60).toFixed(2));
            }

            function incrementQty(btn) {
                var $n = btn.parent(".button-container").find(".qty");
                $n.val(Number($n.val()) + 1);
                update_amounts();
            }

            function decrementQty(btn) {
                var $n = btn.parent(".button-container").find(".qty");
                var QtyVal = Number($n.val());
                if (QtyVal > 1) {
                    $n.val(QtyVal - 1);
                }
                update_amounts();
            }

            function incrementStore(e, cart_id) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('frontend.cart.incrementStore') }}',
                    type: 'POST',
                    data: {
                        'cart_id': cart_id,
                    },
                    success: function(res) {
                        toast('success', res.message);
                    },
                    error: function(err) {
                        console.error('Error:', err);
                    }
                });
            }

            function decrementStore(e, cart_id) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('frontend.cart.decrementStore') }}',
                    type: 'POST',
                    data: {
                        'cart_id': cart_id,
                    },
                    success: function(res) {
                        toast('success', res.message);
                    },
                    error: function(err) {
                        console.error('Error:', err);
                    }
                });
            }
        </script>
    @endpush
@endsection
