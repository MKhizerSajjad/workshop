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
                        <h4 class="mb-sm-0 font-size-18">Booking Form</h4>
                    </div>
                </div>
            </div>
            <div class="checkout-tabs">
                <div class="row">
                    <div class="col-xl-2 col-sm-3">
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
                    <div class="col-xl-10 col-sm-9">

                        <form method="POST" action="{{ route('bookingSave') }}" class="form" enctype="multipart/form-data">
                            @csrf
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
                                                <h4 class="card-title">Itme information</h4>
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
                                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                                                            <input type="text" name="manufacturer" class="form-control" id="manufacturer" placeholder="Enter Manufacturer">
                                                            @error('manufacturer')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="model" class="form-label">Model</label>
                                                            <input type="text" name="model" class="form-control" id="model" placeholder="Enter Model">
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
                                                            <input type="text" name="year" class="form-control" id="year" placeholder="Enter Year">
                                                            @error('year')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="color" class="form-label">Color</label>
                                                            <input type="text" name="color" class="form-control" id="color" placeholder="Enter Color">
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
                                                            <textarea class="form-control" name="additional_info" id="additional_info" placeholder="Enter Additional Information"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-3">
                                                        <label for="problem_description" class="form-label">Description of Problem / Failure</label>
                                                        <div class="col-md-12">
                                                            <textarea class="form-control" name="problem_description" id="problem_description" placeholder="Enter Detailed Description of Problem / Failure"></textarea>
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
                                                        <div class="form-check form-check-inline font-size-16">
                                                            <input class="form-check-input" type="checkbox" value="{{ $part->id }}" name="parts[]" id="part-{{ $part->id }}">
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
                                                <h4 class="card-title">Priority of Case</h4>
                                                <p class="card-title-desc">How fast you wants get back?</p>
                                                {{-- <form> --}}

                                                <div>
                                                    @foreach ($data->priorities as $priority)
                                                        <div class="form-check form-check-inline font-size-16">
                                                            <input class="form-check-input" type="radio" name="priority" value="{{$priority->id}}" id="priority-{{$priority->id}}" {{ $priority->id == 1 ? 'checked' : '' }}>
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

                                                <div class="mb-4 row">
                                                    <div class="col-md-6">
                                                        <div class="form-check form-check-inline font-size-16">
                                                            <input class="form-check-input" type="radio" value="1" name="inspection" id="inspection" checked>
                                                            <label class="form-check-label font-size-13" for="inspection">
                                                                <i class="fa fa-search-plus me-1 font-size-20 align-top"></i>
                                                                Inspection and diagnostics - <b class="font-size-16">35€</b>
                                                                <br><span class="text text-danger">35€ would extra add on</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-check form-check-inline font-size-16">
                                                            <input class="form-check-input" type="radio" value="2" name="inspection" id="withoutinspection2">
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
                                                        <div class="mb-2 form-check form-check-inline font-size-16">
                                                            <input class="form-check-input" type="checkbox" name="services[]" value="{{ $service->id }}" name="services[]" id="service-{{ $service->id }}">
                                                            <label class="form-check-label" for="service-{{ $service->id }}">
                                                                <h5>
                                                                    {{ $service->name }}
                                                                    {!! $service->show_price == 1 ? '<span class="font-size-14"><b>' . number_format($service->price) . ' €</b></span>' : '' !!}
                                                                </h5>
                                                            </label>
                                                        </div>
                                                    @endforeach

                                                    <div class="text-align-center mt-3 mb-3">
                                                        <h3 type="button" id="showAllServices" class="btn btn-primary show-more"><i class="bx bx-show"></i> Show More</button>
                                                    </div>

                                                    @foreach ($data->services->where('status', 2) as $service)
                                                        <div class="mb-2 form-check form-check-inline font-size-16 hidden-services d-none">
                                                            <input class="form-check-input" type="checkbox" name="services[]" value="{{ $service->id }}" name="services[]" id="service-{{ $service->id }}">
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
                                                </div>

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
                                                        <input class="form-check-input service-location" type="radio" name="services_location" value="{{ $location->id }}" id="loc-{{ $location->id }}" {{ $location->id == 1 ? 'checked' : '' }}>
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
                                                                        <textarea class="form-control" id="{{ $location->id .'-'. $field->name }}" name="{{ $location->id .'-'. $field->name }}" placeholder="{{ $field->place_holder ?? 'Enter ' .$field->title }}"></textarea>
                                                                        @else
                                                                        <input type="{{ $field->type }}" class="form-control" id="{{ $location->id .'-'. $field->name }}" name="{{ $location->id .'-'. $field->name }}" placeholder="{{ $field->place_holder ?? 'Enter ' .$field->title }}">
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-confirmation" role="tabpanel" aria-labelledby="v-confirmation-tab">
                                            <div>

                                                {{-- @foreach($data->serviceLocations as $serviceLocation)
                                                    <div class="mb-2 form-check form-check-inline font-size-16">
                                                        <input class="form-check-input" type="radio" id="location_{{ $serviceLocation->id }}" name="services_location" value="{{ $serviceLocation->id }}" {{ $loop->first ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="location_{{ $serviceLocation->id }}">
                                                            <h5>{{ $serviceLocation->title }}</h5>
                                                        </label>
                                                    </div>
                                                @endforeach --}}


                                                <div class="tab-content p-3 text-muted">
                                                    <div class="tab-pane active show" id="home-1" role="tabpanel">
                                                        <div class="row">
                                                            @if (!empty($data->terms))
                                                                @foreach (json_decode($data->terms) as $term)
                                                                    @php
                                                                        // Sanitize the title to be a valid HTML attribute value
                                                                        $sanitizedTitle = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $term->title);
                                                                    @endphp
                                                                    <div class="mb-2 form-check form-check-inline font-size-16">
                                                                        {{-- <input class="form-check-input" type="checkbox" value="1" name="term_{{$sanitizedTitle}}" id="term_{{$sanitizedTitle}}"> --}}
                                                                        <input type="hidden" name="terms[{{ $sanitizedTitle }}][status]" value="0">
                                                                        <input type="hidden" name="terms[{{ $sanitizedTitle }}][link]" value="{{ $term->link }}">
                                                                        <input class="form-check-input" type="checkbox" value="1" name="terms[{{ $sanitizedTitle }}][status]" id="term_{{ $sanitizedTitle }}" {{ $term->is_required == "1" ? 'required' : '' }}>
                                                                        <label class="form-check-label" for="term_{{$sanitizedTitle}}">
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
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-grid gap-2">
                                                <button type="submit" class="btn btn-primary btn-lg waves-effect waves-light">SUBMIT</button>
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
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
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

    function handleLocationChange(radio) {
        // Get the selected value
        // var locationId = radio.value;

        // Perform actions based on the selected locationId
        alert("Selected location ID:", radio);

        // You can add more JavaScript logic here as needed
    }

    function showFieldsConfiguration(serviceLocationId) {
        // Get the selected service location object from PHP data
        let selectedServiceLocation = {!! json_encode($data->serviceLocations) !!}.find(location => location.id === serviceLocationId);

        if (selectedServiceLocation) {
            renderInputFields(selectedServiceLocation.fields);
        }
    }

    function renderInputFields(fields) {
        // alert(fields);
        // let fields = [
        //     { type: 'text', name: 'fieldName1' },
        //     { type: 'textarea', name: 'fieldName2' },
        //     // Add more fields as needed
        // ];


        let fieldsContainer = document.getElementById('fields-container');
        fieldsContainer.innerHTML = ''; // Clear previous content
        fields = JSON.parse(fieldsDataFromBackend);
        // fields = JSON.stringify(fields);
        alert(typeof(fields));
        if (Array.isArray(fields)) {
            fields.forEach(field => {
                let inputField;

                if (field.type === 'text') {
                    inputField = document.createElement('input');
                    inputField.type = 'text';
                    inputField.name = field.name;
                    // Add other attributes as needed
                } else if (field.type === 'textarea') {
                    inputField = document.createElement('textarea');
                    inputField.name = field.name;
                    // Add other attributes as needed
                }

                // Check if inputField is defined before appending
                if (inputField) {
                    alert('adadad');
                    fieldsContainer.appendChild(inputField);
                } else {
                    alert('not array');
                    console.log(`No inputField created for field type: ${field.type}`);
                }
            });
        } else {
            console.error('fields is not an array or is empty.');
        }
    }

    $(document).ready(function() {
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

