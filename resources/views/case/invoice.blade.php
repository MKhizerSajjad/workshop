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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Case</a></li>
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
                                <h4 class="float-end font-size-16">Order # {{$task->code}}</h4>
                                <div class="auth-logo mb-4">
                                    <img src="{{ asset('images/logo.png') }}" alt="logo" class="auth-logo-dark" height="40"/>
                                    <img src="{{ asset('images/logo.png') }}" alt="logo" class="auth-logo-light" height="40"/>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <address>
                                        <strong>Servisas - FabiRide:</strong><br>
                                        Technikas g. 7, Kaunas<br>
                                        <b>Email: </b> servisas@fabiride.com<br>
                                        <b>Phone: </b> +370 60415255<br>
                                        Springfield, ST 54321
                                    </address>
                                </div>
                                <div class="col-sm-6 text-sm-end">
                                    <address class="mt-2 mt-sm-0">
                                        <strong>Customer:</strong><br>
                                        {{$task->customer->first_name}} {{$task->customer->last_name}}<br>
                                        <b>Phone: </b>{{$task->customer->phone}} <br>
                                        <b>Address: </b>{{$task->customer->address}}<br>
                                        {{$task->customer->city}}<br>
                                        {{$task->customer->country}}
                                    </address>
                                </div>
                            </div>
                            <div class="row">
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
                            </div>
                            <div class="py-2 mt-3">
                                <h3 class="font-size-15 fw-bold">Order summary</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-nowrap">
                                    <thead>
                                        <tr>
                                            <th style="width: 70px;">No.</th>
                                            <th>Item</th>
                                            <th class="text-end">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>01</td>
                                            <td>Skote - Admin Dashboard Template</td>
                                            <td class="text-end">$499.00</td>
                                        </tr>

                                        <tr>
                                            <td>02</td>
                                            <td>Skote - Landing Template</td>
                                            <td class="text-end">$399.00</td>
                                        </tr>

                                        <tr>
                                            <td>03</td>
                                            <td>Veltrix - Admin Dashboard Template</td>
                                            <td class="text-end">$499.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-end">Sub Total</td>
                                            <td class="text-end">$1397.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="border-0 text-end">
                                                <strong>Shipping</strong></td>
                                            <td class="border-0 text-end">$13.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="border-0 text-end">
                                                <strong>Total</strong></td>
                                            <td class="border-0 text-end"><h4 class="m-0">$1410.00</h4></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-print-none">
                                <div class="float-end">
                                    <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></a>
                                    <a href="javascript: void(0);" class="btn btn-primary w-md waves-effect waves-light">Send</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- container-fluid -->
    </div>
@endsection
