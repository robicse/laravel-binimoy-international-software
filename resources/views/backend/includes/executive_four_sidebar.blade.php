@if (Auth::check() && Auth::user()->role_id == 5)
    <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: url({{asset('backend/images/sidebar4.png')}})">
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
                        <a href="{{route('executive.four.dashboard')}}" class="nav-link {{Request::is('executive/four/dashboard*') ? 'active' : ''}}">
                            <i class="nav-icon fa fa-dashboard"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('executive.four.ready.for.fly.index')}}" class="nav-link {{Request::is('executive/four/ready-for-fly*') ? 'active' : ''}}">
                            <i class="nav-icon fa fa-fighter-jet"></i>
                            <p>
                                Ready For Fly
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview" style="border-bottom: 1px solid #4f5962; padding-top: 7px;">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-th"></i>
                            <p>
                                Accounts
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{route('admin.accounts.agent.payment')}}" class="nav-link {{Request::is('admin/accounts/agent-payment*') ? 'active' : ''}}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Agent Payments</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('admin.accounts.income.statement')}}" class="nav-link {{Request::is('admin/accounts/income-statement*') ? 'active' : ''}}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Income Statement</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('admin.accounts.cash.receive')}}" class="nav-link {{Request::is('admin/accounts/cash-receive*') ? 'active' : ''}}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Cash Receive</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('admin.accounts.bank.receive')}}" class="nav-link {{Request::is('admin/accounts/bank-receive*') ? 'active' : ''}}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Bank Receive</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('executive.four.accounts')}}" class="nav-link {{Request::is('admin/accounts*') ? 'active' : ''}}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Accounts</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('admin.accounts.balance.sheet')}}" class="nav-link {{Request::is('admin/accounts/balance-sheet*') ? 'active' : ''}}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Balance Sheet</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{--<li class="nav-item" style="border-bottom: 1px solid #4f5962;">
                        <a href="{{route('admin.accounts')}}" class="nav-link {{Request::is('admin/accounts*') ? 'active' : ''}}">
                            <i class="nav-icon fa fa-bank"></i>
                            <p>
                                Accounts
                            </p>
                        </a>
                    </li>--}}

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
