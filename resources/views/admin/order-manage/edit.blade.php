@extends('admin.layouts.app')
@section('title', 'Order List')
@section('content')
    <!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0 align-items-center">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fa-solid fa-house-chimney"></i>
                    </a>
                </li>
                <li class="breadcrumb-item">Order Manage</li>
                <li class="breadcrumb-item active" aria-current="page">Order List</li>
            </ol>
        </nav>
    </div>
    <!--end breadcrumb-->
    <div class="d-flex justify-content-between index_title">
        <h6 class="mb-0">List of Orders</h6>
        {{-- <a data-toggle="modal" data-bs-target="#createModal" data-bs-toggle="modal" class="btn btn-primary">Add New</a> --}}
    </div>

    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="data_table" class="table table-striped table-bordered align-middle">
                    <thead class="bg-primary text-light">
                        <tr>
                            <td>#</td>
                            <td>Food Name</td>
                            <td>Quantity</td>
                            <td>price</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($foodOrder->foodOrderItems as $foodOrderItem)
                            <tr>
                                <td>{{ @$i += 1 }}</td>
                                <td>{{ $foodOrderItem->food->name }}</td>
                                <td>{{ $foodOrderItem->quantity }}</td>
                                <td>{{ $foodOrderItem->price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @push('custom_scripts')
        {{-- <script>
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
                            data: 'customer.name',
                            name: 'customer.name',
                            title: 'Customer Name',
                        },
                        {
                            data: 'customer_type',
                            name: 'customer_type',
                            title: 'Customer Type',
                        },
                        {
                            data: 'food_order_items',
                            title: 'Food Name/Quantity',
                            render: function(data) {
                                if (Array.isArray(data) && data.length > 0) {
                                    var items = '<ul>';
                                    data.forEach(function(item) {
                                        items += '<li>' + item.food.name + ' (Qty: ' + item
                                            .quantity + ')</li>';
                                    });
                                    items += '</ul>';
                                    return items;
                                } else {
                                    return 'No items';
                                }
                            }
                        },
                        {
                            data: 'created_by.name',
                            name: 'created_by.name',
                            title: 'Order By',
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
                        },
                        {
                            data: 'payment',
                            name: 'payment',
                            title: 'Payment',
                        },
                        {
                            data: 'amount',
                            name: 'amount',
                            title: 'Amount',
                        },
                        {
                            data: 'action',
                            name: 'action',
                            className: "text-center",
                            width: "60px",
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
        </script> --}}
    @endpush
@endsection
