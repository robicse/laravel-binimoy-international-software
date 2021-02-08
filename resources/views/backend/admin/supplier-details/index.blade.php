@extends('backend.layouts.master')
@section("title","Supplier Details")
@push('css')
    <style>
        .click a {
            display: block;
        }
    </style>
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Supplier Details List (Passport Provider)</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Supplier Details List</li>
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
                        <h3 class="card-title float-left">Supplier Details Lists</h3>
                        <div class="float-right">
                            <a href="{{route('admin.supplier.create')}}">
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
                                <th>#Id</th>
                                <th>Name</th>
                                <th>Mobile Number</th>
                                <th>Total Passport</th>
                                <th>Passport for Stamping</th>
                                <th>Available Passport</th>
                                <th>Previous Pay</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($suppliers as $key => $supplier)
                                @php
                                $stock = \App\Stock::where('supplier_id',$supplier->id)->first();
                                $availablePass = \App\PassengerDetails::where('supplier_id',$supplier->id)->where('status',0)->get();
                                $stampingPass = \App\OrderDetail::where('supplier_id',$supplier->id)->get();
                                @endphp
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$supplier->name}}</td>
                                <td>{{$supplier->mobile}}</td>
                                <td class="click">
                                    <a href="{{route('admin.passport-stock.supplier',$supplier->id)}}"><strong>{{!empty($stock->quantity) ? $stock->quantity : 'Stock Not Available'}}</strong></a>
                                </td>
                                <td class="click">
                                    <a href="{{route('admin.stamping-passport',$supplier->id)}}"><strong>{{!empty($stampingPass->count()) ? $stampingPass->count() : 'Not Yet stamping'}}</strong></a>
                                </td>
                                <td class="click">
                                    <a href="{{route('admin.available-passport',$supplier->id)}}"><strong>{{$availablePass->count()}}</strong></a>
                                <td>{{$supplier->previous_pay}}</td>
                                <td>
                                    <a class="btn btn-success waves-effect" href="{{route('admin.supplier.edit',$supplier->id)}}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a class="btn btn-info waves-effect" href="{{route('admin.supplier.edit',$supplier->id)}}">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <button class="btn btn-danger waves-effect" type="button"
                                            onclick="deleteCat({{$supplier->id}})">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <form id="delete-form-{{$supplier->id}}" action="{{route('admin.supplier.destroy',$supplier->id)}}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#Id</th>
                                <th>Name</th>
                                <th>Mobile Number</th>
                                <th>Total Passport</th>
                                <th>Passport for Stamping</th>
                                <th>Available Passport</th>
                                <th>Previous Pay</th>
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
