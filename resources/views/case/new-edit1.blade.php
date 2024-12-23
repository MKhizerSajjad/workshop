@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- Start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">New Update Booking Form</h4>
                    </div>
                </div>
            </div>
            <!-- End page title -->

            <div class="checkout-tabs">

                <form method="POST" action="{{ route('case.update', $data->task->id) }}" class="form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <!-- Main Form Section -->
                        <div class="col-xl-9 col-12">

                            {{-- Success and Error --}}
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-border-left alert-dismissible fade show auto-close-3" role="alert">
                                    <i class="ri-check-double-line me-3 align-middle fs-16"></i>
                                    <strong>Success!</strong> {{ $message }}
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

                            <div class="card">
                                <div class="card-body">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="col-md-12">

                                            {{-- top --}}
                                            <div class="row nowrap align-items-end mb-4">
                                                <div class="col-lg-3 col-md-6">
                                                    <label for="caseNumber" class="form-label">Case Number</label>
                                                    <input type="text" class="form-control" id="caseNumber" placeholder="{{$data->task->code}}" disabled>
                                                </div>
                                                <div class="col-lg-2 col-md-6">
                                                    <label for="bookingFilled" class="form-label">Booking Filled</label>
                                                    <input type="date" class="form-control" id="bookingFilled" name="date_opened" value="@php echo $data->task->date_opened ? date('Y-m-d', strtotime($data->task->date_opened)) : ''; @endphp">
                                                </div>
                                                <div class="col-lg-2 col-md-6">
                                                    <label for="itemDelivered" class="form-label">Item Delivered to Service</label>
                                                    <input type="date" class="form-control" id="itemDelivered"  name="date_service" value="@php echo $data->task->date_service ? date('Y-m-d', strtotime($data->task->date_service)) : ''; @endphp">
                                                </div>
                                                <div class="col-lg-2 col-md-6">
                                                    <label for="itemPickedUp" class="form-label">Item Picked Up / Sent Out</label>
                                                    <input type="date" class="form-control" id="itemPickedUp" name="date_closed" value="@php echo $data->task->date_closed ? date('Y-m-d', strtotime($data->task->date_closed)) : ''; @endphp">
                                                </div>
                                                <div class="col-lg-3 col-md-6 d-flex justify-content-end">
                                                    <div class="w-100 w-lg-auto">
                                                        <label for="technician" class="form-label">Technician</label>
                                                        <select class="form-control select2" title="Technician" name="technician_id">
                                                            <option value="">Select Technician </option>
                                                            @foreach ($data->technicians as $technician)
                                                                <option value="{{ $technician->id }}"
                                                                    @if ($technician->id == $data->task->technician_id) selected @endif>
                                                                    {{ $technician->first_name . ' ' . $technician->last_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Info Section --}}
                                            <div class="row  d-flex gap-1 justify-content-between">
                                                <!-- Item Information Section -->
                                                {{-- column-rgt-border --}}
                                                <div class="custom-form custom-border11">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h4 class="card-title mb-0">Item Information</h4>
                                                        </div>
                                                        <div class="col-md-6 text-end">
                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                                data-bs-target="#itemDetailsModal">
                                                                <i class="fa fa-pen"></i>
                                                            </button>
                                                        </div>
                                                        <div class="container" id="itemInfo">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <p><strong>Item:</strong> <span
                                                                            class="text-muted">{{ $data->task->item->name ?? 'N/A' }}</span>
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p><strong>Manufacturer:</strong> <span
                                                                            class="text-muted">{{ $data->task->manufacturer ?? 'N/A' }}</span>
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p><strong>Model:</strong> <span
                                                                            class="text-muted">{{ $data->task->model ?? 'N/A' }}</span></p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p><strong>Year:</strong> <span
                                                                            class="text-muted">{{ $data->task->year ?? 'N/A' }}</span></p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p><strong>Color:</strong> <span
                                                                            class="text-muted">{{ $data->task->color ?? 'N/A' }}</span></p>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <p><strong>Additional Information:</strong><br>
                                                                        <span
                                                                            class="text-muted">{{ $data->task->additional_info ?? 'N/A' }}</span>
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <p><strong>Description of Problem/Failure:</strong><br>
                                                                        <span
                                                                            class="text-muted">{{ $data->task->problem_description ?? 'N/A' }}</span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Item Information Section -->

                                                <!-- Customer Information Section -->
                                                <div class="custom-form custom-border11">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h4 class="card-title">Customer Information</h4>
                                                        </div>
                                                        <div class="col-md-6 text-end">
                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                                data-bs-target="#serviceLocationModal">
                                                                <i class="fa fa-pen"></i>
                                                            </button>
                                                        </div>
                                                        <div class="container" id="serviceLocation">
                                                            @foreach ($data->serviceLocations as $location)
                                                                @if ($location->id == $data->task->services_location)
                                                                    <div class="row">
                                                                        @foreach (json_decode($location->fields) as $field)
                                                                            <div
                                                                                class="col-lg-{{ $field->type === 'textarea' ? '12' : '6' }}">
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
                                                            <b>Customer status : </b> {!! getGenStatus('user', $data->task->customer->status, 'badge') !!}
                                                            {{-- <span>{{ $data->task->customer->status_detail }}</span> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Customer Information Section -->
                                            </div>

                                            <div class="row mt-2 custom-border11">
                                                <div>
                                                    <div class="row nowrap align-items-end">
                                                        {{-- Leaving Parts --}}
                                                        <div class="col-md-4 col-sm-12">
                                                            <h4 class="card-title">Leaving Parts</h4>
                                                            <p class="card-title-desc">The parts you want to leave</p>
                                                            <div id="currentSelectedParts">
                                                                @foreach ($data->parts as $part)
                                                                    @if ($data->task->taskLeaveParts->contains('part_id', $part->id))
                                                                        <span class="btn btn-info">{{ $part->name }}</span>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                            <span class="btn btn-warning font-weight-bold font-size-16 p-1" id="editPartsList">
                                                                <i class="fa fa-edit"></i>
                                                            </span>
                                                            <div id="partsList" style="display: none">
                                                                @foreach ($data->parts as $part)
                                                                    @php
                                                                        $isChecked = $data->task->taskLeaveParts->contains('part_id', $part->id);
                                                                    @endphp
                                                                    <div class="form-check form-check-inline font-size-16 mt-1">
                                                                        <input class="form-check-input" type="checkbox" value="{{ $part->id }}"
                                                                            name="parts[]" id="part-{{ $part->id }}"
                                                                            {{ $isChecked ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="part-{{ $part->id }}">
                                                                            <h5>{{ $part->name }}</h5>
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        {{-- Case Priority --}}
                                                        <div class="col-md-4 col-sm-12">
                                                            <h4 class="card-title">Priority of Case</h4>
                                                            <p class="card-title-desc">How fast you wants get back?</p>
                                                            @php
                                                                $taskPriority = $data->task->priority_id;
                                                                $selectedPriority = $data->priorities->where('id', $taskPriority)->first();
                                                            @endphp
                                                            <span class="btn btn-info" id="currentPriority">{{ $selectedPriority->name }} - <b
                                                                    class="font-size-16">{{ number_format($selectedPriority->price, 0) }}€</b></span>
                                                            <span class="btn btn-warning font-weight-bold font-size-16 p-1" id="editPriority"><i
                                                                    class="fa fa-edit"></i></span>

                                                            <div id="priorityList" style="display: none">
                                                                @foreach ($data->priorities as $priority)
                                                                    <div class="form-check form-check-inline font-size-16">
                                                                        <input class="form-check-input" type="radio" name="priority"
                                                                            value="{{ $priority->id }}" id="priority-{{ $priority->id }}"
                                                                            {{ $priority->id == $data->task->priority_id ? 'checked' : '' }}>
                                                                        <label class="form-check-label font-size-13"
                                                                            for="priority-{{ $priority->id }}">
                                                                            {{ $priority->name }} - {{ number_format($priority->price, 0) }}€
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        {{-- Inspection & Diganose --}}
                                                        <div class="col-md-4 col-sm-12">
                                                            <h4 class="card-title">Inspection and Diagnostics</h4>
                                                            <p class="card-title-desc">Do you want to avail professional diagniostic serves?</p>

                                                            <span class="btn btn-info" id="currentInspection">
                                                                @if ($data->task->inspection_diagnose == 1)
                                                                    Inspection & Diagnostics - <b class="font-size-16">35€</b>
                                                                @else
                                                                    Without Diagnostics - <b class="font-size-16">0€</b>
                                                                @endif
                                                            </span>
                                                            <span class="btn btn-warning font-weight-bold font-size-16 p-1" id="editInspection">
                                                                <i class="fa fa-edit"></i>
                                                            </span>

                                                            @php
                                                                $totalServicesPrice = 0;
                                                                $totalProductsPrice = 0;
                                                            @endphp
                                                            <div class="mb-4 row" id="inspectionList" style="display: none;">
                                                                <div class="col-md-6">
                                                                    <div class="form-check form-check-inline font-size-16">
                                                                        <input class="form-check-input" type="radio" value="1"
                                                                            name="inspection" id="inspection"
                                                                            {{ $data->task->inspection_diagnose == 1 ? 'checked' : '' }}>
                                                                        <label class="form-check-label font-size-13" for="inspection">
                                                                            <i class="fa fa-search-plus me-1 font-size-20 align-top"></i>
                                                                            Inspection and Diagnostics - <b class="font-size-16">35€</b>
                                                                            <br><span class="text text-danger">35€ would extra add on</span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-check form-check-inline font-size-16">
                                                                        <input class="form-check-input" type="radio" value="2"
                                                                            name="inspection" id="withoutinspection2"
                                                                            {{ $data->task->inspection_diagnose != 1 ? 'checked' : '' }}>
                                                                        <label class="form-check-label font-size-13" for="withoutinspection2">
                                                                            <i class="fa fa-search-minus me-1 font-size-20 align-top"></i>
                                                                            Without Diagnostics - <b class="font-size-16">0€</b>
                                                                            <br><span class="text text-danger">Repair, according to the problem named
                                                                                and described by the customer</span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Media --}}
                                            <div class="row">
                                                <h4 class="card-title mt-3">Medias</h4>
                                                <label for="uploadImage" class="custom-file-upload">
                                                    <span><i class="ti-cloud-up"></i> Pictures, files and videos of product</span>
                                                    <input type="file" name="files[]" id="uploadImage" class="form-control-file"
                                                        multiple>
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
                                                                    $previewContent =
                                                                        '<img class="thumb" src="' .
                                                                        asset('/task/media/' . $media->media) .
                                                                        '" title="' .
                                                                        $media->media .
                                                                        '">';
                                                                    break;
                                                                case 'mp4':
                                                                case 'avi':
                                                                case 'mov':
                                                                case 'wmv':
                                                                    $imagePath = asset('images/video.png');
                                                                    $previewContent =
                                                                        '<img class="thumb" src="' .
                                                                        $imagePath .
                                                                        '" title="' .
                                                                        $media->media .
                                                                        '">';
                                                                    break;
                                                                default:
                                                                    $imagePath = asset('images/file.png');
                                                                    $previewContent =
                                                                        '<img class="thumb" src="' .
                                                                        $imagePath .
                                                                        '" title="' .
                                                                        $media->media .
                                                                        '">';
                                                                    break;
                                                            }
                                                        @endphp
                                                        <div class="preview-image">
                                                            {!! $previewContent !!}
                                                            @if ($media->customer_choice == 2)
                                                                <span class="delete-image deleteCaseMedia"
                                                                    data-href="{{ route('case.destroyMedia', $media->id) }}"
                                                                    data-nxame="' + theFile.name + '"><i
                                                                        class="fa fa-trash text-danger"></i></span>
                                                            @endif
                                                            {{-- <br> {{$media->media}} --}}
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>





                                            {{-- Service --}}
                                            <div class="row custom-border11">
                                                <h4 class="card-title">Services</h4>
                                                <p class="card-title-desc">Please select your required services carefully</p>
                                                <div>
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
                                                            <button type="button"
                                                                class="btn btn-success add-btn text-bold add_services_button mb-4">
                                                                <i class="bx bx-plus-circle me-1"></i> Add Services
                                                            </button>
                                                        </div>
                                                    </div>
                                                    @if (count($data->task->taskServices) > 0)
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
                                                                            $thisServiceUnitTax =
                                                                                ($thisServ->unit_price * $thisServ->tax_perc) / 100;
                                                                            $thisServiceTotal =
                                                                                ($thisServ->unit_price + $thisServiceUnitTax) *
                                                                                $thisServ->qty;
                                                                            $totalServicesPrice += $thisServiceTotal;
                                                                        @endphp
                                                                        <div class="mb-2 col-lg-3">
                                                                            <select name="service_{{ $indexS }}"
                                                                                class="select2 form-control service service_{{ $indexS }}">
                                                                                <option data-name="" data-price="0" value="">
                                                                                    Choose Service</option>
                                                                                @foreach ($data->services as $service)
                                                                                    <option data-name="{{ $service->name }}"
                                                                                        data-price="{{ $service->price }}"
                                                                                        value="{{ $service->id }}"
                                                                                        @if ($service->id == $thisServ->service_id) selected @endif>
                                                                                        {{ $service->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-2 col-lg-2">
                                                                            <input type="hidden" name="service_name_{{ $indexS }}"
                                                                                class="form-control service_name service_name_{{ $indexS }}"
                                                                                placeholder="name">
                                                                            <input type="text"
                                                                                name="service_price_{{ $indexS }}"
                                                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');"
                                                                                class="form-control service_price service_price_{{ $indexS }}"
                                                                                placeholder="Enter Price"
                                                                                value="{{ $thisServ->unit_price }}">
                                                                        </div>
                                                                        <div class="mb-2 col-lg-2">
                                                                            <input type="text" name="service_qty_{{ $indexS }}"
                                                                                oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');"
                                                                                class="form-control service_qty service_qty_{{ $indexS }}"
                                                                                placeholder="Enter Quantity"
                                                                                value="{{ $thisServ->qty }}">
                                                                        </div>
                                                                        <div class="mb-2 col-lg-2">
                                                                            <input type="text" name="service_tax_{{ $indexS }}"
                                                                                oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');"
                                                                                class="form-control service_tax service_tax_{{ $indexS }}"
                                                                                placeholder="Enter Tax"
                                                                                value="{{ $thisServ->tax_perc }}">
                                                                        </div>
                                                                        <div class="mb-2 col-lg-2">
                                                                            <input type="text"
                                                                                name="service_total_{{ $indexS }}"
                                                                                class="form-control service_total service_total_{{ $indexS }}"
                                                                                readonly placeholder="Total"
                                                                                value="{{ $thisServiceTotal }}">
                                                                        </div>
                                                                        <div class="col-lg-1">
                                                                            <button type="button"
                                                                                class="btn btn-danger service-remove-btn"
                                                                                data-index="{{ $indexS }}">
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

                                                    <input type="hidden" name="services_row_count" id="services_row_count"
                                                        value="{{ $indexS }}">
                                                    <div class="col-md-12 add_service_template_area"></div>

                                                    <div class="mb-3 col-sm-12 offset-sm-0 col-md-4 offset-md-8">
                                                        <label>Selected Services Total (€)</label>
                                                        <input type="number" name="service_total" id="service-total"
                                                            class="form-control" placeholder="Total Services Amount"
                                                            value="{{ $totalServicesPrice }}" readonly>
                                                    </div>
                                                    {{-- <div class="mb-3 col-sm-12 offset-sm-0 col-md-4 offset-md-8">
                                                        <label>Give your's if price is over (€)</label>
                                                        <input type="text" name="service_desired_total"
                                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="form-control"
                                                            placeholder="Your Desired Amount"
                                                            value="{{ $data->task->service_desired_total }}">
                                                    </div> --}}
                                                </div>
                                            </div>


                                            {{-- Products --}}
                                            <div class="row mt-3 custom-border11">
                                                <h4 class="card-title">Products</h4>
                                                <p class="card-title-desc">Products consumed in this case</p>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-lg-6 mb-2">
                                                                <button type="button"
                                                                    class="btn btn-success add-btn text-bold add_panel_button">
                                                                    <i class="bx bx-plus-circle me-1"></i> Add Merge Product Panel
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6"></div>

                                                    <div class="col-12">
                                                        @foreach ($data->task->taskProducts as $index => $parentProduct)
                                                            @php $index++ @endphp
                                                            <div data-repeater-list="group-a">
                                                                <!-- Initial template for a single row -->
                                                                <div class="row">
                                                                    <div class="mb-3 col-lg-6">
                                                                        <label for="name">Merge Product Name</label>
                                                                        <input type="text"
                                                                            class="form-control merge_name_{{ $index }} merge_name"
                                                                            name="merge_name_{{ $index }}"
                                                                            id="merge_name_{{ $index }}"
                                                                            value="{{ $parentProduct->name }}"
                                                                            placeholder="Merge Product Name">
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
                                                                <div class="newRow_{{ $index }}">
                                                                    @foreach ($parentProduct->taskItemProducts as $indexP => $chilProduct)
                                                                        @php
                                                                            $thisProductUnitTax =
                                                                                ($chilProduct->unit_price * $chilProduct->tax_perc) / 100;
                                                                            $thisProductTotal =
                                                                                ($chilProduct->unit_price + $thisProductUnitTax) *
                                                                                $chilProduct->qty;
                                                                            $totalProductsPrice += $thisProductTotal;
                                                                        @endphp

                                                                        <div data-repeater-item
                                                                            class="row templateRow rowAppend_{{ $index }}">
                                                                            <div class="mb-3 col-lg-3">
                                                                                <select name="product_{{ $index }}[]"
                                                                                    class="select2 form-control product product_{{ $index }}">
                                                                                    <option data-name="" data-price="0" value="">
                                                                                        Choose Product</option>
                                                                                    @foreach ($data->products as $product)
                                                                                        <option data-name="{{ $product->name }}"
                                                                                            data-price="{{ $product->price }}"
                                                                                            value="{{ $product->id }}"
                                                                                            @if ($product->id == $chilProduct->product_id) selected @endif>
                                                                                            {{ $product->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div class="mb-3 col-lg-2">
                                                                                <input type="text" name="price_{{ $index }}[]"
                                                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');"
                                                                                    class="form-control price price_{{ $index }}"
                                                                                    placeholder="Enter Price"
                                                                                    value="{{ $chilProduct->unit_price }}">
                                                                            </div>
                                                                            <div class="mb-3 col-lg-2">
                                                                                <input type="text" name="qty_{{ $index }}[]"
                                                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');"
                                                                                    class="form-control qty qty_{{ $index }}"
                                                                                    placeholder="Enter Quantity"
                                                                                    value="{{ $chilProduct->qty }}">
                                                                            </div>
                                                                            <div class="mb-3 col-lg-2">
                                                                                <input type="text" name="tax_{{ $index }}[]"
                                                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');"
                                                                                    class="form-control tax tax_{{ $index }}"
                                                                                    placeholder="Enter Tax Percentage"
                                                                                    value="{{ $chilProduct->tax_perc }}">
                                                                            </div>
                                                                            <div class="mb-3 col-lg-2">
                                                                                <input type="text" name="total_{{ $index }}[]"
                                                                                    class="form-control total total_{{ $index }}"
                                                                                    readonly placeholder="Total"
                                                                                    value="{{ $thisProductTotal }}">
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
                                                                    <button type="button" class="btn btn-success add-btn-row text-bold"
                                                                        data-index="{{ $index }}">
                                                                        <i class="bx bx-plus-circle me-1"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <input type="hidden" name="row_count" id="row_count"
                                                        value="{{ count($data->task->taskProducts) }}">
                                                    <div class="col-md-12 add_template_area"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Main Form Section -->

                        <!-- Sidebar Section -->
                        <div class="col-xl-3 col-12 right_side">
                            {{--  position-fixed" style="width: 21%; right: 0px; top: 102px; z-index: 999; --}}
                            <div> {{--  class="fixed-div" --}}
                                {{-- <div class="text-center">
                                    <a href="{{ route('case.invoice', $data->task->id) }}" class="btn btn-info font-size-18"
                                        target="_blank">
                                        <i class="bx bx-receipt"></i>
                                    </a>
                                    <a href="{{ route('case.show', $data->task->id) }}" class="btn btn-info font-size-18"
                                        target="_blank">
                                        <i class="bx bx-bullseye"></i>
                                    </a>
                                    @if ($data->task->payment_status != 1)
                                        <a href="#" class="btn btn-info font-size-18" data-bs-toggle="modal"
                                            data-bs-target="#paymentModal-{{ $data->task->id }}">
                                            <i class="bx bx-euro"></i>
                                        </a>
                                        <a href="#" class="btn btn-info font-size-18" data-bs-toggle="modal"
                                            data-bs-target="#commentsModal-{{ $data->task->id }}">
                                            <i class="bx bx-message"></i>
                                        </a>
                                    @endif
                                </div> --}}
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-10">
                                                {{-- <form method="POST" action="{{ route('case.status-update', $data->task->id) }}" class="form" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT') --}}
                                                    <h4 class="card-title">Overview</h4>
                                                    <div class="text-center">
                                                        <label>Case Number: <span class="font-size-16 pull-right">{{ $data->task->code }}</span></label>
                                                        <label>Total: <span class="font-size-16 pull-right">{{ $data->task->total }}</span></label>
                                                        <label>Paid: <span class="font-size-16 pull-right">{{ $data->task->paid ?? 0 }}</span></label>
                                                        <label>Remaining: <span class="font-size-16 pull-right">{{ $data->task->remaining ?? $data->task->total }}</span></label>
                                                        <label class="font-size-11 text-muted">Service Location:
                                                            @foreach ($data->serviceLocations as $location)
                                                                @if ($location->id == $data->task->services_location)
                                                                    <span class="pull-right">{{ $location->title }}</span>
                                                                @endif
                                                            @endforeach
                                                        </label>
                                                    </div>
                                                    <div class="d-grid gap-2">
                                                        <button type="submit"
                                                            class="btn btn-primary btn-lg waves-effect waves-light">UPDATE</button>
                                                    </div>
                                                {{-- </form> --}}
                                            </div>
                                            <div class="col-2 d-flex flex-column align-items-center justify-content-center">
                                                <ul class="list-unstyled d-flex flex-column gap-2 w-100">
                                                    <li class="w-100"><a href="{{ route('case.invoice', $data->task->id) }}"
                                                            class="btn btn-sm btn-info px-3 d-flex align-items-center justify-content-center py-2">
                                                            <i class="bx fs-16 bx-receipt"></i></a>
                                                    </li>
                                                    <li class="w-100"><a href="{{ route('case.show', $data->task->id) }}"
                                                            class="btn btn-sm btn-info px-3 d-flex align-items-center justify-content-center py-2">
                                                            <i class="bx fs-16 bx-bullseye"></i></a>
                                                    </li>

                                                    @if ($data->task->payment_status != 1)
                                                        <li class="w-100"><a href="#" data-bs-toggle="modal" data-bs-target="#paymentModal-{{ $data->task->id }}"
                                                                class="btn btn-sm btn-info px-3 d-flex align-items-center justify-content-center py-2"><i
                                                                    class="bx fs-16 bx-euro"></i></a>
                                                        </li>
                                                        <li class="w-100"><a href="#" data-bs-toggle="modal" data-bs-target="#commentsModal-{{ $data->task->id }}"
                                                                class="btn btn-sm btn-info px-3 d-flex align-items-center justify-content-center py-2">
                                                                <i class="bx fs-16 bx-message"></i></a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if (count($data->task->taskPayments) > 0)
                                <div class="card mt-2 mb-2">
                                    <div class="card-body">
                                        <div class="">
                                            <div class="d-flex align-items-start">
                                                <div class="me-2">
                                                    <h5 class="card-title mb-4">Payment Logs</h5>
                                                </div>
                                            </div>
                                            <div data-simplebar="init" class="mt-2 simplebar-scrollable-y">
                                                <div class="simplebar-wrapper">
                                                            {{-- <div class="simplebar-height-auto-observer-wrapper">
                                                        <div class="simplebar-height-auto-observer"></div>
                                                    </div> --}}
                                                            {{-- <div class="simplebar-mask">
                                                        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                                            <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden scroll;">
                                                                <div class="simplebar-content" style="padding: 0px;"> --}}
                                                    <ul class="verti-timeline list-unstyled">
                                                        @foreach ($data->task->taskPayments as $payment)
                                                            <li class="event-list py-0 mb-2">
                                                                <div class="event-timeline-dot">
                                                                    <i class="bx bx-right-arrow-circle"></i>
                                                                </div>
                                                                <div class="d-flex">
                                                                    <div class="flex-shrink-0 me-3">
                                                                        {!! getPayment('via', $payment->via, 'badge') !!}
                                                                        <span class="text-primary">{{ $payment->created_at->format('d M, Y') }}</span>
                                                                    </div>
                                                                    <div class="flex-grow-1">
                                                                        <div>
                                                                            <h5 class="font-size-15"><a href="javascript: void(0);"
                                                                                    class="text-dark">{{ numberFormat($payment->amount, 'euro') }}</a>
                                                                            </h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex">
                                                                    <p>{{ $payment->note }}</p>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                            {{-- </div>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>
                                                {{-- <div class="simplebar-placeholder" style="width: 351px; height: 125px;"></div>
                                            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                                <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                            </div>
                                            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                                <div class="simplebar-scrollbar" style="height: 217px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="card border-0 mb-2">
                                <div class="card-body">
                                    <strong class="fs-16 d-block text-center w-100 mb-1">Custom Budget (€)</strong>
                                    <input type="text" name="service_desired_total"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="form-control"
                                            placeholder="Your Desired Amount"
                                            value="{{ $data->task->service_desired_total }}">
                                </div>
                            </div>

                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="mt-3">
                                        <div class="d-flex align-items-start mb-4">
                                            <div class="flex-grow-1">
                                                <h5 class="card-title mb-4">Comments</h5>
                                            </div>
                                            @if ($data->task->payment_status != 1)
                                                <a href="#" class="badge bg-info font-size-14 flex-shrink-0 " data-bs-toggle="modal"
                                                    data-bs-target="#commentsModal-{{ $data->task->id }}"><i class="bx bx-message"></i>
                                                    Add Comment</a>
                                            @endif
                                        </div>
                                        <div data-simplebar="init" class="simplebar-scrollable-y" style="max-height: 280px;">
                                            <div>
                                                {{--  class="simplebar-wrapper" style="margin: 0px;" --}}
                                                {{-- <div class="simplebar-height-auto-observer-wrapper">
                                            <div class="simplebar-height-auto-observer"></div>
                                        </div>
                                        <div class="simplebar-mask">
                                            <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                                <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden scroll;">
                                                    <div class="simplebar-content" style="padding: 0px;"> --}}
                                                @if (count($data->task->taskComments) > 0)
                                                    @foreach ($data->task->taskComments as $key => $comment)
                                                        {{-- <div class="row mb-2 py-2 border-bottom">
                                                            <div class="col-md-8 col-9">
                                                                <span class="fs-14 d-block mb-4">{{ $comment->comment }}</span>
                                                                <span class="fs-14 d-block mb-1">Added By: {{ $comment->user_id }}</span>
                                                                <span class="fs-14 d-block mb-1">{{ $comment->created_at }}</span>
                                                            </div>
                                                            <div class="col-md-4 col-3">
                                                                {!! getGenStatus('visibility', $comment->type, 'badge') !!}
                                                                <button class="btn d-inline-block w-100 btn-danger mb-2">Public</button>
                                                                <div class="d-flex align-items-center justify-content-center gap-1">
                                                                    <button class="btn btn-sm  rounded btn-primary "><i class="bx bx-edit"></i></button>
                                                                    <button class="btn btn-sm  rounded btn-danger d-inline-block"><i
                                                                            class="bx bx-trash"></i></button>
                                                                    <button class="btn btn-sm  rounded btn-warning d-inline-block"><i
                                                                            class="bx bx-trash"></i></button>
                                                                </div>
                                                            </div>
                                                        </div> --}}



                                                        {{-- <div class="d-flex mb-0"> --}}
                                                            <div class="row"> {{-- mb-2 py-2 border-bottom --}}
                                                                <div class="col-md-9 col-sm-9">

                                                                    <span class="fs-14 d-block mb-4">{{ $comment->comment }}</span>
                                                                    <span class="fs-14 d-block mb-1">Added By: {{ $comment->user->first_name }}</span>
                                                                    <span class="fs-14 d-block mb-1">{{ $comment->created_at }}</span>
                                                                    {{-- <p class="text-muted mb-1 font-size-16">
                                                                        {{ $comment->comment }}
                                                                    </p>
                                                                    <p class="pt-0">Added By:
                                                                        {{ $comment->user_id }}
                                                                        <br>
                                                                        {{ $comment->created_at }}
                                                                    </p> --}}
                                                                </div>
                                                                <div class="col-md-3 col-sm-3">
                                                                    {{--  text-center p-0 editable-btn --}}
                                                                    {!! getGenStatus('visibility', $comment->type, 'badge') !!}
                                                                    <div class="row text-center d-flex justify-content-center mt-2">
                                                                        {{-- <div class="col-md-6">
                                                                            <span class="btn btn-warning font-weight-bold font-size-16 p-1" id="editComment.{{ $comment->id }}">
                                                                                <i class="fa fa-edit"></i>
                                                                            </span>
                                                                            <a href="" class="btn btn-warning btn-xs justify-content-center"><i class="bx bx-edit"></i></a>
                                                                        </div> --}}
                                                                        <div class="col-md-6">
                                                                            <span class="btn btn-warning font-weight-bold p-1" data-bs-toggle="modal" data-bs-target="#editCommentModal-{{ $comment->id }}">
                                                                                <i class="fa fa-edit"></i>
                                                                            </span>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            {{-- <span class="btn btn-danger font-weight-bold p-1" id="deleteComment.{{ $comment->id }}">
                                                                                <i class="fa fa-trash"></i>
                                                                            </span> --}}
                                                                            <span class="btn btn-danger font-weight-bold p-1" data-bs-toggle="modal" data-bs-target="#deleteCommentModal-{{ $comment->id }}">
                                                                                <i class="fa fa-trash"></i>
                                                                            </span>
                                                                            {{-- <a href="" class="btn btn-danger btn-xs justify-content-center"><i class="bx bx-trash"></i></a> --}}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        {{-- </div>
                                                        <hr class="my-1 mb-1 font-size-12 font-weight-bold border-top"> --}}


                                                        <!-- Edit Comment Modal -->
                                                        <div class="modal fade" id="editCommentModal-{{ $comment->id }}" tabindex="-1" aria-labelledby="editCommentModalLabel-{{ $comment->id }}" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="editCommentModalLabel-{{ $comment->id }}">Edit Comment for <b>{{ $data->task->code }}</b></h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <form method="POST" action="{{ route('case.commentUpdate', ['task' => $data->task->id, 'comment_id' => $comment->id]) }}" enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="modal-body">
                                                                            <div>
                                                                                <label for="visibility" class="col-form-label">Status</label>
                                                                                <select id="visibility" name="visibility" class="select2 form-control @error('visibility') is-invalid @enderror" required>
                                                                                    <option value="">Select Status</option>
                                                                                    @foreach (getGenStatus('visibility') as $key => $price)
                                                                                        <option value="{{ ++$key }}" {{ old('visibility', $comment->type) == $key ? 'selected' : '' }}>{{ $price }}</option>
                                                                                    @endforeach
                                                                                    @error('visibility')
                                                                                        <span class="invalid-feedback" role="alert">
                                                                                            <strong>{{ $message }}</strong>
                                                                                        </span>
                                                                                    @enderror
                                                                                </select>
                                                                            </div>

                                                                            <div>
                                                                                <label for="comment" class="col-form-label">Comment</label>
                                                                                <textarea class="form-control" name="comment" placeholder="Edit your comment">{{ $comment->comment }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-warning">Update Comment</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Delete Comment Modal -->
                                                        <div class="modal fade" id="deleteCommentModal-{{ $comment->id }}" tabindex="-1" aria-labelledby="deleteCommentModalLabel-{{ $comment->id }}" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="deleteCommentModalLabel-{{ $comment->id }}">Delete Comment for <b>{{ $data->task->code }}</b></h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <form method="POST" action="{{ route('case.commentDelete', ['task' => $data->task->id, 'comment_id' => $comment->id]) }}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <div class="modal-body">
                                                                            <p>Are you sure you want to <b>Delete</b> this comment?</p>
                                                                            {{-- <textarea class="form-control" readonly>{{ $comment->comment }}</textarea> --}}
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                            <button type="submit" class="btn btn-danger">Delete Comment</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <hr class="draw-line">
                                                    @endforeach
                                                @else
                                                    <p class="text-muted mb-0 text-center">No comment yet.</p>
                                                @endif
                                                {{-- </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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

    <!-- Service Location Modal -->
    <div class="modal fade" id="serviceLocationModal" tabindex="-1" aria-labelledby="serviceLocationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="{{ route('case.customer-info', $data->task->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="serviceLocationModalLabel">Select Service Location</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
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
                            <div class="tab-content text-muted service-location-form" id="form-location-{{ $location->id }}" style="display: none;">
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

                        <div class="">
                            <div>
                                <label for="status" class="col-form-label">Status</label>
                                <select id="user_status" name="status" class="select2 form-control @error('status') is-invalid @enderror" required>
                                    <option value="">Select Status</option>
                                    @foreach (getGenStatus('user') as $key => $stat)
                                        <option value="{{ ++$key }}" {{ old('status', $data->task->customer->status) == $key ? 'selected' : '' }}>{{ $stat }}</option>
                                    @endforeach
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </select>
                            </div>

                            <div>
                                <label for="status_detail" class="col-form-label">Reason for status update</label>
                                <textarea class="form-control" name="status_detail" placeholder="Reason for status update" required>{{ $data->task->customer->status_detail }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Item information Modal -->
    <div class="modal fade" id="itemDetailsModal" tabindex="-1" aria-labelledby="itemDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="{{ route('case.item-info', $data->task->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="itemDetailsModalLabel">Edit Item Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
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
                        <input type="hidden" name="task_id" value="{{ $data->task->id }}">

                        <div class="mt-0">
                            <label for="visibility" class="col-form-label">Visibility</label>
                            <select id="visibility" name="visibility" class="select2 form-control @error('visibility') is-invalid @enderror" required>
                                <option value="">Select Status </option>
                                @foreach (getGenStatus('visibility') as $key => $price)
                                    <option value="{{ ++$key }}" {{ old('visibility') == $key ? 'selected' : '' }}>{{ $price }}</option>
                                @endforeach
                                @error('visibility')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </select>
                        </div>
                        <div>
                            <label for="comment" class="col-form-label">Comment</label>
                            <textarea class="form-control" name="comment" placeholder="Comment" required></textarea>
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

        // Parts Edit Button
        $('#editPartsList').click(function() {
            var $currentSelectedParts = $('#currentSelectedParts');
            var $partsList = $('#partsList');

            // Toggle visibility
            if ($currentSelectedParts.is(':visible')) {
                $currentSelectedParts.hide();
                $partsList.show();
            } else {
                $currentSelectedParts.show();
                $partsList.hide();
            }
        });

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


    .custom-form {
        width: calc(50% - 10px) !important;
    }

    @media (max-widht: 767px) {
        .custom-form {
            width: 100% !important;
        }
    }

    .custom-border11 {
        border: 2px solid #e0e0e0;
        border-radius: 5px;
        padding: 10px;
    }

    .draw-line {
        border: 0;
        border-top: 3px solid #e0e0e0;
        width: 100%;
    }


.right_side {
  padding-top: 0px;
}
@media (min-width: 1000px) {
  .right_side {
    // padding-top: 270px;
  }
}

.fixed-div {
  position: relative;
  width: 100%;
}
@media (min-width: 1000px) {
  .fixed-div {
    width: 20.25%;
    position: fixed;
    top: 136px;
    z-index: 9999;
    right: 23px;
  }
}

.btn-xs {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
  width: 20px;
  height: 20px;
  margin: 0 2px;
}
@media (min-width: 768px) {
  .btn-xs {
    width: 24px;
    height: 24px;
  }
}

.editable-btn .badge {
  margin-bottom: 2px;
}

.custom-border {
  border: 3px solid #eff2f7;
  border-radius: 8px;
}

.column-rgt-border {
  position: relative;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex; /* Ensure alignment is accurate */
  z-index: 1;
}
.column-rgt-border::after {
  content: "";
  position: absolute;
  top: 0;
  right: 0; /* Position the border at the right edge */
  width: 1px; /* Border width */
  height: 100%; /* Full height of the column */
  background-color: #ccc; /* Border color */
  z-index: -1;
  visibility: hidden;
  opacity: 0;
}
@media (min-width: 768px) {
  .column-rgt-border::after {
    visibility: visible;
    opacity: 1;
  }
}

.column-lft-border {
  position: relative;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex; /* Ensure alignment is accurate */
  z-index: 1;
}
.column-lft-border::after {
  content: "";
  position: absolute;
  top: 0;
  left: 0; /* Position the border at the right edge */
  width: 1px; /* Border width */
  height: 100%; /* Full height of the column */
  background-color: #ccc; /* Border color */
  z-index: -1;
  visibility: hidden;
  opacity: 0;
}
.scroll-y {
    max-height: 300px;
    overflow-y: auto;
    scrollbar-width: thin;
}

@media (min-width: 768px) {
  .column-lft-border::after {
    visibility: visible;
    opacity: 1;
  }
}
</style>
