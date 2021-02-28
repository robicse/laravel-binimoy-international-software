@extends('backend.layouts.master')
@section("title","Invoice View")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/select2/select2.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Invoice Preview</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Invoice View</li>
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
                        <h3 class="card-title float-left">Visa Invoice Preview</h3>
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
                                    $supplier_info = App\Supplier::find($supplier);

                                @endphp
                                <address>
                                    <strong>{{$supplier_info->name}}</strong><br>
                                    <strong> Address : </strong> {{$supplier_info->address}}<br>
                                    <strong>Phone: </strong> {{$supplier_info->mobile}}<br>
                                    {{--<strong>Emergency Phone: </strong> {{$supplier_info->emergency_contact}}<br>--}}
                                    <strong>Email: </strong> {{$supplier_info->email}}
                                </address>
                            </div>


                            <div class="col-sm-4 invoice-col">
                                <div class="text-right">
                                    <strong>Invoice : #{{$order->invoice_id}}</strong><br>

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
                                    <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Passenger Name</th>
                                        <th>Passport No</th>
                                        <th>Visa Type</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $total_amo = 0;
                                    @endphp
                                    @foreach($order_details as $key => $order_details_data)
                                        @php
                                            $passenger_details = App\PassengerDetails::where('id',$order_details_data->passenger_details_id)->first();
                                            $group_details = App\Group::where('id',$order_details_data->group_id)->first();
                                            $groupWise = App\GroupWiseVisa::where('group_id',$order_details_data->group_id)->first();

                                            $total_amo += ($groupWise->per_piece_price);
                                             //$total += ($groupWise->per_piece_price);


                                        @endphp
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$passenger_details->passenger_name}}</td>
                                            <td>{{$passenger_details->pp_no}}</td>
                                            <td>{{$group_details->name}}-{{$group_details->gr}}</td>
                                            <td>{{$groupWise->per_piece_price}} TK</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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
                                    <table class="table">
                                        <tr>
                                            <input class="form-control" type="hidden" name="order_id" id="order_id" value="{{$order->id}}">
                                            <th style="width:50%">Total:</th>
                                            <td class="text-center">{{$total_amo}}</td>
                                        </tr>
                                        <tr>
                                            <th>Discount:</th>
                                            <td class="text-center">{{$order->discount}}</td>
                                        </tr>
                                        <tr>
                                            <th>Pay Amount</th>
                                            <td class="text-center">{{$order->pay_amount}}</td>
                                        </tr>

                                        <tr>
                                            <th>Due:</th>
                                            <td class="text-center">{{$order->due_amount}}</td>
                                        </tr>

                                        <tr>
                                            <th>Payment Method:</th>
                                            @if ($order->payment_method =='1')
                                                <td class="text-center">Cash</td>
                                            @else
                                                <td class="text-center">Bank</td>
                                            @endif

                                        </tr>


                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <div class="row no-print">
                            <div class="col-12">
                                <button type="button" class="btn btn-danger float-right" id="btnPrint"><i class="fa fa-print"></i> Print</button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
@stop
@push('js')
    <script>
        window.print();
        function printData()
        {
            var divToPrint=document.getElementById("printTable");
            newWin= window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
        }
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
