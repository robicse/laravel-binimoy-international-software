@extends('backend.layouts.master')
@section("title","Visa Stock")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/select2/select2.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Visa Stock</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Visa Stock</li>
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
                        <h3 class="card-title float-left">Edit Visa Stock</h3>
                        <div class="float-right">
                            <a href="{{route('admin.visa-stock.index')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('admin.visa-stock.update',$vDetails->id)}}" method="post" enctype="multipart/form-data">
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
                                <div class="form-group col-md-6">
                                    <label for="passenger_name">Agent Name</label>
                                    {{--<input type="text" class="form-control" name="agent_id" id="agent_id" value="{{$vDetails->agent_id}}">--}}
                                    <select name="agent_id" id="agent_id" class="form-control select2">
                                        @php
                                            $agent_name = App\AgentDetail::find($vDetails->agent_id);
                                        @endphp
                                        <option value="{{$agent_name->id}}">{{$agent_name->name}}</option>
                                        @foreach($agent as $data)
                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="quantity">Quantity</label>
                                    <input type="text" class="form-control" name="quantity" id="quantity" value="{{$vDetails->quantity}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="per_piece_price">Per Piece Price</label>
                                    <input type="text" class="form-control" name="per_piece_price" id="per_piece_price" value="{{$vDetails->per_piece_price}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pp_no">Total Price</label>
                                    <input type="text" class="form-control" name="total_price" id="total_price" value="{{$vDetails->total_price}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="pay_amount">Pay Amount</label>
                                    <input type="text" class="form-control" name="pay_amount" id="pay_amount" value="{{$vDetails->pay_amount}}" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="due_amount">Due</label>
                                    <input type="text" class="form-control" name="due_amount" id="due_amount" value="{{$vDetails->due_amount}}" readonly>
                                </div>
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
        $(document).ready(function () {
            $("#quantity, #per_piece_price, #pay_amount").on('keyup',function() {
                $("#total_price").val($("#quantity").val() * $("#per_piece_price").val());
                $("#due_amount").val($("#total_price").val() - $("#pay_amount").val());
            });
        });
    </script>
@endpush
