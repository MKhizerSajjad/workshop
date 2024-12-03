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

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-border-left alert-dismissible fade show auto-colse-3" role="alert">
                        <i class="ri-check-double-line me-3 align-middle fs-16"></i><strong>Success! </strong>
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <form method="POST" action="{{ route('case.update', $data->task->id) }}" class="form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        {{-- <div class="col-xl-2 col-sm-2">
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
                        </div> --}}
                        <div class="col-xl-9 col-sm-9">
                            {{-- <form method="POST" action="{{ route('case.update', $data->task->id) }}" class="form" enctype="multipart/form-data">
                                @csrf
                                @method('PUT') --}}

                                <div class="card">
                                    <div class="card-body">
                                        <div class="tab-content" id="v-pills-tabContent">
                                            <div class="col-md-12">

                                                <div class="row">
                                                    <div class="col-md-6 border-end border-dark">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <h4 class="card-title mb-0">Item information</h4>
                                                                {{-- <p class="card-title-desc mb-0">Fill all information below</p> --}}
                                                            </div>
                                                            <div class="col-md-6 text-end">
                                                                {{-- <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#itemInfo" aria-expanded="false" aria-controls="itemInfo">
                                                                    <i class="fa fa-chevron-down"></i>
                                                                </button> --}}
                                                                <!-- Item information Modal Trigger Button (optional) -->
                                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#itemDetailsModal">
                                                                    <i class="fa fa-pen"></i>
                                                                </button>
                                                            </div>

                                                            <div class="container" id="itemInfo"> <!-- collapse -->
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <p><strong>Item: </strong><span class="text-muted">{{ $data->task->item->name ?? 'N/A' }}</span></p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <p><strong>Manufacturer: </strong><span class="text-muted">{{ $data->task->manufacturer ?? 'N/A' }}</span></p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <p><strong>Model: </strong><span class="text-muted">{{ $data->task->model ?? 'N/A' }}</span></p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <p><strong>Year: </strong><span class="text-muted">{{ $data->task->year ?? 'N/A' }}</span></p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <p><strong>Color: </strong><span class="text-muted">{{ $data->task->color ?? 'N/A' }}</span></p>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <p><strong>Additional Information: <br> </strong><span class="text-muted">{{ $data->task->additional_info ?? 'N/A' }}</span></p>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <p><strong>Description of Problem / Failure: <br> </strong><span class="text-muted">{{ $data->task->problem_description ?? 'N/A' }}</span></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <h4 class="card-title">Customer Information</h4>
                                                                {{-- <p class="card-title-desc">Fill all information below </p> --}}
                                                            </div>
                                                            <div class="col-md-6 text-end">
                                                                {{-- <button class="btn btn-primary mb-1" type="button" data-bs-toggle="collapse" data-bs-target="#serviceLocation" aria-expanded="false" aria-controls="serviceLocation">
                                                                    <i class="fa fa-chevron-down"></i>
                                                                </button> --}}
                                                                <!-- Modal Trigger Button (optional) -->
                                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#serviceLocationModal">
                                                                    <i class="fa fa-pen"></i>
                                                                </button>
                                                            </div>

                                                            <div class="container" id="serviceLocation"> <!-- collapse -->
                                                                @foreach ($data->serviceLocations as $location)
                                                                    @if ($location->id == $data->task->services_location)
                                                                        <div class="row">
                                                                            @foreach (json_decode($location->fields) as $field)
                                                                                <div class="col-lg-{{ $field->type === 'textarea' ? '12' : '6' }} ">
                                                                                    <p>
                                                                                        <strong>{{ $field->title }}:</strong>
                                                                                        <span class="text-muted">
                                                                                            {{ $data->task->customer[$field->name] ?? 'N/A' }}
                                                                                        </span>
                                                                                    </p>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Service Location Modal -->
                                                <div class="modal fade" id="serviceLocationModal" tabindex="-1" aria-labelledby="serviceLocationModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="serviceLocationModalLabel">Select Service Location</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                {{-- <form method="POST" action="{{ route('case.comment', $data->task->id) }}" enctype="multipart/form-data"> --}}
                                                                    <!-- Service Location Selection -->
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

                                                                    <!-- Dynamic Forms for Each Location -->
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
                                                                {{-- </form> --}}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Item information Modal -->
                                                <div class="modal fade" id="itemDetailsModal" tabindex="-1" aria-labelledby="itemDetailsModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="itemDetailsModalLabel">Edit Item Details</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{-- <form method="POST" action="{{ route('case.comment', $data->task->id) }}" enctype="multipart/form-data"> --}}
                                                                <!-- Item Selection -->
                                                                <div class="form-group row mb-2">
                                                                    <label class="col-md-2 col-form-label">Select Item</label>
                                                                    <div class="col-md-12">
                                                                    <select class="form-control select2" title="Item" name="item">
                                                                        <option value="">Select Item</option>
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

                                                                <!-- Manufacturer, Model, Year, Color Fields -->
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

                                                                <!-- Additional Information and Problem Description -->
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
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div>
                                                <h4 class="card-title mt-4">Service Location </h4>
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
                                            </div> --}}
                                            <div>
                                                <h4 class="card-title mt-4">Leaving Parts</h4>
                                                <p class="card-title-desc">The parts you want to leave</p>

                                                <div>
                                                    @foreach ($data->parts as $part)
                                                        @php
                                                            $isChecked = $data->task->taskLeaveParts->contains('part_id', $part->id)
                                                        @endphp
                                                        <div class="form-check form-check-inline font-size-16 mt-1">
                                                            <input class="form-check-input" type="checkbox" value="{{ $part->id }}" name="parts[]" id="part-{{ $part->id }}" {{ $isChecked ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="part-{{ $part->id }}">
                                                                <h5>{{ $part->name }}</h5>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div>

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
                                                            {{-- <br> {{$media->media}} --}}
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
                                                @php
                                                    $taskPriority = $data->task->priority_id;
                                                    $selectedPriority = $data->priorities->where('id', $taskPriority)->first();
                                                @endphp
                                                <span class="btn btn-info" id="currentPriority">{{ $selectedPriority->name }} - <b class="font-size-16">{{ number_format($selectedPriority->price, 0) }}€</b></span>
                                                <span class="btn btn-warning font-weight-bold font-size-16 p-1" id="editPriority"><i class="fa fa-edit"></i></span>

                                                <div id="priorityList" style="display: none">
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

                                                <span class="btn btn-info" id="currentInspection">
                                                    @if ($data->task->inspection_diagnose == 1)
                                                        Inspection and diagnostics - <b class="font-size-16">35€</b>
                                                    @else
                                                        Without diagnostics - <b class="font-size-16">0€</b>
                                                    @endif
                                                </span>
                                                <span class="btn btn-warning font-weight-bold font-size-16 p-1" id="editInspection"><i class="fa fa-edit"></i></span>


                                                @php
                                                    $totalServicesPrice = 0;
                                                    $totalProductsPrice = 0;
                                                @endphp
                                                <div class="mb-4 row" id="inspectionList" style="display: none;">
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
                                                    {{-- @foreach ($data->services->where('status', 1) as $service)
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
                                                    @enderror --}}


                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <button type="button" class="btn btn-success add-btn text-bold add_services_button mb-4">
                                                                <i class="bx bx-plus-circle me-1"></i> Add Services
                                                            </button>
                                                        </div>
                                                    </div>
                                                    @if(count($data->task->taskServices) > 0)
                                                        @foreach ($data->task->taskServices as $indexS => $thisServ)
                                                            @php ++$indexS @endphp
                                                            <div>
                                                                <div data-repeater-item class="row serviceRowTemplate">
                                                                    <div class="row">
                                                                        <div class="col-lg-3">
                                                                            <label for="place_holder">Service</label>
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                            <label for="place_holder">Price</label>
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                            <label for="place_holder">Qty</label>
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                            <label for="place_holder">Tax (%)</label>
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                            <label for="place_holder">Total</label>
                                                                        </div>
                                                                        <div class="col-lg-1">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        @php
                                                                            $thisServiceUnitTax = ($thisServ->unit_price * $thisServ->tax_perc) / 100;
                                                                            $thisServiceTotal = ($thisServ->unit_price  + $thisServiceUnitTax) * $thisServ->qty;
                                                                            $totalServicesPrice += $thisServiceTotal;
                                                                        @endphp
                                                                        <div class="mb-2 col-lg-3">
                                                                            <select name="service_{{$indexS}}" class="select2 form-control service service_{{$indexS}}">
                                                                                <option data-name="" data-price="0" value="">Choose Service</option>
                                                                                @foreach ($data->services as $service)
                                                                                    <option data-name="{{ $service->name }}" data-price="{{ $service->price }}" value="{{ $service->id }}" @if($service->id == $thisServ->service_id) selected @endif>{{ $service->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-2 col-lg-2">
                                                                            <input type="hidden" name="service_name_{{$indexS}}" class="form-control service_name service_name_{{$indexS}}" placeholder="name">
                                                                            <input type="text" name="service_price_{{$indexS}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" class="form-control service_price service_price_{{$indexS}}" placeholder="Enter Price" value="{{ $thisServ->unit_price }}">
                                                                        </div>
                                                                        <div class="mb-2 col-lg-2">
                                                                            <input type="text" name="service_qty_{{$indexS}}" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" class="form-control service_qty service_qty_{{$indexS}}" placeholder="Enter Quantity" value="{{ $thisServ->qty }}">
                                                                        </div>
                                                                        <div class="mb-2 col-lg-2">
                                                                            <input type="text" name="service_tax_{{$indexS}}" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" class="form-control service_tax service_tax_{{$indexS}}" placeholder="Enter Tax" value="{{ $thisServ->tax_perc }}">
                                                                        </div>
                                                                        <div class="mb-2 col-lg-2">
                                                                            <input type="text" name="service_total_{{$indexS}}" class="form-control service_total service_total_{{$indexS}}" readonly placeholder="Total" value="{{ $thisServiceTotal }}">
                                                                        </div>
                                                                        <div class="col-lg-1">
                                                                            <button type="button" class="btn btn-danger service-remove-btn" data-index="{{$indexS}}">
                                                                                <i class="bx bx-minus-circle me-1"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        @php $indexS = 0;  @endphp
                                                    @endif

                                                    <input type="hidden" name="services_row_count" id="services_row_count" value="{{ $indexS }}">
                                                    <div class="col-md-12 add_service_template_area"></div>

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
                                                                <div class="col-lg-6 mb-2">
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
                                                                                <label for="place_holder">Name</label>
                                                                            </div>
                                                                            <div class="mb-3 col-lg-2">
                                                                                <label for="place_holder">Price</label>
                                                                            </div>
                                                                            <div class="mb-3 col-lg-2">
                                                                                <label for="place_holder">Qty</label>
                                                                            </div>
                                                                            <div class="mb-3 col-lg-2">
                                                                                <label for="place_holder">Tax Perc.</label>
                                                                            </div>
                                                                            <div class="mb-3 col-lg-2">
                                                                                <label for="place_holder">Total</label>
                                                                            </div>
                                                                            <div class="mb-3 col-lg-1">
                                                                            </div>
                                                                        </div>
                                                                        <div class="newRow_{{$index}}">
                                                                            @foreach ($parentProduct->taskItemProducts as $indexP => $chilProduct)

                                                                                @php
                                                                                    $thisProductUnitTax = ($chilProduct->unit_price * $chilProduct->tax_perc) / 100;
                                                                                    $thisProductTotal = ($chilProduct->unit_price  + $thisProductUnitTax) * $chilProduct->qty;
                                                                                    $totalProductsPrice += $thisProductTotal;
                                                                                @endphp

                                                                                <div data-repeater-item class="row templateRow rowAppend_{{$index}}">
                                                                                    <div class="mb-3 col-lg-3">
                                                                                        <select name="product_{{$index}}[]" class="select2 form-control product product_{{$index}}">
                                                                                            <option data-name="" data-price="0" value="">Choose Product</option>
                                                                                            @foreach ($data->products as $product)
                                                                                                <option data-name="{{ $product->name }}" data-price="{{ $product->price }}" value="{{ $product->id }}" @if($product->id == $chilProduct->product_id) selected @endif>{{ $product->name }}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="mb-3 col-lg-2">
                                                                                        <input type="text" name="price_{{$index}}[]" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" class="form-control price price_{{$index}}" placeholder="Enter Price" value="{{ $chilProduct->unit_price }}">
                                                                                    </div>
                                                                                    <div class="mb-3 col-lg-2">
                                                                                        <input type="text" name="qty_{{$index}}[]" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" class="form-control qty qty_{{$index}}" placeholder="Enter Quantity" value="{{ $chilProduct->qty }}">
                                                                                    </div>
                                                                                    <div class="mb-3 col-lg-2">
                                                                                        <input type="text" name="tax_{{$index}}[]" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" class="form-control tax tax_{{$index}}" placeholder="Enter Tax Percentage" value="{{ $chilProduct->tax_perc }}">
                                                                                    </div>
                                                                                    <div class="mb-3 col-lg-2">
                                                                                        <input type="text" name="total_{{$index}}[]" class="form-control total total_{{$index}}" readonly placeholder="Total" value="{{ $thisProductTotal }}">
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
                                            {{-- <div>
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
                                            </div> --}}

                                            {{-- <div class="d-grid gap-2">
                                                <button type="submit" class="btn btn-primary btn-lg waves-effect waves-light">UPDATE</button>
                                            </div> --}}
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

                            {{-- </form> --}}
                        </div>
                        <div class="col-xl-3 col-sm-3 position-fixed" style="width:21%; right: 0px; top: 102px; z-index: 999;">
                            {{-- <div class="col-xl-3 col-sm-3 position-fixed" style="width:23%; right: 0px; top: 102px;"> --}}
                            <div class="text-center">
                                <a href="{{ route('case.invoice', $data->task->id) }}" class="btn btn-info font-size-18" target="_blank"><i class="bx bx-receipt"></i></a>
                                <a href="{{ route('case.show', $data->task->id) }}" class="btn btn-info font-size-18" target="_blank"><i class="bx bx-bullseye"></i></a>
                                @if ($data->task->payment_status != 1)
                                    <a href="#" class="btn btn-info font-size-18" data-bs-toggle="modal" data-bs-target="#paymentModal-{{ $data->task->id }}"><i class="bx bx-euro"></i></a>
                                    <a href="#" class="btn btn-info font-size-18" data-bs-toggle="modal" data-bs-target="#commentsModal-{{ $data->task->id }}"><i class="bx bx-message"></i></a>
                                @endif
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <form method="POST" action="{{ route('case.status-update', $data->task->id) }}" class="form" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <h4 class="card-title">Overview</h4>
                                        <div>
                                            <div style="margin-top: 0px;">
                                                <label>Case Number : <span class="font-size-18">{{ $data->task->code }}</span></label>
                                            </div>
                                            <div style="margin-top: 0px;">
                                                <label>Total : <span class="font-size-18">{{ $data->task->total }}</span></label>
                                            </div>
                                            <div style="margin-top: 0px;">
                                                <label>Paid : <span class="font-size-18">{{ $data->task->paid ?? 0 }}</span></label>
                                            </div>
                                            <div style="margin-top: 0px;">
                                                <label>Remaining : <span class="font-size-18">{{ $data->task->remaining ?? $data->task->total }}</span></label>
                                            </div>
                                            <div style="margin-top: 0px;">
                                                <label>Service Location :</label>
                                                @foreach ($data->serviceLocations as $location)
                                                    @if ($location->id == $data->task->services_location)
                                                        <span class="font-size-14">{{ $location->title }}</span>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div style="margin-top: 0px;">
                                                {{-- <label>Services : <span class="font-size-18">{{$data->task->taskService->sum('unit_price') ?? 0}}</span></label> --}}
                                            </div>

                                            {{-- <div class="mt-1">
                                                <label class="col-form-label">Case Status</label>
                                                <select class="form-control select2 @error('status') is-invalid @enderror" title="Status" name="status">
                                                    <option value="">Select Case Status </option>
                                                    @foreach (getCaseStatus('general') as $key => $status)
                                                        <option value="{{ ++$key }}" @if($key == $data->task->status) selected @endif>{{ $status }}</option>
                                                    @endforeach
                                                    @error('status')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </select>
                                            </div>
                                            <div class="mt-1">
                                                <label class="col-form-label">Payment Status</label>
                                                <select class="form-control select2 @error('payment_status') is-invalid @enderror" title="Payment Status" name="payment_status">
                                                    <option value="">Select Payment Status </option>
                                                    @foreach (getPayment('status') as $key => $status)
                                                        <option value="{{ ++$key }}" @if($key == $data->task->payment_status) selected @endif>{{ $status }}</option>
                                                    @endforeach
                                                    @error('status')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </select>
                                            </div>
                                            <div class="mt-1">
                                                <label class="col-form-label">Payment Method</label>
                                                <select class="form-control select2" title="Payment Method" name="payment_method">
                                                    <option value="">Select Payment Method </option>
                                                    @foreach (getPayment('via') as $key => $status)
                                                        <option value="{{ ++$key }}" @if($key == $data->task->payment_status) selected @endif>{{ $status }}</option>
                                                    @endforeach
                                                </select>
                                            </div> --}}

                                            <div class="d-grid gap-2">
                                                <button type="submit" class="btn btn-primary btn-lg waves-effect waves-light">UPDATE</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-3 position-fixed" style="width:21%; right: 0px; top: 420px; z-index: 999;">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-start">
                                        <div class="me-2">
                                            <h5 class="card-title mb-4">Comments</h5>
                                        </div>
                                        @if ($data->task->payment_status != 1)
                                            <a href="#" class="btn btn-info font-size-12 float-right" data-bs-toggle="modal" data-bs-target="#commentsModal-{{ $data->task->id }}"><i class="bx bx-message"></i> Add Comment</a>
                                        @endif
                                    </div>
                                    <div data-simplebar="init" class="mt-2 simplebar-scrollable-y" style="max-height: 280px;"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px;">
                                        @if(count($data->task->taskComments) > 0)
                                            @foreach ($data->task->taskComments as $key => $comments)
                                                <div class="d-flex mb-0">
                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            <p class="text-muted mb-1 font-size-16">
                                                                {{ $comments->comment }}
                                                            </p>
                                                            <p class="pt-0">Added By:
                                                                {{ $comments->user_id }}
                                                                <br>
                                                                {{ $comments->created_at }}
                                                            </p>
                                                        </div>
                                                        <div class="col-md-2">
                                                            {!! getGenStatus('visibility', $comments->type, 'badge') !!}
                                                            <div class="row text-center d-flex justify-content-center">
                                                                <a href="" class="btn btn-warning btn-sm px-0 py-0"><i class="bx bx-edit"></i></a>
                                                                <a href="" class="btn btn-danger btn-sm px-0 py-0"><i class="bx bx-trash"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="my-1 mb-1 font-size-12 font-weight-bold border-top">
                                            @endforeach
                                        @else
                                            <p class="text-muted mb-0">No comment yet.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="simplebar-placeholder" style="width: 351px; height: 125px;"></div>
                            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                            </div>
                            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                <div class="simplebar-scrollbar" style="height: 217px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                            </div>
                        </div>

                        @if(count($data->task->taskPayments) > 0)
                            <div class="col-xl-3 col-sm-3 position-fixed" style="width:23%; right: 0px; top: 420px; z-index: 999;">
                            {{-- <div class="col-xl-3 col-sm-3 position-fixed" style="width:23%; right: 0px; top: 400px; height: 100;"> --}}
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start">
                                            <div class="me-2">
                                                <h5 class="card-title mb-4">Payment Logs</h5>
                                            </div>
                                        </div>
                                        <div data-simplebar="init" class="mt-2 simplebar-scrollable-y" style="max-height: 280px;"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px;">
                                            <ul class="verti-timeline list-unstyled">
                                                @foreach ($data->task->taskPayments as $payment)
                                                    <li class="event-list py-0 mb-2">
                                                        <div class="event-timeline-dot">
                                                            <i class="bx bx-right-arrow-circle"></i>
                                                        </div>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 me-3">
                                                                {!! getPayment('via', $payment->via, 'badge') !!}
                                                                <span class="text-primary">{{$payment->created_at->format('d M, Y')}}</span>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <div>
                                                                    <h5 class="font-size-15"><a href="javascript: void(0);" class="text-dark">{{ numberFormat($payment->amount, 'euro') }}</a></h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex">
                                                            <p>{{ $payment->note }}</p>
                                                        </div>
                                                    </li>
                                                    {{-- <li class="event-list active">
                                                        <div class="event-timeline-dot">
                                                            <i class="bx bx-right-arrow-circle font-size-18"></i>
                                                            <i class="bx bxs-right-arrow-circle font-size-18 bx-fade-right"></i>
                                                        </div>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 me-3">
                                                                <h5 class="font-size-14">{{$payment->created_at->format('d M, Y')}} <i class="bx bx-right-arrow-alt font-size-16 text-primary align-middle ms-2"></i></h5>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <div>
                                                                    {!! getPayment('via', $payment->via, 'badge') !!}
                                                                    {{ $payment->amount }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li> --}}
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="simplebar-placeholder" style="width: 351px; height: 125px;"></div>
                                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                </div>
                                <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                    <div class="simplebar-scrollbar" style="height: 217px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                                </div>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="services_row_template d-none">
        <div data-repeater-item class="row serviceRowTemplate">
            <div class="row">
                <div class="col-lg-3">
                    <label for="place_holder">Service</label>
                </div>
                <div class="col-lg-2">
                    <label for="place_holder">Price</label>
                </div>
                <div class="col-lg-2">
                    <label for="place_holder">Qty</label>
                </div>
                <div class="col-lg-2">
                    <label for="place_holder">Tax (%)</label>
                </div>
                <div class="col-lg-2">
                    <label for="place_holder">Total</label>
                </div>
                <div class="col-lg-1">
                </div>

                <div class="mb-2 col-lg-3">
                    <select name="service_INDEX" class="select2 form-control service service_INDEX">
                        <option data-name="" data-price="0" value="">Choose Service</option>
                        @foreach ($data->services as $service)
                            <option data-name="{{ $service->name }}" data-price="{{ $service->price }}" value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2 col-lg-2">
                    <input type="hidden" name="service_name_INDEX" class="form-control service_name service_name_INDEX" placeholder="name">
                    <input type="text" name="service_price_INDEX" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" class="form-control service_price service_price_INDEX" placeholder="Enter Price" value="0">
                </div>
                <div class="mb-2 col-lg-2">
                    <input type="text" name="service_qty_INDEX" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" class="form-control service_qty service_qty_INDEX" placeholder="Enter Quantity" value="0">
                </div>
                <div class="mb-2 col-lg-2">
                    <input type="text" name="service_tax_INDEX" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" class="form-control service_tax service_tax_INDEX" placeholder="Enter Tax" value="{{ $data->tax }}">
                </div>
                <div class="mb-2 col-lg-2">
                    <input type="text" name="service_total_INDEX" class="form-control service_total service_total_INDEX" readonly placeholder="Total" value="0">
                </div>
                <div class="col-lg-1">
                    <button type="button" class="btn btn-danger service-remove-btn" data-index="INDEX">
                        <i class="bx bx-minus-circle me-1"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row template_row d-none">
        <div class="col-12">
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
                        <label for="place_holder">Name</label>
                    </div>
                    <div class="mb-3 col-lg-2">
                        <label for="place_holder">Price</label>
                    </div>
                    <div class="mb-3 col-lg-2">
                        <label for="place_holder">Qty</label>
                    </div>
                    <div class="mb-3 col-lg-2">
                        <label for="place_holder">Tax (%)</label>
                    </div>
                    <div class="mb-3 col-lg-2">
                        <label for="place_holder">Total</label>
                    </div>
                    <div class="mb-3 col-lg-1">
                    </div>
                </div>
                <div class="newRow_INDEX">
                    <div data-repeater-item class="row templateRow rowAppend_INDEX">
                        <div class="mb-2 col-lg-3">
                            <select name="product_INDEX[]" class="select2 form-control product product_INDEX">
                                <option data-name="" data-price="0" value="">Choose Product</option>
                                @foreach ($data->products as $product)
                                    <option data-name="{{ $product->name }}" data-price="{{ $product->price }}" value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2 col-lg-2">
                            <input type="hidden" name="name_INDEX[]" class="form-control name name_INDEX" placeholder="name">
                            <input type="text" name="price_INDEX[]" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" class="form-control price price_INDEX" placeholder="Enter Price" value="0">
                        </div>
                        <div class="mb-2 col-lg-2">
                            <input type="text" name="qty_INDEX[]" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" class="form-control qty qty_INDEX" placeholder="Enter Quantity" value="0">
                        </div>
                        <div class="mb-2 col-lg-2">
                            <input type="text" name="tax_INDEX[]" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" class="form-control tax tax_INDEX" placeholder="Enter Tax Percentage" value="{{ $data->tax }}">
                        </div>
                        <div class="mb-2 col-lg-2">
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
            <div class="mb-2 col-lg-3">
                <select name="product_INDEX[]" class="select2 form-control product product_INDEX">
                    <option data-name="" data-price="0" value="">Choose Product</option>
                    @foreach ($data->products as $product)
                        <option data-name="{{ $product->name }}" data-price="{{ $product->price }}" value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-2 col-lg-2">
                <input type="hidden" name="name_INDEX[]" class="form-control name name_INDEX" placeholder="name">
                <input type="text" name="price_INDEX[]" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" class="form-control price price_INDEX" placeholder="Enter Price" value="0">
            </div>
            <div class="mb-2 col-lg-2">
                <input type="text" name="qty_INDEX[]" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" class="form-control qty qty_INDEX" placeholder="Enter Quantity" value="0">
            </div>
            <div class="mb-2 col-lg-2">
                <input type="text" name="tax_INDEX[]" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" class="form-control tax tax_INDEX" placeholder="Enter Tax Percentage" value="{{ $data->tax }}">
            </div>
            <div class="mb-2 col-lg-2">
                <input type="text" name="total_INDEX[]" class="form-control total total_INDEX" readonly placeholder="Total" value="0">
            </div>
            <div class="col-lg-1">
                <button type="button" class="btn btn-danger remove-btn" data-index="INDEX">
                    <i class="bx bx-minus-circle me-1"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Payment Modal -->
    <div class="modal fade" id="paymentModal-{{ $data->task->id }}" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Add New Payment for <b>{{$data->task->code}}</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('case.status-update', $data->task->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div>
                            <label class="col-form-label amount">Payment Amount <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" placeholder="Payment Amount" step="0.01" min="0.01" max="{{$data->task->pending}}" required>
                            @error('amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div>
                            <label class="col-form-label payment_method mt-1">Payment Method <span class="text-danger">*</span></label>
                            <select class="form-control select2 @error('payment_method') is-invalid @enderror" name="payment_method" required>
                                <option value="">Select Payment Method</option>
                                @foreach (getPayment('via') as $payKey => $status)
                                    <option value="{{ ++$payKey }}">{{ $status }}</option>
                                @endforeach
                                @error('payment_method')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </select>
                        </div>
                        <div>
                            <label for="note" class="col-form-label">Note</label>
                            <textarea class="form-control" name="note" placeholder="Note"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Comments Modal -->
    <div class="modal fade" id="commentsModal-{{ $data->task->id }}" tabindex="-1" aria-labelledby="commentsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="commentsModalLabel">Add New Comments for <b>{{$data->task->code}}</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('case.comment', $data->task->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div>
                            <label for="comment" class="col-form-label">Comment</label>
                            <textarea class="form-control" name="comment" placeholder="Comment"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Comment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Total of All Selected Services
    function updateServiceTotal000() {
        let total = 0;

        const checkboxes = document.querySelectorAll('input[type="checkbox"][service-price]');

        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                total += parseFloat(checkbox.getAttribute('service-price'));
            }
        });

        document.getElementById('service-total').value = total.toFixed(2);
    }



    function updateServiceTotal() {

        const inputs = document.querySelectorAll('.service_total');

        let totalServices = 0;

        inputs.forEach(input => {
            const value = parseFloat(input.value) || 0; // Default to 0 if value is NaN
            totalServices += value;
        });

        document.getElementById('service-total').value = totalServices.toFixed(2);
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


        // Priority Button
        $('#editPriority').click(function() {
            var $currentPriority = $('#currentPriority');
            var $priorityList = $('#priorityList');

            // Toggle visibility
            if ($currentPriority.is(':visible')) {
                $currentPriority.hide();
                $priorityList.show();
            } else {
                $currentPriority.show();
                $priorityList.hide();
            }
        });
        // Inspection & Diagnose
        $('#editInspection').click(function() {
            var $currentInspection = $('#currentInspection');
            var $inspectionList = $('#inspectionList');

            // Toggle visibility
            if ($currentInspection.is(':visible')) {
                $currentInspection.hide();
                $inspectionList.show();
            } else {
                $currentInspection.show();
                $inspectionList.hide();
            }
        });


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


    // });

    // $(document).ready(function() {


        // $('.select2').select2();
        var rowCount = 0;
        var serviceRowCount = 0;

        // if there is record in DB in then consider that count (only parent products)
        var dbRowCountService = <?php echo count($data->task->taskServices) ?>;
        if (dbRowCountService > 0) {
            serviceRowCount = dbRowCountService;
        }

        $(document).on('click', '.add_services_button', function(){
            serviceRowCount++;
            var templateHTML = $('.services_row_template').html();
            templateHTML = templateHTML.replace(/INDEX/g, serviceRowCount);
            $('.add_service_template_area').append(templateHTML);
            $('#services_row_count').val(serviceRowCount)
        })

        $(document).on('click', '.service-remove-btn', function(){
            $(this).closest('.serviceRowTemplate').remove();
            updateServiceTotal();
        })

        $(document).on('keyup', '.service_price, .service_qty, .service_tax', function(){
            var price = $(this).closest('.serviceRowTemplate').find('.service_price');
            var qty = $(this).closest('.serviceRowTemplate').find('.service_qty');
            var taxPercentage = $(this).closest('.serviceRowTemplate').find('.service_tax');
            var total = $(this).closest('.serviceRowTemplate').find('.service_total');
            if(qty.val() == ''){
                qty.val(0)
            }
            if(price.val() == ''){
                price.val(0)
            }
            qtyAmount = parseFloat(price.val()) * parseInt(qty.val());
            taxAmount = (parseFloat(taxPercentage.val()) * qtyAmount ) / 100;
            rowTotal = taxAmount + qtyAmount;
            total.val(parseFloat(rowTotal));
            updateServiceTotal();
        })

        $(document).on('change', '.service', function(){
            var servicePrice = $(this).find(':selected').data('price');
            var serviceName = $(this).find(':selected').data('name');

            var name = $(this).closest('.serviceRowTemplate').find('.service_name')
            var price = $(this).closest('.serviceRowTemplate').find('.service_price')
            var qty = $(this).closest('.serviceRowTemplate').find('.service_qty')
            var taxPercentage = $(this).closest('.serviceRowTemplate').find('.service_tax').val()
            var total = $(this).closest('.serviceRowTemplate').find('.service_total')

            var qtyTotal = parseFloat(servicePrice) * parseInt(1);
            var taxAmount = (taxPercentage * qtyTotal) / 100;
            var rowTotal = parseFloat(qtyTotal) + parseFloat(taxAmount);

            name.val(serviceName);
            total.val(parseFloat(rowTotal));
            price.val(servicePrice);
            // tax.val(taxPercentage);
            qty.val(1);
            updateServiceTotal();

        })




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
    .switch {position: relative;display: inline-block;width: 60px;height: 50px;}
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
