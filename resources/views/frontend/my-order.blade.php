@extends('frontend.layouts.app')
@section('content')
    <style>
        .table th {
            color: #fff;
        }
    </style>
    <section class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped align-baseline">
                        <thead class="bg-primary">
                            <tr>
                                <th>Order ID</th>
                                <th>Order Date</th>
                                <th>Order Status</th>
                                <th>Product</th>
                                <th>Order Total</th>
                                <th width="130px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ strPad4($order->invoice_no) }}</td>
                                    <td>{{ bdDate($order->order_date) }}</td>
                                    <td>{!! orderStatus($order->status) !!}
                                        {{ Carbon\Carbon::parse($order->updated_at)->diffForHumans() }}</td>
                                    <td>
                                        <ul>
                                            @foreach ($order->orderItems as $orderItem)
                                                <li>{{ $orderItem->product->name }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="text-end">{{ nF2($order->total_price) }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('my_order.cancel', Crypt::encrypt($order->id)) }}"
                                            class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"
                                            title="Cancel Order">
                                            <i class="fa-regular fa-circle-xmark"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    @push('custom_scripts')
    @endpush
@endsection
