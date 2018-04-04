@extends('admin.master')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List Order</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th> ID </th>
                                <th> Name </th>
                                <th> Email </th>
                                <th> Address </th>
                                <th> Phone </th>
                                <th> Description </th>
                                <th> Total Price </th>
                                <th> Payment </th>
                                <th> Status </th>
                                <th> Set Day </th>
                                <th> Detail </th>
                                <th>  </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td> {{ $order->id }} </td>
                                <td> {{ $order->customer_name }} </td>
                                <td> {{ $order->customer_email }} </td>
                                <td> {{ $order->delivery_information }} </td>
                                <td> {{ $order->customer_phone }} </td>
                                <td> {{ $order->message }} </td>
                                <td> ${{ $order->total_price }} </td>
                                <td> {{ $order->payment }} </td>
                                @if ( $order->status == 0) {{-- Dang Cho --}}
                                <td>{{ 'Waiting' }}</td>
                                @elseif ($order->status == 1) {{-- Xac Nhan --}}
                                <td>{{ 'Confirm' }}</td>
                                @elseif ($order->status == 2) {{-- Hoan Thanh --}}
                                <td>{{ 'Finish' }}</td>
                                @else
                                <td>{{ 'Cancel' }}</td>  {{-- Huy Bo --}}
                                @endif
                                <td> {{ $order->created_at }} </td>
                                <td align="center"> 
                                    <a href="{{ route('orderdetail', $order->id)}}">
                                        <i class="fa fa-pencil-square-o"></i>    
                                    </a> 
                                </td>
                                <td align="center">
                                    <a>
                                        <i class="glyphicon glyphicon-trash"></i>    
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        });
    </script>
@endsection
