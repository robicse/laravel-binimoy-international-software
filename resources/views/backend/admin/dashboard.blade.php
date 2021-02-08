@extends('backend.layouts.master')
@section("title","Dashboard")
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{strtoupper('Binimoy '.Auth::user()->role->name.' Dashboard' )}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{route('admin.group.index')}}">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fa fa-building-o"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Group</span>
                                <span class="info-box-number">{{$groups->count()}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </a>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{route('admin.agent.index')}}">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-users"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Agent</span>
                                <span class="info-box-number">{{$agentDetails->count()}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </a>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{route('admin.supplier.index')}}">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i
                                    class="fa fa-users"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Supplier</span>
                                <span class="info-box-number">{{$supplierDetails->count()}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </a>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{route('admin.all-stamping-passport')}}">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-shopping-cart"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Stamping Passport</span>
                                <span class="info-box-number">{{$orderDetails->count()}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </a>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->


            <!-- /.row -->

            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-md-9">
                    <!-- MAP & BOX PANE -->
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Latest Applied Visa</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-widget="remove">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                    <tr>
                                        <th>Invoice ID</th>
                                        <th>Supplier Name</th>
                                        <th>Total Amount</th>
                                        <th>Discount</th>
                                        <th>Pay Amount</th>
                                        <th>Due Amount</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        @php
                                            $supDetails = \App\Supplier::find($order->supplier_id);
                                        @endphp
                                    <tr>
                                        <td class="click">
                                            @if(empty($order->pay_amount))
                                                <a href="{{route('admin.order.invoice',$order->id)}}">{{$order->invoice_id}}</a>
                                            @else
                                                <a href="{{route('admin.order.invoice.view',$order->id)}}">{{$order->invoice_id}}</a>
                                            @endif
                                        </td>
                                        <td>{{$supDetails->name}}</td>
                                        <td>{{$order->total_amount}}</td>
                                        <td>{{!empty($order->discount)? $order->discount : '0'}}</td>
                                        <td>{{$order->pay_amount}}</td>
                                        <td>{{$order->due_amount}}</td>
                                        <td>{{date('jS M Y',strtotime($order->created_at))}}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <a href="{{route('admin.order.create')}}" class="btn btn-sm btn-info float-left">Place New Order</a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All
                                Orders</a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                </div>
                <div class="col-md-3">
                    <!-- Info Boxes Style 2 -->
                    <div class="info-box mb-3 bg-warning">
                        <span class="info-box-icon"><i class="fa fa-cc-visa"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Visa Available</span>
                            <span class="info-box-number">
                        @php
                            $total_quantity = 0;
                            $order_visa_sold = 0;
                        @endphp
                    @foreach($groups as $group_data)
                        @php
                           $group_wise_quantity = App\GroupWiseVisa::where('group_id',$group_data->id)->sum('quantity');
                           $total_quantity += $group_wise_quantity;
                           $order_visa = App\OrderDetail::where('group_id',$group_data->id)->groupBy('group_id')->count();
                           $order_visa_sold += $order_visa;
                           //$net_visa_quantity = $total_quantity - $order_visa_sold;
                        @endphp
                    @endforeach
                                {{--{{$net_visa_quantity}}--}}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    <div class="info-box mb-3 bg-success">
                        <span class="info-box-icon"><i class="fa fa-heart-o"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Manpower</span>
                            <span class="info-box-number"></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    <div class="info-box mb-3 bg-danger">
                        <span class="info-box-icon"><i class="fa fa-plane"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Ready For Fly</span>
                            <span class="info-box-number"></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    <div class="info-box mb-3 bg-primary">
                        <span class="info-box-icon"><i class="fa fa-area-chart"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Income</span>
                            <span class="info-box-number"></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>

                    <div class="info-box mb-3 bg-danger">
                        <span class="info-box-icon"><i class="fa fa-line-chart"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Expense</span>
                            <span class="info-box-number"></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>

                    <div class="info-box mb-3 bg-info">
                        <span class="info-box-icon"><i class="fa fa-bar-chart"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Net Profit/Loss</span>
                            <span class="info-box-number"></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
@stop
