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
                            <a class="nav-link" id="v-media-tab" data-bs-toggle="pill" href="#v-media" role="tab" aria-controls="v-media" aria-selected="false">
                                <i class= "fa fa-th-large d-block check-nav-icon mt-4 mb-2"></i>
                                <p class="fw-bold mb-4">Media</p>
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
                                                <h4 class="card-title">Item information</h4>
                                                <p class="card-title-desc">Fill all information below</p>
                                                <div class="form-group row mb-2">
                                                    <label class="col-md-2 col-form-label">Select Item</label>
                                                    <div class="col-md-12">
                                                        <select class="form-control select2" title="Item" name="item">
                                                            <option value="">Select Item </option>
                                                            @foreach ($data->items as $item)
                                                                <option value="{{ $item->id }}" {{ old('item') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
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
                                                        <input type="text" name="manufacturer" class="form-control" id="manufacturer" value="{{ old('manufacturer') }}" placeholder="Enter Manufacturer">
                                                        @error('manufacturer')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="model" class="form-label">Model</label>
                                                        <input type="text" name="model" class="form-control" id="model" value="{{ old('model') }}" placeholder="Enter Model">
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
                                                        <input type="text" name="year" class="form-control" id="year" value="{{ old('year') }}" placeholder="Enter Year">
                                                        @error('year')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="color" class="form-label">Color</label>
                                                        <input type="text" name="color" class="form-control" id="color" value="{{ old('color') }}" placeholder="Enter Color">
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
                                                        <textarea class="form-control" name="additional_info" id="additional_info" placeholder="Enter Additional Information">{{ old('additional_info') }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label for="problem_description" class="form-label">Description of Problem / Failure</label>
                                                    <div class="col-md-12">
                                                        <textarea class="form-control" name="problem_description" id="problem_description" placeholder="Enter Detailed Description of Problem / Failure">{{ old('problem_description') }}</textarea>
                                                        @error('problem_description')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <h4 class="card-title">Leaving Parts</h4>
                                                <p class="card-title-desc">The parts you want to leave</p>
                                                <div>
                                                    @foreach ($data->parts as $part)
                                                        <div class="form-check form-check-inline font-size-16 mt-1">
                                                            <input class="form-check-input" type="checkbox" value="{{ $part->id }}" name="parts[]" id="part-{{ $part->id }}" {{ in_array($part->id, old('parts', [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="part-{{ $part->id }}">
                                                                <h5>{{ $part->name }}</h5>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="mt-2">
                                                    <label for="extra-parts">More Leaving Parts</label>
                                                    <p class="card-title-desc font-size-10 mb-0">Each part should be comma (<code><b>,</b></code>) seprated </p>
                                                    <textarea name="extra-parts" id="extra-parts" class="input form-control">{{ old('extra-parts') }}</textarea><br>
                                                </div>
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
                                                <h4 class="card-title mt-2">Medias</h4>
                                                <label for="uploadImage" class="custom-file-upload">
                                                    <span><i class="ti-cloud-up"></i> Pictures, files and videos of product</span>
                                                    <input type="file" name="files[]" id="uploadImage" class="form-control-file" multiple>
                                                </label>
                                                <div id="imagesBody">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-services" role="tabpanel" aria-labelledby="v-services-tab">
                                            <div>
                                                <h4 class="card-title">Priority of Case</h4>
                                                <p class="card-title-desc">How fast you wants get back?</p>
                                                <div>
                                                    @foreach ($data->priorities as $priority)
                                                        <div class="form-check form-check-inline font-size-16">
                                                            <input class="form-check-input" type="radio" name="priority" value="{{$priority->id}}" id="priority-{{$priority->id}}" {{ old('priority') == $priority->id ? 'checked' : ($priority->id == 1 ? 'checked' : '') }}>
                                                            <label class="form-check-label font-size-13" for="priority-{{$priority->id}}">
                                                                {{ $priority->name }} - {{ number_format($priority->price, 0) }}({{ config('app.currency') }})
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <h4 class="card-title mt-5">Inspection and diagnostics</h4>
                                                <p class="card-title-desc">Do you want to avail professional diagniostic serves?</p>

                                                <div class="mb-4 row">
                                                    <div class="col-md-6">
                                                        <div class="form-check form-check-inline font-size-16">
                                                            <input class="form-check-input" type="radio" value="1" name="inspection" id="inspection"  {{ (old('inspection', '1') == '1' || old('inspection', '1') != '2')? 'checked' : '' }}>
                                                            <label class="form-check-label font-size-13" for="inspection">
                                                                <i class="fa fa-search-plus me-1 font-size-20 align-top"></i>
                                                                Inspection and diagnostics - <b class="font-size-16">{{ config('app.insp_diag_amount') }}({{ config('app.currency') }})</b>
                                                                {{-- <br><span class="text text-danger">{{ config('app.insp_diag_amount') }}({{ config('app.currency') }}) would extra add on</span> --}}
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-check form-check-inline font-size-16">
                                                            <input class="form-check-input" type="radio" value="2" name="inspection" id="withoutinspection2" {{ old('inspection', '1') == '2' ? 'checked' : '' }}>
                                                            <label class="form-check-label font-size-13" for="withoutinspection2">
                                                                <i class="fa fa-search-minus me-1 font-size-20 align-top"></i>
                                                                Without diagnostics - <b class="font-size-16">0({{ config('app.currency') }})</b>
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
                                                            <input class="form-check-input" type="checkbox" name="services[]" service-price="{{ $service->price }}" value="{{ $service->id }}" name="services[]" id="service-{{ $service->id }}" {{ in_array($service->id, old('services', [])) ? 'checked' : '' }} onchange="updateServiceTotal()">
                                                            <input class="form-check-input" type="hidden" name="serviceprices[]" value="{{ $service->price }}" name="serviceprices[]" id="serviceprices{{ $service->id }}">
                                                            <label class="form-check-label" for="service-{{ $service->id }}">
                                                                <h5>
                                                                    {{ $service->name }}
                                                                    {{-- config('app.currency')  --}}
                                                                    @if ($service->show_price == 1)
                                                                        <span class="font-size-14">
                                                                            <b>
                                                                                {{ number_format($service->price) . config('app.currency') }}
                                                                            </b>
                                                                        </span>
                                                                    @endif
                                                                    {{-- {!! $service->show_price == 1 ? '<span class="font-size-14"><b>' . number_format($service->price) .' </b></span>' : '' !!} --}}
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
                                                        <div class="mb-2 form-check form-check-inline font-size-16 hidden-services d-none">
                                                            <input class="form-check-input" type="checkbox" name="services[]" service-price="{{ $service->price }}" value="{{ $service->id }}" name="services[]" id="service-{{ $service->id }}" {{ in_array($service->id, old('services', [])) ? 'checked' : '' }} onchange="updateServiceTotal()">
                                                            <label class="form-check-label" for="service-{{ $service->id }}">
                                                                <h5>
                                                                    {{ $service->name }}

                                                                    @if ($service->show_price == 1)
                                                                        <span class="font-size-14">
                                                                            <b>
                                                                                {{ number_format($service->price) . config('app.currency') }}
                                                                            </b>
                                                                        </span>
                                                                    @endif
                                                                    {{-- {!! $service->show_price == 1 ? '<span class="font-size-14"><b>' . number_format($service->price) . '</b></span>' : '' !!} --}}
                                                                </h5>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                    @error('services')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                    <div class="mb-3 col-sm-12 offset-sm-0 col-md-4 offset-md-8">
                                                        <label>Selected Services Total ({{ config('app.currency') }})</label>
                                                        <input type="number" name="service_total" id="service-total" class="form-control" placeholder="Total Services Amount" value="{{ old('service_total') }}" readonly>
                                                    </div>
                                                    <div class="mb-3 col-sm-12 offset-sm-0 col-md-4 offset-md-8">
                                                        <label>Give your's if price is over ({{ config('app.currency') }})</label>
                                                        <input type="text" name="service_desired_total" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" class="form-control" placeholder="Your Desired Amount" value="{{ old('service_desired_total') }}">
                                                    </div>
                                                </div>
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
                                                            <input class="form-check-input service-location" type="radio" name="services_location" value="{{ $location->id }}" id="loc-{{ $location->id }}" {{ old('services_location') == $location->id ? 'checked' : ($location->id == 1 ? 'checked' : '') }}>
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
                                                                        <div>
                                                                            <label for="{{ $location->id .'-'. $field->name }}">{{ $field->title }}</label>
                                                                            @if ($field->type === 'textarea')
                                                                                <textarea class="form-control" id="{{ $location->id .'-'. $field->name }}" name="{{ $location->id .'-'. $field->name }}" placeholder="{{ $field->place_holder ?? 'Enter ' .$field->title }}">{{ old($location->id .'-'. $field->name) }}</textarea>
                                                                            @else
                                                                                <input type="{{ $field->type }}" class="form-control" id="{{ $location->id .'-'. $field->name }}" name="{{ $location->id .'-'. $field->name }}" placeholder="{{ $field->place_holder ?? 'Enter ' .$field->title }}" value="{{ old($location->id .'-'. $field->name) }}">
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="col-sm-12 px-3">
                                                    <label for="found_us">Where You Found Us?</label>
                                                    <select id="found_us" name="found_us" class="select2 form-control @error('found_us') is-invalid @enderror">
                                                        <option value="">Select Option </option>
                                                        @foreach (getPlatforms() as $platform)
                                                            <option value="{{ $platform->id }}" {{ old('found_us') == $platform->id ? 'selected' : '' }}>{{ $platform->name }}</option>
                                                        @endforeach
                                                        @error('found_us')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-confirmation" role="tabpanel" aria-labelledby="v-confirmation-tab">
                                            <div>

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
                                                                        <input class="form-check-input" type="checkbox" value="1" name="terms[{{ $sanitizedTitle }}][status]" id="term_{{ $sanitizedTitle }}" {{ $term->is_required == "1" ? 'required' : '' }} {{ old("terms[{$sanitizedTitle}][status]", '0') == '1' ? 'checked' : '' }}>
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

                                                            <div class="mb-2 form-check form-check-inline font-size-16">
                                                                <input class="form-check-input" type="checkbox" value="1" name="receive_newsletter" id="receive_newsletter" checked {{ old("terms[{$sanitizedTitle}][status]", '0') == '1' ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="receive_newsletter">
                                                                    <h5>I agree to receive newsletter</h5>
                                                                </label>
                                                            </div>


                                                            <!-- Additional Sections -->
                                                            @include('partials.signatiure-pad', ['data' => $data])
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
                        </form>
                    </div>
                </div>
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

