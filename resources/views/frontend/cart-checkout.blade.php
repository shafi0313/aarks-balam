@extends('frontend.layouts.app')
@section('content')
    <style>
        .checkout-side ul {
            list-style: none
        }

        .cart_table tr td {
            text-align: right;
        }
    </style>
    <!-- Start Product Area -->
    <section class="gap mt-3">
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('frontend.shipping.confirm') }}" method="post" class="checkout-meta donate-page">
                @csrf
                <input type="hidden" name="total_price" value="{{ $priceWithDiscount }}">
                <input type="hidden" name="discount" value="{{ $discount }}">
                <input type="hidden" name="shipping_charge" value="60">
                <div class="row">
                    <div class="col-lg-6">
                        <h3 class="pb-1">Billing details</h3>
                        <div class="mb-2">
                            <x-form-input name="name" value="{{ user()->name }}" label="name" required />
                        </div>
                        <div class="mb-2">
                            <x-form-input type="email" name="email" value="{{ user()->email }}" label="Email"
                                required />
                        </div>
                        <div class="mb-2">
                            <x-form-input name="phone" value="{{ old('phone') ?? user()->phone }}" label="Phone"
                                required />
                        </div>
                        <div class="mb-2">
                            <x-form-input name="address" value="{{ old('address') ?? user()->address }}" label="Address"
                                required />
                        </div>
                        <div class="mb-2">
                            <x-form-textarea name="note" label="Order Note" />
                        </div>
                    </div>
                    <div class="col-lg-6 ps-3">
                        <h3 class="pb-1">Cart Total</h3>
                        <div class="table-responsive">
                            <table class="table table-striped cart_table">
                                <tbody>
                                    <tr class="cart-subtotal">
                                        <th>Subtotal:</th>
                                        <td>
                                            &#2547; {{ number_format($priceWithDiscount, 2) }}
                                        </td>
                                    </tr>
                                    <tr class="Shipping">
                                        <th>Discount:</th>
                                        <td>&#2547; {{ number_format($discount, 2) }}</td>
                                    </tr>
                                    <tr class="Shipping">
                                        <th>Shipping:</th>
                                        <td>&#2547; 60</td>
                                    </tr>
                                    <tr class="Total">
                                        <th>Total:</th>
                                        <td>&#2547;</span>{{ number_format($priceWithoutDiscount + 60, 2) }}</td>
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
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary"><span>Place Order</span></button>
                    </div>
                </div>
            </form>
    </section>
    <!-- End Product Area -->

    @push('custom_scripts')
    @endpush
@endsection
