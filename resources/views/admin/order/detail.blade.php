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
                                <th> Image </th>
                                <th> Name </th>
                                <th> Quatity </th>
                                <th> Price </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orderDetail as $item)
                            <tr>
                                <td> {{ $item->id }} </td>
                                <td>
                                    <img src="images/{{ $item->image }}" alt="" width="50" height="50">
                                </td>
                                <td> {{ $item->belongToProduct->product_name }} </td>
                                <td> {{ $item->quantity }} </td>
                                <td> ${{ $item->sold_price }} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            <div class="row" style="padding-left: 8px;">
                <div class="col-sm-2">
                    <select class="form-control m-bot15" id="status_bill_detail" 
                    idOrder="@if (isset($order)) {{ $order->id }} @endif">
                        @if (isset($order))
                            @if ($order->status == 2)
                            <option value="2" @if ($order->status == 2) {{ 'selected=""' }} @endif> Finish </option>
                            @else
                            <option class="del_option" value="0" 
                            @if ($order->status == 0) {{ 'selected=""' }} @endif> Waiting 
                            </option>
                            <option class="del_option" value="1" 
                            @if ($order->status == 1) {{ 'selected=""' }} @endif> Confirm 
                            </option>
                            <option value="2" @if ($order->status == 2) {{ 'selected=""' }} @endif> Finish </option>
                            <option class="del_option" value="3" 
                            @if ($order->status == 3) {{ 'selected=""' }} @endif> Cancel 
                            </option>
                            @endif
                        @endif
                    </select>
                </div>
                @if ($order->status != 2)
                <div class="col-sm-2 dlt">
                    <a id="button_update_status" class="btn btn-success"><i class="fa fa-refresh"></i> Update </a>
                </div>
                @endif
            </div>
            <div class="row" style="padding-left: 8px; padding-top: 10px; padding-bottom: 10px;">
                <div class="col-sm-2">
                    <a class="btn btn-warning" href="{{ route('order') }}">
                        <i class="glyphicon glyphicon-chevron-left"></i> Back 
                    </a>
                </div>
            </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/customers/detail.js') }}"></script>
@endsection
