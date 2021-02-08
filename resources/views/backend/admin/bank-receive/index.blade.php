@extends('backend.layouts.master')
@section("title","Bank Received List")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <h1>Bank Received List</h1>
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
                        <li class="breadcrumb-item active">Bank Received</li>
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
                        <h3 class="card-title float-left">Bank Received Lists</h3>
                        {{--<div class="float-right">
                            <a href="{{route('admin.order.create')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-plus-circle"></i>
                                    Add
                                </button>
                            </a>
                        </div>--}}
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Invoice ID</th>
                                <th>Supplier Name</th>
                                <th>Total Amount</th>
                                <th>Discount</th>
                                <th>Pay Amount</th>
                                <th>Due Amount</th>

                                {{--<th>Action</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $total = 0;
                                $totaldue = 0;
                            @endphp
                            @foreach($orders as $order)

                                @php
                                    $supDetails = \App\Supplier::find($order->supplier_id);
                                    $total += $order->pay_amount;
                                    $totaldue += $order->due_amount;
                                @endphp
                                <tr>

                                    <td>{{date('jS M Y',strtotime($order->created_at))}}</td>
                                    <td>{{$order->invoice_id}}</td>
                                    <td class="click"><a href="{{route('admin.order.supplier.wise.passport',$order->supplier_id)}}">{{$supDetails->name}}</a></td>
                                    <td>{{$order->total_amount}}</td>
                                    <td>{{!empty($order->discount)? $order->discount : '0'}}</td>
                                    <td>{{$order->pay_amount}}</td>
                                    <td>{{$order->due_amount}}</td>


                                </tr>
                            @endforeach

                            </tbody>
                            <tr>
                                <td colspan="5" class="bg-success text-right text-bold">Total</td>
                                <td class="bg-success text-right text-bold">{{number_format($total, 2)}}</td>
                                <td class="bg-success text-right text-bold">{{number_format($totaldue, 2)}}</td>
                            </tr>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>

@stop
@push('js')
    <script src="{{asset('backend/js/form.js')}}"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#example1').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'print'
                ]
            } );
        } );

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
