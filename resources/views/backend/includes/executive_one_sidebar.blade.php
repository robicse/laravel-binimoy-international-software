@if (Auth::check() && Auth::user()->role_id == 2)
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: url({{asset('backend/images/sidebar1.png')}})">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{asset('backend/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Binimoy</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar" >
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('backend/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth::user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('executive.one.dashboard')}}" class="nav-link {{Request::is('executive/one/dashboard*') ? 'active' : ''}}">
                        <i class="nav-icon fa fa-dashboard"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                {{--<li class="nav-item">
                    <a href="{{route('executive.one.customer-entry-form')}}" class="nav-link {{Request::is('executive.one.customer-entry-form*') ? 'active' : ''}}">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                            Customer List
                        </p>
                    </a>
                </li>--}}

                <li class="nav-item">
                    <a href="{{route('executive_one.group.index')}}" class="nav-link {{Request::is('executive/one/group*') ? 'active' : ''}}">
                        <i class="nav-icon fa fa-building-o"></i>
                        <p>
                            Group Lists
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('executive_one.agent.index')}}" class="nav-link {{Request::is('executive/one/agent*') ? 'active' : ''}}">
                        <i class="nav-icon fa fa-user-circle"></i>
                        <p>
                            Agent Details
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('executive_one.visa-stock.index')}}" class="nav-link {{Request::is('executive/one/visa-stock*') ? 'active' : ''}}">
                        <i class="nav-icon fa fa-cc-visa"></i>
                        <p>
                            Visa Stock
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('executive_one.supplier.index')}}" class="nav-link {{Request::is('executive/one/supplier*') ? 'active' : '' ||
                        Request::is('executive/one/stamping-passport*') ? 'active' : '' || Request::is('executive/one/all-stamping-passport*') ? 'active' : '' ||
                        Request::is('executive/one/available-passport*') ? 'active' : ''}}">
                        <i class="nav-icon fa fa-user-circle"></i>
                        <p>
                            Supplier Details
                        </p>
                    </a>
                </li>

                <li class="nav-item" style="padding-top: 7px;">
                    <a href="{{route('executive_one.passport-stock.index')}}" class="nav-link {{Request::is('executive/one/passport-stock*') ? 'active' : ''}}">
                        <i class="nav-icon fa fa-book"></i>
                        <p>
                            Passport Stock
                        </p>
                    </a>
                </li>


                {{--<li class="nav-item has-treeview menu-open" style="background: #111">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-th"></i>
                        <p>
                            Other List
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./index.html" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Dashboard v1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./index2.html" class="nav-link active">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Dashboard v2</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./index3.html" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Dashboard v3</p>
                            </a>
                        </li>
                    </ul>
                </li>--}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
@else
    <h2 class="text-danger text-center m-5">Your don't have permission to access here.</h2>
@endif
