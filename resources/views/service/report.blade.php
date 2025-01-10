@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Service Usage Report</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class=""><a href="javascript: void(0);">Service</a></li>
                                <li class="mx-1"><a href="javascript: void(0);"> > </a></li>
                                <li class="breadcrumb-item active">Service Usage Report</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Service Usage Report</h4>
                            <form method="GET" action="{{ route('service.report') }}">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-sm-5">
                                        <label for="from">From <span class="text text-danger"> *</span></label>
                                        <input id="from" name="from" type="date" class="form-control @error('from') is-invalid @enderror" placeholder="From" value="{{ old('from', $from ??  '') }}">
                                        @error('from')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-5">
                                        <label for="to">To <span class="text text-danger"> *</span></label>
                                        <input id="to" name="to" type="date" class="form-control @error('to') is-invalid @enderror" placeholder="to" value="{{ old('to', $to ?? '') }}">
                                        @error('to')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-2 mt-4 pt-1">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light w-10">Search</button>
                                        <a href="{{ route('service.report') }}" class="waves-effect waves-light btn btn-secondary"> Clear</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if (isset($services) && count($services) > 0)
                        <div class="card">
                            <div class="card-body">
                                <form method="GET" action="{{ url('service/report') }}">
                                    <input type="hidden" name="from" value="{{ $from ?? request('from') }}">
                                    <input type="hidden" name="to" value="{{ $to ?? request('to') }}">
                                    <input type="hidden" name="report" value="true">
                                    <div class="float-end" bis_skin_checked="1">
                                        <button type="submit" class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></button>
                                    </div>
                                </form>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Service Name</th>
                                            <th>Usage Count</th>
                                            <th>Quantity Used</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($services as $service)
                                            <tr>
                                                <td>{{ $service->name }}</td>
                                                <td>{{ $service->total_usage_count }}</td>
                                                <td>{{ $service->total_qty_used }}</td>
                                                <td>{{ $service->total_amount }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @elseif(isset($services))
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text text-danger text-center">No Record Found!</h4>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
