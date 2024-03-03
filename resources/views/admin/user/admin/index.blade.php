@extends('admin.layouts.app')
@section('title', 'Admin User')
@section('content')
    @include('admin.layouts.includes.breadcrumb', ['title' => ['Admin', 'Admin Users', 'Index']])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <h4 class="card-title">List of Admin Users</h4>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                            <i class="fa-solid fa-plus"></i> Add New
                        </button>
                    </div>
                    <table id="data_table" class="table table-bordered bordered table-centered mb-0 w-100">
                        <thead>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>



                    {{-- <div class="row">
                        <div class="col-lg-6">
                            <form>
                                <div class="mb-3">
                                    <label for="simpleinput" class="form-label">Text</label>
                                    <input type="text" id="simpleinput" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label for="example-email" class="form-label">Email</label>
                                    <input type="email" id="example-email" name="example-email" class="form-control"
                                        placeholder="Email">
                                </div>

                                <div class="mb-3">
                                    <label for="example-password" class="form-label">Password</label>
                                    <input type="password" id="example-password" class="form-control" value="password">
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Show/Hide Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" class="form-control"
                                            placeholder="Enter your password">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="example-palaceholder" class="form-label">Placeholder</label>
                                    <input type="text" id="example-palaceholder" class="form-control"
                                        placeholder="placeholder">
                                </div>

                                <div class="mb-3">
                                    <label for="example-textarea" class="form-label">Text area</label>
                                    <textarea class="form-control" id="example-textarea" rows="5"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="example-readonly" class="form-label">Readonly</label>
                                    <input type="text" id="example-readonly" class="form-control" readonly=""
                                        value="Readonly value">
                                </div>

                                <div class="mb-3">
                                    <label for="example-disable" class="form-label">Disabled</label>
                                    <input type="text" class="form-control" id="example-disable" disabled=""
                                        value="Disabled value">
                                </div>

                                <div class="mb-3">
                                    <label for="example-static" class="form-label">Static control</label>
                                    <input type="text" readonly class="form-control-plaintext" id="example-static"
                                        value="email@example.com">
                                </div>

                                <div class="mb-0">
                                    <label for="example-helping" class="form-label">Helping text</label>
                                    <input type="text" id="example-helping" class="form-control"
                                        placeholder="Helping text">
                                    <span class="help-block"><small>A block of help text that breaks onto a new line and may
                                            extend beyond one line.</small></span>
                                </div>

                            </form>
                        </div> <!-- end col -->

                        <div class="col-lg-6">
                            <form>

                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Input Select</label>
                                    <select class="form-select" id="example-select">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="example-multiselect" class="form-label">Multiple Select</label>
                                    <select id="example-multiselect" multiple class="form-control">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="example-fileinput" class="form-label">Default file input</label>
                                    <input type="file" id="example-fileinput" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label for="example-date" class="form-label">Date</label>
                                    <input class="form-control" id="example-date" type="date" name="date">
                                </div>

                                <div class="mb-3">
                                    <label for="example-month" class="form-label">Month</label>
                                    <input class="form-control" id="example-month" type="month" name="month">
                                </div>

                                <div class="mb-3">
                                    <label for="example-time" class="form-label">Time</label>
                                    <input class="form-control" id="example-time" type="time" name="time">
                                </div>

                                <div class="mb-3">
                                    <label for="example-week" class="form-label">Week</label>
                                    <input class="form-control" id="example-week" type="week" name="week">
                                </div>

                                <div class="mb-3">
                                    <label for="example-number" class="form-label">Number</label>
                                    <input class="form-control" id="example-number" type="number" name="number">
                                </div>

                                <div class="mb-3">
                                    <label for="example-color" class="form-label">Color</label>
                                    <input class="form-control" id="example-color" type="color" name="color"
                                        value="#727cf5">
                                </div>

                                <div class="mb-0">
                                    <label for="example-range" class="form-label">Range</label>
                                    <input class="form-range" id="example-range" type="range" name="range"
                                        min="0" max="100">
                                </div>

                            </form>
                        </div> <!-- end col -->
                    </div> --}}
                    <!-- end row-->
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->
    @can('admin-user-add')
        @include('admin.user.admin.create')
    @endcan
    @push('scripts')
        <script>
            $(function() {
                $('#data_table').DataTable({
                    processing: true,
                    serverSide: true,
                    deferRender: true,
                    ordering: true,
                    // responsive: true,
                    scrollX: true,
                    scrollY: 400,
                    ajax: "{{ route('admin.admin-users.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            title: 'SL',
                            className: "text-center",
                            width: "17px",
                            searchable: false,
                            orderable: false,
                        },
                        {
                            data: 'name',
                            name: 'name',
                            title: 'Name'
                        },
                        {
                            data: 'email',
                            name: 'email',
                            title: 'Email'
                        },
                        {
                            data: 'phone',
                            name: 'phone',
                            title: 'Phone'
                        },
                        {
                            data: 'gender',
                            name: 'gender',
                            title: 'gender'
                        },
                        {
                            data: 'permission',
                            name: 'permission',
                            title: 'Permission'
                        },
                        {
                            data: 'is_active',
                            name: 'is_active',
                            title: 'Status'
                        },
                        {
                            data: 'image',
                            name: 'image',
                            title: 'Image'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            title: 'Action',
                            className: "text-center",
                            width: "60px",
                            orderable: false,
                            searchable: false,
                        },
                    ],
                    // fixedColumns: false,
                    scroller: {
                        loadingIndicator: true
                    }
                });
            });
        </script>
    @endpush
@endsection
