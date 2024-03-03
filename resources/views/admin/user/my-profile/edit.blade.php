@extends('admin.layouts.app')
@section('title', 'My Profile')
@section('content')
    @include('admin.layouts.includes.breadcrumb', ['title' => ['My Profile', 'Edit', '']])
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body position-relative">
                    <form onsubmit="ajaxStoreModal(event, this, 'editModal')"
                action="{{ route('admin.admin-users.update', user()->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf @method('PUT')
                        @bind($myProfile)
                            <div class="row gy-2">
                                <div class="col-md-6">
                                    <x-form-input name="name" label="Name *" />
                                </div>
                                <div class="col-md-6">
                                    <x-form-input type="email" name="email" label="Email *" />
                                </div>
                                <div class="col-md-6">
                                    <x-form-input name="user_name" label="user name " />
                                </div>
                                <div class="col-md-6">
                                    <x-form-input name="phone" label="phone *" oninput="phoneIn(event)" />
                                </div>
                                <div class="col-md-6">
                                    <label for="gender" class="form-label">Gender *</label>
                                    <select class="form-select" name="gender">
                                        <option selected disabled value="">Choose...</option>
                                        @foreach ($genders as $gender)
                                            <option value="{{ $gender['id'] }}" @selected($gender['id'] == $myProfile->gender)>
                                                {{ $gender['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <x-form-input name="address" label="address *" />
                                </div>
                                <div class="col-md-6">
                                    <x-form-input type="file" name="image" label="image " />
                                </div>
                                <div class="col-md-6">
                                    <label for="password" class="form-label">Old Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <div class="col-md-12 text-center mt-2">
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                    <button type="submit" class="btn btn-warning">Update</button>
                                </div>
                            </div>
                        @endbind
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col-->
    </div>

    @push('scripts')
    @endpush
@endsection
