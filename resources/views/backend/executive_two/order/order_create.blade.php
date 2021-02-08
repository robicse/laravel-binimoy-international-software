@extends('backend.layouts.master')
@section("title","Passport add for visa")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/select2/select2.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Passport add for visa </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('executive.two.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Passport add for visa</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <!-- general form elements -->
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title float-left">Passport add for visa</h3>
                        <div class="float-right">
                            <a href="{{route('executive.two.order.index')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('executive.two.order.create')}}" method="get" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group col-md-6">
                                <label for="supplier_id">Supplier Name</label>
                                {{--<input type="name" class="form-control" name="name" id="name" placeholder="Enter Group Name">--}}
                                <select name="supplier_id" id="supplier_id" class="form-control select2" onchange="this.form.submit()" required>
                                    <option value="">Please Select One</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{$supplier->id}}" {{$supplier->id == $sup_id ? 'selected' : ''}}>{{$supplier->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                    <form role="form" action="{{route('executive.two.order.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="form-group">
                                    <input type="hidden" name="supplier_id" value="{{$sup_id}}">
                                </div>
                                <table class="table table-bordered" id="dynamic_field">
                                    <tr>
                                        <td>
                                            <div class="form-group" style="width: 120px!important;">
                                                <label for="passenger_id">Passenger Name</label>
                                                <select name="passenger_id[]" id="passenger_id" class="form-control passenger_id pp_no select2" required>
                                                    @foreach($passenger as $p)
                                                        <option value="{{$p->id}}">{{$p->passenger_name}} ({{$p->pp_no}})</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group" style="width: 120px!important;">
                                                <label for="group_id">Group Name</label>
                                                <select name="group_id[]" id="group_id" class="form-control group_id select2" required>
                                                    @foreach($groups as $group)
                                                        <option value="{{$group->id}}">{{$group->name}} ({{$group->gr}})</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group" style="width: 120px!important;">
                                                <label for="img">Photo</label>
                                                <input type="file" class="form-control-file img" name="img[]" id="img">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <label for="img">Photo Date</label>
                                                <input type="date" class="form-control" name="photo_date[]" id="photo_date">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group" style="width: 120px!important;">
                                                <label for="img">P.C</label>
                                                <select name="pc[]" id="pc" class="form-control pc">
                                                    <option value="">Select one</option>
                                                    <option value="1">OK</option>
                                                    <option value="0">Not Yet</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <label for="img">P.C Data</label>
                                                <input type="date" value="" name="pc_date[]" class="form_datetime form-control">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group" style="width: 120px!important;">
                                                <label for="img">M.C</label>
                                                <select name="mc[]" id="mc" class="form-control mc">
                                                    <option value="">Select one</option>
                                                    <option value="1">OK</option>
                                                    <option value="0">Not Yet</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td style="width: 50px!important;">
                                            <div class="form-group">
                                                <label for="img">M.C Date</label>
                                                <input type="date" value="" name="mc_date[]" class="form_datetime form-control">
                                            </div>
                                        </td>

                                        <td><button type="button" name="add" id="add" title="Add more" class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@stop
@push('js')
    <script src="{{asset('backend/js/form.js')}}"></script>
    <script src="{{asset('backend/plugins/select2/select2.full.min.js')}}"></script>


    <script type="text/javascript">
        $(".form_datetime").datetimepicker({format: 'Y-m-d'});
    </script>

    <script>
        //Initialize Select2 Elements
        $('.select2').select2();
    </script>
    <script>
        $(document).ready(function(){
            var i=1;
            $('#add').click(function(){
                var passenger_id = $('.passenger_id').html();
                var group_id = $('.group_id').html();
                var pc = $('.pc').html();
                var mc = $('.mc').html();
                /*var pp_no = $('.pp_no').html();*/
                i++;
                $('#dynamic_field').append(
                    '<tr id="row'+i+'">'+
                    '<td width="">'+
                    '<select class="form-control passenger_id select2" name="passenger_id[]" required>' + passenger_id +'</select>'+
                    '</td>'+
                    '<td width="">'+
                    '<select class="form-control group_id select2" name="group_id[]" required>' + group_id +'</select>'+
                    '</td>'+
                    '<td width="">'+
                    '<input type="file" name="img[]"  class="form-control-file" />'+
                    '</td>'+
                    '<td width="">'+
                    '<input type="date" name="photo_date[]" class="form-control" />'+
                    '</td>'+
                    '<td width="">'+
                    '<select class="form-control pc select2" name="pc[]" required>' + pc +'</select>'+
                    '</td>'+
                    '<td width="">'+
                    '<input type="date" name="pc_date[]" class="form-control" />'+
                    '</td>'+
                    '<td width="">'+
                    '<select class="form-control mc select2" name="mc[]" required>' + mc +'</select>'+
                    '</td>'+
                    '<td width="">'+
                    '<input type="date" name="mc_date[]" class="form-control" />'+
                    '</td>'+
                    '<td width="2%">'+
                    '<button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button>'+
                    '</td>'+
                    '</tr>'
                );
            });

            $(document).on('click', '.btn_remove', function(){
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();
            });

        });
    </script>


@endpush
