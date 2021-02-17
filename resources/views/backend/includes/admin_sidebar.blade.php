@if (Auth::check() && Auth::user()->role_id == 1)
    <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: url({{asset('backend/images/sidebar.png')}})">
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
                    <a href="#" class="d-block">{{strtoupper(Auth::user()->role->name)}}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{route('admin.dashboard')}}" class="nav-link{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-dashboard"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.group.index')}}" class="nav-link {{request()->is('admin/group*') ? 'active' : ''}}">
                            <i class="nav-icon fa fa-building-o"></i>
                            <p>
                                Group Lists
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.agent.index')}}" class="nav-link {{request()->is('admin/agent*') ? 'active' : ''}}">
                            <i class="nav-icon fa fa-user-circle"></i>
                            <p>
                                Agent Details
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.visa-stock.index')}}" class="nav-link {{request()->is('admin/visa-stock*') ? 'active' : ''}}">
                            <i class="nav-icon fa fa-cc-visa"></i>
                            <p>
                                Visa Stock
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.supplier.index')}}" class="nav-link {{request()->is('admin/supplier*') ? 'active' : ''}}">
                            <i class="nav-icon fa fa-user-circle"></i>
                            <p>
                                Supplier Details
                            </p>
                        </a>
                    </li>
                    <li class="nav-item" style="border-bottom: 1px solid #4f5962;">
                        <a href="{{route('admin.passport-stock.index')}}" class="nav-link {{request()->is('admin/passport-stock*') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-book"></i>
                            <p>
                                Passport Stock
                            </p>
                        </a>
                    </li>
                    <li class="nav-item" style="padding-top: 7px;">
                        <a href="{{route('admin.order.index')}}" class="nav-link {{request()->is('admin/order*') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-shopping-cart"></i>
                            <p>
                                Passport Stamping
                            </p>
                        </a>
                    </li>

                    <li class="nav-item" style="padding-top: 7px;">
                        <a href="{{route('admin.order.visa.stamped')}}" class="nav-link {{request()->is('admin/visa-stamped*') ? 'active' : '' }}" >
                            <i class="nav-icon fa fa-microchip"></i>
                            <p>
                                Visa Stamped
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.training_card.index')}}" class="nav-link {{request()->is('admin/training-card*') ? 'active' : ''}}">
                            <i class="nav-icon fa fa-thumbs-o-up"></i>
                            <p>
                                Passport T.C And Finger
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('admin.manpower.index')}}" class="nav-link {{request()->is('admin/manpower*') ? 'active' : ''}}">
                            <i class="nav-icon fa fa-handshake-o"></i>
                            <p>
                                Manpower
                            </p>
                        </a>
                    </li>

                    <li class="nav-item" style="border-bottom: 1px solid #4f5962;">
                        <a href="{{route('admin.ready.for.fly.index')}}" class="nav-link {{request()->is('admin/ready-for-fly*') ? 'active' : ''}}">
                            <i class="nav-icon fa fa-fighter-jet"></i>
                            <p>
                                Ready For Fly
                            </p>
                        </a>
                    </li>

                    {{--<li class="nav-item" style="border-bottom: 1px solid #4f5962;">
                        <a href="{{route('admin.accounts')}}" class="nav-link {{Request::is('admin/accounts*') ? 'active' : ''}}">
                            <i class="nav-icon fa fa-bank"></i>
                            <p>
                                Accounts
                            </p>
                        </a>
                    </li>--}}
{{--                    <li class="nav-item has-treeview" style="border-bottom: 1px solid #4f5962; padding-top: 7px;">--}}
{{--                        <a href="#" class="nav-link">--}}
{{--                            <i class="nav-icon fa fa-th"></i>--}}
{{--                            <p>--}}
{{--                                Accounts--}}
{{--                                <i class="right fa fa-angle-left"></i>--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                        <ul class="nav nav-treeview">--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{route('admin.expense-category.index')}}" class="nav-link {{request()->is('admin/expense-category*') ? 'active' : ''}}">--}}
{{--                                    <i class="fa fa-circle-o nav-icon"></i>--}}
{{--                                    <p>Expense Category</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{route('admin.expense-manage.index')}}" class="nav-link {{request()->is('admin/expense-manage*') ? 'active' : ''}}">--}}
{{--                                    <i class="fa fa-circle-o nav-icon"></i>--}}
{{--                                    <p>Expense Manage</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}

{{--                            <li class="nav-item">--}}
{{--                                <a href="{{route('admin.accounts.agent.payment')}}" class="nav-link {{request()->is('admin/accounts/agent-payment*') ? 'active' : ''}}">--}}
{{--                                    <i class="fa fa-circle-o nav-icon"></i>--}}
{{--                                    <p>Agent Payments</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}

{{--                            <li class="nav-item">--}}
{{--                                <a href="{{route('admin.accounts.income.statement')}}" class="nav-link {{request()->is('admin/accounts/income-statement*') ? 'active' : ''}}">--}}
{{--                                    <i class="fa fa-circle-o nav-icon"></i>--}}
{{--                                    <p>Income Statement</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}

{{--                            <li class="nav-item">--}}
{{--                                <a href="{{route('admin.accounts.cash.receive')}}" class="nav-link {{request()->is('admin/accounts/cash-receive*') ? 'active' : ''}}">--}}
{{--                                    <i class="fa fa-circle-o nav-icon"></i>--}}
{{--                                    <p>Cash Receive</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}

{{--                            <li class="nav-item">--}}
{{--                                <a href="{{route('admin.accounts.bank.receive')}}" class="nav-link {{request()->is('admin/accounts/bank-receive*') ? 'active' : ''}}">--}}
{{--                                    <i class="fa fa-circle-o nav-icon"></i>--}}
{{--                                    <p>Bank Receive</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}

{{--                            <li class="nav-item">--}}
{{--                                <a href="{{route('admin.accounts')}}" class="nav-link {{request()->is('admin/accounts/account*') ? 'active' : ''}}">--}}
{{--                                    <i class="fa fa-circle-o nav-icon"></i>--}}
{{--                                    <p>Accounts</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}

{{--                            <li class="nav-item">--}}
{{--                                <a href="{{route('admin.accounts.balance.sheet')}}" class="nav-link {{request()->is('admin/accounts/balance-sheet*') ? 'active' : ''}}">--}}
{{--                                    <i class="fa fa-circle-o nav-icon"></i>--}}
{{--                                    <p>Balance Sheet</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
                    <li class="treeview{{Request::is('admin/account/coa_print*') || Request::is('admin/account/coa_print*')|| Request::is('admin/transaction*')|| Request::is('admin/account/cashbook*')|| Request::is('admin/account/trial-balance*')|| Request::is('admin/account/credit-voucher*') || Request::is('admin/account/debit-voucher*') || Request::is('admin/account/generalledger*')  ? ' is-expanded': ''}}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-file-text-o"></i> <span class="app-menu__label">Accounts </span><i class="treeview-indicator fa fa-angle-right"></i></a>
                        <ul class="treeview-menu">
                            <li  style="background-color: gray"><a class="app-menu__item" href="{{ route('admin.transaction.create') }}"><span class="app-menu__label">Posting</span></a></li>
                            <li  style="background-color: gray"><a class="app-menu__item" href="{{ route('admin.transaction.index') }}"><span class="app-menu__label">Posting List</span></a></li>
                            <li  style="background-color: gray"><a class="app-menu__item" href="{!! URL::to('admin/account/cashbook') !!}"><span class="app-menu__label">Cash Book</span></a></li>
                            <li  style="background-color: gray"><a class="app-menu__item" href="{{ route('admin.account.generalledger') }}"><span class="app-menu__label">Ledger</span></a></li>
                            {{--                <li  style="background-color: gray"><a class="app-menu__item" href="{{ route('account.debit.voucher') }}"><span class="app-menu__label">Debit Voucher</span></a></li>--}}
                            {{--                <li  style="background-color: gray"><a class="app-menu__item" href="{{ route('account.credit.voucher') }}"><span class="app-menu__label">Credit Voucher</span></a></li>--}}
                            <li  style="background-color: gray"><a class="app-menu__item" href="{!! URL::to('/account/trial-balance') !!}"><span class="app-menu__label">Trial Balance</span></a></li>
                            {{--                <li  style="background-color: gray"><a class="app-menu__item" href="{!! URL::to('/account/balance-sheet') !!}"><span class="app-menu__label">Balance Sheet</span></a></li>--}}
                            <li><a class="treeview-item{{Request::is('accounts')||Request::is('accounts/*') ? ' active': ''}}" href="{!! route('accounts.index') !!}">Chart Of Accounts</a></li>
                            <li  style="background-color: gray"><a class="app-menu__item" href="{{ route('account.coa_print') }}"><span class="app-menu__label">COA Prints</span></a></li>

                        </ul>
                    </li>

                    <li class="nav-item" style="border-bottom: 1px solid #4f5962;padding-top: 7px;">
                        <a href="{{route('admin.users.index')}}" class="nav-link {{request()->is('admin/users*') ? 'active' : ''}}">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                User Manage
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

