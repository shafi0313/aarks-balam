@extends('frontend.layout.app')
@section('content')
    <link rel="stylesheet" href="https://unpkg.com/xzoom/dist/xzoom.css">
    <!-- Start Product Area -->
    <div class="product-area section">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Shipping Address</div>
                        <div class="card-body">
                            <p class="card-text">Name: {{ user()->name }}</p>
                            <p class="card-text">Phone: {{ user()->phone }}</p>
                            <p class="card-text">{{ user()->address }}</p>
                            <p class="card-text">{{ user()->district->name ?? '' }},
                                {{ user()->upazila->name ?? '' }}, {{ user()->union->name ?? '' }}</p>
                        </div>
                        {{-- <div class="card-footer text-muted">
                            2 days ago
                        </div> --}}
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            Checkout Summary
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <p class="card-text">Subtotal</p>
                                <p class="card-text">&#2547; {{ $priceWithoutDiscount }}</p>
                            </div>
                            <hr class="bg-primary my-1">
                            <div class="d-flex justify-content-between">
                                <p class="card-text">Discount</p>
                                <p class="card-text">&#2547; {{ $discount }}</p>
                            </div>
                            <hr class="bg-primary my-1">
                            <div class="d-flex justify-content-between">
                                <p class="card-text">Shipping</p>
                                <p class="card-text">&#2547; 50</p>
                            </div>
                            <hr class="bg-primary my-1">
                            <div class="d-flex justify-content-between">
                                <p class="card-text">Total</p>
                                <p class="card-text">&#2547; {{ $priceWithDiscount + 50 }}</p>
                            </div>
                            <hr class="bg-primary my-1">
                            <div class="d-flex justify-content-between">
                                <p class="card-text"><b>Payable Total</b></p>
                                <p class="card-text"><b>&#2547; {{ $priceWithDiscount + 50 }}</b></p>
                            </div>
                        </div>
                        {{-- <div class="card-footer text-muted">
                          2 days ago
                        </div> --}}
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Payment Method</div>
                        <form action="{{ route('frontend.shipping.confirm') }}" method="post">
                            @csrf
                            {{-- <input type="hidden" name="product_id" value="{{ $product->id }}"> --}}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check payMethod">
                                            <input class="form-check-input" type="radio" name="pay_method"
                                                id="cashOnDelivery" value="1" required>
                                            <label class="form-check-label" for="cashOnDelivery">
                                                <i class="fa-solid fa-hand-holding-dollar"></i> Cash on Delivery
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check payMethod">
                                            <input class="form-check-input" type="radio" name="pay_method" id="bank"
                                                value="2" required>
                                            <label class="form-check-label" for="bank">
                                                <img src="{{ asset('frontend/images/icon-ssl.png') }}" alt="">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div>
                                    {{-- <p>বি:দ্র: কিছু কিছু ক্ষেত্রে আপনার অর্ডারে থাকা বই/পণ্যের মূল্য প্রকাশক/সরবরাহকারীর
                                        পক্ষ থেকে বিভিন্ন কারণে পরিবর্তন হতে পারে। এছাড়া আপনার অর্ডারের বই/পণ্য প্রকাশক/
                                        সরবরাহকারীর কাছে নাও থাকতে পারে। এই ধরণের অনাকাঙ্ক্ষিত বিষয়গুলোর জন্য আমরা দুঃখিত ও
                                        ক্ষমাপ্রার্থী।</p> --}}
                                </div>
                            </div>
                            <div class="card-footer text-muted text-end">
                                <button class="btn btn-primary">Confirm Order</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product Area -->

    @push('custom_scripts')
        <script src="https://unpkg.com/xzoom/dist/xzoom.min.js"></script>
        <script>
            $(".xzoom, .xzoom-gallery").xzoom({
                tint: '#333',
                Xoffset: 15
            });

            // -----------------for-Shopping-cart-------------
            $(document).ready(function() {
                update_amounts();
                $('.qty, .price').on('keyup keypress blur change', function(e) {
                    update_amounts();
                });
            });

            function update_amounts() {
                var sum = 0.0;
                $('#myTable > tbody  > tr').each(function() {
                    var qty = $(this).find('.qty').val();
                    var price = $(this).find('.price').val();
                    var amount = (qty * price)
                    sum += amount;
                    $(this).find('.amount').text('' + amount);
                });
                $('.total').text(sum);
            }



            //----------------for quantity-increment-or-decrement-------
            var incrementQty;
            var decrementQty;
            var plusBtn = $(".cart-qty-plus");
            var minusBtn = $(".cart-qty-minus");
            var incrementQty = plusBtn.click(function() {
                var $n = $(this)
                    .parent(".button-container")
                    .find(".qty");
                $n.val(Number($n.val()) + 1);
                update_amounts();
            });

            var decrementQty = minusBtn.click(function() {
                var $n = $(this)
                    .parent(".button-container")
                    .find(".qty");
                var QtyVal = Number($n.val());
                if (QtyVal > 1) {
                    $n.val(QtyVal - 1);
                }
                update_amounts();
            });
        </script>
    @endpush
@endsection
