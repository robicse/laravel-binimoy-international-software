@extends('backend.layouts.master')
@section("title","posting")
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>All Posting </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">  Posting List</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title float-left"> Posting List</h3>
                        <div class="float-right">
                            <a href="{{route('admin.transaction.create')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-plus-circle"></i>
                                    Add Posting
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="5%">#Id</th>
                                <th>Date</th>
                                <th>Voucher Type</th>
                                <th>Voucher No</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($transactions as $key => $transaction)

                                @php
                                    $current_transactions = \Illuminate\Support\Facades\DB::table('transactions')
                                ->where('voucher_type_id',$transaction->voucher_type_id)
                                ->where('voucher_no',$transaction->voucher_no)
                                ->where('transaction_description',$transaction->transaction_description)
                                ->first();
                                @endphp
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $current_transactions->date}}</td>
                                    <td>
                                        @php
                                            echo \App\VoucherType::where('id',$transaction->voucher_type_id)->pluck('name')->first();
                                        @endphp
                                    </td>
                                    <td> @php
                                            echo \App\VoucherType::where('id',$transaction->voucher_type_id)->pluck('name')->first();
                                        @endphp -{{ $current_transactions->voucher_no}}</td>
                                    <td> {{ $transaction->transaction_description}}</td>
                                    <td>
                                        <a href="{{ url('account/voucher-invoice/'.$transaction->voucher_type_id.'/'.$transaction->voucher_no) }}" class="btn btn-sm btn-primary float-left" style="margin-left: 5px">print</a>
                                        <a href="{{ url('account/transaction-edit/'.$transaction->voucher_type_id.'/'.$transaction->voucher_no) }}" class="btn btn-sm btn-primary float-left" style="margin-left: 5px"><i class="fa fa-edit"></i></a>
                                        <form method="post" action="{{ url('account/transaction-delete/'.$transaction->voucher_type_id.'/'.$transaction->voucher_no) }}">
                                            @csrf
                                            <button class="btn btn-sm btn-danger" style="margin-left: 5px" type="submit" onclick="return confirm('You Are Sure This Delete !')"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th width="5%">#Id</th>
                                <th>Date</th>
                                <th>Voucher Type</th>
                                <th>Voucher No</th>
                                <th>Description</th>
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

@endsection


