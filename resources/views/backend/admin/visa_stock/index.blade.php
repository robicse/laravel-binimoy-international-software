@extends('backend.layouts.master')
@section("title","Visa Details")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-2">
                    <h1>Visa Details</h1>
                </div>
                <div class="col-sm-4">
                    <h3>Total Visa Stock: {{$visaStocks}}</h3>
                </div>
                <div class="col-sm-4">
                    @php
                        $total_available_quantity2 = 0;
                    @endphp
                    @foreach($visaDetails as $total_visa_data)
                    @php
                        $agent_name = App\AgentDetail::find($total_visa_data->agent_id);

                        $quantity2 = App\VisaStock::find($total_visa_data->id);
                        //dd($quantity1);
                        //$quantity1->quantity;
                        $check_data2 = App\GroupWiseVisa::where('visa_stock_id',$total_visa_data->id)->sum('quantity');
                        //dd($check_data1);
                       //print_r($check_data1);
                if ($check_data2 ==''){
                    $available_quantity2 = $quantity2->quantity;
                    //dd($available_quantity1);
                }else{
                    $available_quantity2 = $quantity2->quantity - $check_data2;
                    $total_available_quantity2 += $available_quantity2;
                }
                    @endphp
                @endforeach
                    <h3>Total Available Visa: {{$total_available_quantity2}}</h3>
                </div>
                <div class="col-sm-2">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Visa Details</li>
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
                        <h3 class="card-title float-left">Visa Details</h3>
                        <div class="float-right">
                            <a href="{{route('admin.visa-stock.create')}}">
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
                                <th>Agent Name</th>
                                <th>Quantity</th>
                                <th>Per Piece Price</th>
                                <th>Total Price</th>
                                <th>Paid Amount</th>
                                <th>Due</th>
                                <th>Available Visa</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($visaDetails as $key => $vDetails)
                                @php
                                /*echo "<pre>";
                                    print_r($vDetails);
                                echo "</pre>";
                                exit;*/
                                $agent_name = App\AgentDetail::find($vDetails->agent_id);

                    $quantity1 = App\VisaStock::find($vDetails->id);
                    //dd($quantity1);
                        //$quantity1->quantity;
                    $check_data1 = App\GroupWiseVisa::where('visa_stock_id',$vDetails->id)->sum('quantity');
                    //dd($check_data1);
                    /*echo "<pre>";
                        print_r($check_data1);
                    echo "</pre>";
                   exit;*/
                        if ($check_data1 ==''){
                            $available_quantity1 = $quantity1->quantity;
                            //dd($available_quantity1);
                        }else{
                            $available_quantity1 = $quantity1->quantity - $check_data1;
                            //dd($available_quantity1);
                        }

                                @endphp
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{!empty($agent_name->name) ? $agent_name->name : '' }}</td>
                                    <td>{{!empty($vDetails->quantity)?$vDetails->quantity:''}}</td>
                                    <td>{{!empty($vDetails->per_piece_price)?$vDetails->per_piece_price:''}}</td>
                                    <td>{{!empty($vDetails->total_price)?$vDetails->total_price:''}}</td>
                                    <td>{{!empty($vDetails->pay_amount)?$vDetails->pay_amount:''}}</td>
{{--                                    <td>{{!empty($vDetails->due_amount)?$vDetails->due_amount:''}}</td>--}}
                                    <td>
                                        {{ $vDetails->due_amount}}
                                        @if($vDetails->total_price != $vDetails->pay_amount)
                                            <a href="" class="btn btn-warning btn-sm mx-1" data-toggle="modal" data-target="#exampleModal-<?= $vDetails->id;?>"> Pay Due</a>
                                        @endif
                                    </td>
                                    <td style="color:darkgreen; font-size: 20px;"><b>{{!empty($available_quantity1)?$available_quantity1:''}}</b></td>
                                    <td>
                                        <a class="btn btn-success waves-effect" href="{{route('admin.visa-stock.visa_divided',$vDetails->id)}}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a class="btn btn-info waves-effect" href="{{route('admin.visa-stock.edit',$vDetails->id)}}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a class="btn btn-info waves-effect" href="{{route('admin.visa-stock.show',$vDetails->id)}}">
                                           <b>show</b>
                                        </a>
                                        <button type="button" title="Visa Group Wise Divided" class="btn btn-primary" data-toggle="modal" data-target="#visaModal-{{$vDetails->id}}">
                                         group wise
                                        </button>
                                        {{--<a class="btn btn-primary waves-effect" href="">
                                            <i class="fa fa-plus"></i>
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

                                <!-- Modal -->

                                <div class="modal fade" id="visaModal-{{$vDetails->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Group Wise Visa Divided</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form role="form" action="{{route('admin.visa-stock.visa_divided_group')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">

                                                    <div class="form-group">
                                                        <label for="agent_id">Agent Name</label>
                                                        <input type="hidden" class="form-control" name="visa_stock_id" id="visa_stock_id" value="{{$vDetails->id}}">
                                                        <input type="hidden" class="form-control" name="agent_id" id="agent_id" value="{{$agent_name->id}}">
                                                        <input type="text" class="form-control" name="" id="" value="{{$agent_name->name}}" readonly>
                                                        {{--<select name="agent_id" id="agent_id" class="form-control select2" readonly="">
                                                            <option value="{{$agent_name->id}}">{{$agent_name->name}}</option>
                                                            @foreach($agent as $data)
                                                                <option value="{{$data->id}}">{{$data->name}}</option>
                                                            @endforeach
                                                        </select>--}}
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="group_id">Group</label>
                                                        {{--<input type="name" class="form-control" name="name" id="name" placeholder="Enter Group Name">--}}
                                                        <select name="group_id" id="group_id" class="form-control select2" required>
                                                            <option value="">Please Select One</option>
                                                            @foreach($group as $data1)
                                                                <option value="{{$data1->id}}">{{$data1->name}} ({{$data1->gr}})</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    @php
                                                        $pre_quantity = App\VisaStock::find($vDetails->id);
                                                                //$quantity->quantity;
                                                                //dd($pre_quantity);
                                                            $check_data = App\GroupWiseVisa::where('visa_stock_id',$vDetails->id)->sum('quantity');
                                                           //print_r($check_data)
                                                                if ($check_data ==''){
                                                                    $available_quantity = $pre_quantity->quantity;
                                                                    //dd($available_quantity);
                                                                }else{
                                                                    $available_quantity = $pre_quantity->quantity - $check_data;
                                                                }
                                                            /*$quantity = App\VisaStock::find($vDetails->id);
                                                                $quantity->quantity;*/

                                                    @endphp

                                                    <div class="form-group">
                                                        <label for="quantity">Available Quantity</label>
                                                        <input type="text" class="form-control" name="available_quantity" id="available_quantity" value="{{$available_quantity}}" readonly>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="quantity">Quantity</label>
                                                        <input type="number" class="form-control" max="{{$available_quantity}}" name="quantity" id="quantity" placeholder="Enter quantity less than available quantity" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="quantity">Visa sale Price</label>
                                                        <input type="text" class="form-control" name="per_piece_price" id="per_piece_price" placeholder="Enter Price Per Piece" required>
                                                    </div>

                                                    {{--<div class="form-group">
                                                        <label for="quantity">Total Price</label>
                                                        <input type="text" class="form-control" name="total_price" id="total_price" >
                                                    </div>--}}

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="exampleModal-{{$vDetails->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Pay Due</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('pay.due')}}" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="due">Enter Due Amount</label>
                                                        <input type="hidden" class="form-control" name="visa_stock_id" value="{{$vDetails->id}}">
                                                        <input type="number" class="form-control" id="due" aria-describedby="emailHelp" name="new_paid" min="" max="{{$vDetails->due_amount}}" placeholder="Enter Amount">
                                                    </div>
{{--                                                    <div class="form-group">--}}
{{--                                                        <label for="payment_type">Payment Type</label>--}}
{{--                                                        <select name="payment_type" id="payment_type" class="form-control" required>--}}
{{--                                                            <option value="Cash" selected>Cash</option>--}}
{{--                                                            <option value="Check">Check</option>--}}
{{--                                                        </select>--}}
{{--                                                        <span>&nbsp;</span>--}}
{{--                                                        <input type="text" name="check_number" id="check_number" class="form-control" placeholder="Check Number">--}}
{{--                                                        <span>&nbsp;</span>--}}
{{--                                                        <input type="text" name="check_date" id="check_date" class="datepicker form-control" placeholder="Issue Deposit Date ">--}}
{{--                                                    </div>--}}
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        @push('js')
{{--                                            <script>--}}
{{--                                                $(function() {--}}
{{--                                                    $('#check_number').hide();--}}
{{--                                                    $('#check_date').hide();--}}
{{--                                                    $('#payment_type').change(function(){--}}
{{--                                                        if($('#payment_type').val() == 'Check') {--}}
{{--                                                            $('#check_number').show();--}}
{{--                                                            $('#check_date').show();--}}
{{--                                                        } else {--}}
{{--                                                            $('#check_number').val('');--}}
{{--                                                            $('#check_number').hide();--}}
{{--                                                            $('#check_date').hide();--}}
{{--                                                        }--}}
{{--                                                    });--}}
{{--                                                });--}}
{{--                                            </script>--}}
                                        @endpush
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#Id</th>
                                <th>Agent Name</th>
                                <th>Quantity</th>
                                <th>Per Piece Price</th>
                                <th>Total Price</th>
                                <th>Available Visa</th>
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
        /*function deleteCat(id) {
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
        }*/
    </script>

    <script>
        $(document).ready(function () {
            $("#quantity, #per_piece_price").on('keyup',function() {
                $("#total_price").val($("#quantity").val() * $("#per_piece_price").val());
            });
        });
    </script>

@endpush
