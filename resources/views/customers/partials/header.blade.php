<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Obaju e-commerce template">
    <meta name="author" content="Ondrej Svestka | ondrejsvestka.cz">
    <meta name="keywords" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        Fashion-Shop | @yield('title')
    </title>
    <base href="{{asset('')}}">
    <meta name="keywords" content="">
    <link href="http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100" rel='stylesheet' type='text/css'>
    <!-- styles -->
    <link href="{{ asset('library/customers/bower_shopping_mall/customers/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('library/customers/bower_shopping_mall/customers/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('library/customers/bower_shopping_mall/customers/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('library/customers/bower_shopping_mall/customers/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('library/customers/bower_shopping_mall/customers/owl.theme.css') }}" rel="stylesheet">
    <link href="{{ asset('library/customers/bower_shopping_mall/customers/style.default.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('library/customers/toastr/build/toastr.css') }}">
    <link href="{{ asset('css/myCss.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="favicon.png">
</head>
<body>
        <!-- *** TOPBAR ***
            _________________________________________________________ -->
<div id="app"> 
    <div id="top">
        <div class="container">
            <div class="col-md-6 offer" data-animate="fadeInDown">
                <a href="#" class="btn btn-success btn-sm" data-animate-hover="shake">
                Offer of the day</a>  
                <a href="#">Get flat 35% off on orders over $50!</a>
            </div>
            <div class="col-md-6" data-animate="fadeInDown">
                <ul class="menu">
                    @if (Route::has('login'))
                        @auth
                            <li><a href="{{ route('myorder', Auth::user()->id) }}">My Order</a>
                            <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                            </li>
                            <li><a href="contact.html">Contact</a>
                            </li>
                        @else
                            <li><a href="{{ route('login') }}">Login</a>
                            </li>
                            <li><a href="{{ route('register') }}">Register</a>
                            </li>
                            <li><a href="contact.html">Contact</a>
                            </li>
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </div>
<!-- *** TOP BAR END *** -->
<!-- *** NAVBAR ***
    _________________________________________________________ -->
    <div class="navbar navbar-default yamm" role="navigation" id="navbar">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand home" href="{{ route('home') }}" data-animate-hover="bounce">
                <img src="images/logo.png" alt="Obaju logo" class="hidden-xs">
                <img src="images/logo-small.png" alt="Obaju logo" class="visible-xs">
                <span class="sr-only">Obaju - go to homepage</span>
                </a>
                <div class="navbar-buttons">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <i class="fa fa-align-justify"></i>
                    </button>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search">
                    <span class="sr-only">Toggle search</span>
                    <i class="fa fa-search"></i>
                    </button>
                    {{-- <a class="btn btn-default navbar-toggle" href="basket.html">
                    <i class="fa fa-shopping-cart"></i>  <span class="hidden-xs home_count_cart">3 items in cart</span>
                    </a> --}}
                </div>
            </div>

            <div id="main-menu">
                <div class="navbar-collapse collapse" id="navigation">
                    <div >
                        <ul class="nav navbar-nav navbar-left">
                            <li class="active"><a href="/">Home</a>
                            </li>
                            @foreach($categories as $category)
                                @if($category['parent_id'] == null)
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" 
                                    data-hover="dropdown" data-delay="200"> 
                                        {{ $category['category_name'] }} <b class="caret"></b>
                                    </a>
                                    @php
                                        subMenu($categories, $category['id']);
                                    @endphp
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
                
            <!--/.nav-collapse -->
            <div class="navbar-buttons">
                <div class="navbar-collapse collapse right" id="basket-overview">
                    <a href="{{ route('showcart') }}" class="btn btn-primary navbar-btn">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="hidden-sm home_count_cart">(empty)</span>
                    </a>
                </div>
                <!--/.nav-collapse -->
                <div class="navbar-collapse collapse right" id="search-not-mobile">
                    <button type="button" 
                    class="btn navbar-btn btn-primary" 
                    data-toggle="collapse" data-target="#search">
                    <span class="sr-only">Toggle search</span>
                    <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
            <div class="collapse clearfix" id="search">
                <form class="navbar-form" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-search"></i>
                        </button>
                        </span>
                    </div>
                </form>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
        <!-- /.container -->
