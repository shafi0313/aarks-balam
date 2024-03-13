@extends('frontend.layouts.app')
@section('title', 'Dashboard')
@section('content')

    <section class="">
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-md-5 col-xs-8">
                    <form action="{{ route('sign_in') }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-body">
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
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" name="phone" value="{{ old('phone') }}" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" value="{{ old('password') }}"
                                        class="form-control">
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
