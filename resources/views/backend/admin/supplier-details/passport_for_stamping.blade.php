@extends('backend.layouts.master')
@section("title","Passport For Stamping")
@push('css')
    <style>
        /*td a {
            display:block;
            width:100%;
        }*/
    </style>
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1>{{$supplierDetails->name}}'s stamping passport stock: {{$orderDetails->count()}}</h1>
                </div>
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Passenger Details</li>
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
{{--                            <a href="{{route('admin.supplier.create')}}">--}}
{{--                                <button class="btn btn-success">--}}
{{--                                    <i class="fa fa-plus-circle"></i>--}}
{{--                                    Add--}}
{{--                                </button>--}}
{{--                            </a>--}}
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
                                $pDetails = \App\PassengerDetails::find($orderDetail->passenger_details_id);
                                $group = \App\Group::find($orderDetail->group_id);
                            @endphp
                            <tr>
                                <td>{{$key +1 }}</td>
                                <td>{{$pDetails->passenger_name}}</td>
                                <td>{{$pDetails->pp_no}}</td>
                                <td>{{$group->name}}-{{$group->gr}}</td>
                                <td>{{$supplierDetails->name}}</td>
                                <td>{{$orderDetail->pc == 1 ? 'Yes' : 'Not Yet'}}</td>
                                <td>{{$orderDetail->pc_date}}</td>
                                <td>{{$orderDetail->mp == 1 ? 'Yes' : 'Not Yet'}}</td>
                                <td>{{$orderDetail->mp_date}}</td>
                                <td>{{$orderDetail->tc == 1 ? 'Yes' : 'Not Yet'}}</td>
                                <td>{{$orderDetail->finger == 1 ? 'Yes' : 'Not Yet'}}</td>
                                <td>{{$orderDetail->v_issue_date}}</td>
                                <td>{{$orderDetail->visa_no}}</td>
                                <td>{{$orderDetail->id_number}}</td>
                            </tr>
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
