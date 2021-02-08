@extends('backend.layouts.master')
@section("title","Passport Stock")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/select2/select2.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Passport Stock</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('executive.one.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Passport Stock</li>
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
                    <h3 class="card-title float-left">Add Passport Stock</h3>
                    <div class="float-right">
                        <a href="{{route('executive_one.passport-stock.index')}}">
                            <button class="btn btn-success">
                                <i class="fa fa-backward"> </i>
                                Back
                            </button>
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="{{route('executive_one.passport-stock.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group col-md-6">
                            <label for="supplier_id">Supplier Name</label>
                            {{--<input type="name" class="form-control" name="name" id="name" placeholder="Enter Group Name">--}}
                            <select name="supplier_id" id="supplier_id" class="form-control select2" required>
                                <option value="">Please Select One</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dynamic_field">
                                {{--<tr>
                                    <td> Passenger Name</td>
                                    <td></td>
                                    <td></td>
                                </tr>--}}

                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label for="passenger_name">Passenger Name</label>
                                            <input type="text" class="form-control" name="passenger_name[]" id="passenger_name" placeholder="Enter Name" required>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="pp_no">Passport Number</label>
                                            <input type="text" class="form-control" name="pp_no[]" id="pp_no" placeholder="Enter passport number" required>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="group_name">Group Name</label>
                                            <select name="group_id[]" id="group_id" class="form-control group_id" required>
                                                <option value="">Select one</option>
                                                @foreach($groups as $group_data)
                                                <option value="{{$group_data['id']}}">{{$group_data['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="pp_img">Passport Image</label>
                                            <input type="file" class="form-control" name="pp_img[]" id="pp_img" required>
                                        </div>
                                    </td>
                                    <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
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

    <script src="{{asset('backend/plugins/select2/select2.full.min.js')}}"></script>

    <script>
        //Initialize Select2 Elements
        $('.select2').select2();
    </script>
    <script>
        $(document).ready(function(){
            var i=1;
            $('#add').click(function(){
                i++;
                var group_id = $('.group_id').html();
                $('#dynamic_field').append(
                    '<tr id="row'+i+'">'+
                    '<td width="">'+
                    '<input type="text" name="passenger_name[]" placeholder="Enter name" class="form-control name_list" />'+
                    '</td>'+
                    '<td width="">'+
                    '<input type="text" name="pp_no[]" placeholder="Enter passport number" class="form-control name_list" />'+
                    '</td>'+
                    '<td width="">'+
                    '<select class="form-control group_id select2" name="group_id[]" required>' + group_id +'</select>'+
                    '</td>'+
                    '<td width="">'+
                    '<input type="file" name="pp_img[]"  class="form-control name_list" />'+
                    '</td>'+
                    '<td width="5%">'+
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
