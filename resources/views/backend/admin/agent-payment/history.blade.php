@extends('backend.layouts.master')
@section("title","Payment History")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <h1>Payment History</h1>
                </div>
                <div class="col-sm-4 text-right">
                    <h3>Total Visa Stock: {{$VisaStocks}}</h3>
                </div>
                <div class="col-sm-2">
                    @php
                        $total_available_quantity2 = 0;
                    @endphp
                    @foreach($VisaStocks_details as $total_visa_data)
                        @php
                            $agent_name = App\AgentDetail::find($total_visa_data->agent_id);

                $quantity2 = App\VisaStock::find($total_visa_data->id);
                //dd($quantity1);
                    //$quantity1->quantity;
                $check_data2 = App\GroupWiseVisa::where('visa_stock_id',$total_visa_data->id)->sum('quantity');
                //dd($check_data1);
               //print_r($check_data1);
                    if ($check_data2 ==''){
                        $available_quantity2 = $quantity2->quantity;
                        //dd($available_quantity1);
                    }else{
                        $available_quantity2 = $quantity2->quantity - $check_data2;
                        $total_available_quantity2 += $available_quantity2;
                    }
                        @endphp
                    @endforeach
                    {{--<h3>Total Available Visa: {{$total_available_quantity2}}</h3>--}}
                </div>
                <div class="col-sm-2">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">History</li>
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
                        <h3 class="card-title float-left">Payment History</h3>
                        {{--<div class="float-right">
                            <a href="{{route('admin.visa-stock.create')}}">
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
                                <th>#Id</th>
                                <th>Agent Name</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Paid Amount</th>
                                <th>Payable Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($VisaStocks_details as $key => $vDetails)

                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$agent_name->name}}</td>
                                    <td>{{!empty($vDetails->quantity)?$vDetails->quantity:''}}</td>
                                    <td>{{$vDetails->total_price}}</td>
                                    <td style="color:darkgreen; font-size: 20px;"><b>{{$vDetails->pay_amount}}</b></td>
                                    <td style="color:darkred; font-size: 20px;"><b>{{$vDetails->due_amount}}</b></td>

                                </tr>



                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#Id</th>
                                <th>Agent Name</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Paid Amount</th>
                                <th>Payable Amount</th>
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
        /*function deleteCat(id) {
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
        }*/
    </script>


@endpush
