@extends('frontend.layouts.app')
@section('title', 'Dashboard')
@section('content')

    <section class="section category-area">
        <div class="container">
            <div class="section-title">
                <h2> Products</h2>
            </div>
            <div class="row">
                @foreach ($products as $product)
                    @include('frontend.product-component')
                @endforeach
            </div>
        </div>
    </section>

    @push('scripts')
    @endpush
@endsection
