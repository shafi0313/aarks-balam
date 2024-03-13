<div class="donation">
    <a href="{{ route('frontend.cart.index') }}" class="btn btn-primary position-relative pr-cart">
        <i class="fa-solid fa-cart-shopping"></i>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            {{ $datum->count() }}
        </span>View Cart
    </a>
    {{-- <div class="cart-popup">
        <ul>
            @php
                $totalPrice = 0;
            @endphp
            @foreach ($datum as $data)
                <li class="d-flex align-items-center position-relative">
                    <div class="p-img light-bg">
                        <img src="{{ imagePath('food', $data->food->image) }}" alt="{{ $data->food->name }}">
                    </div>
                    <div class="p-data">
                        <h3 class="font-semi-bold">{{ $data->food->name }}</h3>
                        <p class="theme-clr font-semi-bold">
                            {{ nF2($data->food->price - ($data->food->price * $data->food->discount) / 100) }}
                        </p>
                    </div>
                    <a href="JavaScript:void(0)" id="crosss" onClick="cartDelete(event, '{{ $data->id }}')"></a>
                </li>
        </ul>
        @php
            $totalPrice += $data->food->price - ($data->food->price * $data->food->discount) / 100;
        @endphp
        @endforeach
        <div class="cart-total d-flex align-items-center justify-content-between">
            <span class="font-semi-bold">Total:</span>
            <span class="font-semi-bold">{{ $totalPrice }}</span>
        </div>

        <div class="cart-btns d-flex align-items-center justify-content-between">
            <a class="font-bold" href="{{ route('frontend.cart.index') }}">View Cart</a>
        </div>
    </div> --}}
</div>
