@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Invoice</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="">Case</a></li>
                                <li class="mx-1"><a href="javascript: void(0);"> > </a></li>
                                <li class="breadcrumb-item active">Invoice</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="invoice-title">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="auth-logo mb-4">
                                            <img src="{{ asset('images/logo.png') }}" alt="logo" class="auth-logo-dark" height="60"/>
                                            <img src="{{ asset('images/logo.png') }}" alt="logo" class="auth-logo-light" height="60"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 text-sm-end">
                                        <h4 class="float-end font-size-16">Order # {{$task->code}}</h4><br><br>
                                        <strong>Payment Status: </strong>{!! getPayment('status', $task->payment_status, 'badge') !!}<br>
                                        <strong>Order Status: </strong>{!! getCaseStatus('general', $task->status, 'badge') !!}<br>
                                        <strong>Opened Date: </strong> {{ date('D d M Y', strtotime($task->date_opened)) }}<br>
                                        @if (!empty($task->date_closed))
                                            <strong>Completed Date: </strong> {{ date('D d M Y', strtotime($task->date_closed)) }}<br>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <address>
                                        <strong>Servisas - FabiRide:</strong><br><br>
                                        Technikas g. 7, Kaunas<br>
                                        <b>Email: </b> servisas@fabiride.com<br>
                                        <b>Phone: </b> +370 60415255<br>
                                        Springfield, ST 54321
                                    </address>
                                </div>
                                <div class="col-sm-6 text-sm-end">
                                    <address class="mt-2 mt-sm-0">
                                        <strong>Customer:</strong><br>
                                        <b>Name: </b>{{$task->customer->first_name}} {{$task->customer->last_name}}<br>
                                        <b>Phone: </b>{{$task->customer->phone}} <br>
                                        <b>Email: </b>{{$task->customer->email}} <br>
                                        <b>Company: </b>{{$task->customer->company}} <br>
                                        <b>Address: </b>{{$task->customer->address}}<br>
                                        {{$task->customer->city}}, {{$task->customer->country}}
                                    </address>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-sm-6 mt-3">
                                    <address>
                                        <strong>Payment Status: </strong>{!! getPayment('status', $task->payment_status, 'badge') !!}<br>
                                        <strong>Order Status: </strong>{!! getCaseStatus('general', $task->status, 'badge') !!}<br>
                                    </address>
                                </div>
                                <div class="col-sm-6 mt-3 text-sm-end">
                                    <address>
                                        <strong>Opened Date: </strong> {{ date('D d M Y', strtotime($task->date_opened)) }}<br>
                                        @if (!empty($task->date_closed))
                                            <strong>Completed Date: </strong> {{ date('D d M Y', strtotime($task->date_closed)) }}<br>
                                        @endif
                                    </address>
                                </div>
                            </div> --}}
                            <div class="py-2 mt-1">
                                <h3 class="font-size-15 fw-bold">Item Details</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-nowrap">
                                    <thead>
                                        <tr>
                                            <th style="width: 70px;">Item</th>
                                            <th>Manufacturer</th>
                                            <th>Color</th>
                                            <th>Model</th>
                                            <th>Year</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $task->item->name }}</td>
                                            <td>{{ $task->manufacturer }}</td>
                                            <td>{{ $task->color }}</td>
                                            <td>{{ $task->model }}</td>
                                            <td>{{ $task->year }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="py-2 mt-1">
                                        <h3 class="font-size-15 fw-bold">Description of Problem / Failure</h3>
                                        <p>{{ $task->problem_description }}aada</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="py-2 mt-1">
                                        <h3 class="font-size-15 fw-bold">Additional Information</h3>
                                        <p>{{ $task->additional_info }}</p>
                                    </div>
                                </div>
                            </div>

                            @php
                                $total_service_tax = 0;
                                $total_service_price = 0;
                                $total_product_tax = 0;
                                $total_product_price = 0;
                            @endphp

                            <div class="py-2 mt-1">
                                <h3 class="font-size-15 fw-bold">Services</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Comment</th>
                                            <th style="width: 50px;">Qty</th>
                                            <th style="width: 70px;">Unit Price</th>
                                            <th style="width: 50px;">Tax (%)</th>
                                            <th class="text-end">Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($task->taskServices as $service)
                                            @php
                                                $service->qty;
                                                $service->unit_price;
                                                $service->tax_perc;
                                                $unit_tax = ($service->tax_perc * $service->unit_price) / 100;
                                                $price = $service->qty * $service->unit_price;
                                                $tax = $service->qty * $service->unit_tax;
                                                $service_price = $price + $tax;
                                                $total_service_price = $total_service_price + $service_price;
                                                $total_service_tax = $total_service_tax + $tax;
                                            @endphp
                                            <tr>
                                                <td>{{ $service->service->name }}</td>
                                                <td>{{ $service->comment }}</td>
                                                <td>{{ $service->qty }}</td>
                                                <td>{{ $service->unit_price }}</td>
                                                <td>{{ $service->tax_perc }}</td>
                                                <td class="text-end">{{ $service_price }}</td>
                                            </tr>
                                        @endforeach

                                        <tr>
                                            <td colspan="5" class="text-end">Services Total</td>
                                            <td class="text-end">{{ $total_service_price }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="py-2 mt-1">
                                <h3 class="font-size-15 fw-bold">Parts</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th style="width: 50px;">Qty</th>
                                            <th style="width: 70px;">Unit Price</th>
                                            <th style="width: 50px;">Tax (%)</th>
                                            <th class="text-end">Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($task->taskProducts as $product)
                                            @php
                                                $product->qty;
                                                $product->unit_price;
                                                $product->tax_perc;
                                                $unit_tax = ($product->tax_perc * $product->unit_price) / 100;
                                                $price = $product->qty * $product->unit_price;
                                                $tax = $product->qty * $product->unit_tax;
                                                $product_price = $price + $tax;
                                                $total_product_price = $total_product_price + $product_price;
                                                $total_product_tax = $total_product_tax + $tax;
                                            @endphp
                                            <tr>
                                                <td>{{ $product->name ?? $product->product->name }}</td>
                                                <td>{{ $product->qty }}</td>
                                                <td>{{ $product->unit_price }}</td>
                                                <td>{{ $product->tax_perc }}</td>
                                                <td class="text-end">{{ $product_price }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="4" class="text-end">Parts Total</td>
                                            <td class="text-end">{{ $total_product_price }}</td>
                                        </tr>
                                        <hr>
                                        <tr>
                                            <td colspan="4" class="border-0 text-end">
                                                <strong>Tax Total</strong></td>
                                            <td class="border-0 text-end">{{ $total_service_tax + $total_product_tax }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="border-0 text-end">
                                                <strong>Grand Total</strong></td>
                                            <td class="border-0 text-end"><h4 class="m-0">{{ $total_service_price + $total_product_price }}</h4></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-print-none">
                                <div class="float-end">
                                    <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- container-fluid -->
    </div>
@endsection
