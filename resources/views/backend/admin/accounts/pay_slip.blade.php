@extends('backend.layouts.master')
@section("title","Take Payment Slip Print")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/select2/select2.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Invoice View</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Take Payment Slip</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content" >
        <div class="row">
            <div class="col-12">
                <!-- general form elements -->
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title float-left">Take Payment Slip</h3>
                        <div class="float-right">
                            {{--<a href="{{route('admin.order.create')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>--}}
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- Main content -->
                    <div class="invoice p-3 mb-3" id="printTable">
                        <!-- Font Awesome Icons -->
                        <link rel="stylesheet" href="{{asset('backend/plugins/font-awesome/css/font-awesome.min.css')}}">
                        <!-- Theme style -->
                        <link rel="stylesheet" href="{{asset('backend/dist/css/adminlte.min.css')}}">
                        <!-- Google Font: Source Sans Pro -->
                        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fa fa-globe"></i> Binimoy Int.
                                    <small class="float-right">Date: @php echo date('Y-m-d'); @endphp</small>
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">

                                <address>
                                    {{--<strong>Robiul Hasan</strong><br>--}}
                                    <strong> Address : </strong> 82, ShantiNagar (40/3 New Paltan)<br>
                                    Dhaka-1217, Bangladesh<br>
                                    <strong>Phone: </strong> (880) 1787-681170<br>
                                    <strong>Email: </strong> info@binimoy.com
                                </address>
                            </div>

                            <div class="col-sm-4 invoice-col">
                                Supplier
                                @php


                                $supplier_info = App\Supplier::find($take_payment_data->supplier_id);

                                @endphp
                                <address>
                                    <strong>{{$supplier_info->name}}</strong><br>
                                    <strong> Address : </strong> {{$supplier_info->address}}<br>
                                    <strong>Phone: </strong> {{$supplier_info->mobile}}<br>
                                    <strong>Emergency Phone: </strong> {{$supplier_info->emergency_contact}}<br>
                                    <strong>Email: </strong> {{$supplier_info->email}}
                                </address>
                            </div>


                            <div class="col-sm-4 invoice-col">
                                <div class="text-right">
                                    <strong>Invoice : #{{$take_payment_data->invoice_id}}</strong><br>

                                    {{--<b>Order ID:</b>00{{$order->id}}<br>
                                    --}}{{--<b>Payment Due:</b> 2/22/2014<br>--}}{{--
                                    <b>Account:</b> 968-34567--}}
                                </div>

                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <td>Total Amount</td>
                                        <td>{{$order_data->total_amount}}</td>
                                    </tr>
                                    <tr>
                                        <td>Payable Amount</td>
                                        <td>{{$take_payment_data->payable_amount}}</td>
                                    </tr>
                                    <tr>
                                        <td>Now Pay</td>
                                        <td>{{$take_payment_data->pay_amount}}</td>
                                    </tr>
                                    <tr>
                                        <td>Due</td>
                                        <td>{{$take_payment_data->due_amount}}</td>
                                    </tr>
                                </table>
                                <hr>
                                <div class="col-md-12 text-center">
                                    <a href="">
                                        <button class="btn-primary btn">print</button>
                                    </a>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-6">

                            </div>
                            <!-- /.col -->
                            <div class="col-6">
                                <div class="table-responsive">

                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->


                    </div>

                </div>
            </div>
    </section>
@stop
@push('js')
    <script>
        function printData()
        {
            var divToPrint=document.getElementById("printTable");
            newWin= window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
        }

        $('button').on('click',function(){
            printData();
        })
    </script>
@endpush
