@extends('customers.main')
@section('title', 'Home')
@section('content')
    <div id="all">

        <div id="content">
            <div class="container">
                <div class="col-md-9" id="basket">

                    <div class="box">
                        <h1>My Order</h1>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th> Set Day </th>
                                        <th> Description </th>
                                        <th> Total </th>
                                        <th> Status </th>
                                        <th> Detail </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr class="rem1">
                                        <td>
                                            @if($order->status == 0)
                                            <a href="{{ route('deleteorder', $order->id) }}" 
                                                onclick="return confirm('Bạn có chắc là muốn xóa?')">
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                            @endif
                                        </td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->message }}</td>
                                        <td>${{ $order->total_price }}</td>
                                        <td>
                                            @if ( $order->status == 0)
                                            {{ 'Waiting' }}
                                            @elseif ($order->status == 1)
                                            {{ 'Confirm' }}
                                            @elseif ($order->status == 2)
                                            {{ 'Finish' }}
                                            @else
                                            {{ 'Cancel' }}
                                            @endif
                                        </td>
                                        <td> 
                                            <a href="{{ route('myorderdetail', $order->id) }}">
                                                <i class="fa fa-pencil-square-o"></i>    
                                            </a> 
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                            <!-- /.table-responsive -->

                    </div>
                    <!-- /.box -->
                </div>
            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->

        <!-- *** FOOTER *** -->
@endsection
@section('javascript')
    <script></script>
@endsection
