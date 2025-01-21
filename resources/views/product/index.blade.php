@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Products</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class=""><a href="javascript: void(0);">Products</a></li>
                                <li class="mx-1"><a href="javascript: void(0);"> > </a></li>
                                <li class="breadcrumb-item active">Products List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-border-left alert-dismissible fade show auto-colse-3" role="alert">
                    <i class="ri-check-double-line me-3 align-middle fs-16"></i><strong>Success! </strong>
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- <div class="d-flex justify-content-end gap-2" bis_skin_checked="1">
                                <a href="{{ route('product.create') }}" class="btn btn-primary waves-effect waves-light"> <i class="bx bx-plus me-1"></i> Add New</a>
                            </div> --}}

                            <div class="row mb-3">
                                <div class="col-lg-4 col-sm-12">
                                    <div class="mt-2">
                                        <h4 class="card-title">Products List</h4>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-sm-12">
                                    <form class="mt-4 mt-sm-0 float-sm-end d-sm-flex align-items-center" method="GET">
                                        <div class="search-box me-2">
                                            <div class="position-relative">
                                                <input type="text" class="form-control border-1" name="product" id="searchProductList" autocomplete="off" placeholder="Search..." value="{{ request()->get('product') }}">
                                                <i class="bx bx-search-alt search-icon"></i>
                                            </div>
                                        </div>
                                        <div class="me-2">
                                            <div class="position-relative">
                                                <select name="limit" id="limit" class="form-select border-1 mr-3" style="width: 70px; border-radius: 30px">
                                                    @php
                                                        $limit = request()->get('limit') ?? 10;
                                                    @endphp
                                                    <option value="10" @if($limit == 10) selected @endif>10</option>
                                                    <option value="25" @if($limit == 25) selected @endif>25</option>
                                                    <option value="50" @if($limit == 50) selected @endif>50</option>
                                                    <option value="100" @if($limit == 100) selected @endif>100</option>
                                                </select>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-rounded waves-effect waves-light"><i class="bx bx-filter-alt me-1"></i> Search</button>
                                        <a href="{{ route('product.index') }}" class="btn btn-secondary btn-rounded waves-effect waves-light mx-2"><i class="bx bx-crosshair me-1"></i> Clear</a>
                                    </form>
                                </div>
                            </div>

                            @if (count($data) > 0)
                                <div class="table-responsive" bis_skin_checked="1">
                                    <table class="table mb-0 table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Picture</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Tax</th>
                                                <th>Total</th>
                                                <th>Qty</th>
                                                <th>Status</th>
                                                {{-- <th>Status</th> --}}
                                                <th class="text-center">Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $product)
                                                @php
                                                    $taxAmount = ($product->price * getTax()) / 100;
                                                @endphp
                                                <tr>
                                                    <td  class="text-center">{{ ++$key }}</td>
                                                    <td><img src=" {{ $product->img_url }}" alt="{{ $product->name }}" width="50px" height="50px" onerror="this.onerror=null;this.src='{{ asset('images/brands/bitbucket.png') }}'"></td>
                                                    <td>{{ $product->name }}</td>
                                                    <td>{{ numberFormat($product->price) . config('app.currency') }}</td>
                                                    <td>{{ numberFormat($taxAmount) . config('app.currency') }}</td>
                                                    <td>{{  numberFormat(($product->price + $taxAmount)) . config('app.currency') }}</td>
                                                    <td>{{ $product->stock_quantity }}</td>
                                                    <td>{!! getStockStatus('woocommerce', $product->stock_status, 'badge') !!}</td>
                                                    {{-- <td>{!! getGenStatus('general', $product->status, 'badge') !!}</td> --}}
                                                    <td class="text-center"> <a href="{{ route('product.edit', $product->id) }}"><i class="bx bx-pencil"></i></a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $data->links() }}
                                </div>
                            @else
                                <div class="noresult">
                                    <div class="text-center">
                                        <h4 class="mt-2 text-danger">Sorry! No Result Found</h4>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
             </div>
        </div>
    </div>
@endsection


<style>
    .w-5 {
        width: 10px !important;
    }
    .h-5 {
        height: 10px !important;
    }
    .flex.justify-between.flex-1
    {
        display: none !important;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
