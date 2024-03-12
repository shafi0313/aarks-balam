<div class="col-lg-3 col-md-4 col-sm-6">
    <div class="card">
        <a href="{{ route('product_show', Crypt::encrypt($product->id)) }}">
            <img src="{{ imagePath('product', $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
            <div class="card-body">
                <h3 class="card-title">{{ $product->name }}</h3>
                <h4 class="card-title"> &#2547; {{ $product->price }}</h4>
            </div>
        </a>
    </div>
</div>
