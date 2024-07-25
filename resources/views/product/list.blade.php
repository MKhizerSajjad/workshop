@extends('layouts.app')

@section('content')
    @guest
        @include('layouts.components.web-topbar')
    @endguest
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            {{-- <div class="row">
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
            </div> --}}
            <!-- end page title -->

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-border-left alert-dismissible fade show auto-colse-3" role="alert">
                    <i class="ri-check-double-line me-3 align-middle fs-16"></i><strong>Success! </strong>
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-lg-12">

                    <div class="row mb-3">
                        <div class="col-xl-4 col-sm-6">
                            <div class="mt-2">
                                <h5>Products</h5>
                            </div>
                        </div>
                        <div class="col-lg-8 col-sm-6">
                            <form class="mt-4 mt-sm-0 float-sm-end d-sm-flex align-items-center" method="GET">
                                <div class="search-box me-2">
                                    <div class="position-relative">
                                        <input type="text" class="form-control border-0" name="product" id="searchProductList" autocomplete="off" placeholder="Search..." value="{{ request()->get('product') }}">
                                        <i class="bx bx-search-alt search-icon"></i>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-rounded waves-effect waves-light"><i class="bx bx-filter-alt me-1"></i> Search</button>
                                <a href="{{ route('productsList') }}" class="btn btn-secondary btn-rounded waves-effect waves-light mx-2"><i class="bx bx-crosshair me-1"></i> Clear</a>
                            </form>
                        </div>
                    </div>
                    <div class="row" id="product-list">
                        @if (count($data) > 0)
                            @foreach ($data as $key => $product)
                                <div class="col-xl-3 col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="product-img position-relative">
                                                {{-- <div class="avatar-sm product-ribbon">
                                                    <span class="avatar-title rounded-circle bg-primary">
                                                        - 25 %
                                                    </span>
                                                </div> --}}
                                                <img src="{{ $product->img_url }}" alt="{{ $product->name }}" class="img-fluid mx-auto d-block">
                                            </div>
                                            <div class="mt-4 text-center">
                                                <h5 class="mb-3 text-truncate"><a href="javascript: void(0);" class="text-dark">{{ $product->name }} </a></h5>

                                                {{-- <p class="text-muted">
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                </p> --}}
                                                <h5 class="my-0">
                                                    {{-- <span class="text-muted me-2"><del>$500</del></span>  --}}
                                                    <b>{{ $product->price }}</b>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <span class="text text-center">{{ $data->links() }}</span>
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
