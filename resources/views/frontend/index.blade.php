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
