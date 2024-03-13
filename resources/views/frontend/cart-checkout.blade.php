@extends('frontend.layouts.app')
@section('content')
    @include('frontend.layouts.includes.banner', ['bannerTitle' => 'Cart Checkout ', 'page' => ''])


    <!-- Start Product Area -->
    <section class="gap">
        <div class="container">
            <form action="{{ route('frontend.shipping.confirm') }}" method="post" class="checkout-meta donate-page">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <h3 class="pb-3">Billing details</h3>
                        <div class="col-lg-12">
                            <input type="text" class="input-text " name="name" placeholder="Name" value="{{ user()->name }}" required>
                            <input type="email" class="input-text " name="email" placeholder="Email address" value="{{ user()->email }}" required >
                            <div class="row">
                                <div class="col-lg-6">
                                    <select name="delivery_area_id" class="nice-select Advice city" required>
                                        <option selected value disabled>Select Delivery Area</option>
                                        @foreach ($deliveryAreas as $deliveryArea)
                                        <option value="{{ $deliveryArea->id }}" {{ $deliveryArea->id == user()->delivery_area_id ?'selected':'' }}>{{ $deliveryArea->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <input type="tel" class="input-text " name="phone" placeholder="Phone" value="{{ user()->phone }}" required>
                                </div>
                            </div>
                            <input type="text" name="address" placeholder="Address" value="{{ user()->address }}" required>
                            {{-- <div class="ship-address">
                                <div class="d-flex">
                                    <input type="radio" id="Create" name="Create" value="Create">
                                    <label for="Create">
                                        Create an account for later use
                                    </label>
                                </div>
                                <div class="d-flex">
                                    <input type="radio" id="ShipAddress" name="Create" value="ShipAddress">
                                    <label for="ShipAddress">
                                        Ship to same Address
                                    </label>
                                </div>
                            </div> --}}
                        </div>
                        <div class="woocommerce-additional-fields">
                            <textarea name="note" class="input-text " placeholder="Order Note"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="cart_totals-checkout"
                            style="background-image: url({{ asset('frontend/img/patron.jpg') }})">
                            <div class="cart_totals cart-Total">
                                <h4>Cart Total</h4>
                                <table class="shop_table_responsive">
                                    <tbody>
                                        <tr class="cart-subtotal">
                                            <th>Subtotal:</th>
                                            <td>
                                                <span class="woocommerce-Price-amount">
                                                    <bdi>
                                                        <span class="woocommerce-Price-currencySymbol">&#2547;</span>
                                                        {{ number_format($priceWithDiscount, 2) }}
                                                    </bdi>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="Shipping">
                                            <th>Discount:</th>
                                            <td>
                                                <span class="woocommerce-Price-amount amount">
                                                    &#2547;
                                                </span>{{ number_format($discount, 2) }}
                                            </td>
                                        </tr>
                                        <tr class="Shipping">
                                            <th>Shipping:</th>
                                            <td>
                                                <span class="woocommerce-Price-amount amount">
                                                    &#2547;
                                                </span>60
                                            </td>
                                        </tr>
                                        <tr class="Total">
                                            <th>Total:</th>
                                            <td>
                                                <span class="woocommerce-Price-amount">
                                                    <bdi>
                                                        <span>&#2547;</span>{{ number_format($priceWithoutDiscount + 60, 2) }}
                                                    </bdi>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="checkout-side">
                                <h3>Payment Method</h3>
                                <ul>
                                    {{-- <li>
                                      <input type="radio" id="Bank_Payment" name="Bank_Payment" value="Bank_Payment">
                                      <label for="Bank_Payment">
                                              Bank Payment
                                      </label>
                                  </li>
                                  <li>
                                      <input type="radio" id="Check_Payment" name="Bank_Payment" value="Check_Payment">
                                      <label for="Check_Payment">
                                              Check Payment
                                      </label>
                                  </li>
                                  <li>
                                      <input type="radio" id="PayPal" name="Bank_Payment" value="Check_Payment">
                                      <label for="PayPal">
                                              PayPal
                                      </label>
                                  </li> --}}
                                    <li>
                                        <input type="radio" id="Cash on Delivery" name="Bank_Payment" checked
                                            value="Check_Payment">
                                        <label for="Cash on Delivery">
                                            Cash on Delivery
                                        </label>
                                    </li>
                                </ul>
                                <button type="submit" class="button"><span>Place Order</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- End Product Area -->

    @push('custom_scripts')
    @endpush
@endsection
