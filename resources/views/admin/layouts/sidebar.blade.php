<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="images/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Admin</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active">
                <a href="{{ route('listuser') }}">
                    <i class="fa fa-dashboard"></i> <span>Users</span>
                </a>
            </li>
            <li class="active">
                <a href="{{route('indexCategory')}}">
                <i class="fa fa-files-o"></i>
                <span>Categories</span>
                </a>
            </li>
            <li class="active">
                <a href="{{ route('indexColors') }}">
                <i class="fa fa-th"></i> <span>Colors</span>
                </a>
            </li>
            <li class="active">
                <a href="{{ route('indexSizes') }}">
                <i class="fa fa-pie-chart"></i>
                <span>Sizes</span>
                </a>
            </li>
            <li class="active">
                <a href="{{ route('indexProducts') }}">
                <i class="fa fa-laptop"></i>
                <span>Products</span>
                <span class="pull-right-container">
                </span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                <i class="fa fa-edit"></i> <span>Discounts</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('discountProgram') }}"><i class="fa fa-circle-o"></i> Set Discount Programs </a></li>
                    <li><a href="{{ route('discount') }}"><i class="fa fa-circle-o"></i> Set Discount Products</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
