@extends('back.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header text-center">
                    <h2>Orders List</h2>
                    <!-- إضافة زر لحذف جميع البيانات من جدول booking_request -->
                    <form action="{{ route('booking_requests.clear') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Clear All Booking Requests</button>
                    </form>
                </div>
                <div class="card-body">
                    <!-- جدول الأوردرات -->
                    <table id="ordersTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Order Number</th>
                                <th>Customer Name</th>
                                <th>Phone Number</th>
                                <th>Booking Date</th>
                                <th>Status</th>
                                <th>Total Price</th>
                                <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td>{{ $order->order_id }}</td>
                                    <td>{{ $order->customer_name }}</td>
                                    <td>{{ $order->customer_phone }}</td>

                                    <td>{{ $order->booking_date }}</td>
                                    <td>
                                        @if($order->status == 'completed')
                                            <span class="badge badge-success" style="color: black;">Confirmed</span>
                                        @else
                                            <span class="badge badge-danger" style="color: black;">Pending</span>
                                        @endif
                                    </td>
                                    <td style="color: black;">{{ $order->total_price }} SAR</td>
                                    <td>
                                        <a href="#" class="btn btn-info btn-sm">View Details</a>
                                        <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="#" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No Orders at the current moment</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- إضافة DataTables لتنسيق الجدول -->
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#ordersTable').DataTable(); // تفعيل DataTables على الجدول
    });
</script>
@endsection
