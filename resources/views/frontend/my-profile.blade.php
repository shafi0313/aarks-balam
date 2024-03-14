@extends('frontend.layouts.app')
@section('content')

    <section class="mt-5">
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form onsubmit="ajaxStoreModal(event, this)" action="{{ route('my_profile.update', Crypt::encrypt(user()->id)) }}"
                method="post">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name *</label>
                            <input type="text" name="name" value="{{ user()->name }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" value="{{ user()->email }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone *</label>
                            <input type="text" name="phone" value="{{ user()->phone }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">address *</label>
                            <input type="text" name="address" value="{{ user()->address }}" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-info">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection
