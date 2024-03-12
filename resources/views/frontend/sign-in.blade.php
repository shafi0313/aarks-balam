@extends('frontend.layouts.app')
@section('title', 'Dashboard')
@section('content')

    <section class="">
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-md-5 col-xs-8">
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <p class="text-center">Sign in into your account</p>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                        placeholder="name@example.com" value="{{ old('username') ?? old('email') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Sing In</button>
                                </div>
                                <div class="text-center mt-3">
                                    <a href="">Forgot password?</a><br>
                                    Don't have an account? <a href="{{ route('sign_up') }}">Sign up</a>
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
