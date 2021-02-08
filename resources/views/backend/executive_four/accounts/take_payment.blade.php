@extends('backend.layouts.master')
@section("title","Due Invoice Take Payment")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/select2/select2.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Due Invoice Take Payment</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Due Invoice Take Payment</li>
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
                        <h3 class="card-title float-left">Due Invoice Take Payment</h3>
                        <div class="float-right">
                            <a href="{{route('admin.accounts')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->

                    @php
                      $suppiler_name = App\Supplier::find($order_details->supplier_id);
                      $paid_amount = ($order_details->pay_amount + $order_details->discount);
                    @endphp

                    <form role="form" action="{{route('admin.accounts.take.payment.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="id" id="id" value="{{$order_details->id}}">
                                <input type="hidden" name="supplier_id" id="supplier_id" value="{{$order_details->supplier_id}}">
                                <div class="form-group col-md-6">
                                    <label for="invoice_id">Invoice ID</label>
                                    <input type="text" class="form-control" name="invoice_id" id="invoice_id" value="{{$order_details->invoice_id}}" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="suppiler_name">Supplier Name</label>
                                    <input type="text" class="form-control" name="suppiler_name" id="suppiler_name" value="{{$suppiler_name->name}}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="total_amount">Total Amount</label>
                                    <input type="text" class="form-control" name="total_amount" id="total_amount" value="{{$order_details->total_amount}}" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="paid_amount">Paid Amount </label> <span>(According to Discount)</span>
                                    <input type="text" class="form-control" name="paid_amount" id="paid_amount" value="{{$paid_amount}}" readonly>
                                </div>
                                </div>
                                <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="payable_amount">Payable Amount</label>
                                    <input type="text" class="form-control" name="payable_amount" id="payable_amount" value="{{$order_details->due_amount}}" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pay_amount">Pay Amount</label>
                                    <input type="number" class="form-control" name="pay_amount" id="pay_amount" max="{{$order_details->due_amount}}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="due_amount">Due Amount</label>
                                    <input type="text" class="form-control" name="due_amount" id="dueAmount" readonly>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="due_amount">Payment Method</label>
                                    <select name="payment_method" id="payment_method" class="form-control" required>
                                        <option value="">Select one</option>
                                        <option value="1" selected>Cash</option>
                                        <option value="2">Bank</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@stop
@push('js')
    <script src="{{asset('backend/js/form.js')}}"></script>
    <script src="{{asset('backend/plugins/select2/select2.full.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $("#payable_amount, #pay_amount").on('keyup',function() {
                var payable_amount = $("#payable_amount").val();
                var pay_amount = $("#pay_amount").val();
                var dueAmount = payable_amount - pay_amount;
                $('#dueAmount').val(dueAmount);
            });
        });
    </script>

    <script type="text/javascript">
        $(".form_datetime").datetimepicker({format: 'Y-m-d'});
    </script>
@endpush
