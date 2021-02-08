@if (Auth::check() && Auth::user()->role_id == 4)
    <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: url({{asset('backend/images/sidebar3.png')}})">
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
                        <a href="{{route('executive.three.dashboard')}}" class="nav-link {{Request::is('executive/three/dashboard*') ? 'active' : ''}}">
                            <i class="nav-icon fa fa-dashboard"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('executive.three.training_card.index')}}" class="nav-link {{Request::is('executive/three/training-card*') ? 'active' : ''}}">
                            <i class="nav-icon fa fa-thumbs-o-up"></i>
                            <p>
                                Passport T.C And Finger
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('executive.three.manpower.index')}}" class="nav-link {{Request::is('executive/three/manpower*') ? 'active' : ''}}">
                            <i class="nav-icon fa fa-handshake-o"></i>
                            <p>
                                Manpower
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
