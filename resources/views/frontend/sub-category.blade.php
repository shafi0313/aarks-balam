@extends('frontend.layouts.app')
@section('title', 'Dashboard')
@section('content')

    <section class="section category-area">
        <div class="container">
            <div class="section-title">
                <h2> Sub Categories</h2>
            </div>
            <div class="row">
                @foreach ($subCategories as $subCategory)
                    <div class="col-md-2">
                        <a href="{{ route('product_by_sub_category', $subCategory->id) }}">
                            <div class="card">
                                <img src="{{ imagePath('category', $subCategory->image) }}" class="card-img-top"
                                    alt="{{ $subCategory->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $subCategory->name }}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @push('scripts')
    @endpush
@endsection
