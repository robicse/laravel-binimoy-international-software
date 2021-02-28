@extends('backend.layouts.master')
@section("title","Trial Balance")
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class=""></i> Trial Balance</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>

                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <!-- general form elements -->
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <form method="post" action="{{ route('admin.account.trial_balance') }}">
                    @csrf
                    <div class="form-group row">
                        <label class="control-label col-md-3 text-right">From</label>
                        <div class="col-md-8">
                            <input type="date" class="form-control-sm" name="date_from" value="" id="demoDate" required>
                            @if ($errors->has('date_from'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('date_from') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3 text-right">To</label>
                        <div class="col-md-8">
                            <input type="date" class="form-control-sm" name="date_to" value="" required />
                            @if ($errors->has('date_to'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('date_to') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3"></label>
                        <div class="col-md-8">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-fw fa-lg fa-check-circle"></i>View
                            </button>
                        </div>
                    </div>
                </form>

                     </div>
                </div>
            </div>
        </div>
    </section>

@endsection


