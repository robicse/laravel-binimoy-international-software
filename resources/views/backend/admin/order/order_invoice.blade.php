@extends('backend.layouts.master')
@section("title","Invoice add for visa")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/select2/select2.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Invoice for visa </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Invoice for visa</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <!-- general form elements -->
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title float-left">Invoice add for visa</h3>
                        <div class="float-right">
                            <a href="{{route('admin.order.create')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->

                <!-- Main content -->
                    <div class="invoice p-3 mb-3">
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
                                    $total=0;
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
                                    @foreach($order_details as $key => $order_details_data)
                                    @php
                                            $passenger_details = App\PassengerDetails::where('id',$order_details_data->passenger_details_id)->first();
                                            $group_details = App\Group::where('id',$order_details_data->group_id)->first();
                                            $groupWise = App\GroupWiseVisa::where('group_id',$order_details_data->group_id)->first();
                                        $total += ($groupWise->per_piece_price);
                                    @endphp
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$passenger_details->passenger_name}}</td>
                                        <td>{{$passenger_details->pp_no}}</td>
                                        <td>{{$group_details->name}}-{{$group_details->gr}}</td>
                                        <td>{{$groupWise->per_piece_price}}</td>

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
                                {{--<p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                                    plugg
                                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                                </p>--}}
                            </div>
                            <!-- /.col -->
                            <div class="col-6">
                                {{--<p class="lead">Amount Due 2/22/2014</p>--}}

                                <form action="{{route('admin.order.invoice_store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <input class="form-control" type="hidden" name="order_id" id="order_id" value="{{$order->id}}">
                                                <th style="width:50%">Total:</th>
                                                <td><input class="form-control" type="text" name="total_amount" id="total_amount" value="{{$total}}" readonly></td>
                                            </tr>
                                            @php
                                                $forAmountCheck = App\Order::find($order->id);
                                            //print_r($forAmountCheck);
                                            //if ($forAmountCheck->discount =='')
                                            @endphp
                                            <tr>
                                                <th>Discount:</th>
                                                <td>
                                                    @if($forAmountCheck->discount =='')
                                                    <input class="form-control" type="text" name="discount" id="discount" placeholder="Enter your discount amount">
                                                    @else
                                                    <input class="form-control" type="text" name="discount" id="discount" value="{{$forAmountCheck->discount}}">
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Pay Amount</th>
                                                <td>
                                                    @if($forAmountCheck->pay_amount =='')
                                                        <input class="form-control" type="text" name="pay_amount" id="pay_amount" placeholder="Enter Payment">
                                                    @else
                                                        <input class="form-control" type="text" name="pay_amount" id="pay_amount" value="{{$forAmountCheck->pay_amount}}">
                                                    @endif

                                                </td>
                                            </tr>

                                            <tr>
                                                <th>Due:</th>
                                                <td>
                                                    @if($forAmountCheck->due_amount =='')
                                                        <input class="form-control" type="text" name="due_amount" id="dueAmount" readonly>
                                                    @else
                                                        <input class="form-control" type="text" name="due_amount" id="dueAmount" value="{{$forAmountCheck->due_amount}}" readonly>
                                                    @endif
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>Payment Method:</th>
                                                <td>
                                                    <select name="payment_method" id="payment_method" class="form-control" required>
                                                        <option value="">Select one</option>
                                                        <option value="1" selected>Cash</option>
                                                        <option value="2">Bank</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <div class="row no-print">
                            <div class="col-12">
                                {{--<a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                                --}}<button type="submit" class="btn btn-success float-right"><i class="fa fa-credit-card"></i> Submit
                                    Payment
                                </button>
                                {{--<button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                    <i class="fa fa-download"></i> Generate PDF
                                </button>--}}
                            </div>
                        </div>
                    </form>

                    </div>

            </div>
        </div>
    </section>

@stop
@push('js')

    <script>
        $(document).ready(function () {
            $("#total_amount, #discount,#pay_amount").on('keyup',function() {
                var totalAmount = $("#total_amount").val();
                var discount = $("#discount").val();
                var payAmount = $("#pay_amount").val();
                var subTotal = totalAmount - discount;
                var dueAmount = subTotal - payAmount;

                //onsole.log(dueAmount);
                $('#dueAmount').val(dueAmount);
                //document.getElementById('due_amount').id
                //document.getElementById('due_amount');


                /*$("#due_amount").val() - );*/
            });
        });
    </script>

    <script src="{{asset('backend/js/form.js')}}"></script>
    <script src="{{asset('backend/plugins/select2/select2.full.min.js')}}"></script>

    <script>
        //Initialize Select2 Elements
        $('.select2').select2();
    </script>
    <script>
        $(document).ready(function(){
            var i=1;
            $('#add').click(function(){
                var passenger_id = $('.passenger_id').html();
                var group_id = $('.group_id').html();
                var pc = $('.pc').html();
                /*var pp_no = $('.pp_no').html();*/
                i++;
                $('#dynamic_field').append(
                    '<tr id="row'+i+'">'+
                    '<td width="">'+
                    '<select class="form-control passenger_id select2" name="passenger_id[]" required>' + passenger_id +'</select>'+
                    '</td>'+
                    '<td width="">'+
                    '<select class="form-control group_id select2" name="group_id[]" required>' + group_id +'</select>'+
                    '</td>'+
                    '<td width="">'+
                    '<input type="file" name="img[]"  class="form-control-file" />'+
                    '</td>'+
                    '<td width="">'+
                    '<select class="form-control pc select2" name="pc[]" required>' + pc +'</select>'+
                    '</td>'+
                    '<td width="2%">'+
                    '<button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button>'+
                    '</td>'+
                    '</tr>'
                );
            });

            $(document).on('click', '.btn_remove', function(){
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();
            });

        });
    </script>
@endpush
