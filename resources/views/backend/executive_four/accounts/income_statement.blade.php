@extends('backend.layouts.master')
@section("title","Income Statement")
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
                    <h1>Income Statement</h1>
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
                        <li class="breadcrumb-item active">Income Statement</li>
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
                        <h3 class="card-title float-left">Income Statement</h3>
                        <div class="float-right">
                            {{--<a href="{{route('admin.order.create')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-plus-circle"></i>
                                    Add
                                </button>
                            </a>--}}
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#Id</th>
                                <th>Invoice</th>
                                <th>Supplier Name</th>
                                <th>Total Amount</th>
                                <th>Paid Amount</th>
                                <th>Discount</th>
                                <th>Due Amount</th>
                                <th>Balance</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $total_amount = 0;
                                //$total_income = 0;
                            @endphp
                            @foreach($order as $key => $orderinfo)
                                @php
                                    //$total_amount = 0;

                                        $supplierDetails = \App\Supplier::where('id', $orderinfo->supplier_id)->first();
                                        $orderdetails = \App\OrderDetail::where('order_id', $orderinfo->id)->first();
                                        //$groupwisevisa = \App\GroupWiseVisa::where('group_id', $orderdetails->group_id)->sum('per_piece_price');


                                @endphp
                                <tr>
                                    <td>{{$key +1 }}</td>
                                    <td>{{$orderinfo->invoice_id}}</td>
                                    <td>{{$supplierDetails->name}}</td>
                                    <td>{{$orderinfo->total_amount}}</td>
                                    <td>{{$orderinfo->pay_amount}}</td>
                                    <td>{{$orderinfo->discount}}</td>
                                    <td>{{$orderinfo->due_amount}}</td>
                                    <td><?php $balance =+ $orderinfo->pay_amount;?>{{$balance}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#Id</th>
                                <th>Invoice</th>
                                <th>Supplier Name</th>
                                <th>Total Amount</th>
                                <th>Paid Amount</th>
                                <th>Discount</th>
                                <th>Due Amount</th>
                                <th>Balance</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div>
                        <table class="table table-bordered table-striped">
                            <tr>
                                <td colspan="2" class="text-center" style="font-size: 25px;">Income Statement</td>
                            </tr>
                            <tr>
                                <td style="font-size: 22px; color: #0b2e13;">Total Income</td>
                                <td style="font-size: 22px; color: #0b2e13;">{{ number_format($total_income, 2) }} TK</td>
                            </tr>
                            <tr>
                                <td style="font-size: 22px; color:#a94442;">Total Expense</td>
                                <td style="font-size: 22px; color:#a94442;">{{ number_format($total_expense, 2) }} TK</td>
                            </tr>
                            <tr>
                                <td style="font-size: 22px; color: #0b2e13;">Ticket Cost</td>
                                <td style="font-size: 22px; color: #0b2e13;">{{ number_format($total_ticket_cost, 2) }} TK</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    @php
                                        $total_expenses = $total_expense + $total_ticket_cost;
                                        $net = $total_income - $total_expenses;
                                    @endphp

                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 22px; color: #2a9055;">Net</td>
                                <td style="font-size: 22px; color: #2a9055;">{{ number_format($net, 2) }} TK</td>
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
