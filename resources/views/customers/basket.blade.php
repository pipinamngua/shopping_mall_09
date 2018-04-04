@extends('customers.main')
@section('title', 'Home')
@section('content')
    <div id="all">

        <div id="content">
            <div class="container">
                <div class="col-md-9" id="basket">

                    <div class="box">

                        <form action="{{ route('checkout') }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <h1>Shopping cart</h1>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Product</th>
                                            <th>Quantity</th>
                                            <th>Unit price</th>
                                            <th colspan="2">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cartContents as $cart)
                                            <tr class="myTable">
                                                <td>
                                                    <a href="#">
                                                        <img src="images/{{ $cart->options->img }}" 
                                                        alt="White Blouse Armani">
                                                    </a>
                                                </td>
                                                <td><a href="#">{{ $cart->name }}</a>
                                                </td>
                                                <td>
                                                    <input type="number" value="{{ $cart->qty }}" 
                                                    class="form-control change-qty" min="1" 
                                                    idCart="{{ $cart->rowId }}">
                                                </td>
                                                <td>{{ $cart->price }}</td>
                                                <td class="item_price">
                                                    ${{ number_format($cart->price * $cart->qty, 0, ',', '.') }}
                                                </td>
                                                <td>
                                                    <a href="" class="delete-product" idCart="{{ $cart->rowId }}">
                                                        <i class="fa fa-trash-o"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            @php
                                                $cartTotal = str_replace(',', '.', $cartTotal);
                                            @endphp
                                            <th colspan="5">Total</th>
                                            <th colspan="2" class="item_total_price">${{ $cartTotal }}</th>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>
                            <!-- /.table-responsive -->
                            <h1>Checkout</h1>
                            <div class="content">
                                @if(Session::has('errors'))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="alert alert-danger">
                                            {{ $errors->first() }}
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if (Session::has('thongbao'))
                                <div class="row">
                                    <div class="col-sm-12">
                                       <div class="row alert alert-success"> 
                                           {{Session::get('thongbao')}} 
                                       </div>
                                    </div>
                                </div>
                                @endif
                                @if (Session::has('loi'))
                                <div class="row">
                                    <div class="col-sm-12">
                                       <div class="row alert alert-success"> 
                                           {{Session::get('loi')}} 
                                       </div>
                                    </div>
                                </div>
                                @endif
                                @if(isset(Auth::user()->email))
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="fullname">Fullname</label>
                                            <input name="name" type="text" class="form-control" id="fullname" 
                                            value="{{Auth::user()->name}}" readonly="">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input name="email" type="text" class="form-control" id="email" 
                                            value="{{Auth::user()->email}}" readonly="">
                                        </div>
                                    </div>

                                </div>
                                @else
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="fullname">Fullname</label>
                                            <input name="name" type="text" class="form-control" id="fullname">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input name="email" type="text" class="form-control" id="email">
                                        </div>
                                    </div>

                                </div>
                                @endif
                                <!-- /.row -->

                                <div class="row">
                                    @if(isset(Auth::user()->address))
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input name="address" type="text" class="form-control" id="address" 
                                            value="{{Auth::user()->address}}">
                                        </div>
                                    </div>
                                    @else
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input name="address" type="hidden" class="form-control" id="address" 
                                            value="">
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="delivery_information">Delivery Information</label>
                                            <input name="delivery_information" type="text" class="form-control" 
                                            id="delivery_information">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row -->
                                
                                <div class="row">
                                    @if(isset(Auth::user()->phone))
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="phone">Telephone</label>
                                            <input name="phone" type="text" class="form-control" id="phone"
                                            value="{{Auth::user()->phone}}">
                                        </div>
                                    </div>
                                    @else
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="phone">Telephone</label>
                                            <input name="phone" type="text" class="form-control" id="phone">
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="message">Message</label>
                                            <textarea name="message" class="form-control" id="message" rows="3">
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>

                            <div class="box-footer">
                                <div class="pull-left">
                                    <a href="/" class="btn btn-default">
                                        <i class="fa fa-chevron-left"></i> Continue shopping
                                    </a>
                                </div>
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary">
                                        Check out<i class="fa fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>

                        </form>

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
        <script src="{{ asset('js/customers/basket.js') }}"></script>
@endsection
