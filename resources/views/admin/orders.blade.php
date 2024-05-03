@extends('admin.layout')

@section('body')
@include('success')

<div class="container">
    <h2 style="text-align: center" class="mt-4">All Orders</h2>
    <form action="{{ url('searchOrder') }}" method="GET" class="mb-4">
        @csrf
        <div class="form-group">
            <input type="text" required name="search" class="form-control" placeholder="Search orders by customer email...">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Email</th> 
                    <th>Amount</th>
                    <th>Payment Status</th>
                    <th>Delivery Status</th>
                    <th>Date</th>
                    <th>Action</th>
                    <th> Print</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->user->name}}</td>
                    <td>{{$order->user->email}}</td>
                    <td>{{$order->amount}} L.E</td>
                    <td>{{$order->payment_status}}</td>
                    <td>{{$order->delivery_status}}</td>
                    <td>{{$order->created_at}}</td>
                    <td>
                      @can('show-order')
                        <a href="{{url("orders/show/$order->id")}}" class="btn btn-sm btn-info">Show</a>
                        @endcan

                        @can('delivered')
                        @if ($order->delivery_status == "undelivered")
                        <a href="{{url("delivered/$order->id")}}" class="btn btn-sm btn-primary" >Delivered</a>
                        @endif
                        @endcan
                    </td>
                    <td><a href="{{url("print_pdf/$order->id")}}" class="btn btn-sm btn-secondry" >Print PDF</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{$orders->links()}}
</div>

@endsection
