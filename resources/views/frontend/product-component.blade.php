<div class="col-lg-3 col-md-4 col-sm-6">
    <div class="card">
        <a href="{{ route('product_show', Crypt::encrypt($product->id)) }}">
            <img src="{{ imagePath('product', $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
            <div class="card-body">
                <h3 class="card-title">{{ $product->name }}</h3>
                <div class="d-flex justify-content-between">
                    <p><span>&#2547; </span>{{ $product->price }}</p>
                    @auth
                        <a href="javascript:;" onclick="cart(event,'{{ $product->id }}')" class="btn btn-warning">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                    @endauth
                    @guest
                        <a href="javascript:;" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#loginModal">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                    @endguest
                </div>
            </div>
        </a>
    </div>
</div>
