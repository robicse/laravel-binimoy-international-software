@extends('backend.layouts.master')
@section("title","Available Passport")
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
                    <h1>{{$supplierDetails->name}}'s available Passport Stock: {{$passengerDetails->count()}}</h1>
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
                        <h3 class="card-title float-left">Available Passport Lists</h3>
                        <div class="float-right">
                            <a href="{{route('admin.order.create')}}">
                                <button class="btn btn-success">
                                    <i class="nav-icon fa fa-shopping-cart"> Passport Stamping</i>
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#Id</th>
                                <th>Passenger Name</th>
                                <th>Passport NO</th>
                                <th>Passport Copy</th>
                                {{--<th>Supplier Name</th>--}}
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($passengerDetails as $key => $pDetails)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$pDetails->passenger_name}}</td>
                                    <td>{{$pDetails->pp_no}}</td>
                                    <td>
                                        <img src="{{asset('uploads/passport/'.$pDetails->pp_img)}}" alt="" width="30">
                                        <a href="{{asset('uploads/passport/'.$pDetails->pp_img)}}" download="" class="btn btn-warning">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </td>
                                    {{--<td>
                                        <a href="{{route('admin.passport-stock.supplier',$pDetails->supplier_id)}}">
                                            {{$pDetails->supplier->name}}
                                        </a>
                                    </td>--}}
                                    <td>
                                        <a class="btn btn-info waves-effect" href="{{route('admin.passport-stock.edit',$pDetails->id)}}">
                                            <i class="fa fa-edit"></i>
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
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#Id</th>
                                <th>Passenger Name</th>
                                <th>Passport NO</th>
                                <th>Passport Copy</th>
                                {{--<th>Supplier Name</th>--}}
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
