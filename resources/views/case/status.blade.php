@extends('layouts.app')

@section('content')
    @guest
        @include('layouts.components.web-topbar')
    @endguest
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Case Status</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class=""><a href="javascript: void(0);">Case</a></li>
                                <li class="mx-1"><a href="javascript: void(0);"> > </a></li>
                                <li class="breadcrumb-item active">Case Status</li>
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
                            <h4 class="card-title">Case Status</h4>
                            <p class="card-title-desc">Put the given below information to check the status of your Case</p>
                            <form method="GET" action="{{ route('bookingStatusSearch') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-8 offset-md-2">
                                        <div class="mb-3">
                                            <label for="case_number">Case Number <span class="text text-danger"> *</span></label>
                                            <input id="case_number" name="case_number" type="text" class="form-control @error('case_number') is-invalid @enderror" placeholder="Enter Case Number" value="{{ request('case_number') }}">
                                            @error('case_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-8 offset-md-2">
                                        <div class="mb-3">
                                            <label for="phone">Phone <span class="text text-danger"> *</span></label>
                                            <input id="phone" name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter Booking Phone" value="{{ request('phone') }}">
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light w-50"><i class="bx bx-search"></i> Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @if (isset($data) && $data === null)
                <div class="checkout-tabs">
                    <div class="row">
                        <div class="col-xl-12 col-sm-12">

                            <div class="card">
                                <div class="card-body text-center">
                                    <h3 class="text text-danger">Sorry! No record found.</h3>
                                    <span class="font-size-14">Please enter valid information</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif (isset($data) && $data != null)
                <div class="checkout-tabs">
                    <div class="row">
                        <div class="col-xl-2 col-sm-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active" id="v-pills-item-tab" data-bs-toggle="pill" href="#v-pills-item" role="tab" aria-controls="v-pills-item" aria-selected="true">
                                    <i class= "fa fa-wrench d-block check-nav-icon mt-4 mb-2"></i>
                                    <p class="fw-bold mb-4">Item Info</p>
                                </a>
                                <a class="nav-link" id="v-media-tab" data-bs-toggle="pill" href="#v-media" role="tab" aria-controls="v-media" aria-selected="false">
                                    <i class= "fa fa-th-large d-block check-nav-icon mt-4 mb-2"></i>
                                    <p class="fw-bold mb-4">Media</p>
                                </a>
                                <a class="nav-link" id="v-services-tab" data-bs-toggle="pill" href="#v-services" role="tab" aria-controls="v-services" aria-selected="false">
                                    <i class= "fa fa-cog d-block check-nav-icon mt-4 mb-2"></i>
                                    <p class="fw-bold mb-4">Services</p>
                                </a>
                                <a class="nav-link" id="v-products-tab" data-bs-toggle="pill" href="#v-products" role="tab" aria-controls="v-products" aria-selected="false">
                                    <i class= "fa fa-cogs d-block check-nav-icon mt-4 mb-2"></i>
                                    <p class="fw-bold mb-4">Products</p>
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-sm-9">

                            @php
                                $productsTotal = 0;
                                $servicesTotal = 0;
                                $taskItemProductsTotal = 0;
                            @endphp

                            <div class="card">
                                <div class="card-body">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <div class="tab-pane fade show active" id="v-pills-item" role="tabpanel" aria-labelledby="v-pills-item-tab">
                                            <div>
                                                <h4 class="card-title">Item information</h4>
                                                <p class="card-title-desc">Fill all information below</p>
                                                {{-- <form> --}}
                                                    {{-- @foreach ($data->items as $item)
                                                        <div class="form-check form-check-inline font-size-16">
                                                            <input class="form-check-input" type="radio" name="item" id="item-{{ $item->id }}" name="{{ $item->id }}">
                                                            <label class="form-check-label font-size-13" for="item-{{ $item->id }}"> {{ $item->name }}</label>
                                                        </div>
                                                    @endforeach --}}
                                                    <div class="form-group row mb-2">
                                                        <label class="col-md-2 col-form-label">Select Item</label>
                                                        <div class="col-md-12">
                                                            <select class="form-control select2" title="Item" name="item" disabled>
                                                                <option value="">Select Item </option>
                                                                @foreach ($data->items as $item)
                                                                    <option value="{{ $item->id }}" @if($item->id == $data->task->item_id) selected @endif>{{ $item->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('item')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-2">
                                                        <div class="col-md-6">
                                                            <label for="manufacturer" class="form-label">Manufacturer</label>
                                                            <input type="text" name="manufacturer" class="form-control" disabled id="manufacturer" value="{{ $data->task->manufacturer }}" placeholder="Enter Manufacturer">
                                                            @error('manufacturer')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="model" class="form-label">Model</label>
                                                            <input type="text" name="model" class="form-control" disabled id="model" value="{{ $data->task->model }}" placeholder="Enter Model">
                                                            @error('model')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-2">
                                                        <div class="col-md-6">
                                                            <label for="year" class="form-label">Year</label>
                                                            <input type="text" name="year" class="form-control" disabled id="year" value="{{ $data->task->year }}" placeholder="Enter Year">
                                                            @error('year')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="color" class="form-label">Color</label>
                                                            <input type="text" name="color" class="form-control" disabled id="color" value="{{ $data->task->color }}" placeholder="Enter Color">
                                                            @error('color')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-3">
                                                        <label for="additional_info" class="form-label">Additional Information</label>
                                                        <div class="col-md-12">
                                                            <textarea class="form-control" disabled name="additional_info" id="additional_info" placeholder="Enter Additional Information">{{ $data->task->additional_info }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-3">
                                                        <label for="problem_description" class="form-label">Description of Problem / Failure</label>
                                                        <div class="col-md-12">
                                                            <textarea class="form-control" disabled name="problem_description" id="problem_description" placeholder="Enter Detailed Description of Problem / Failure">{{ $data->task->problem_description }}</textarea>
                                                            @error('problem_description')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                {{-- </form> --}}
                                            </div>
                                            {{-- <div class="row mt-4">
                                                <div class="offset-md-6 col-sm-6 text text-primary text-bold">
                                                    <div class="text-end">
                                                        <a id="v-parts-tab" data-bs-toggle="pill" href="#v-parts" role="tab" aria-controls="v-parts" aria-selected="false" class="d-none d-sm-inline-block nav-link">
                                                            Proceed to Parts & Media
                                                            <i class="mdi mdi-arrow-right me-1"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                        <div class="tab-pane fade" id="v-media" role="tabpanel" aria-labelledby="v-media-tab">
                                            <div>
                                                <h4 class="card-title mt-5">Uploaded By Customer</h4>
                                                <div id="imagesBody">
                                                    @foreach ($data->task->media->where('customer_choice', 1) as $media)
                                                        @php
                                                            $fileType = pathinfo($media->media, PATHINFO_EXTENSION); // Get the file extension
                                                            $previewContent = '';
                                                            $imagePath = '';

                                                            switch ($fileType) {
                                                                case 'jpg':
                                                                case 'jpeg':
                                                                case 'png':
                                                                case 'gif':
                                                                    $previewContent = '<img class="thumb" src="' . asset('/task/media/'. $media->media) . '" title="' . $media->media . '">';
                                                                    break;
                                                                case 'mp4':
                                                                case 'avi':
                                                                case 'mov':
                                                                case 'wmv':
                                                                    $imagePath = asset('images/video.png');
                                                                    $previewContent = '<img class="thumb" src="' . $imagePath . '" title="' . $media->media . '">';
                                                                    break;
                                                                default:
                                                                    $imagePath = asset('images/file.png');
                                                                    $previewContent = '<img class="thumb" src="' . $imagePath . '" title="' . $media->media . '">';
                                                                    break;
                                                            }
                                                        @endphp
                                                        <div class="preview-image">
                                                            {!! $previewContent !!}
                                                            <span class="delete-image" data-nxame="' + theFile.name + '"></span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <hr>
                                                <h4 class="card-title mt-5">Uploaded By Service Center</h4>
                                                <div id="imagesBody">

                                                    @foreach ($data->task->media->where('customer_choice', 2) as $media)
                                                        @php
                                                            $fileType = pathinfo($media->media, PATHINFO_EXTENSION); // Get the file extension
                                                            $previewContent = '';
                                                            $imagePath = '';

                                                            switch ($fileType) {
                                                                case 'jpg':
                                                                case 'jpeg':
                                                                case 'png':
                                                                case 'gif':
                                                                    $previewContent = '<img class="thumb" src="' . asset('/task/media/'. $media->media) . '" title="' . $media->media . '">';
                                                                    break;
                                                                case 'mp4':
                                                                case 'avi':
                                                                case 'mov':
                                                                case 'wmv':
                                                                    $imagePath = asset('images/video.png');
                                                                    $previewContent = '<img class="thumb" src="' . $imagePath . '" title="' . $media->media . '">';
                                                                    break;
                                                                default:
                                                                    $imagePath = asset('images/file.png');
                                                                    $previewContent = '<img class="thumb" src="' . $imagePath . '" title="' . $media->media . '">';
                                                                    break;
                                                            }
                                                        @endphp
                                                        <div class="preview-image">
                                                            {!! $previewContent !!}
                                                            <span class="delete-image" data-nxame="' + theFile.name + '"></span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-services" role="tabpanel" aria-labelledby="v-services-tab">
                                            <div>
                                                <h4 class="card-title mt-5">Services</h4>
                                                <p class="card-title-desc">Services consumed in this case</p>
                                                <div class="mb-5">
                                                    <div class="row">
                                                        <div class="col-12 mb-5">
                                                            @if (count($data->task->taskServices) > 0)
                                                                @foreach ($data->task->taskServices as $index => $service)
                                                                    @php
                                                                        $servicesTotal +=  ($service->unit_price * $service->qty);
                                                                    @endphp
                                                                    <div data-repeater-list="group-a">
                                                                        <div class="row">
                                                                            <div class="mb-3 col-lg-3">
                                                                                <label for="name">Service Name</label>
                                                                                <input type="text" class="form-control" readonly name="merge_name_INDEX" id="merge_name_INDEX" value="{{ $service->service->name }}" placeholder="Service Name" >
                                                                            </div>
                                                                            <div class="mb-3 col-lg-3">
                                                                                <label for="place_holder">Service Price</label>
                                                                                <input type="text" class="form-control" readonly name="price" placeholder="Enter Price" value="{{ $service->unit_price }}">
                                                                            </div>
                                                                            <div class="mb-3 col-lg-3">
                                                                                <label for="place_holder">Service Qty</label>
                                                                                <input type="text" class="form-control" readonly name="qty" placeholder="Enter Quantity" value="{{ $service->qty }}">
                                                                            </div>
                                                                            <div class="mb-3 col-lg-3">
                                                                                <label for="place_holder">Service Total</label>
                                                                                <input type="text" name="total" class="form-control" readonly placeholder="Total" value="{{ $service->unit_price * $service->qty }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach

                                                                <div class="row">
                                                                    <div class="mb-3 col-lg-3 offset-md-9">
                                                                        <label for="place_holder"><b>Services Total</b></label>
                                                                        <input type="text" name="services_total" class="form-control" readonly placeholder="Services Total" value="{{ $servicesTotal }}">
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <h3 class="text text-danger text-center">No service  till now In this case</h3>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-products" role="tabpanel" aria-labelledby="v-products-tab">
                                            <div>
                                                <h4 class="card-title mt-5">Products</h4>
                                                <p class="card-title-desc">Products consumed in this case</p>
                                                <div class="mb-5">
                                                    <div class="row">
                                                        <div class="col-12 mb-5">
                                                            @if (count($data->task->taskProducts) > 0)
                                                                @foreach ($data->task->taskProducts as $index => $parentProduct)
                                                                    @php
                                                                        $productsTotal +=  ($parentProduct->unit_price * $parentProduct->qty);
                                                                        $taskItemProduct = $parentProduct->taskItemProducts->first();
                                                                        $taskItemProductsTotal += $taskItemProduct->total;
                                                                    @endphp
                                                                    <div data-repeater-list="group-a">
                                                                        <div class="row">
                                                                            <div class="mb-3 col-lg-3">
                                                                                <label for="name">Name</label>
                                                                                <input type="text" name="name" id="name" class="form-control" readonly placeholder="Product Name" value="{{ $parentProduct->name }}">
                                                                            </div>
                                                                            <div class="mb-3 col-lg-2">
                                                                                <label for="place_holder">Price</label>
                                                                                <input type="text" name="price" class="form-control price price_INDEX" readonly placeholder="Enter Price" value="{{ $taskItemProduct->unit_price }}">
                                                                            </div>
                                                                            <div class="mb-3 col-lg-2">
                                                                                <label for="place_holder">Qty</label>
                                                                                <input type="text" name="qty" class="form-control" readonly placeholder="Enter Quantity" value="{{ $taskItemProduct->qty }}">
                                                                            </div>
                                                                            <div class="mb-3 col-lg-2">
                                                                                <label for="place_holder">Tax</label>
                                                                                <input type="text" name="tax" class="form-control" readonly placeholder="Enter Tax %" value="{{ $taskItemProduct->tax_perc }}">
                                                                            </div>
                                                                            <div class="mb-3 col-lg-3">
                                                                                <label for="place_holder">Total</label>
                                                                                <input type="text" name="total" class="form-control" readonly placeholder="Total" value="{{ $taskItemProduct->total }}">
                                                                            </div>
                                                                        </div>
                                                                        {{-- @foreach ($parentProduct->taskChildProducts as $index => $chilProduct)
                                                                            <div class="newRow_INDEX">
                                                                                <div data-repeater-item class="row templateRow rowAppend_INDEX">
                                                                                    <div class="mb-3 col-lg-3">
                                                                                        <select name="product_INDEX[]" class="select2 form-control product product_INDEX">
                                                                                            <option data-price="0" value="">Choose Product</option>
                                                                                            @foreach ($data->products as $product)
                                                                                                <option data-price="{{ $product->price }}" value="{{ $product->id }}" @if($product->id == $chilProduct->product_id) selected @endif>{{ $product->name }}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="mb-3 col-lg-3">
                                                                                        <input type="text" name="price_INDEX[]" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" class="form-control price price_INDEX" placeholder="Enter Price" value="{{ $chilProduct->unit_price }}">
                                                                                    </div>
                                                                                    <div class="mb-3 col-lg-3">
                                                                                        <input type="text" name="qty_INDEX[]" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" class="form-control qty qty_INDEX" placeholder="Enter Quantity" value="{{ $chilProduct->qty }}">
                                                                                    </div>
                                                                                    <div class="mb-3 col-lg-2">
                                                                                        <input type="text" name="total_INDEX[]" class="form-control total total_INDEX" readonly placeholder="Total" value="{{ $chilProduct->unit_price * $chilProduct->qty }}">
                                                                                    </div>
                                                                                    <div class="col-lg-1">
                                                                                        <button type="button" class="btn btn-danger remove-btn">
                                                                                            <i class="bx bx-minus-circle me-1"></i>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach --}}
                                                                    </div>
                                                                @endforeach

                                                                <div class="row">
                                                                    <div class="mb-3 col-lg-3 offset-md-9">
                                                                        <label for="place_holder"><b>Products Total</b></label>
                                                                        <input type="text" name="products_total" class="form-control" readonly placeholder="Products Total" value="{{ $taskItemProductsTotal }}">
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <h3 class="text text-danger text-center">No product till now In this case</h3>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
            @endif
        </div>
    </div>
@endsection

<style>
    .switch {position: relative;display: inline-block;width: 60px;height: 34px;}
    .switch input {opacity: 0;width: 0;height: 0;}
    .slider {position: absolute;cursor: pointer;top: 0;left: 0;right: 0;bottom: 0;background-color: #ccc;-webkit-transition: .4s;transition: .4s;}
    .slider:before {position: absolute;content: "";height: 26px;width: 26px;left: 4px;bottom: 4px;background-color: white;-webkit-transition: .4s;transition: .4s;}
    input:checked + .slider {background-color: #84ba3f;}
    input:focus + .slider {box-shadow: 0 0 1px #84ba3f;}
    input:checked + .slider:before {-webkit-transform: translateX(26px);-ms-transform: translateX(26px);transform: translateX(26px);}
    .slider.round {border-radius: 34px;}
    .slider.round:before {border-radius: 50%;}
    .custom-file-upload {
        border: 2px dashed #ccc;
        border-radius: 5px;
        display: inline-block;
        padding: 20px 200px;
        cursor: pointer;
        text-align: center;
        width: 100%;
        font-size: 20px;
        transition: border 0.3s ease;
    }

    .custom-file-upload:hover {
        border-color: #aaa;
    }

    .custom-file-upload input[type="file"] {
        display: none;
    }

    .custom-file-upload span {
        display: block;
        margin-bottom: 10px;
    }

    .custom-file-upload i {
        font-size: 24px;
        margin-right: 10px;
    }


    .preview-image {
        display: inline-block;
        position: relative;
        margin: 10px;
    }

    .preview-image img {
        width: 100px; /* Adjust as per your requirement */
        height: 100px; /* Adjust as per your requirement */
        object-fit: cover;
        border: 1px solid #ccc;
        padding: 5px;
        border-radius: 5px;
    }

    .delete-image {
        position: absolute;
        top: 2px;
        right: 2px;
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 50%;
        padding: 2px;
        cursor: pointer;
    }
</style>
