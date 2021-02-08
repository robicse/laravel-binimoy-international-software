@extends('backend.layouts.master')
@section("title","Passport For Stamping")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <h1>Passport List For Stamping</h1>
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
                        <li class="breadcrumb-item active">Passport For Stamping</li>
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
                        <h3 class="card-title float-left">Passport For Stamping Lists</h3>
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
                                <th>Passenger Name</th>
                                <th>Passport No</th>
                                <th>Photo</th>
                                <th>PC</th>
                                <th>MC</th>
                                <th>Visa Issue Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pending_orders as $order)
                                @php
                                    $order_inv = \App\Order::where('id',$order->order_id)->first();
                                    $supDetails = \App\Supplier::find($order_inv->supplier_id);
                                    $passenger = \App\PassengerDetails::find($order->passenger_details_id);
                                @endphp
                                <tr>
                                    <td>{{$order_inv->invoice_id}}</td>
                                    <td class="click">{{$supDetails->name}}</td>
                                    <td>{{$passenger->passenger_name}}</td>
                                    <td>{{$passenger->pp_no}}</td>
                                    <form action="{{route('admin.passport.status.change',$order->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <td>
                                            @if ($order->photo=='')
                                                <span style="font-size: 16px; color: red">
                                                    <input type="file" name="img" class="form-control" onchange="this.form.submit()">
                                                </span>
                                            @else
                                                <span style="font-size: 16px; color: darkgreen"><b>Yes</b></span>
                                            @endif
                                        </td>
                                    </form>
                                    <form action="{{route('admin.passport.status.change',$order->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <td>
                                            <div class="form-group" style="width: 120px!important;">
                                                <select name="pc" id="pc" class="form-control finger" onchange="this.form.submit()">
                                                    <option value="">Select one</option>
                                                    <option value="1" {{$order->pc== 1 ? 'selected' : ''}}>Yes</option>
                                                    <option value="0" {{$order->pc== 0 ? 'selected' : ''}}>Not Yet</option>
                                                </select>
                                            </div>
                                        </td>
                                    </form>

                                    <form action="{{route('admin.passport.status.change',$order->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <td>
                                            <div class="form-group" style="width: 120px!important;">
                                                <select name="mc" id="mc" class="form-control mc" onchange="this.form.submit()">
                                                    <option value="">Select one</option>
                                                    <option value="1" {{$order->mp== 1 ? 'selected' : ''}}>Yes</option>
                                                    <option value="0" {{$order->mp== 0 ? 'selected' : ''}}>Not Yet</option>
                                                </select>
                                            </div>
                                        </td>
                                    </form>
                                    <td>{{date('jS M Y',strtotime($order->visa_issue_date))}}</td>
                                    {{--<td>
                                        <a class="btn btn-info waves-effect" href="{{route('admin.order.invoice',$order->id)}}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a class="btn btn-primary waves-effect" href="{{route('admin.order.invoice.view',$order->id)}}">
                                            <i class="fa fa-file"></i>
                                        </a>
                                        --}}{{--<button class="btn btn-danger waves-effect" type="button"
                                                onclick="deleteCat({{$group->id}})">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <form id="delete-form-{{$group->id}}" action="{{route('admin.group.destroy',$group->id)}}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>--}}{{--
                                    </td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Invoice ID</th>
                                <th>Supplier Name</th>
                                <th>Passenger Name</th>
                                <th>Passport No</th>
                                <th>Photo</th>
                                <th>PC</th>
                                <th>MC</th>
                                <th>Visa Issue Date</th>
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
