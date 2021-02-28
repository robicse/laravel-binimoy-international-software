@extends('backend.layouts.master')
@section("title","Visa Stamped")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <h1>Visa Stamped List</h1>
                </div>
                {{--@php
                    $total_quantity = 0;
                    $order_visa_sold = 0;
                @endphp
                @foreach($groups as $group_data)
                    @php
                        $group_wise_quantity = App\GroupWiseVisa::where('group_id',$group_data->id)->sum('quantity');
                        $total_quantity += $group_wise_quantity;
                        $order_visa = App\OrderDetail::where('group_id',$group_data->id)->groupBy('group_id')->count();
                        $order_visa_sold += $order_visa;
                        $net_visa_quantity = $total_quantity - $order_visa_sold;
                    @endphp
                @endforeach--}}
                <div class="col-sm-4">
                    {{--<h2>Available Visa : --}}{{--{{$net_visa_quantity}}--}}{{--</h2>--}}
                </div>

                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Visa Stamped</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title float-left">Visa Stamped Lists</h3>
                        <div class="float-right">
                            <a href="{{route('admin.order.create')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-plus-circle"></i>
                                    Add
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Invoice ID</th>
                                <th>Supplier Name</th>
                                <th>Total Amount</th>
                                <th>Discount</th>
                                <th>Pay Amount</th>
                                <th>Due Amount</th>
{{--                                <th>Date</th>--}}
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                @php
                                    $supDetails = \App\Supplier::find($order->supplier_id);
                                @endphp
                                <tr>
                                    <td>{{$order->invoice_id}}</td>
                                    <td class="click"><a href="{{route('admin.order.supplier.wise.passport',$order->supplier_id)}}">{{$supDetails->name}}</a></td>
                                    <td>{{$order->total_amount}}</td>
                                    <td>{{!empty($order->discount)? $order->discount : '0'}}</td>
                                    <td>{{$order->pay_amount}}</td>
{{--                                    <td>{{$order->due_amount}}</td>--}}
                                    <td>
{{--                                        {{ $order->due_amount}}--}}
                                        @if($order->total_amount != $order->pay_amount)
                                            <a href="" class="btn btn-warning btn-sm mx-1" data-toggle="modal" data-target="#exampleModal-<?= $order->id;?>"> Pay Due</a>
                                        @endif
                                    </td>
{{--                                    <td>{{date('jS M Y',strtotime($order->created_at))}}</td>--}}
                                    <td>
                                        <a class="btn btn-info waves-effect" href="{{route('admin.order.invoice',$order->id)}}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a class="btn btn-primary waves-effect" href="{{route('admin.order.invoice.view',$order->id)}}">
                                            <i class="fa fa-credit-card"></i>
                                        </a>
                                        {{--<button class="btn btn-danger waves-effect" type="button"
                                                onclick="deleteCat({{$group->id}})">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <form id="delete-form-{{$group->id}}" action="{{route('admin.group.destroy',$group->id)}}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>--}}
                                    </td>
                                </tr>
                                <div class="modal fade" id="exampleModal-{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Pay Due</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('pay.order.due')}}" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="due">Enter Due Amount</label>
                                                        <input type="hidden" class="form-control" name="order_id" value="{{$order->id}}">
                                                        <input type="number" class="form-control" id="due" aria-describedby="emailHelp" name="new_paid" min="" max="{{$order->due_amount}}" placeholder="Enter Amount">
                                                    </div>
                                                    {{--                                                    <div class="form-group">--}}
                                                    {{--                                                        <label for="payment_type">Payment Type</label>--}}
                                                    {{--                                                        <select name="payment_type" id="payment_type" class="form-control" required>--}}
                                                    {{--                                                            <option value="Cash" selected>Cash</option>--}}
                                                    {{--                                                            <option value="Check">Check</option>--}}
                                                    {{--                                                        </select>--}}
                                                    {{--                                                        <span>&nbsp;</span>--}}
                                                    {{--                                                        <input type="text" name="check_number" id="check_number" class="form-control" placeholder="Check Number">--}}
                                                    {{--                                                        <span>&nbsp;</span>--}}
                                                    {{--                                                        <input type="text" name="check_date" id="check_date" class="datepicker form-control" placeholder="Issue Deposit Date ">--}}
                                                    {{--                                                    </div>--}}
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        @push('js')
                                            {{--                                            <script>--}}
                                            {{--                                                $(function() {--}}
                                            {{--                                                    $('#check_number').hide();--}}
                                            {{--                                                    $('#check_date').hide();--}}
                                            {{--                                                    $('#payment_type').change(function(){--}}
                                            {{--                                                        if($('#payment_type').val() == 'Check') {--}}
                                            {{--                                                            $('#check_number').show();--}}
                                            {{--                                                            $('#check_date').show();--}}
                                            {{--                                                        } else {--}}
                                            {{--                                                            $('#check_number').val('');--}}
                                            {{--                                                            $('#check_number').hide();--}}
                                            {{--                                                            $('#check_date').hide();--}}
                                            {{--                                                        }--}}
                                            {{--                                                    });--}}
                                            {{--                                                });--}}
                                            {{--                                            </script>--}}
                                        @endpush
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Invoice ID</th>
                                <th>Supplier Name</th>
                                <th>Total Amount</th>
                                <th>Discount</th>
                                <th>Pay Amount</th>
                                <th>Due Amount</th>
{{--                                <th>Date</th>--}}
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>

@stop
@push('js')
    <script src="{{asset('backend/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script>
        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });

        //sweet alert
        function deleteCat(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your Data is save :)',
                        'error'
                    )
                }
            })
        }
    </script>
@endpush
