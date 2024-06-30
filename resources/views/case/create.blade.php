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
                                                <form>
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
                                                </form>
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
                                                    <input class="form-check-input" type="checkbox" value="battery">
                                                    <label class="form-check-label" for="battery">
                                                        <h5>Battery</h5>
                                                    </label>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="charger">
                                                    <label class="form-check-label" for="charger">
                                                        <h5>Charger</h5>
                                                    </label>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="other-parts">
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
                                                    <input class="form-check-input" type="checkbox" value="charger">
                                                    <label class="form-check-label" for="charger">
                                                        <h5>Inspection and diagnotics - 35EUR</h5>
                                                    </label>
                                                </div>
                                                <br>
                                                <div class="d-flex gap-2 flex-wrap mb-3">
                                                    <button class="btn btn-primary collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                        More Services
                                                    </button>
                                                </div>

                                                <div class="collapse" id="collapseExample" style="">
                                                    <div class="card border shadow-none card-body text-muted mb-0">
                                                        <h4>Please select from services below</h4>
                                                    </div>
                                                </div>

                                            </section>
                                            <!--Services -- START -->

                                            <!--Uplaod  -- START -->
                                            <h3>Media</h3>
                                            <section>
                                            
                                        <div>
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
                                        </div>
                                            </section>
                                            <!--Upload -- START -->

                                            <!--Priority  -- START -->
                                            <h3>Priority</h3>
                                            <section>
                                            </section>
                                            <!--Priority -- START -->

                                            <!--Location  -- START -->
                                            <h3>Location</h3>
                                            <section>
                                            </section>
                                            <!--Location -- START -->

                                            <!--Confirmation  -- START -->
                                            <h3>Confirmation</h3>
                                            <section>
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
