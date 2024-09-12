@extends('layouts.app')

@section('content')

    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Update Booking Form</h4>
                    </div>
                </div>
            </div>
            <div class="checkout-tabs">
                <div class="row">
                    <div class="col-xl-2 col-sm-2">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="v-pills-item-tab" data-bs-toggle="pill" href="#v-pills-item" role="tab" aria-controls="v-pills-item" aria-selected="true">
                                <i class= "fa fa-wrench d-block check-nav-icon mt-4 mb-2"></i>
                                <p class="fw-bold mb-4">Item Info</p>
                            </a>
                            <a class="nav-link" id="v-parts-tab" data-bs-toggle="pill" href="#v-parts" role="tab" aria-controls="v-parts" aria-selected="false">
                                <i class= "fa fa-th-large d-block check-nav-icon mt-4 mb-2"></i>
                                <p class="fw-bold mb-4">Parts & Media</p>
                            </a>
                            <a class="nav-link" id="v-services-tab" data-bs-toggle="pill" href="#v-services" role="tab" aria-controls="v-services" aria-selected="false">
                                <i class= "fa fa-cog d-block check-nav-icon mt-4 mb-2"></i>
                                <p class="fw-bold mb-4">Services</p>
                            </a>
                            <a class="nav-link" id="v-location-tab" data-bs-toggle="pill" href="#v-location" role="tab" aria-controls="v-location" aria-selected="false">
                                <i class= "fa fa-map-marker d-block check-nav-icon mt-4 mb-2"></i>
                                <p class="fw-bold mb-4">Service Location</p>
                            </a>
                            <a class="nav-link" id="v-confirmation-tab" data-bs-toggle="pill" href="#v-confirmation" role="tab" aria-controls="v-confirmation" aria-selected="false">
                                <i class= "fa fa-check-circle d-block check-nav-icon mt-4 mb-2"></i>
                                <p class="fw-bold mb-4">Confirmation</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-8 col-sm-8">
                        <form method="POST" action="{{ route('case.update', $data->task->id) }}" class="form" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="card">
                                <div class="card-body">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        {{-- @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif --}}
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
                                                            <select class="form-control select2" title="Item" name="item">
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
                                                            <input type="text" name="manufacturer" class="form-control" id="manufacturer" value="{{ $data->task->manufacturer }}" placeholder="Enter Manufacturer">
                                                            @error('manufacturer')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="model" class="form-label">Model</label>
                                                            <input type="text" name="model" class="form-control" id="model" value="{{ $data->task->model }}" placeholder="Enter Model">
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
                                                            <input type="text" name="year" class="form-control" id="year" value="{{ $data->task->year }}" placeholder="Enter Year">
                                                            @error('year')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="color" class="form-label">Color</label>
                                                            <input type="text" name="color" class="form-control" id="color" value="{{ $data->task->color }}" placeholder="Enter Color">
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
                                                            <textarea class="form-control" name="additional_info" id="additional_info" placeholder="Enter Additional Information">{{ $data->task->additional_info }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-3">
                                                        <label for="problem_description" class="form-label">Description of Problem / Failure</label>
                                                        <div class="col-md-12">
                                                            <textarea class="form-control" name="problem_description" id="problem_description" placeholder="Enter Detailed Description of Problem / Failure">{{ $data->task->problem_description }}</textarea>
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
                                        <div class="tab-pane fade" id="v-parts" role="tabpanel" aria-labelledby="v-parts-tab">
                                            <div>
                                                <h4 class="card-title">Leaving Parts</h4>
                                                <p class="card-title-desc">The parts you want to leave</p>
                                                {{-- <form> --}}

                                                <div>
                                                    @foreach ($data->parts as $part)
                                                        @php
                                                            $isChecked = $data->task->taskLeaveParts->contains('part_id', $part->id);
                                                        @endphp
                                                        <div class="form-check form-check-inline font-size-16 mt-1">
                                                            <input class="form-check-input" type="checkbox" value="{{ $part->id }}" name="parts[]" id="part-{{ $part->id }}" {{ $isChecked ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="part-{{ $part->id }}">
                                                                <h5>{{ $part->name }}</h5>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <h4 class="card-title mt-5">Medias</h4>
                                                {{-- <p class="card-title-desc">Pictures and videos of product</p> --}}
                                                {{-- <div>
                                                    <label class="form-label">Attached Files</label>
                                                    <div class="fallback dropzone" id="myId" enctype="multipart/form-data">
                                                        <div class="fallback">
                                                            <input name="file" type="file" multiple />
                                                        </div>

                                                        <div class="dz-message needsclick">
                                                            <div class="mb-3">
                                                                <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                                            </div>

                                                            <h4>Drop files here or click to upload.</h4>
                                                        </div>
                                                    </div>
                                                </div> --}}

                                                <label for="uploadImage" class="custom-file-upload">
                                                    <span><i class="ti-cloud-up"></i> Pictures, files and videos of product</span>
                                                    <input type="file" name="files[]" id="uploadImage" class="form-control-file" multiple>
                                                    {{-- <input type="file" id="uploadImage" name="file[]" class="form-control-file" multiple="multiple"> --}}
                                                </label>
                                                <div id="imagesBody">

                                                    @foreach ($data->task->media as $media)
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
                                                            @if ($media->customer_choice == 2)
                                                                <span class="delete-image deleteCaseMedia" data-href="{{ route('case.destroyMedia', $media->id) }}" data-nxame="' + theFile.name + '"><i class="fa fa-trash text-danger"></i></span>
                                                            @endif
                                                        </div>

                                                    @endforeach
                                                </div>
                                                {{-- <section>
                                                    <div>
                                                        <h5 class="font-size-14 mb-3">Upload document file for a verification</h5>
                                                        <div class="dropzone">
                                                            <div class="fallback">
                                                                <input name="file[]" type="file" multiple="multiple">
                                                            </div>
                                                            <div class="dz-message needsclick">
                                                                <div class="mb-3">
                                                                    <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                                                </div>

                                                                <h4>Drop files here or click to upload.</h4>
                                                            </div>
                                                        </div>

                                                        <ul class="list-unstyled mb-0" id="dropzone-preview">
                                                            <li class="mt-2" id="dropzone-preview-list">
                                                                <!-- This is used as the file preview template -->
                                                                <div class="border rounded">
                                                                    <div class="d-flex p-2">
                                                                        <div class="flex-shrink-0 me-3">
                                                                            <div class="avatar-sm bg-light rounded">
                                                                                <img data-dz-thumbnail class="img-fluid rounded d-block" src=" {{ asset('images/new-document.png') }}" alt="Dropzone-Image">
                                                                            </div>
                                                                        </div>
                                                                        <div class="flex-grow-1">
                                                                            <div class="pt-1">
                                                                                <h5 class="fs-md mb-1" data-dz-name>&nbsp;</h5>
                                                                                <p class="fs-sm text-muted mb-0" data-dz-size></p>
                                                                                <strong class="error text-danger" data-dz-errormessage></strong>
                                                                            </div>
                                                                        </div>
                                                                        <div class="flex-shrink-0 ms-3">
                                                                            <button data-dz-remove class="btn btn-sm btn-danger">Delete</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </section> --}}


                                                {{-- </form> --}}
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-services" role="tabpanel" aria-labelledby="v-services-tab">
                                            <div>
                                                <h4 class="card-title">Technician</h4>
                                                <p class="card-title-desc">Alot Technician To Case</p>
                                                <div class="form-group row mb-5">
                                                    <div class="col-md-12">
                                                        <select class="form-control select2" title="Technician" name="technician_id">
                                                            <option value="">Select Technician </option>
                                                            @foreach ($data->technicians as $technician)
                                                                <option value="{{ $technician->id }}" @if($technician->id == $data->task->technician_id) selected @endif>{{ $technician->first_name .' '. $technician->last_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <h4 class="card-title">Priority of Case</h4>
                                                <p class="card-title-desc">How fast you wants get back?</p>
                                                {{-- <form> --}}

                                                <div>
                                                    @foreach ($data->priorities as $priority)
                                                        <div class="form-check form-check-inline font-size-16">
                                                            <input class="form-check-input" type="radio" name="priority" value="{{$priority->id}}" id="priority-{{$priority->id}}" {{ $priority->id == $data->task->priority_id ? 'checked' : '' }}>
                                                            <label class="form-check-label font-size-13" for="priority-{{$priority->id}}">
                                                                {{ $priority->name }} - {{ number_format($priority->price, 0) }}€
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                {{-- <div class="form-group row mb-2">
                                                    <label class="col-md-2 col-form-label">Select Item</label>
                                                    <div class="col-md-12">
                                                        <select class="form-control select2" title="Country">
                                                            <option value="">Select Item </option>
                                                            @foreach ($data->priorities as $priority)
                                                                <option value="{{ $priority->id }}">{{ $priority->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div> --}}



                                                <h4 class="card-title mt-5">Inspection and diagnostics</h4>
                                                <p class="card-title-desc">Do you want to avail professional diagniostic serves?</p>
                                                {{-- <form> --}}

                                                @php
                                                    $totalServicesPrice = 0;
                                                @endphp
                                                <div class="mb-4 row">
                                                    <div class="col-md-6">
                                                        <div class="form-check form-check-inline font-size-16">
                                                            <input class="form-check-input" type="radio" value="1" name="inspection" id="inspection" {{ $data->task->inspection_diagnose == 1 ? 'checked' : '' }}>
                                                            <label class="form-check-label font-size-13" for="inspection">
                                                                <i class="fa fa-search-plus me-1 font-size-20 align-top"></i>
                                                                Inspection and diagnostics - <b class="font-size-16">35€</b>
                                                                <br><span class="text text-danger">35€ would extra add on</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-check form-check-inline font-size-16">
                                                            <input class="form-check-input" type="radio" value="2" name="inspection" id="withoutinspection2" {{ $data->task->inspection_diagnose != 1 ? 'checked' : '' }}>
                                                            <label class="form-check-label font-size-13" for="withoutinspection2">
                                                                <i class="fa fa-search-minus me-1 font-size-20 align-top"></i>
                                                                Without diagnostics - <b class="font-size-16">0€</b>
                                                                <br><span class="text text-danger">Repair, according to the problem named and described by the customer</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <h4 class="card-title mt-5">Services</h4>
                                                <p class="card-title-desc">Please select your required services carefully</p>
                                                <div class="mb-5">
                                                    @foreach ($data->services->where('status', 1) as $service)
                                                        @php
                                                            $isChecked = $data->task->taskServices->contains('service_id', $service->id);

                                                            if ($isChecked) {
                                                                $totalServicesPrice += $service->price;
                                                            }
                                                        @endphp
                                                        <div class="mb-2 form-check form-check-inline font-size-16">
                                                            <input class="form-check-input" type="checkbox" name="services[]" service-price="{{ $service->price }}" value="{{ $service->id }}" name="services[]" id="service-{{ $service->id }}" {{ $isChecked ? 'checked' : '' }} onchange="updateServiceTotal()">
                                                            <label class="form-check-label" for="service-{{ $service->id }}">
                                                                <h5>
                                                                    {{ $service->name }}
                                                                    {!! $service->show_price == 1 ? '<span class="font-size-14"><b>' . number_format($service->price) . ' €</b></span>' : '' !!}
                                                                </h5>
                                                            </label>
                                                        </div>
                                                    @endforeach

                                                    @if (count($data->services->where('status', 2)) > 0)
                                                        <div class="text-align-center mt-3 mb-3">
                                                            <h3 type="button" id="showAllServices" class="btn btn-primary show-more"><i class="bx bx-show"></i> Show More</button>
                                                        </div>
                                                    @endif

                                                    @foreach ($data->services->where('status', 2) as $service)
                                                        @php
                                                            $isChecked = $data->task->taskServices->contains('service_id', $service->id);
                                                            if ($isChecked) {
                                                                $totalServicesPrice += $service->price;
                                                            }
                                                        @endphp
                                                        <div class="mb-2 form-check form-check-inline font-size-16 hidden-services d-none">
                                                            <input class="form-check-input" type="checkbox" name="services[]" service-price="{{ $service->price }}" value="{{ $service->id }}" name="services[]" id="service-{{ $service->id }}" {{ $isChecked ? 'checked' : '' }}  onchange="updateServiceTotal()">
                                                            <label class="form-check-label" for="service-{{ $service->id }}">
                                                                <h5>
                                                                    {{ $service->name }}
                                                                    {!! $service->show_price == 1 ? '<span class="font-size-14"><b>' . number_format($service->price) . ' €</b></span>' : '' !!}
                                                                </h5>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                    @error('services')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror


                                                    <div class="col-12 mb-5">
                                                        @foreach ($data->task->taskProducts as $index => $parentProduct)
                                                            @php $index++ @endphp
                                                            <div data-repeater-list="group-a">
                                                                <!-- Initial template for a single row -->
                                                                <div class="row">
                                                                    <div class="mb-3 col-lg-6">
                                                                        <label for="name">Merge Product Name</label>
                                                                        <input type="text" class="form-control merge_name_{{$index}} merge_name" name="merge_name_{{$index}}" id="merge_name_{{$index}}" value="{{ $parentProduct->name }}" placeholder="Merge Product Name" >
                                                                    </div>
                                                                    <div class="mb-3 col-lg-6"></div>
                                                                    <div class="mb-3 col-lg-3">
                                                                        <label for="place_holder">Product Name</label>
                                                                    </div>
                                                                    <div class="mb-3 col-lg-3">
                                                                        <label for="place_holder">Product Price</label>
                                                                    </div>
                                                                    <div class="mb-3 col-lg-3">
                                                                        <label for="place_holder">Product Qty</label>
                                                                    </div>
                                                                    <div class="mb-3 col-lg-2">
                                                                        <label for="place_holder">Product Total</label>
                                                                    </div>
                                                                    <div class="mb-3 col-lg-1">
                                                                    </div>
                                                                </div>
                                                                <div class="newRow_{{$index}}">
                                                                    @foreach ($parentProduct->taskItemProducts as $indexP => $chilProduct)
                                                                        <div data-repeater-item class="row templateRow rowAppend_{{$index}}">
                                                                            <div class="mb-3 col-lg-3">
                                                                                <select name="product_{{$index}}[]" class="select2 form-control product product_{{$index}}">
                                                                                    <option data-name="" data-price="0" value="">Choose Product</option>
                                                                                    @foreach ($data->products as $product)
                                                                                        <option data-name="{{ $product->name }}" data-price="{{ $product->price }}" value="{{ $product->id }}" @if($product->id == $chilProduct->product_id) selected @endif>{{ $product->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div class="mb-3 col-lg-3">
                                                                                <input type="text" name="price_{{$index}}[]" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" class="form-control price price_{{$index}}" placeholder="Enter Price" value="{{ $chilProduct->unit_price }}">
                                                                            </div>
                                                                            <div class="mb-3 col-lg-3">
                                                                                <input type="text" name="qty_{{$index}}[]" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" class="form-control qty qty_{{$index}}" placeholder="Enter Quantity" value="{{ $chilProduct->qty }}">
                                                                            </div>
                                                                            <div class="mb-3 col-lg-2">
                                                                                <input type="text" name="total_{{$index}}[]" class="form-control total total_{{$index}}" readonly placeholder="Total" value="{{ $chilProduct->unit_price * $chilProduct->qty }}">
                                                                            </div>
                                                                            <div class="col-lg-1">
                                                                                <button type="button" class="btn btn-danger remove-btn">
                                                                                    <i class="bx bx-minus-circle me-1"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            <!-- Button to add new rows -->
                                                            <div class="row">
                                                                <div class="col-lg-1 offset-lg-11">
                                                                    <button type="button" class="btn btn-success add-btn-row text-bold" data-index="{{$index}}">
                                                                        <i class="bx bx-plus-circle me-1"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    <div class="mb-3 col-sm-12 offset-sm-0 col-md-4 offset-md-8">
                                                        <label>Selected Services Total (€)</label>
                                                        <input type="number" name="service_total" id="service-total" class="form-control" placeholder="Total Services Amount" value="{{ $totalServicesPrice }}" readonly>
                                                    </div>
                                                    <div class="mb-3 col-sm-12 offset-sm-0 col-md-4 offset-md-8">
                                                        <label>Give your's if price is over (€)</label>
                                                        <input type="text" name="service_desired_total" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="form-control" placeholder="Your Desired Amount" value="{{ $data->task->service_desired_total }}">
                                                    </div>
                                                </div>

                                                <h4 class="card-title mt-5">Products</h4>
                                                <p class="card-title-desc">Products consumed in this case</p>
                                                {{-- <div class="mb-5"> --}}
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <button type="button" class="btn btn-success add-btn text-bold add_panel_button">
                                                                        <i class="bx bx-plus-circle me-1"></i> Add Merge Product Panel
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <!-- <select title="products" id="dd_products" name="products[]" class="select2 form-control select2-multiple filter" multiple="multiple" data-placeholder="Choose Products" style="width: 100%">
                                                                @foreach ($data->products as $product)
                                                                    @php
                                                                        $isChecked = $data->task->taskProducts->contains('product_id', $product->id);
                                                                    @endphp
                                                                    <option value="{{ $product->id }}">{{ $product->name }}</option> -->
                                                                    <!-- <div class="col-md-6">
                                                                        <div class="mb-2 form-check form-check-inline font-size-16">
                                                                            <input class="form-check-input" type="checkbox" name="products[]" value="{{ $product->id }}" name="products[]" id="product-{{ $product->id }}" {{ $isChecked ? 'checked' : '' }}>
                                                                            <label class="form-check-label" for="product-{{ $product->id }}">
                                                                                <h5>
                                                                                    {{ $product->name }}
                                                                                    <br>
                                                                                    <span class="font-size-14"><b>{{number_format($product->price)}} €</b></span>
                                                                                </h5>
                                                                            </label>
                                                                        </div>
                                                                    </div> -->
                                                                <!-- @endforeach
                                                            </select> -->

                                                        </div>
                                                        <div class="col-md-6"></div>


                                                        {{-- <div class="row template_row"> --}}
                                                            <div class="col-12 mb-5">
                                                                @foreach ($data->task->taskProducts as $index => $parentProduct)
                                                                    @php $index++ @endphp
                                                                    <div data-repeater-list="group-a">
                                                                        <!-- Initial template for a single row -->
                                                                        <div class="row">
                                                                            <div class="mb-3 col-lg-6">
                                                                                <label for="name">Merge Product Name</label>
                                                                                <input type="text" class="form-control merge_name_{{$index}} merge_name" name="merge_name_{{$index}}" id="merge_name_{{$index}}" value="{{ $parentProduct->name }}" placeholder="Merge Product Name" >
                                                                            </div>
                                                                            <div class="mb-3 col-lg-6"></div>
                                                                            <div class="mb-3 col-lg-3">
                                                                                <label for="place_holder">Product Name</label>
                                                                            </div>
                                                                            <div class="mb-3 col-lg-3">
                                                                                <label for="place_holder">Product Price</label>
                                                                            </div>
                                                                            <div class="mb-3 col-lg-3">
                                                                                <label for="place_holder">Product Qty</label>
                                                                            </div>
                                                                            <div class="mb-3 col-lg-2">
                                                                                <label for="place_holder">Product Total</label>
                                                                            </div>
                                                                            <div class="mb-3 col-lg-1">
                                                                            </div>
                                                                        </div>
                                                                        <div class="newRow_{{$index}}">
                                                                            @foreach ($parentProduct->taskItemProducts as $indexP => $chilProduct)
                                                                                <div data-repeater-item class="row templateRow rowAppend_{{$index}}">
                                                                                    <div class="mb-3 col-lg-3">
                                                                                        <select name="product_{{$index}}[]" class="select2 form-control product product_{{$index}}">
                                                                                            <option data-name="" data-price="0" value="">Choose Product</option>
                                                                                            @foreach ($data->products as $product)
                                                                                                <option data-name="{{ $product->name }}" data-price="{{ $product->price }}" value="{{ $product->id }}" @if($product->id == $chilProduct->product_id) selected @endif>{{ $product->name }}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="mb-3 col-lg-3">
                                                                                        <input type="text" name="price_{{$index}}[]" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" class="form-control price price_{{$index}}" placeholder="Enter Price" value="{{ $chilProduct->unit_price }}">
                                                                                    </div>
                                                                                    <div class="mb-3 col-lg-3">
                                                                                        <input type="text" name="qty_{{$index}}[]" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" class="form-control qty qty_{{$index}}" placeholder="Enter Quantity" value="{{ $chilProduct->qty }}">
                                                                                    </div>
                                                                                    <div class="mb-3 col-lg-2">
                                                                                        <input type="text" name="total_{{$index}}[]" class="form-control total total_{{$index}}" readonly placeholder="Total" value="{{ $chilProduct->unit_price * $chilProduct->qty }}">
                                                                                    </div>
                                                                                    <div class="col-lg-1">
                                                                                        <button type="button" class="btn btn-danger remove-btn">
                                                                                            <i class="bx bx-minus-circle me-1"></i>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    <!-- Button to add new rows -->
                                                                    <div class="row">
                                                                        <div class="col-lg-1 offset-lg-11">
                                                                            <button type="button" class="btn btn-success add-btn-row text-bold" data-index="{{$index}}">
                                                                                <i class="bx bx-plus-circle me-1"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        {{-- </div> --}}
                                                        <input type="hidden" name="row_count" id="row_count" value="{{count($data->task->taskProducts)}}">
                                                        <div class="col-md-12 add_template_area"></div>
                                                    </div>
                                                {{-- </div> --}}

                                                {{-- </form> --}}
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-location" role="tabpanel" aria-labelledby="v-location-tab">
                                            <div>
                                                <h4 class="card-title">Service Location</h4>
                                                <p class="card-title-desc">Fill all information below</p>
                                                <br>
                                                <div>
                                                    @foreach ($data->serviceLocations as $location)
                                                    <div class="mb-2 form-check form-check-inline font-size-16">
                                                        <input class="form-check-input service-location" type="radio" name="services_location" value="{{ $location->id }}" id="loc-{{ $location->id }}" {{ $location->id == $data->task->services_location ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="loc-{{ $location->id }}">
                                                            <h5>{{ $location->title }}</h5>
                                                        </label>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                @foreach ($data->serviceLocations as $location)
                                                    <div class="tab-content p-3 text-muted service-location-form" id="form-location-{{ $location->id }}" style="display: none;">
                                                        <div class="tab-pane active show" id="location-{{$location->id}}" role="tabpanel">
                                                            @if ($location->detail)
                                                                <div class="alert alert-info d-none d-lg-block">
                                                                    {{ $location->detail }}
                                                                </div>
                                                            @endif
                                                            <div class="row">
                                                                @foreach (json_decode($location->fields) as $field)
                                                                <div class="col-lg-{{ $field->type === 'textarea' ? '12' : '6' }}">
                                                                    <div class="mb-3">
                                                                        <label for="{{ $location->id .'-'. $field->name }}">{{ $field->title }}</label>
                                                                        @if ($field->type === 'textarea')
                                                                            <textarea class="form-control" id="{{ $location->id .'-'. $field->name }}" name="{{ $location->id .'-'. $field->name }}" placeholder="{{ $field->place_holder ?? 'Enter ' .$field->title }}">{{ $data->task->customer[$field->name] }}</textarea>
                                                                        @else
                                                                            <input type="{{ $field->type }}" class="form-control" id="{{ $location->id .'-'. $field->name }}" name="{{ $location->id .'-'. $field->name }}" placeholder="{{ $field->place_holder ?? 'Enter ' .$field->title }}" value="{{ $data->task->customer[$field->name] }}">
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                    {{-- <br>
                                                    <div>

                                                    @foreach (getService('location') as $key => $location)
                                                        <div class="mb-2 form-check form-check-inline font-size-16">
                                                            <input class="form-check-input" type="radio" name="services_location" value="{{++$key}}" name="services_location" id="loc-{{$key}}" {{ $key == $data->task->services_location ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="loc-{{$key}}">
                                                                <h5>{{ $location }}</h5>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                    </div>

                                                    <div class="tab-content p-3 text-muted">
                                                        <div class="tab-pane active show" id="home-1" role="tabpanel">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="first_name">First Name</label>
                                                                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter first name" value="{{ $data->task->customer->first_name }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="last_name">Last Name</label>
                                                                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter last name" value="{{ $data->task->customer->last_name }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="phone">Phone Number</label>
                                                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number" value="{{ $data->task->customer->phone }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="email">Email</label>
                                                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{ $data->task->customer->email }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="city">City</label>
                                                                        <input type="text" class="form-control" id="city" name="city" placeholder="Enter city" value="{{ $data->task->customer->city }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="company">Company</label>
                                                                        <input type="text" class="form-control" id="company" name="company" placeholder="Enter company" value="{{ $data->task->customer->company }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="mb-3">
                                                                        <label for="address">Address</label>
                                                                        <textarea class="form-control" id="address" name="address" placeholder="Enter address">{{ $data->task->customer->address }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> --}}

                                                {{-- </form> --}}
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-confirmation" role="tabpanel" aria-labelledby="v-confirmation-tab">
                                            <div>
                                                <div class="tab-content p-3 text-muted">
                                                    <div class="tab-pane active show" id="home-1" role="tabpanel">
                                                        <div class="row">
                                                            @foreach (json_decode($data->task->details) as $term)
                                                                <div class="mb-2 form-check form-check-inline font-size-16">
                                                                    <input type="hidden" name="terms[{{ $term->name }}][status]" value="0">
                                                                    <input type="hidden" name="terms[{{ $term->name }}][link]" value="{{ $term->link }}">
                                                                    <input class="form-check-input" type="checkbox" value="1" name="terms[{{ $term->name }}][status]" id="term_{{ $term->name }}" {{ $term->is_check == "1" ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="term_{{$term->name}}">
                                                                        <h5>
                                                                            @if(!empty($term->link))
                                                                                <a href="{{ $term->link }}" target="_blank">{{ $term->title }}</a>
                                                                            @else
                                                                                {{ $term->title }}
                                                                            @endif
                                                                        </h5>
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-grid gap-2">
                                                <button type="submit" class="btn btn-primary btn-lg waves-effect waves-light">UPDATE</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row mt-4">
                                <div class="col-sm-6">
                                    <a href="ecommerce-cart.html" class="btn text-muted d-none d-sm-inline-block btn-link">
                                        <i class="mdi mdi-arrow-left me-1"></i> Back to Shopping Cart </a>
                                </div> <!-- end col -->
                                <div class="col-sm-6">
                                    <div class="text-end">
                                        <a href="ecommerce-checkout.html" class="btn btn-success">
                                            <i class="mdi mdi-truck-fast me-1"></i> Proceed to Shipping </a>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row --> --}}

                        </form>
                    </div>
                    <div class="col-xl-2 col-sm-2">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('case.update', $data->task->id) }}" class="form" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <h4 class="card-title">Overview</h4>
                                    {{-- <p class="card-title-desc">Fill all information below</p> --}}
                                    <div>
                                        {{-- <h4 class="card-title">Leaving Parts</h4>
                                        <p class="card-title-desc">The parts you want to leave</p> --}}
                                        {{-- <form> --}}

                                        <div class="mt-1">
                                            <label class="col-form-label">Case Status</label>
                                            <select class="form-control select2" title="Item" name="item">
                                                <option value="">Select Case Status </option>
                                                @foreach (getCaseStatus('general') as $key => $status)
                                                    <option value="{{ $key }}" @if($key == $data->task->payment_status) selected @endif>{{ $status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mt-1">
                                            <label class="col-form-label">Payment Status</label>
                                            <select class="form-control select2" title="Item" name="item">
                                                <option value="">Select Payment Status </option>
                                                @foreach (getPayment('status') as $key => $status)
                                                    <option value="{{ $key }}" @if($key == $data->task->payment_status) selected @endif>{{ $status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mt-1">
                                            <label class="col-form-label">Payment Method</label>
                                            <select class="form-control select2" title="Item" name="item">
                                                <option value="">Select Payment Method </option>
                                                @foreach (getPayment('via') as $key => $status)
                                                    <option value="{{ $key }}" @if($key == $data->task->payment_status) selected @endif>{{ $status }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="d-grid gap-2 mt-3">
                                            <button type="submit" class="btn btn-primary btn-lg waves-effect waves-light">UPDATE</button>
                                        </div>
                                    <div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row template_row d-none">
        <div class="col-12 mb-5">
            {{-- <h4 class="card-title mb-4">Input Fields</h4> --}}

            <div data-repeater-list="group-a">
                <!-- Initial template for a single row -->
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="name">Merge Product Name</label>
                        <input type="text" class="form-control merge_name_INDEX merge_name" name="merge_name_INDEX" id="merge_name_INDEX" value="" placeholder="Merge Product Name" >
                    </div>
                    <div class="mb-3 col-lg-6"></div>
                    <div class="mb-3 col-lg-3">
                        <label for="place_holder">Product Name</label>
                    </div>
                    <div class="mb-3 col-lg-3">
                        <label for="place_holder">Product Price</label>
                    </div>
                    <div class="mb-3 col-lg-3">
                        <label for="place_holder">Product Qty</label>
                    </div>
                    <div class="mb-3 col-lg-2">
                        <label for="place_holder">Product Total</label>
                    </div>
                    <div class="mb-3 col-lg-1">
                    </div>
                </div>
                <div class="newRow_INDEX">
                    <div data-repeater-item class="row templateRow rowAppend_INDEX">
                        <div class="mb-3 col-lg-3">
                            <select name="product_INDEX[]" class="select2 form-control product product_INDEX">
                                <option data-name="" data-price="0" value="">Choose Product</option>
                                @foreach ($data->products as $product)
                                    <option data-name="{{ $product->name }}" data-price="{{ $product->price }}" value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-lg-3">
                            <input type="hidden" name="name_INDEX[]" class="form-control name name_INDEX" placeholder="name">
                            <input type="text" name="price_INDEX[]" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" class="form-control price price_INDEX" placeholder="Enter Price" value="0">
                        </div>
                        <div class="mb-3 col-lg-3">
                            <input type="text" name="qty_INDEX[]" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" class="form-control qty qty_INDEX" placeholder="Enter Quantity" value="0">
                        </div>
                        <div class="mb-3 col-lg-2">
                            <input type="text" name="total_INDEX[]" class="form-control total total_INDEX" readonly placeholder="Total" value="0">
                        </div>
                        <div class="col-lg-1">
                            <button type="button" class="btn btn-danger remove-btn">
                                <i class="bx bx-minus-circle me-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Button to add new rows -->
            <div class="row">
                <div class="col-lg-1 offset-lg-11">
                    <button type="button" class="btn btn-success add-btn-row text-bold" data-index="INDEX">
                        <i class="bx bx-plus-circle me-1"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="template_row_append d-none">
        <div data-repeater-item class="row templateRow">
            <div class="mb-3 col-lg-3">
                <select name="product_INDEX[]" class="select2 form-control product product_INDEX">
                    <option data-name="" data-price="0" value="">Choose Product</option>
                    @foreach ($data->products as $product)
                        <option data-name="{{ $product->name }}" data-price="{{ $product->price }}" value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 col-lg-3">
                <input type="hidden" name="name_INDEX[]" class="form-control name name_INDEX" placeholder="name">
                <input type="text" name="price_INDEX[]" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" class="form-control price price_INDEX" placeholder="Enter Price" value="0">
            </div>
            <div class="mb-3 col-lg-3">
                <input type="text" name="qty_INDEX[]" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" class="form-control qty qty_INDEX" placeholder="Enter Quantity" value="0">
            </div>
            <div class="mb-3 col-lg-2">
                <input type="text" name="total_INDEX[]" class="form-control total total_INDEX" readonly placeholder="Total" value="0">
            </div>
            <div class="col-lg-1">
                <button type="button" class="btn btn-danger remove-btn" data-index="INDEX">
                    <i class="bx bx-minus-circle me-1"></i>
                </button>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Total of All Selected Services
    function updateServiceTotal() {
        let total = 0;

        const checkboxes = document.querySelectorAll('input[type="checkbox"][service-price]');

        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                total += parseFloat(checkbox.getAttribute('service-price'));
            }
        });

        document.getElementById('service-total').value = total.toFixed(2);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const showAllButton = document.getElementById('showAllServices');

        showAllButton.addEventListener('click', function() {
            // Toggle visibility of hidden services
            const hiddenServices = document.querySelectorAll('.hidden-services');
            hiddenServices.forEach(function(service) {
                service.classList.toggle('d-none');
            });

            // Toggle button text and class
            if (showAllButton.classList.contains('show-more')) {
                showAllButton.innerHTML = '<i class="bx bx-hide"></i> Show Less';
                showAllButton.classList.remove('show-more');
                showAllButton.classList.add('show-less');
            } else {
                showAllButton.innerHTML = '<i class="bx bx-show"></i> Show More';
                showAllButton.classList.remove('show-less');
                showAllButton.classList.add('show-more');
            }
        });
    });

    $(document).ready(function() {
        // Function to handle file selection and preview
        $('#uploadImage').on('change', function(e) {
            var files = e.target.files; // Get the files from input
            var imagesBody = $('#imagesBody'); // Get the div where preview will be displayed

            // Loop through the files
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var reader = new FileReader(); // Create a new FileReader

                // Closure to capture the file information
                reader.onload = (function(theFile) {
                    return function(e) {
                        var fileType = theFile.type.split('/')[0]; // Get file type (image, pdf, etc.)
                        var previewContent;

                        // Check file type to decide on preview content
                        if (fileType === 'image') {
                            previewContent = '<img class="thumb" src="' + e.target.result + '" title="' + escape(theFile.name) + '">';
                        } else if (fileType === 'video') {
                            imagePath = '{{ asset("images/video.png") }}';
                            previewContent = '<img class="thumb" src="' + imagePath + '" title="' + escape(theFile.name) + '">';
                        }else {
                            imagePath = '{{ asset("images/file.png") }}';
                            previewContent = '<img class="thumb" src="' + imagePath + '" title="' + escape(theFile.name) + '">';

                        }

                        // Create a new image or file preview element
                        var imgElement = $('<div class="preview-image"> \
                                            ' + previewContent + ' \
                                            <span class="delete-image" data-name="' + theFile.name + '"><i class="fa fa-trash text-danger"></i></span> \
                                        </div>');

                        // Append the image or file preview element to the imagesBody
                        imagesBody.append(imgElement);
                    };
                })(file);

                // Read in the image file as a data URL
                reader.readAsDataURL(file);
            }
        });

        // Function to handle deletion of images
        $('#imagesBody').on('click', '.delete-image', function() {
            var imageName = $(this).data('name'); // Get the file name from data attribute
            $(this).parent().remove(); // Remove the parent element (the whole preview div)

            // If you need to do something else with the deleted file (like removing from server),
            // you would typically make an AJAX call here.
        });
    });

    $(document).ready(function() {
        // $('.select2').select2();
        var rowCount = 0;
        // if there is record in DB in then consider that count (only parent products)
        var dbRowCount = <?php echo count($data->task->taskProducts) ?>;
        if (dbRowCount > 0) {
            rowCount = dbRowCount;
        }

        $(document).on('click', '.add_panel_button', function(){
            rowCount++;
            var templateHTML = $('.template_row').html();
            templateHTML = templateHTML.replace(/INDEX/g, rowCount);
            $('.add_template_area').append(templateHTML);
            $('#row_count').val(rowCount)
        })

        $(document).on('click', '.remove-btn', function(){
            $(this).closest('.templateRow').remove();
        })

        $(document).on('click', '.add-btn-row', function(){
            var templateHTML = $('.template_row_append').html();
            rowNumber = $(this).data('index');
            templateHTML = templateHTML.replace(/INDEX/g, rowNumber);
            $('.newRow_'+rowNumber).append(templateHTML);
        })

        $(document).on('keyup', '.price, .qty', function(){
            var price = $(this).closest('.templateRow').find('.price');
            var qty = $(this).closest('.templateRow').find('.qty');
            var total = $(this).closest('.templateRow').find('.total')
            if(qty.val() == ''){
                qty.val(0)
            }
            if(price.val() == ''){
                price.val(0)
            }
            rowTotal = parseFloat(price.val())*parseInt(qty.val());
            total.val(parseFloat(rowTotal));
        })

        $(document).on('change', '.product', function(){
            var productPrice = $(this).find(':selected').data('price');
            var productName = $(this).find(':selected').data('name');

            var name = $(this).closest('.templateRow').find('.name')
            var price = $(this).closest('.templateRow').find('.price')
            var qty = $(this).closest('.templateRow').find('.qty')
            var total = $(this).closest('.templateRow').find('.total')

            name.val(productName);
            rowTotal = parseFloat(productPrice)*parseInt(1);
            total.val(parseFloat(rowTotal));
            price.val(productPrice);
            qty.val(1);
        })


        $(document).on('click', '.deleteCaseMedia', function(){
            var url = $(this).data('href');
            console.log(url);
            $.ajax({
                type: 'get',
                url: url,
                data: '',
                success: function(response){
                    console.log(response);
                },
                error: function(error){
                    console.log(error);
                }
            })
        })




        // Show the initially selected form on page load
        var initialLocationId = $('input[name="services_location"]:checked').val();
        $('#form-location-' + initialLocationId).show();

        // Handle radio button change event
        $('input[name="services_location"]').change(function() {
            var locationId = $(this).val();

            // Hide all forms
            $('.service-location-form').hide();

            // Show the selected form
            $('#form-location-' + locationId).show();
        });
    });
</script>

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
