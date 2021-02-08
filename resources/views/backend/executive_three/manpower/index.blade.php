@extends('backend.layouts.master')
@section("title","Manpower Passport List")
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
                    <h1>Manpower Passport</h1>
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
                        <li class="breadcrumb-item"><a href="{{route('executive.three.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Manpower Passport</li>
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
                        <h3 class="card-title float-left">Manpower Passport List</h3>
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
                                <th>Name</th>
                                <th>PP NO</th>
                                <th>Group</th>
                                <th>REF</th>
                                <th>P.C</th>
                                <th>P.C Date</th>
                                <th>M.C</th>
                                <th>M.C Date</th>
                                <th>T.C</th>
                                <th>Finger</th>
                                <th>Visa Issue</th>
                                <th>Visa No</th>
                                <th>ID</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orderDetails as $key => $orderDetail)
                               @php
                                    $supplierDetails = App\Supplier::find($orderDetail->supplier_id);
                                    $pDetails = \App\PassengerDetails::find($orderDetail->passenger_details_id);
                                    $group = \App\Group::find($orderDetail->group_id);
                                @endphp
                                    <tr>
                                        <td>{{$key +1 }}</td>
                                        <td>
                                            @if ($orderDetail->v_issue_date=='' && $orderDetail->visa_no=='' && $orderDetail->id_number=='')
                                                <span style="font-size: 16px; color: red"> <b>{{$pDetails->passenger_name}}</b></span>
                                            @else
                                                <span style="font-size: 16px; color: darkgreen"><b>{{$pDetails->passenger_name}}</b></span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($orderDetail->v_issue_date=='' && $orderDetail->visa_no=='' && $orderDetail->id_number=='')
                                                <span style="font-size: 16px; color: red"> <b>{{$pDetails->pp_no}}</b></span>
                                            @else
                                                <span style="font-size: 16px; color: darkgreen"><b>{{$pDetails->pp_no}}</b></span>
                                            @endif
                                        </td>
                                        <td>{{$group->name}}-{{$group->gr}}</td>
                                        <td>{{$supplierDetails->name}}</td>
                                        <td>{{$orderDetail->pc == 1 ? 'Yes' : 'Not Yet'}}</td>
                                        <td>{{$orderDetail->pc_date}}</td>
                                        <td>{{$orderDetail->mp == 1 ? 'Yes' : 'Not Yet'}}</td>
                                        <td>{{$orderDetail->mp_date}}</td>
                                        <td>{{$orderDetail->tc == 1 ? 'Yes' : 'Not Yet'}}</td>
                                        <td>{{$orderDetail->finger == 1 ? 'Yes' : 'Not Yet'}}</td>
                                        <td>
                                            @if ($orderDetail->v_issue_date == '')
                                                <a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalRegisterForm_{{$orderDetail->id}}">Click To Add </a>
                                            @endif
                                                {{$orderDetail->v_issue_date}}
                                        </td>
                                        <td>
                                            @if ($orderDetail->visa_no == '')
                                                <a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalRegisterForm_{{$orderDetail->id}}">Click To Add </a>
                                            @endif
                                                {{$orderDetail->visa_no}}
                                        </td>
                                        <td>{{$orderDetail->id_number}}</td>

                                    </tr>

                               <div class="modal fade" id="modalRegisterForm_{{$orderDetail->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                    aria-hidden="true">
                                   <div class="modal-dialog" role="document">
                                       <div class="modal-content">

                                           <form action="{{route('executive.three.manpower.visa.issue')}}" method="post" enctype="multipart/form-data">
                                               @csrf
                                           <div class="modal-header text-center">
                                               <h4 class="modal-title w-100 font-weight-bold">Add Visa Information</h4>
                                               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                   <span aria-hidden="true">&times;</span>
                                               </button>
                                           </div>
                                           <div class="modal-body mx-3">
                                               <div class="md-form mb-5">
                                                   <label data-error="wrong" data-success="right" for="visa_no">Visa Number</label>
                                                   <input type="hidden" id="order_details_id" name="order_details_id" class="form-control validate" value="{{$orderDetail->id}}">
                                                   <input type="text" id="visa_no" name="visa_no" class="form-control validate" placeholder="Enter Visa No">
                                               </div>
                                               <div class="md-form mb-5">
                                                   <label data-error="wrong" data-success="right" for="v_issue_date">Visa Issue Date</label>
                                                   <input type="date" name="v_issue_date" id="v_issue_date" class="form-control validate" value="{{date('Y-m-d')}}">
                                               </div>

                                               <div class="md-form mb-4">
                                                   <label data-error="wrong" data-success="right" for="id_number">Id Number</label>
                                                   <input type="text" id="id_number" name="id_number" class="form-control validate" placeholder="Enter Id Number">
                                               </div>

                                           </div>
                                           <div class="modal-footer d-flex justify-content-center">
                                               <button type="submit" class="btn btn-success">Save</button>
                                           </div>
                                         </form>
                                       </div>
                                   </div>
                               </div>

                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#Id</th>
                                <th>Name</th>
                                <th>PP NO</th>
                                <th>Group</th>
                                <th>REF</th>
                                <th>P.C</th>
                                <th>P.C Date</th>
                                <th>M.C</th>
                                <th>M.C Date</th>
                                <th>T.C</th>
                                <th>Finger</th>
                                <th>Visa Issue</th>
                                <th>Visa No</th>
                                <th>ID</th>
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
