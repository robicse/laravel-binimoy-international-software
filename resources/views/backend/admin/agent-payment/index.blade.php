@extends('backend.layouts.master')
@section("title","Agent List")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Agent List (Visa Provider)</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Agent List</li>
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
                        <h3 class="card-title float-left">Agent Lists</h3>
                        {{--<div class="float-right">
                            <a href="{{route('admin.agent.create')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-plus-circle"></i>
                                    Add
                                </button>
                            </a>
                        </div>--}}
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#Id</th>
                                <th>Name</th>
                                <th>Mobile Number</th>
                                <th>Total Visa</th>
                                <th>Amount</th>
                                <th>Paid Amount</th>
                                <th>Due Amount</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($agents as $key => $agent)
{{--                                @php--}}
{{--                                $visa = App\VisaStock::where('agent_id',$agent->id)->sum('quantity');--}}
{{--                                $visaAmo = App\VisaStock::where('agent_id',$agent->id)->sum('total_price');--}}
{{--                                $visaPaid = App\VisaStock::where('agent_id',$agent->id)->sum('pay_amount');--}}
{{--                                $visaDue = App\VisaStock::where('agent_id',$agent->id)->sum('due_amount');--}}
{{--                                $Due = App\TakeAgentPayment::where('agent_id',$agent->id)->get();--}}
{{--                                $agent = DB::table('take_agent_payments')--}}
{{--                                ->join('agent_details','agent_details.id','=','take_agent_payments.agent_id')--}}
{{--                                //->where('take_agent_payments.agent_id',$agentDetail->id)--}}
{{--                                ->get();--}}

{{--                                //dd($agent);--}}
{{--                                @endphp--}}
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$agent->name}}</td>

                                    <td>{{$agent->mobile }}</td>
                                    <td>{{$agent->quantity}}</td>
                                    <td>{{$agent->payable_amount}}</td>
{{--                                    <td>{{$visaAmo}}</td>--}}
{{--                                    <td>{{$visaPaid}}</td>--}}
{{--                                    <td>{{$visaDue}}</td>--}}
                                    <td>
                                        <a class="btn btn-danger waves-effect" href="{{route('admin.accounts.agent.payment.history',$agent->id)}}">
                                            <i class="fa fa-server"></i>
                                        </a>
                                        <button type="button" title="Agent Payment Create" class="btn btn-success" data-toggle="modal" data-target="#visaModal-{{$agent->id}}">
                                            <i class="fa fa-plus-circle"></i>
                                        </button>
{{--                                        <a class="btn btn-success waves-effect" href="{{route('admin.accounts.agent.payment.create',$agent->id)}}">--}}
{{--                                            <i class="fa fa-plus-circle"></i>--}}
{{--                                        </a>--}}

{{--                                        <button class="btn btn-danger waves-effect" type="button"--}}
{{--                                                onclick="deleteCat({{$group->id}})">--}}
{{--                                            <i class="fa fa-trash"></i>--}}
{{--                                        </button>--}}
{{--                                        <form id="delete-form-{{$group->id}}" action="{{route('admin.group.destroy',$group->id)}}" method="POST" style="display: none;">--}}
{{--                                            @csrf--}}
{{--                                            @method('DELETE')--}}
{{--                                        </form>--}}
                                    </td>
                                </tr>

                                <!-- Modal -->
{{--                                <div class="modal fade" id="visaModal-{{$agentDetail->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--                                    <div class="modal-dialog" role="document">--}}
{{--                                        <div class="modal-content">--}}
{{--                                            <div class="modal-header">--}}
{{--                                                <h5 class="modal-title" id="exampleModalLabel">Take Payments From Agent</h5>--}}
{{--                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                                    <span aria-hidden="true">&times;</span>--}}
{{--                                                </button>--}}
{{--                                            </div>--}}
{{--                                            <form role="form" action="{{route('admin.accounts.agent.payment.create')}}" method="post" enctype="multipart/form-data">--}}
{{--                                                @csrf--}}
{{--                                                <div class="modal-body">--}}

{{--                                                    <div class="form-group">--}}
{{--                                                        <label for="agent_id">Agent Name</label>--}}
{{--                                                        <input type="hidden" class="form-control" name="agent_id" id="agent_id" value="{{$agentDetail->id}}">--}}
{{--                                                        <input type="text" class="form-control" name="" id="" value="{{$agentDetail->name}}" readonly>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="form-group">--}}
{{--                                                        <label for="total_visa">Total Visa</label>--}}
{{--                                                        <input type="text" class="form-control" name="total_visa" id="total_visa" value="{{$visa}}" readonly>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="form-group">--}}
{{--                                                        <label for="total_price">Total Price</label>--}}
{{--                                                        <input type="text" class="form-control" name="total_price" id="total_price" value="{{$visaAmo}}" readonly>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="form-group">--}}
{{--                                                        <label for="paid_amount">Paid Amount</label>--}}
{{--                                                        <input type="text" class="form-control" name="paid_amount" id="paid_amount" value="{{$visaPaid}}" readonly>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="form-group">--}}
{{--                                                        <label for="payable_amount">Payable Amount</label>--}}
{{--                                                        <input type="text" class="form-control" name="payable_amount" id="payable_amount" value="{{$visaDue}}" readonly>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="form-group">--}}
{{--                                                        <label for="pay_amount">Pay Amount</label>--}}
{{--                                                        <input type="number" class="form-control" name="pay_amount" id="pay_amount" max="" placeholder="Enter Price Per Piece" required>--}}
{{--                                                    </div>--}}

{{--                                                    --}}{{--<div class="form-group">--}}
{{--                                                        <label for="due_amount">Due Amount</label>--}}
{{--                                                        <input type="text" class="form-control" name="due_amount" id="due_amount" placeholder="Due Amount">--}}
{{--                                                    </div>--}}


{{--                                                    --}}{{--<div class="form-group">--}}
{{--                                                        <label for="quantity">Total Price</label>--}}
{{--                                                        <input type="text" class="form-control" name="total_price" id="total_price" >--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="modal-footer">--}}
{{--                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                                                    <button type="submit" class="btn btn-primary">Save changes</button>--}}
{{--                                                </div>--}}
{{--                                            </form>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#Id</th>
                                <th>Name</th>
                                <th>Mobile Number</th>
                                <th>Total Visa</th>
                                <th>Amount</th>
                                <th>Paid Amount</th>
                                <th>Due Amount</th>
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
    <script src="{{asset('backend/js/form.js')}}"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

    {{--<script>
        $(document).ready(function () {
            //alert('test');
            $("#payable_amount, #pay_amount").on('keyup',function() {
                $("#due_amount").val($("#payable_amount").val() - $("#pay_amount").val());
            });
        });
    </script>--}}

    <script>
        $(document).ready(function() {
            $('#example1').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'print'
                ]
            } );
        } );


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
