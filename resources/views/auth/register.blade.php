@extends('layouts.app')

@section('content')
<div class="account-pages my-3 pt-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12 col-xl-12">

                <div class="container-fluid">
                    <div class="checkout-tabs">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Basic Wizard</h4>

                                        <div id="basic-example">
                                            <!--Select item -- START-->
                                            <h3>Select Item</h3>
                                            <section>
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


                                            <!-- Company Document -->
                                            <h3>Item Information</h3>
                                            <section>
                                                <form>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="manufacturer">Manufacturer</label>
                                                                <input type="text" class="form-control" id="manufacturer" placeholder="Enter Manufacturer">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="model">Model</label>
                                                                <input type="text" class="form-control" id="model" placeholder="Enter Model">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="year">Year</label>
                                                                <input type="text" class="form-control" id="year" placeholder="Enter year">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="color">Color</label>
                                                                <input type="text" class="form-control" id="color" placeholder="Enter Color">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label for="additional-info">Additional Information</label>
                                                            <input type="text" class="form-control" id="additional-info" placeholder="Enter Additional Info">
                                                        </div>
                                                    </div>
                                                </form>
                                            </section>

                                            <!-- Bank Details -->
                                            <h3>Description</h3>
                                            <section>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label for="description">Description of problem / failure</label>
                                                        <textarea class="form-control" id="description" rows="6"></textarea>
                                                    </div>
                                                </div>
                                            </section>

                                            <!-- Confirm Details -->
                                            <h3>Parts</h3>
                                            <section>
                                             
                                            </section>
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
                        <p>Already have an account ? <a href="{{ route('login') }}" class="fw-medium text-primary"> Login</a> </p>
                        <p>© <script>
                                document.write(new Date().getFullYear())

                            </script> {{ config('app.name') }}. Powered with <i class="mdi mdi-heart text-danger"></i> by The Tech Shelf</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
