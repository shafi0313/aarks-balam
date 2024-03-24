@extends('admin.layouts.app')
@section('title', 'Product')
@section('content')
    @include('admin.layouts.includes.breadcrumb', ['title' => ['', 'Product', 'Index']])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <h4 class="card-title">List of Products</h4>
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
                    <!-- end row-->
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->
    @include('admin.order-manage.js')

    @push('scripts')
        <script>
            $(document).on('click', '.accept', function() {
                swal({
                    title: "Are you sure?",
                    text: "This change will affect this record!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: $(this).data("route"),
                            type: "GET",
                            data: {
                                status: $(this).data("value"),
                            },
                            success: (res) => {
                                $(".table").DataTable().ajax.reload();
                                swal({
                                    icon: "success",
                                    title: "Success",
                                    text: res.message,
                                });
                            },
                            error: (err) => {
                                swal({
                                    icon: "error",
                                    title: "Oops...",
                                    text: err.responseJSON.message,
                                });
                            },
                        });
                    }
                });
            });

            // Reject
            $(document).on('click', '.reject', function() {
                swal({
                    title: "Are you sure?",
                    text: "This change will affect this record!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: $(this).data("route"),
                            type: "GET",
                            success: (res) => {
                                $(".table").DataTable().ajax.reload();
                                swal({
                                    icon: "success",
                                    title: "Success",
                                    text: res.message,
                                });
                            },
                            error: (err) => {
                                swal({
                                    icon: "error",
                                    title: "Oops...",
                                    text: err.responseJSON.message,
                                });
                            },
                        });
                    }
                });

            });
            $(function() {
                $('#data_table').DataTable({
                    processing: true,
                    serverSide: true,
                    deferRender: true,
                    ordering: true,
                    // // responsive: true,
                    scrollY: 400,
                    ajax: {
                        url: "{{ route('admin.order_manages.index') }}",
                        dataSrc: 'data'
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            className: "text-center",
                            width: "17px",
                            searchable: false,
                            orderable: false,
                            title: 'SL',
                        },
                        {
                            data: 'user.name',
                            name: 'user.name',
                            title: 'customer Name',
                        },
                        {
                            data: 'order_date',
                            name: 'order_date',
                            title: 'order date',
                        },
                        {
                            data: 'status',
                            name: 'status',
                            title: 'Status',
                            className: "text-center",
                        },
                        {
                            data: 'payment',
                            name: 'payment',
                            title: 'Payment',
                            className: "text-center",
                        },
                        {
                            data: 'amount',
                            name: 'amount',
                            title: 'Amount',
                            className: "text-end",
                        },
                        {
                            data: 'action',
                            name: 'action',
                            className: "text-center",
                            width: "100px",
                            orderable: false,
                            searchable: false,
                            title: 'Action',
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
