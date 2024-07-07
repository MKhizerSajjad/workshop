@extends('layouts.app')

@section('content')
<div class="account-pages my-3 pt-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12 col-xl-12">

                <div class="container-fluid">
                    <div class="checkout-tabs">
                        <div class="row">
                            <h1 class="text-center mb-4">Maintinance Booking</h1>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('save') }}" class="form" enctype="multipart/form-data">
                                            @csrf
                                            <div id="booking-form">
                                                <!--Select item -- START-->
                                                <h3>Select Item</h3>
                                                <section>
                                                    <h3 class="mt-3">Select item from below</h3>
                                                    <br>
                                                    <div class="form-check">
                                                        @foreach (\App\Models\Item::all() as $val)
                                                        <div class="form-check mt-3">
                                                            <input class="form-check-input" type="radio" name="item" id="item-{{ $val->id }}" value="{{ $val->id }}">
                                                            <label class="form-check-label" for="item-{{ $val->id }}">
                                                                <h5>{{ $val->name }}</h5>
                                                            </label>
                                                        </div>
                                                        @endforeach
                                                        <div class="form-check mt-3">
                                                            <input class="form-check-input" type="radio" name="item" id="item-other" value="none">
                                                            <label class="form-check-label" for="item-other">
                                                                <h5>Other</h5>
                                                            </label>
                                                            <div>
                                                            </div>
                                                </section>
                                                <!--Select item -- END-->

                                                <!--Item info -- START -->
                                                <h3>Item details</h3>
                                                <section>
                                                    <h3 class="mt-3">Enter item below</h3>
                                                    <br>

                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="manufacturer">Manufacturer</label>
                                                                <input type="text" class="form-control" name="manufacturer" placeholder="Enter Manufacturer">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="model">Model</label>
                                                                <input type="text" class="form-control" name="model" placeholder="Enter Model">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="year">Year</label>
                                                                <input type="text" class="form-control" name="year" placeholder="Enter year">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="color">Color</label>
                                                                <input type="text" class="form-control" name="color" placeholder="Enter Color">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label for="additional-info">Additional Information</label>
                                                            <input type="text" class="form-control" name="additional-info" placeholder="Enter Additional Info">
                                                        </div>
                                                    </div>

                                                </section>
                                                <!--Item info -- END -->

                                                <!--Description -- START -->
                                                <h3>Description</h3>
                                                <section>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <h3 class="mt-3">Description of problem /
                                                                failure</h3>
                                                            <br>
                                                            <textarea class="form-control" name="description" rows="6"></textarea>
                                                        </div>
                                                    </div>
                                                </section>
                                                <!--Description -- END -->

                                                <!--Parts -- START -->
                                                <h3>Parts</h3>
                                                <section>
                                                    <h3 class="mt-3">Do you leave more parts ?</h3>
                                                    <br>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="1" name="parts[]">
                                                        <label class="form-check-label" for="battery">
                                                            <h5>Battery</h5>
                                                        </label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="2" name="parts[]">
                                                        <label class="form-check-label" for="charger">
                                                            <h5>Charger</h5>
                                                        </label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="3" name="parts[]">
                                                        <label class="form-check-label" for="other-parts">
                                                            <h5>Other parts</h5>
                                                        </label>
                                                    </div>

                                                </section>
                                                <!--Parts -- START -->

                                                <!--Services -- START -->
                                                <h3>Services</h3>
                                                <section>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="1" name="service[]">
                                                        <label class="form-check-label" for="charger">
                                                            <h5>Inspection and diagnostics - 35EUR</h5>
                                                        </label>
                                                    </div>
                                                    @foreach (\App\Models\Service::where('prioritized', 1)->get() as $val)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="{{$val->id}}" name="service[]">
                                                        <label class="form-check-label" for="{{$val->name}}">
                                                            <h5>{{$val->name}} - €{{$val->price}}</h5>
                                                        </label>
                                                    </div>
                                                    @endforeach

                                                    <br>
                                                    <div class="d-flex gap-2 flex-wrap mb-3">
                                                        <button class="btn btn-primary collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                            More Services
                                                        </button>
                                                    </div>

                                                    <div class="collapse" id="collapseExample" style="">
                                                        <div class="card border shadow-none card-body text-muted mb-0">
                                                            @foreach (\App\Models\Service::where('prioritized', 2)->get() as $val)
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="{{$val->id}}" name="service[]">
                                                                <label class="form-check-label" for="{{$val->name}}">
                                                                    <h5>{{$val->name}} - €{{$val->price}}</h5>
                                                                </label>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                </section>
                                                <!--Services -- START -->

                                                <!--Uplaod  -- START -->
                                                <h3>Media</h3>
                                                <section>
                                                    <input name="files" type="file" multiple="multiple">
                                                    
                                                    {{-- <div>
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
                                                                                <img data-dz-thumbnail class="img-fluid rounded d-block" alt="Dropzone-Image">
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
                                                    </div> --}}
                                                </section>
                                                <!--Upload -- START -->

                                                <!--Priority  -- START -->
                                                <h3>Priority</h3>
                                                <section>
                                                    <h3 class="mt-3">Select Priority</h3>
                                                    <br>
                                                    @foreach (\App\Models\Priority::all() as $val)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" value="{{$val->id}}" name="priority">
                                                        <label class="form-check-label" for="battery">
                                                            <h5>{{$val->name}} (+ €{{$val->price}})</h5>
                                                        </label>
                                                    </div>
                                                    @endforeach

                                                </section>
                                                <!--Priority -- START -->

                                                <!--Location  -- START -->
                                                <h3>Location</h3>
                                                <section>
                                                    <div class="card">
                                                        <div class="card-body">

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
                                                                    <p class="mb-0">
                                                                        Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table.
                                                                    </p>
                                                                </div>
                                                            </div>



                                                        </div>
                                                    </div>
                                                </section>
                                                <!--Location -- START -->

                                                <!--Confirmation  -- START -->
                                                <h3>Confirmation</h3>
                                                <section>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="1" name="is_terms">
                                                        <label class="form-check-label" for="battery">
                                                            <h5>I read and agree with terms of service</h5>
                                                        </label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="1" name="is_service">
                                                        <label class="form-check-label" for="battery">
                                                            <h5>I read and agree with service pricing</h5>
                                                        </label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="1" name="is_newsletter">
                                                        <label class="form-check-label" for="battery">
                                                            <h5>I agree to receive newsletter</h5>
                                                        </label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="1" name="is_gdr">
                                                        <label class="form-check-label" for="battery">
                                                            <h5>I read with GDR</h5>
                                                        </label>
                                                    </div>

                                                    <div class="d-grid gap-2">
                                                        <button type="submit" class="btn btn-primary btn-lg waves-effect waves-light">SUBMIT</button>
                                        </form>
                                    </div>
                                    </section>
                                    <!--Confirmation -- START -->

                                </div>

                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
            </div>
        </div>

        <div class="text-center">
            <div>
                <p>
                    ©
                    <script>
                        document.write(new Date().getFullYear())

                    </script>
                    {{ config('app.name') }}.
                    Powered with
                    <i class="mdi mdi-heart text-danger"></i>
                    by The Tech Shelf
                </p>
            </div>
        </div>

    </div>
</div>
</div>
</div>
@endsection
