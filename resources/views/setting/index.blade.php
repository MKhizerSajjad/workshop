@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Settings</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class=""><a href="javascript: void(0);">Settings</a></li>
                                <li class="mx-1"><a href="javascript: void(0);"> > </a></li>
                                <li class="breadcrumb-item active">Settings List</li>
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

            @php

                // Decode the JSON data for new settings
                $businessData = json_decode($data['business_information']['data'], true);
                $emailData = json_decode($data['email_settings']['data'], true);
                $paymentData = json_decode($data['payments']['data'], true);

                // Check if $data[type] is not null
                $taxData = $data['tax'] ?? ['type' => 'tax', 'data' => [['name' => '', 'percentage' => '', 'status' => '']]];
                $termsData = $data['term'] ?? ['type' => 'term', 'data' => [['title' => '', 'link' => '', 'is_required' => '']]];
                // Check if 'data' is a JSON string that needs to be decoded
                if (is_string($taxData['data'])) {
                    $taxDecodedData = json_decode($taxData['data'], true); // true to get an associative array
                } else {
                    $taxDecodedData = $taxData['data']; // If 'data' is already an array or object
                }
                // Check if 'data' is a JSON string that needs to be decoded
                if (is_string($termsData['data'])) {
                    $termDecodedData = json_decode($termsData['data'], true); // true to get an associative array
                } else {
                    $termDecodedData = $termsData['data']; // If 'data' is already an array or object
                }
            @endphp

            <div class="row">
                <!-- Business Information -->
                <div class="col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Business Information</h4>
                            <form method="POST" action="{{ route('setting.store') }}">
                                @csrf
                                <input type="hidden" name="type" value="business_information">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label for="company_name">Company Name</label>
                                        <input type="text" name="company_name" class="form-control" value="{{ $businessData['company_name'] }}" required>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="company_phone">Company Phone</label>
                                        <input type="text" name="company_phone" class="form-control" value="{{ $businessData['company_phone'] }}" required>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="company_address">Company Address</label>
                                        <input type="text" name="company_address" class="form-control" value="{{ $businessData['company_address'] }}" required>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="working_days">Working Days</label>
                                        <select name="working_days[]" class="form-control" multiple required>
                                            @foreach (['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $day)
                                                <option value="{{ $day }}" @if(in_array($day, $businessData['working_days'])) selected @endif>{{ $day }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="working_hours">Working Hours</label>
                                        <div class="d-flex">
                                            <input type="time" name="working_hours[start]" class="form-control me-2" value="{{ $businessData['working_hours']['start'] }}" required>
                                            <input type="time" name="working_hours[end]" class="form-control" value="{{ $businessData['working_hours']['end'] }}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="logo">Logo</label>
                                        <input type="file" name="logo" class="form-control">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="favicon">Favicon</label>
                                        <input type="file" name="favicon" class="form-control">
                                    </div>
                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light w-100">Update Business Information</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Email Settings -->
                <div class="col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Email Settings</h4>
                            <form method="POST" action="{{ route('setting.store') }}">
                                @csrf
                                <input type="hidden" name="type" value="email_settings">
                                <div class="row">
                                    @foreach ($emailData as $email)
                                        <div class="col-12 mb-3">
                                            <label for="mail_mailer">Mailer</label>
                                            <input type="text" name="mail_mailer" class="form-control" value="{{ $email['mail_mailer'] }}" required>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="mail_host">Host</label>
                                            <input type="text" name="mail_host" class="form-control" value="{{ $email['mail_host'] }}" required>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="mail_port">Port</label>
                                            <input type="number" name="mail_port" class="form-control" value="{{ $email['mail_port'] }}" required>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="mail_username">Username</label>
                                            <input type="text" name="mail_username" class="form-control" value="{{ $email['mail_username'] }}" required>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="mail_password">Password</label>
                                            <input type="password" name="mail_password" class="form-control" value="{{ $email['mail_password'] }}" required>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="mail_encryption">Encryption</label>
                                            <input type="text" name="mail_encryption" class="form-control" value="{{ $email['mail_encryption'] }}" required>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="mail_from_address">From Address</label>
                                            <input type="text" name="mail_from_address" class="form-control" value="{{ $email['mail_from_address'] }}" required>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="mail_from_name">From Name</label>
                                            <input type="text" name="mail_from_name" class="form-control" value="{{ $email['mail_from_name'] }}" required>
                                        </div>
                                    @endforeach
                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light w-100">Update Email Settings</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Payments Settings -->
                {{-- <div class="col-md-4 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Payments Settings</h4>
                            <form method="POST" action="{{ route('setting.store') }}">
                                @csrf
                                <input type="hidden" name="type" value="payments">
                                <div class="row">
                                    <div class="col-12 mt-3">
                                        <label for="stripe_enabled">Stripe Enabled</label>
                                        <input type="checkbox" name="stripe_enabled" id="stripe_enabled" @if($paymentData[0]['stripe']['enabled']) checked @endif>
                                    </div>

                                    <div class="col-12" id="stripe_input_field" style="display: none;">
                                        <input type="text" name="stripe_key" id="stripe_key" class="form-control" placeholder="Enter your Stripe key" required>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <label for="paypal_enabled">PayPal Enabled</label>
                                        <input type="checkbox" name="paypal_enabled" id="paypal_enabled" @if($paymentData[0]['paypal']['enabled']) checked @endif>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label for="cash_payment_enabled">Cash Payment Enabled</label>
                                        <input type="checkbox" name="cash_payment_enabled" id="cash_payment_enabled" @if($paymentData[0]['cash_payment_enabled']) checked @endif>
                                    </div>
                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light w-100">Update Payments Settings</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> --}}
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Tax</h4>
                            {{-- <p class="card-title-desc">Fill all information below</p> --}}
                            <form method="POST" action="{{ route('setting.store') }}">
                                @csrf
                                <input type="hidden" name="type" value="tax">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <div data-repeater-list="group-a">
                                                <!-- Initial template for a single row -->
                                                <div class="row">
                                                    <div class="mb-3 col-lg-4">
                                                        <label for="tax_name">Name</label>
                                                    </div>
                                                    <div class="mb-3 col-lg-4">
                                                        <label for="percentage">Percentage (%)</label>
                                                    </div>
                                                    <div class="mb-3 col-lg-4">
                                                        <label for="status">Status</label>
                                                    </div>
                                                    {{-- <div class="mb-3 col-lg-1">
                                                    </div> --}}
                                                </div>

                                                @foreach ($taxDecodedData as $tax)
                                                    <div data-repeater-item class="row taxTemplateRow">
                                                        <div class="mb-3 col-lg-4">
                                                            <input type="text" name="name[]" class="form-control name @error('name.*') is-invalid @enderror" placeholder="Enter Name" value="{{ $tax['name'] }}" required readonly>
                                                            @error('name.*')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3 col-lg-4">
                                                            <input type="text" name="percentage[]" class="form-control percentage @error('percentage.*') is-invalid @enderror" placeholder="Enter Place Holder" value="{{ $tax['percentage'] }}" required>
                                                            @error('percentage.*')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3 col-lg-4">
                                                            <select id="tax_status" name="status[]" class="form-control @error('status.*') is-invalid @enderror" required readonly>
                                                                <option value="">Select status </option>
                                                                @foreach (getGenStatus('general') as $key => $status)
                                                                    <option value="{{ ++$key }}" @if($key == $tax['status']) selected @endif>{{ $status }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('status.*')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        {{-- <div class="col-lg-1">
                                                            <button type="button" class="btn btn-danger tax-remove-btn">
                                                                <i class="bx bx-minus-circle me-1"></i>
                                                            </button>
                                                        </div> --}}
                                                    </div>
                                                @endforeach
                                            </div>
                                            <!-- Button to add new rows -->
                                            {{-- <div class="row">
                                                <div class="col-lg-1 offset-lg-11">
                                                    <button type="button" class="btn btn-success tax-add-btn text-bold">
                                                        <i class="bx bx-plus-circle me-1"></i>
                                                    </button>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end gap-2" bis_skin_checked="1">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light w-100">Update Tax</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Terms</h4>
                            {{-- <p class="card-title-desc">Fill all information below</p> --}}
                            <form method="POST" action="{{ route('setting.store') }}">
                                @csrf
                                <input type="hidden" name="type" value="term">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <div data-repeater-list="group-b">
                                                <!-- Initial template for a single row -->
                                                <div class="row">
                                                    <div class="mb-3 col-lg-4">
                                                        <label for="title">Title</label>
                                                    </div>
                                                    <div class="mb-3 col-lg-4">
                                                        <label for="link">Link</label>
                                                    </div>
                                                    <div class="mb-3 col-lg-3">
                                                        <label for="required">Required</label>
                                                    </div>
                                                    <div class="mb-3 col-lg-1">
                                                    </div>
                                                </div>
                                                @foreach ($termDecodedData as $term)
                                                    <div data-repeater-item class="row termTemplateRow">
                                                        <div class="mb-3 col-lg-4">
                                                            <input type="text" name="title[]" class="form-control title @error('title.*') is-invalid @enderror" placeholder="Enter title" value="{{ $term['title'] }}" required>
                                                            @error('title.*')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3 col-lg-4">
                                                            <input type="text" name="link[]" class="form-control link @error('link.*') is-invalid @enderror" placeholder="Enter Place Holder" value="{{ $term['link'] }}" required>
                                                            @error('link.*')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3 col-lg-3">
                                                            <select id="is_required" name="is_required[]" class="form-control @error('is_required.*') is-invalid @enderror" required>
                                                                <option value="">Select Option </option>
                                                                @foreach (getGenStatus('bool') as $key => $status)
                                                                    <option value="{{ ++$key }}" @if($key == $term['is_required']) selected @endif>{{ $status }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('type.*')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-lg-1">
                                                            <button type="button" class="btn btn-danger term-remove-btn">
                                                                <i class="bx bx-minus-circle me-1"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <!-- Button to add new rows -->
                                            <div class="row">
                                                <div class="col-lg-1 offset-lg-11">
                                                    <button type="button" class="btn btn-success term-add-btn text-bold">
                                                        <i class="bx bx-plus-circle me-1"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end gap-2" bis_skin_checked="1">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light w-100">Update Terms</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {


        // **** Strip Checkbox ****
        // Get the checkbox and input field elements
        const checkbox = document.getElementById('stripe_enabled');
        const inputField = document.getElementById('stripe_input_field');
        const stripeKeyInput = document.getElementById('stripe_key');

        // Function to handle checkbox state change
        function toggleStripeInput() {
            if (checkbox.checked) {
                // Show the input field and make it required
                inputField.style.display = 'block';
                stripeKeyInput.required = true;
            } else {
                // Hide the input field and remove the required validation
                inputField.style.display = 'none';
                stripeKeyInput.required = false;
            }
        }

        // Add event listener to handle checkbox change
        checkbox.addEventListener('change', toggleStripeInput);

        // Run the function initially in case the checkbox is already checked
        toggleStripeInput();


        // Function to duplicate a row
        function duplicateTaxRow() {
            var template = $('.taxTemplateRow').first().clone();
            template.find('input[type="text"]').val(''); // Clear input values
            template.find('input[type="number"]').val(''); // Clear input values
            template.appendTo('[data-repeater-list="group-a"]');
            taxBindRowEvents(template); // Bind events to new row
        }

        // Function to bind events to a row
        function taxBindRowEvents(row) {
            row.find('.tax-remove-btn').on('click', function() {
                removeTaxRow(row);
            });
        }

        // Function to remove a specific row
        function removeTaxRow(row) {
            row.remove();
        }
        // Event listener for adding new row
        $('.tax-add-btn').on('click', function() {
            duplicateTaxRow();
        });

        // Initial event binding for the first row
        taxBindRowEvents($('.taxTemplateRow'));



        // Function to duplicate a row
        function duplicateTermRow() {
            var template = $('.termTemplateRow').first().clone();
            template.find('input[type="text"]').val(''); // Clear input values
            template.find('input[type="number"]').val(''); // Clear input values
            template.appendTo('[data-repeater-list="group-b"]');
            termBindRowEvents(template); // Bind events to new row
        }

        // Function to bind events to a row
        function termBindRowEvents(row) {
            row.find('.term-remove-btn').on('click', function() {
                removetermRow($(this).closest('.termTemplateRow'));
            });
        }

        // Function to remove a specific row
        function removetermRow(row) {
            row.remove();
        }
        // Event listener for adding new row
        $('.term-add-btn').on('click', function() {
            duplicateTermRow();
        });

        // Initial event binding for the first row
        termBindRowEvents($('.termTemplateRow'));

    });
</script>
