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
                        <h4 class="mb-sm-0 font-size-18">Take Back</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class=""><a href="javascript: void(0);">Case</a></li>
                                <li class="mx-1"><a href="javascript: void(0);"> > </a></li>
                                <li class="breadcrumb-item active">Take Back</li>
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
                            <h4 class="card-title">Take Back</h4>
                            <p class="card-title-desc">Put the given below information to get back your prodcut</p>
                            <form method="GET" action="{{ route('takeBackDetails') }}">
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
                        <div class="col-xl-12 col-sm-12">

                            @php
                                $productsTotal = 0;
                                $servicesTotal = 0;
                            @endphp

                            <div class="card">
                                <div class="card-body">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="text-center">
                                            @if ($data->task->status == 1)
                                                <h3>Great! Your invoice has been fully paid</h3>
                                            @elseif ($data->task->status == 2)
                                                <h3>Oops! Your invoice is not fully paid, please complete your payment.</h3>
                                            @elseif ($data->task->status == 3 || $data->task->status == 4)
                                                <h3>Oops! Your invoice is not paid, please complete your payment.</h3>
                                            @endif
                                            <div class="row">
                                                <div class="col-md-1 offset-md-4">
                                                    <span class="font-size-20">{!! getPayment('status', $data->task->status, 'badge') !!}</span>
                                                </div>
                                                <div class="col-md-2">
                                                    <h4><a href="{{ route('caseInvoice', $data->task->id) }}" target="_blank" class="badge bg-primary font-size-18"><i class="bx bx-receipt"></i> Invoice</a></h4>
                                                </div>
                                                @if ($data->task->status != 1)
                                                    <div class="col-md-2">
                                                        <a href="" class="badge bg-primary font-size-18"><i class="bx bx-loader-circle"></i> Refresh Payment</a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="tab-pane fade show active" id="v-pills-item" role="tabpanel" aria-labelledby="v-pills-item-tab">
                                            <div>
                                                <h4 class="card-title">Customer Details</h4>
                                                <p class="card-title-desc">Fill all information below</p>
                                                <form method="POST" action="{{ route('case.update', $data->task->id) }}" class="form" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group row mb-2">
                                                        <div class="col-md-6">
                                                            <label for="code" class="form-label">Case Number</label>
                                                            <input type="text" name="code" class="form-control" readonly id="code" value="{{ $data->task->code }}" placeholder="Enter Case Number">
                                                            @error('code')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="date" class="form-label">Date</label>
                                                            <input type="date" name="date" class="form-control" readonly id="date" value="{{ date('Y-m-d') }}" placeholder="Enter Date">
                                                            @error('date')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6 mt-2">
                                                            <label for="first_name" class="form-label">First Name</label>
                                                            <input type="text" name="first_name" class="form-control" readonly id="first_name" value="{{ $data->task->customer->first_name }}" placeholder="Enter First Name">
                                                            @error('first_name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6 mt-2">
                                                            <label for="last_name" class="form-label">Last Name</label>
                                                            <input type="text" name="last_name" class="form-control" readonly id="last_name" value="{{ $data->task->customer->last_name }}" placeholder="Enter Last Name">
                                                            @error('last_name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6 mt-2">
                                                            <label class="col-form-label">Location</label>
                                                            <select class="form-control select2" title="Item" name="item">
                                                                <option value="">Select Location </option>
                                                                @foreach (getService('location') as $key => $status)
                                                                    <option value="{{ $key }}" @if($key == $data->task->payment_status) selected @endif>{{ $status }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12 mt-2">
                                                            <input class="form-check-input" type="checkbox" value="1" name="is_servised" id="is_servised">
                                                            <label class="form-check-label" for="is_servised">
                                                                <h5>I confirmed that my order is servised</h5>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-12 mt-2">
                                                            <input class="form-check-input" type="checkbox" value="1" name="is_satisfied" id="is_satisfied">
                                                            <label class="form-check-label" for="is_satisfied">
                                                                <h5>I confirmed I inspected the item and its confirmed that I'm satisfied</h5>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <h4 class="card-title mt-5">Medias</h4>
                                                            <label for="uploadImage" class="custom-file-upload">
                                                                <span><i class="ti-cloud-up"></i> Pictures, files and videos of product</span>
                                                                <input type="file" name="files[]" id="uploadImage" class="form-control-file" multiple>
                                                            </label>
                                                            <div id="imagesBody"></div>
                                                        </div>
                                                        <div class="d-grid gap-2 mt-3">
                                                            <button type="submit" class="btn btn-primary btn-lg waves-effect waves-light">SUBMIT</button>
                                                        </div>
                                                    </div>
                                                </form>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
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
