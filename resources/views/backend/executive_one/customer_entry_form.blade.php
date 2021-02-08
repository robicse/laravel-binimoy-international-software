@extends('backend.layouts.master')
@section("title","Customer Entry Form")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/select2/select2.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Customer Entry Form</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Customer Entry Form</li>
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
                        <h3 class="card-title float-left">Customer Entry Form</h3>
                        <div class="float-right">
                            <a href="">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="#" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pp_number">Passport Number</label>
                                    <input type="text" class="form-control" name="pp_number" id="pp_number" placeholder="Enter Passport Number">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="mobile">Contact Number</label>
                                    <input type="number" class="form-control" name="mobile" id="mobile" placeholder="Enter mobile number">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="date_of_birth">Date Of Birth</label>
                                    <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" placeholder="Enter Date Of Birth">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="address">Visa selection</label>
                                    <select name="visa_section" id="" class="form-control select2">
                                        <option value="Please select one"></option>
                                        @foreach($groups as $group)
                                            <option value="{{$group->id}}">{{$group->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="address">Reference By</label>
                                    <select name="visa_section" id="" class="form-control select2">
                                        <option value="Please select one"></option>
                                        @foreach($agents as $agent)
                                            <option value="{{$agent->id}}">{{$agent->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="date_of_birth">Date of stumping</label>
                                    <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" placeholder="Enter Date Of Birth">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="date_of_birth">Date of manpower</label>
                                    <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" placeholder="Enter Date Of Birth">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="date_of_birth">Date of fly</label>
                                    <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" placeholder="Enter Date Of Birth">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pp_scan_copy">Passport Scan Copy</label>
                                <input type="file" class="form-control-file" name="pp_scan_copy" id="pp_scan_copy">
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
@endpush
