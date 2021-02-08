@extends('backend.layouts.master')
@section("title","Group Wise Visa Divided")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <h1>Group Wise Visa</h1>
                </div>
                <div class="col-sm-4">
                    {{--<h1>Total Visa Stock: {{$groupVisa}}</h1>--}}
                </div>
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.visa-stock.index')}}">Visa Details</a></li>
                        <li class="breadcrumb-item active">Group Wise Visa</li>
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
                        <h3 class="card-title float-left">Group Wise Visa</h3>
                        <div class="float-right">
                            {{--<a href="{{route('admin.visa-stock.visa_divided_group',$visaStockID)}}">
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
                                <th>Group</th>
                                <th>Agent Name</th>
                                <th>Quantity</th>
                                <th>Per Piece Price</th>
                                <th>Total Price</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($groupVisa as $key => $groupVisaData)
                                @php
                                    $agent_name = App\AgentDetail::find($groupVisaData->agent_id);
                                    $group_name = App\Group::find($groupVisaData->group_id);

                                @endphp
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$group_name->name}}</td>
                                    <td>{{$agent_name->name}}</td>
                                    <td>{{$groupVisaData->quantity}}</td>
                                    <td>{{$groupVisaData->per_piece_price}}</td>
                                    <td>{{$groupVisaData->total_price}}</td>
                                    <td>
                                        <a class="btn btn-info waves-effect" href="{{route('admin.visa-stock.group_wise_visa_edit',$groupVisaData->id)}}">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        {{--<a class="btn btn-danger waves-effect" href="{{route('admin.visa-stock.visa_divided',$vDetails->id)}}">
                                            <i class="fa fa-random"></i>
                                        </a>--}}
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
                                <th>Group</th>
                                <th>Agent Name</th>
                                <th>Quantity</th>
                                <th>Per Piece Price</th>
                                <th>Total Price</th>
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
