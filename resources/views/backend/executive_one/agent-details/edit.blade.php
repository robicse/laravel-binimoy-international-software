@extends('backend.layouts.master')
@section("title","Agent Details Edit")
@push('css')

@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Agent Details Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('executive.one.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Agent Details Edit</li>
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
                        <h3 class="card-title float-left">Edit Agent Details</h3>
                        <div class="float-right">
                            <a href="{{route('executive_one.agent.index')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('executive_one.agent.update',$agentDetail->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">Agent Name</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{$agentDetail->name}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Agent Email</label>
                                    <input type="text" class="form-control" name="email" id="email" value="{{$agentDetail->email}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="mobile">Agent Mobile Number</label>
                                    <input type="text" class="form-control" name="mobile" id="mobile" value="{{$agentDetail->mobile}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="emergency_contact">Agent Emergency Contact</label>
                                    <input type="text" class="form-control" name="emergency_contact" id="emergency_contact" value="{{$agentDetail->emergency_contact}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address">Agent Address</label>
                                <textarea name="address" id="address" class="form-control" rows="3">{{$agentDetail->address}}</textarea>
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

@endpush
