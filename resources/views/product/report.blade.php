@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Product Usage Report</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class=""><a href="javascript: void(0);">Product</a></li>
                                <li class="mx-1"><a href="javascript: void(0);"> > </a></li>
                                <li class="breadcrumb-item active">Product Usage Report</li>
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
                            <h4 class="card-title">Product Usage Report</h4>
                            <form method="GET" action="{{ route('product.report') }}">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-sm-5">
                                        <label for="from">From <span class="text text-danger"> *</span></label>
                                        <input id="from" name="from" type="date" class="form-control @error('from') is-invalid @enderror" placeholder="From" value="{{ old('from', $from ?? '') }}">
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
                                        <a href="{{ route('product.report') }}" class="waves-effect waves-light btn btn-secondary"> Clear</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if (isset($products))
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>SKU</th>
                                            <th>Usage Count</th>
                                            <th>Quantity Used</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $product)
                                            <tr>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->sku }}</td>
                                                <td>{{ $product->total_usage_count }}</td>
                                                <td>{{ $product->total_qty_used }}</td>
                                                <td>{{ $product->total_amount }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div>
@endsection
