@extends('layouts.app')

@section('content')

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
                            {{-- <a class="nav-link" id="v-pills-shipping-tab" data-bs-toggle="pill" href="#v-pills-shipping" role="tab" aria-controls="v-pills-shipping" aria-selected="false">
                                <i class= "bx bxs-truck d-block check-nav-icon mt-4 mb-2"></i>
                                <p class="fw-bold mb-4">Shipping Info</p>
                            </a>
                            <a class="nav-link" id="v-pills-payment-tab" data-bs-toggle="pill" href="#v-pills-payment" role="tab" aria-controls="v-pills-payment" aria-selected="false">
                                <i class= "bx bx-money d-block check-nav-icon mt-4 mb-2"></i>
                                <p class="fw-bold mb-4">Payment Info</p>
                            </a>
                            <a class="nav-link" id="v-pills-confir-tab" data-bs-toggle="pill" href="#v-pills-confir" role="tab" aria-controls="v-pills-confir" aria-selected="false">
                                <i class= "bx bx-badge-check d-block check-nav-icon mt-4 mb-2"></i>
                                <p class="fw-bold mb-4">Confirmation</p>
                            </a> --}}
                        </div>
                    </div>
                    <div class="col-xl-10 col-sm-9">
                        <form method="POST" action="{{ route('bookingSave') }}" class="form" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="tab-content" id="v-pills-tabContent">
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
                                                            <textarea class="form-control" nmae="additional_info" id="additional_info" placeholder="Enter Additional Information"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-3">
                                                        <label for="problem_description" class="form-label">Description of Problem / Failure</label>
                                                        <div class="col-md-12">
                                                            <textarea class="form-control" nmae="problem_description" id="problem_description" placeholder="Enter Detailed Description of Problem / Failure"></textarea>
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
                                                <h4 class="card-title">Leaving PartsMedia</h4>
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
                                                <p class="card-title-desc">Pictures and videos of product</p>
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

                                                <section>
                                                    <div>
                                                        <h5 class="font-size-14 mb-3">Upload document file for a verification</h5>
                                                        <div class="dropzone">
                                                            <div class="fallback">
                                                                <input name="file" type="file" multiple="multiple">
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
                                                </section>


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
                                                            <input class="form-check-input" type="radio" name="inspection" id="inspection" checked>
                                                            <label class="form-check-label font-size-13" for="inspection">
                                                                <i class="fa fa-search-plus me-1 font-size-20 align-top"></i>
                                                                Inspection and diagnostics - <b class="font-size-16">35€</b>
                                                                <br><span class="text text-danger">35€ would extra add on</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-check form-check-inline font-size-16">
                                                            <input class="form-check-input" type="radio" name="inspection" id="withoutinspection2">
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
                                                    @foreach ($data->services as $service)
                                                        <div class="mb-2 form-check form-check-inline font-size-16 {{ $service->prioritized != 1 ? 'd-none' : '' }}">
                                                            <input class="form-check-input" type="checkbox" name="services[]" value="{{ $service->id }}" name="services[]" id="service-{{ $service->id }}">
                                                            <label class="form-check-label" for="service-{{ $service->id }}">
                                                                <h5>{{ $service->name }}</h5>
                                                            </label>
                                                        </div>
                                                    @endforeach

                                                    <div class="text-align-center mt-3">
                                                        <button type="button" id="showAllServices" class="btn btn-primary"><i class="bx bx-show"></i> Show More</button>
                                                    </div>
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
                                                {{-- <form> --}}
                                                    <h3 class="mt-3">Select Service Location</h3>
                                                            <br>
                                                            <!-- Nav tabs -->
                                                            <ul class="nav nav-pills nav-justified" role="tablist">
                                                                <li class="nav-item waves-effect waves-light" role="presentation">
                                                                    <a class="nav-link active" data-bs-toggle="tab" href="#home-1" role="tab" aria-selected="true">
                                                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                                        <span class="d-none d-sm-block">Deliver To Office</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item waves-effect waves-light" role="presentation">
                                                                    <a class="nav-link" data-bs-toggle="tab" href="#office-1" role="tab" aria-selected="false" tabindex="-1">
                                                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                                        <span class="d-none d-sm-block">I Will Send To Office</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item waves-effect waves-light" role="presentation">
                                                                    <a class="nav-link" data-bs-toggle="tab" href="#engineer-1" role="tab" aria-selected="false" tabindex="-1">
                                                                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                                                        <span class="d-none d-sm-block">Invite Engineer To My Home</span>
                                                                    </a>
                                                                </li>

                                                            </ul>

                                                            <div class="tab-content p-3 text-muted">
                                                                <div class="tab-pane active show" id="home-1" role="tabpanel">
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="first_name_home">First Name</label>
                                                                                <input type="text" class="form-control" id="first_name_home" name="first_name_home" placeholder="Enter first name">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="last_name_home">Last Name</label>
                                                                                <input type="text" class="form-control" id="last_name_home" name="last_name_home" placeholder="Enter last name">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="phone_number_home">Phone Number</label>
                                                                                <input type="text" class="form-control" id="phone_number_home" name="phone_number_home" placeholder="Enter phone number">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="email_home">Email</label>
                                                                                <input type="email" class="form-control" id="email_home" name="email_home" placeholder="Enter email">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="city_home">City</label>
                                                                                <input type="text" class="form-control" id="city_home" name="city_home" placeholder="Enter city">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="company_home">Company</label>
                                                                                <input type="text" class="form-control" id="company_home" name="company_home" placeholder="Enter company">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="address_home">Address</label>
                                                                                <input type="text" class="form-control" id="address_home" name="address_home" placeholder="Enter address">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane" id="office-1" role="tabpanel">
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="first_name_office">First Name</label>
                                                                                <input type="text" class="form-control" id="first_name_office" name="first_name_office" placeholder="Enter first name">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="last_name_office">Last Name</label>
                                                                                <input type="text" class="form-control" id="last_name_office" name="last_name_office" placeholder="Enter last name">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="phone_number_office">Phone Number</label>
                                                                                <input type="text" class="form-control" id="phone_number_office" name="phone_number_office" placeholder="Enter phone number">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="email_office">Email</label>
                                                                                <input type="email" class="form-control" id="email_office" name="email_office" placeholder="Enter email">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="city_office">City</label>
                                                                                <input type="text" class="form-control" id="city_office" name="city_office" placeholder="Enter city">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="company_office">Company</label>
                                                                                <input type="text" class="form-control" id="company_office" name="company_office" placeholder="Enter company">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="address_office">Address</label>
                                                                                <input type="text" class="form-control" id="address_office" name="address_office" placeholder="Enter address">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane" id="engineer-1" role="tabpanel">
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="first_name_home">First Name</label>
                                                                                <input type="text" class="form-control" id="first_name_home" name="first_name_home" placeholder="Enter first name">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="last_name_home">Last Name</label>
                                                                                <input type="text" class="form-control" id="last_name_home" name="last_name_home" placeholder="Enter last name">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="phone_number_home">Phone Number</label>
                                                                                <input type="text" class="form-control" id="phone_number_home" name="phone_number_home" placeholder="Enter phone number">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="email_home">Email</label>
                                                                                <input type="email" class="form-control" id="email_home" name="email_home" placeholder="Enter email">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="city_home">City</label>
                                                                                <input type="text" class="form-control" id="city_home" name="city_home" placeholder="Enter city">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="company_home">Company</label>
                                                                                <input type="text" class="form-control" id="company_home" name="company_home" placeholder="Enter company">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="address_home">Address</label>
                                                                                <input type="text" class="form-control" id="address_home" name="address_home" placeholder="Enter address">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                {{-- </form> --}}
                                            </div>

                                            <div class="d-grid gap-2">
                                                <button type="submit" class="btn btn-primary btn-lg waves-effect waves-light">SUBMIT</button>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-shipping" role="tabpanel" aria-labelledby="v-pills-shipping-tab">
                                            <div>
                                                <h4 class="card-title">Shipping information</h4>
                                                <p class="card-title-desc">Fill all information below</p>
                                                {{-- <form> --}}
                                                    <div class="form-group row mb-4">
                                                        <label for="billing-name" class="col-md-2 col-form-label">Name</label>
                                                        <div class="col-md-10">
                                                            <input type="text" class="form-control" id="billing-name" placeholder="Enter your name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-4">
                                                        <label for="billing-email-address" class="col-md-2 col-form-label">Email Address</label>
                                                        <div class="col-md-10">
                                                            <input type="email" class="form-control" id="billing-email-address" placeholder="Enter your email">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-4">
                                                        <label for="billing-phone" class="col-md-2 col-form-label">Phone</label>
                                                        <div class="col-md-10">
                                                            <input type="text" class="form-control" id="billing-phone" placeholder="Enter your Phone no.">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-4">
                                                        <label for="billing-address" class="col-md-2 col-form-label">Address</label>
                                                        <div class="col-md-10">
                                                            <textarea class="form-control" id="billing-address" rows="3" placeholder="Enter full address"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-4">
                                                        <label class="col-md-2 col-form-label">Country</label>
                                                        <div class="col-md-10">
                                                            <select class="form-control select2" title="Country">
                                                                <option value="0">Select Country</option>
                                                                <option value="AF">Afghanistan</option>
                                                                <option value="AL">Albania</option>
                                                                <option value="DZ">Algeria</option>
                                                                <option value="AS">American Samoa</option>
                                                                <option value="AD">Andorra</option>
                                                                <option value="AO">Angola</option>
                                                                <option value="AI">Anguilla</option>
                                                                <option value="AQ">Antarctica</option>
                                                                <option value="AR">Argentina</option>
                                                                <option value="AM">Armenia</option>
                                                                <option value="AW">Aruba</option>
                                                                <option value="AU">Australia</option>
                                                                <option value="AT">Austria</option>
                                                                <option value="AZ">Azerbaijan</option>
                                                                <option value="BS">Bahamas</option>
                                                                <option value="BH">Bahrain</option>
                                                                <option value="BD">Bangladesh</option>
                                                                <option value="BB">Barbados</option>
                                                                <option value="BY">Belarus</option>
                                                                <option value="BE">Belgium</option>
                                                                <option value="BZ">Belize</option>
                                                                <option value="BJ">Benin</option>
                                                                <option value="BM">Bermuda</option>
                                                                <option value="BT">Bhutan</option>
                                                                <option value="BO">Bolivia</option>
                                                                <option value="BW">Botswana</option>
                                                                <option value="BV">Bouvet Island</option>
                                                                <option value="BR">Brazil</option>
                                                                <option value="BN">Brunei Darussalam</option>
                                                                <option value="BG">Bulgaria</option>
                                                                <option value="BF">Burkina Faso</option>
                                                                <option value="BI">Burundi</option>
                                                                <option value="KH">Cambodia</option>
                                                                <option value="CM">Cameroon</option>
                                                                <option value="CA">Canada</option>
                                                                <option value="CV">Cape Verde</option>
                                                                <option value="KY">Cayman Islands</option>
                                                                <option value="CF">Central African Republic</option>
                                                                <option value="TD">Chad</option>
                                                                <option value="CL">Chile</option>
                                                                <option value="CN">China</option>
                                                                <option value="CX">Christmas Island</option>
                                                                <option value="CC">Cocos (Keeling) Islands</option>
                                                                <option value="CO">Colombia</option>
                                                                <option value="KM">Comoros</option>
                                                                <option value="CG">Congo</option>
                                                                <option value="CK">Cook Islands</option>
                                                                <option value="CR">Costa Rica</option>
                                                                <option value="CI">Cote d'Ivoire</option>
                                                                <option value="HR">Croatia (Hrvatska)</option>
                                                                <option value="CU">Cuba</option>
                                                                <option value="CY">Cyprus</option>
                                                                <option value="CZ">Czech Republic</option>
                                                                <option value="DK">Denmark</option>
                                                                <option value="DJ">Djibouti</option>
                                                                <option value="DM">Dominica</option>
                                                                <option value="DO">Dominican Republic</option>
                                                                <option value="EC">Ecuador</option>
                                                                <option value="EG">Egypt</option>
                                                                <option value="SV">El Salvador</option>
                                                                <option value="GQ">Equatorial Guinea</option>
                                                                <option value="ER">Eritrea</option>
                                                                <option value="EE">Estonia</option>
                                                                <option value="ET">Ethiopia</option>
                                                                <option value="FK">Falkland Islands (Malvinas)</option>
                                                                <option value="FO">Faroe Islands</option>
                                                                <option value="FJ">Fiji</option>
                                                                <option value="FI">Finland</option>
                                                                <option value="FR">France</option>
                                                                <option value="GF">French Guiana</option>
                                                                <option value="PF">French Polynesia</option>
                                                                <option value="GA">Gabon</option>
                                                                <option value="GM">Gambia</option>
                                                                <option value="GE">Georgia</option>
                                                                <option value="DE">Germany</option>
                                                                <option value="GH">Ghana</option>
                                                                <option value="GI">Gibraltar</option>
                                                                <option value="GR">Greece</option>
                                                                <option value="GL">Greenland</option>
                                                                <option value="GD">Grenada</option>
                                                                <option value="GP">Guadeloupe</option>
                                                                <option value="GU">Guam</option>
                                                                <option value="GT">Guatemala</option>
                                                                <option value="GN">Guinea</option>
                                                                <option value="GW">Guinea-Bissau</option>
                                                                <option value="GY">Guyana</option>
                                                                <option value="HT">Haiti</option>
                                                                <option value="HN">Honduras</option>
                                                                <option value="HK">Hong Kong</option>
                                                                <option value="HU">Hungary</option>
                                                                <option value="IS">Iceland</option>
                                                                <option value="IN">India</option>
                                                                <option value="ID">Indonesia</option>
                                                                <option value="IQ">Iraq</option>
                                                                <option value="IE">Ireland</option>
                                                                <option value="IL">Israel</option>
                                                                <option value="IT">Italy</option>
                                                                <option value="JM">Jamaica</option>
                                                                <option value="JP">Japan</option>
                                                                <option value="JO">Jordan</option>
                                                                <option value="KZ">Kazakhstan</option>
                                                                <option value="KE">Kenya</option>
                                                                <option value="KI">Kiribati</option>
                                                                <option value="KR">Korea, Republic of</option>
                                                                <option value="KW">Kuwait</option>
                                                                <option value="KG">Kyrgyzstan</option>
                                                                <option value="LV">Latvia</option>
                                                                <option value="LB">Lebanon</option>
                                                                <option value="LS">Lesotho</option>
                                                                <option value="LR">Liberia</option>
                                                                <option value="LY">Libyan Arab Jamahiriya</option>
                                                                <option value="LI">Liechtenstein</option>
                                                                <option value="LT">Lithuania</option>
                                                                <option value="LU">Luxembourg</option>
                                                                <option value="MO">Macau</option>
                                                                <option value="MG">Madagascar</option>
                                                                <option value="MW">Malawi</option>
                                                                <option value="MY">Malaysia</option>
                                                                <option value="MV">Maldives</option>
                                                                <option value="ML">Mali</option>
                                                                <option value="MT">Malta</option>
                                                                <option value="MH">Marshall Islands</option>
                                                                <option value="MQ">Martinique</option>
                                                                <option value="MR">Mauritania</option>
                                                                <option value="MU">Mauritius</option>
                                                                <option value="YT">Mayotte</option>
                                                                <option value="MX">Mexico</option>
                                                                <option value="MD">Moldova, Republic of</option>
                                                                <option value="MC">Monaco</option>
                                                                <option value="MN">Mongolia</option>
                                                                <option value="MS">Montserrat</option>
                                                                <option value="MA">Morocco</option>
                                                                <option value="MZ">Mozambique</option>
                                                                <option value="MM">Myanmar</option>
                                                                <option value="NA">Namibia</option>
                                                                <option value="NR">Nauru</option>
                                                                <option value="NP">Nepal</option>
                                                                <option value="NL">Netherlands</option>
                                                                <option value="AN">Netherlands Antilles</option>
                                                                <option value="NC">New Caledonia</option>
                                                                <option value="NZ">New Zealand</option>
                                                                <option value="NI">Nicaragua</option>
                                                                <option value="NE">Niger</option>
                                                                <option value="NG">Nigeria</option>
                                                                <option value="NU">Niue</option>
                                                                <option value="NF">Norfolk Island</option>
                                                                <option value="MP">Northern Mariana Islands</option>
                                                                <option value="NO">Norway</option>
                                                                <option value="OM">Oman</option>
                                                                <option value="PW">Palau</option>
                                                                <option value="PA">Panama</option>
                                                                <option value="PG">Papua New Guinea</option>
                                                                <option value="PY">Paraguay</option>
                                                                <option value="PE">Peru</option>
                                                                <option value="PH">Philippines</option>
                                                                <option value="PN">Pitcairn</option>
                                                                <option value="PL">Poland</option>
                                                                <option value="PT">Portugal</option>
                                                                <option value="PR">Puerto Rico</option>
                                                                <option value="QA">Qatar</option>
                                                                <option value="RE">Reunion</option>
                                                                <option value="RO">Romania</option>
                                                                <option value="RU">Russian Federation</option>
                                                                <option value="RW">Rwanda</option>
                                                                <option value="KN">Saint Kitts and Nevis</option>
                                                                <option value="LC">Saint LUCIA</option>
                                                                <option value="WS">Samoa</option>
                                                                <option value="SM">San Marino</option>
                                                                <option value="ST">Sao Tome and Principe</option>
                                                                <option value="SA">Saudi Arabia</option>
                                                                <option value="SN">Senegal</option>
                                                                <option value="SC">Seychelles</option>
                                                                <option value="SL">Sierra Leone</option>
                                                                <option value="SG">Singapore</option>
                                                                <option value="SK">Slovakia (Slovak Republic)</option>
                                                                <option value="SI">Slovenia</option>
                                                                <option value="SB">Solomon Islands</option>
                                                                <option value="SO">Somalia</option>
                                                                <option value="ZA">South Africa</option>
                                                                <option value="ES">Spain</option>
                                                                <option value="LK">Sri Lanka</option>
                                                                <option value="SH">St. Helena</option>
                                                                <option value="PM">St. Pierre and Miquelon</option>
                                                                <option value="SD">Sudan</option>
                                                                <option value="SR">Suriname</option>
                                                                <option value="SZ">Swaziland</option>
                                                                <option value="SE">Sweden</option>
                                                                <option value="CH">Switzerland</option>
                                                                <option value="SY">Syrian Arab Republic</option>
                                                                <option value="TW">Taiwan, Province of China</option>
                                                                <option value="TJ">Tajikistan</option>
                                                                <option value="TZ">Tanzania, United Republic of</option>
                                                                <option value="TH">Thailand</option>
                                                                <option value="TG">Togo</option>
                                                                <option value="TK">Tokelau</option>
                                                                <option value="TO">Tonga</option>
                                                                <option value="TT">Trinidad and Tobago</option>
                                                                <option value="TN">Tunisia</option>
                                                                <option value="TR">Turkey</option>
                                                                <option value="TM">Turkmenistan</option>
                                                                <option value="TC">Turks and Caicos Islands</option>
                                                                <option value="TV">Tuvalu</option>
                                                                <option value="UG">Uganda</option>
                                                                <option value="UA">Ukraine</option>
                                                                <option value="AE">United Arab Emirates</option>
                                                                <option value="GB">United Kingdom</option>
                                                                <option value="US">United States</option>
                                                                <option value="UY">Uruguay</option>
                                                                <option value="UZ">Uzbekistan</option>
                                                                <option value="VU">Vanuatu</option>
                                                                <option value="VE">Venezuela</option>
                                                                <option value="VN">Viet Nam</option>
                                                                <option value="VG">Virgin Islands (British)</option>
                                                                <option value="VI">Virgin Islands (U.S.)</option>
                                                                <option value="WF">Wallis and Futuna Islands</option>
                                                                <option value="EH">Western Sahara</option>
                                                                <option value="YE">Yemen</option>
                                                                <option value="ZM">Zambia</option>
                                                                <option value="ZW">Zimbabwe</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row mb-4">
                                                        <label class="col-md-2 col-form-label">States</label>
                                                        <div class="col-md-10">
                                                            <select class="form-control select2" title="Country">
                                                                <option value="0">Select States</option>
                                                                <option value="AL">Alabama</option>
                                                                <option value="AK">Alaska</option>
                                                                <option value="AZ">Arizona</option>
                                                                <option value="AR">Arkansas</option>
                                                                <option value="CA">California</option>
                                                                <option value="CO">Colorado</option>
                                                                <option value="DE">Delaware</option>
                                                                <option value="Fl"> Florida</option>
                                                                <option value="GA">Georgia</option>
                                                                <option value="HI">Hawaii</option>
                                                                <option value="MT">Montana</option>
                                                                <option value="NV">Nevada</option>
                                                                <option value="NM">New Mexico</option>
                                                                <option value="NY">New York</option>
                                                                <option value="NC">North Dakota</option>
                                                                <option value="TX">Texas</option>
                                                                <option value="VA">Virginia</option>
                                                                <option value="WI">Wisconsin</option>
                                                                <option value="WY">Wyoming</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-0">
                                                        <label for="example-textarea" class="col-md-2 col-form-label">Order Notes:</label>
                                                        <div class="col-md-10">
                                                            <textarea class="form-control" id="example-textarea" rows="3" placeholder="Write some note.."></textarea>
                                                        </div>
                                                    </div>

                                                {{-- </form> --}}
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-payment" role="tabpanel" aria-labelledby="v-pills-payment-tab">
                                            <div>
                                                <h4 class="card-title">Payment information</h4>
                                                <p class="card-title-desc">Fill all information below</p>

                                                <div>
                                                    <div class="form-check form-check-inline font-size-16">
                                                        <input class="form-check-input" type="radio" name="paymentoptionsRadio" id="paymentoptionsRadio1" checked>
                                                        <label class="form-check-label font-size-13" for="paymentoptionsRadio1"><i class="fab fa-cc-mastercard me-1 font-size-20 align-top"></i> Credit / Debit Card</label>
                                                    </div>
                                                    <div class="form-check form-check-inline font-size-16">
                                                        <input class="form-check-input" type="radio" name="paymentoptionsRadio" id="paymentoptionsRadio2">
                                                        <label class="form-check-label font-size-13" for="paymentoptionsRadio2"><i class="fab fa-cc-paypal me-1 font-size-20 align-top"></i> Paypal</label>
                                                    </div>
                                                    <div class="form-check form-check-inline font-size-16">
                                                        <input class="form-check-input" type="radio" name="paymentoptionsRadio" id="paymentoptionsRadio3">
                                                        <label class="form-check-label font-size-13" for="paymentoptionsRadio3"><i class="far fa-money-bill-alt me-1 font-size-20 align-top"></i> Cash on Delivery</label>
                                                    </div>
                                                </div>

                                                <h5 class="mt-5 mb-3 font-size-15">For card Payment</h5>
                                                <div class="p-4 border">
                                                    {{-- <form> --}}
                                                        <div class="form-group mb-0">
                                                            <label for="cardnumberInput">Card Number</label>
                                                            <input type="text" class="form-control" id="cardnumberInput" placeholder="0000 0000 0000 0000">
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group mt-4 mb-0">
                                                                    <label for="cardnameInput">Name on card</label>
                                                                    <input type="text" class="form-control" id="cardnameInput" placeholder="Name on Card">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="form-group mt-4 mb-0">
                                                                    <label for="expirydateInput">Expiry date</label>
                                                                    <input type="text" class="form-control" id="expirydateInput" placeholder="MM/YY">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="form-group mt-4 mb-0">
                                                                    <label for="cvvcodeInput">CVV Code</label>
                                                                    <input type="text" class="form-control" id="cvvcodeInput" placeholder="Enter CVV Code">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    {{-- </form> --}}
                                                </div>
                                                </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-confir" role="tabpanel" aria-labelledby="v-pills-confir-tab">
                                            <div class="card shadow-none border mb-0">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-4">Order Summary</h4>

                                                    <div class="table-responsive">
                                                        <table class="table align-middle mb-0 table-nowrap">
                                                            <thead class="table-light">
                                                            <tr>
                                                                <th scope="col">Product</th>
                                                                <th scope="col">Product Desc</th>
                                                                <th scope="col">Price</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <th scope="row"><img src="assets/images/product/img-1.png" alt="product-img" title="product-img" class="avatar-md"></th>
                                                                <td>
                                                                    <h5 class="font-size-14 text-truncate"><a href="ecommerce-product-detail.html" class="text-dark">Half sleeve T-shirt  (64GB) </a></h5>
                                                                    <p class="text-muted mb-0">$ 450 x 1</p>
                                                                </td>
                                                                <td>$ 450</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row"><img src="assets/images/product/img-7.png" alt="product-img" title="product-img" class="avatar-md"></th>
                                                                <td>
                                                                    <h5 class="font-size-14 text-truncate"><a href="ecommerce-product-detail.html" class="text-dark">Wireless Headphone </a></h5>
                                                                    <p class="text-muted mb-0">$ 225 x 1</p>
                                                                </td>
                                                                <td>$ 225</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <h6 class="m-0 text-end">Sub Total:</h6>
                                                                </td>
                                                                <td>
                                                                    $ 675
                                                                </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="3">
                                                                        <div class="bg-primary-subtle p-3 rounded">
                                                                            <h5 class="font-size-14 text-primary mb-0"><i class="fas fa-shipping-fast me-2"></i> Shipping <span class="float-end">Free</span></h5>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2">
                                                                        <h6 class="m-0 text-end">Total:</h6>
                                                                    </td>
                                                                    <td>
                                                                        $ 675
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
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


<script>
    // document.addEventListener('DOMContentLoaded', function() {
    //     const showAllButton = document.getElementById('showAllServices');
    //     const allServices = document.querySelectorAll('.form-check-inline');

    //     showAllButton.addEventListener('click', function() {
    //         allServices.forEach(service => {
    //             service.style.display = 'block';
    //         });
    //         showAllButton.style.display = 'none'; // Optionally hide the button after showing all services
    //     });
    // });

    document.addEventListener('DOMContentLoaded', function() {
        const showAllButton = document.getElementById('showAllServices');
        const allServices = document.querySelectorAll('.form-check-inline');

        showAllButton.addEventListener('click', function() {
            allServices.forEach(service => {
                service.classList.remove('d-none');
            });
            showAllButton.style.display = 'none'; // Optionally hide the button after showing all services
        });
    });
</script>
