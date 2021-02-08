@extends('backend.layouts.master')
@section("title","Balance Sheet")
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
                    <h1>Balance Sheet</h1>
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
                        <li class="breadcrumb-item active">Balance Sheet</li>
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
                        <h3 class="card-title float-left">Balance Sheet</h3>
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
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="text-center">Balance Sheet</h2>
                            </div>
                            <div class="col-md-6 text-center">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <td colspan="2" style="font-size: 22px;"> <b>Income</b> </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 22px; color: #0b2e13;">Cash</td>
                                        <td style="font-size: 22px; color: #0b2e13;">{{number_format($cash,2)}} tk</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 22px; color: #0b2e13;">Bank</td>
                                        <td style="font-size: 22px; color: #0b2e13;">{{number_format($bank,2)}} tk</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 22px; color: #0b2e13;">Stock</td>
                                        <td style="font-size: 22px; color: #0b2e13;">{{number_format($stock,2)}} tk</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 22px; color: #0b2e13;">Receivable</td>
                                        <td style="font-size: 22px; color: #0b2e13;">{{number_format($receivable,2)}} tk</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            @php
                                              $total_income = $receivable + $stock + $bank + $cash;
                                            @endphp
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="font-size: 22px; color: #0b2e13;"> <b>Total</b> </td>
                                        <td style="font-size: 22px; color: #0b2e13;"> <b>{{number_format($total_income,2)}} tk</b> </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6 text-center">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <td colspan="2" style="font-size: 22px;"> <b>Expense</b> </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 22px; color: #a77a94;">Agent Cost</td>
                                        <td style="font-size: 22px; color: #a77a94;">{{number_format($agentCost,2)}} tk</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 22px; color: #a77a94;">Agent Payable</td>
                                        <td style="font-size: 22px; color: #a77a94;">{{number_format($payable,2)}} tk</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 22px; color: #a77a94;">Total Expense</td>
                                        <td style="font-size: 22px; color: #a77a94;">{{number_format($expense,2)}} tk</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            @php
                                                $total_expenses = $expense + $payable + $agentCost;
                                            @endphp
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="font-size: 22px; color: #a77a94;"><b>Total</b></td>
                                        <td style="font-size: 22px; color: #a77a94;"><b>{{number_format($total_expenses,2)}} tk</b></td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">
                                            @php
                                                $net = $total_income - $total_expenses;
                                            @endphp
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="font-size: 22px; color: #2a9055;"><b>Net</b></td>
                                        <td style="font-size: 22px; color: #2a9055;"><b>{{number_format($net,2)}} tk</b></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
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
