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
                        <h3 class="card-title float-left">Edit Passport Stock</h3>
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
                    <form role="form" action="{{route('executive_one.passport-stock.update',$pDetails->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
{{--                            <div class="form-group">--}}
{{--                                <label for="supplier_id">Supplier Name</label>--}}
{{--                                --}}{{--<input type="name" class="form-control" name="name" id="name" placeholder="Enter Group Name">--}}
{{--                                <select name="supplier_id" id="supplier_id" class="form-control select2">--}}
{{--                                    <option value="">Please Select One</option>--}}
{{--                                    @foreach($suppliers as $supplier)--}}
{{--                                        <option value="{{$supplier->id}}" {{$supplier->id == $stock->supplier_id? 'selected' : ''}} >{{$supplier->name}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="passenger_name">Passenger Name</label>
                                    <input type="text" class="form-control" name="passenger_name" id="passenger_name" value="{{$pDetails->passenger_name}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="pp_no">Passport Number</label>
                                    <input type="text" class="form-control" name="pp_no" id="pp_no" value="{{$pDetails->pp_no}}">
                                </div>
                            </div>
                            <img src="{{asset('uploads/passport/'.$pDetails->pp_img)}}" alt="" width="150">
                            <div class="form-group col-4">
                                <label for="pp_img">Passport Scan Copy</label>
                                <input type="file" class="form-control-file" name="pp_img" id="pp_img">
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
