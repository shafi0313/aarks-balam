@extends('frontend.layouts.app')
@section('title', 'Dashboard')
@section('content')

    <section class="">
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-md-5 col-xs-8">
                    <form action="">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Sing In</button>
                                </div>
                                <div class="text-center mt-2">
                                    You have an account?<a href="{{ route('sign_in') }}"> Sign In</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
    @endpush
@endsection
