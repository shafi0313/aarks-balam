@extends('frontend.layouts.app')
@section('title', 'Dashboard')
@section('content')

    <section class="">
        <div class="container">
            <div class="row">
                <div class="hero owl-carousel owl-theme">
                    @foreach ($sliders as $slider)
                        <div class="item">
                            <img src="{{ imagePath('slider', $slider->image) }}" alt="slider image">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="section category-area">
        <div class="container">
            <div class="section-title">
                <h2>Our Categories</h2>
            </div>
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-md-2">
                        <a href="">
                            <div class="card">
                                <img src="{{ imagePath('category', $category->image) }}" class="card-img-top"
                                    alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $category->name }}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    
    <section class="section products-area">
        <div class="container">
            <div class="section-title">
                <h2>Our Products</h2>
            </div>
            <ul class="nav justify-content-center" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="cat-all-tab" data-bs-toggle="tab" data-bs-target="#cat-all"
                        type="button" role="tab" aria-controls="cat-all" aria-selected="true">All</button>
                </li>
                @foreach ($productCategories as $productCategory)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="cat-{{ $productCategory->id }}-tab" data-bs-toggle="tab"
                            data-bs-target="#cat-{{ $productCategory->id }}" type="button" role="tab"
                            aria-controls="cat-{{ $productCategory->id }}"
                            aria-selected="true">{{ $productCategory->name }}</button>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active }}" id="cat-all" role="tabpanel" aria-labelledby="cat-all-tab">
                    <div class="row">
                        @foreach ($products as $product)
                            @include('frontend.product-component')
                        @endforeach
                    </div>
                </div>

                @foreach ($productCategories as $productCategory)
                    <div class="tab-pane fade" id="cat-{{ $productCategory->id }}" role="tabpanel"
                        aria-labelledby="cat-{{ $productCategory->id }}-tab">
                        <div class="row">
                            @foreach ($productCategory->products as $product)
                                @include('frontend.product-component')
                            @endforeach
                        </div>
                    </div>
                @endforeach
                <div class="col-md-12 text-center">
                    <a href="" class="default-btn">SEE ALL PRODUCTS</a>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            $('.owl-carousel').owlCarousel({
                smartSpeed: 1000,
                autoplay: true,
                lazyLoad: true,
                nav: true,
                navText: ["<i class='fa-solid fa-angle-left'></i>", "<i class='fa-solid fa-angle-right'></i>"],
                dots: true,
                loop: true,
                items: 1,
            })
        </script>
    @endpush
@endsection
