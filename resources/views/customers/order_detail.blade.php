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
                                        <th> ID </th>
                                        <th> Image </th>
                                        <th> Name </th>
                                        <th> Quatity </th>
                                        <th> Price </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orderDetail as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>
                                            <img src="images/{{$item->image}}" alt="" width="50" height="50">
                                        </td>
                                        <td>{{ $item->belongToProduct->product_name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->sold_price }}</td>                                        
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
