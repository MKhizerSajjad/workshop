@extends('layouts.app')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- Start Page Title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Settings</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class=""><a href="javascript:void(0);">Settings</a></li>
                            <li class="mx-1"><a href="javascript:void(0);"> > </a></li>
                            <li class="breadcrumb-item active">Settings List</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Title -->

        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-border-left alert-dismissible fade show auto-close-3" role="alert">
            <i class="ri-check-double-line me-3 align-middle fs-16"></i><strong>Success! </strong>
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @php
            $businessData = json_decode($data['business_information']['data'] ?? '{}', true);
            $emailData = json_decode($data['email_settings']['data'] ?? '{}', true);
            $taxData = json_decode($data['tax']['data'] ?? '[]', true);
            $termsData = json_decode($data['term']['data'] ?? '[]', true);
        @endphp

        <div class="row">
            <!-- Business Information -->
            <div class="col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Business Information</h4>
                        <form method="POST" action="{{ route('setting.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="type" value="business_information">
                            <div class="mb-3">
                                <label for="company_name">Company Name</label>
                                <input type="text" name="company_name" class="form-control" value="{{ $businessData['company_name'] ?? '' }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="company_email">Company Email</label>
                                <input type="email" name="company_email" class="form-control" value="{{ $businessData['company_email'] ?? '' }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="company_phone">Company Phone</label>
                                <input type="text" name="company_phone" class="form-control" value="{{ $businessData['company_phone'] ?? '' }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="company_website">Company Website</label>
                                <input type="url" name="company_website" class="form-control" value="{{ $businessData['company_website'] ?? '' }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="company_address">Company Address</label>
                                <input type="text" name="company_address" class="form-control" value="{{ $businessData['company_address'] ?? '' }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="working_days">Working Days</label>
                                <select name="working_days[]" class="form-control" multiple required>
                                    @foreach (['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $day)
                                        <option value="{{ $day }}" @if(in_array($day, $businessData['working_days'])) selected @endif>{{ $day }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="working_hours">Working Hours</label>
                                <div class="d-flex">
                                    <input type="time" name="working_hours[start]" class="form-control me-2" value="{{ $businessData['working_hours']['start'] }}" required>
                                    <input type="time" name="working_hours[end]" class="form-control" value="{{ $businessData['working_hours']['end'] }}" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="logo">Logo</label>
                                <input type="file" name="logo" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="favicon">Favicon</label>
                                <input type="file" name="favicon" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light w-100">Update Business Information</button>
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
                            <div class="mb-3">
                                <label for="mail_mailer">Mailer</label>
                                <input type="text" name="mail_mailer" class="form-control" value="{{ $emailData['mail_mailer'] ?? '' }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="mail_host">Host</label>
                                <input type="text" name="mail_host" class="form-control" value="{{ $emailData['mail_host'] ?? '' }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="mail_port">Port</label>
                                <input type="number" name="mail_port" class="form-control" value="{{ $emailData['mail_port'] ?? '' }}" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="mail_encryption">Encryption</label>
                                <input type="text" name="mail_encryption" class="form-control" value="{{ $emailData['mail_encryption'] }}" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="mail_from_address">From Address</label>
                                <input type="text" name="mail_from_address" class="form-control" value="{{ $emailData['mail_from_address'] }}" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="mail_from_name">From Name</label>
                                <input type="text" name="mail_from_name" class="form-control" value="{{ $emailData['mail_from_name'] }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="mail_username">Username</label>
                                <input type="text" name="mail_username" class="form-control" value="{{ $emailData['mail_username'] ?? '' }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="mail_password">Password</label>
                                <input type="password" name="mail_password" class="form-control" value="{{ $emailData['mail_password'] ?? '' }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light w-100">Update Email Settings</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dynamic Forms (Tax & Terms) -->
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tax Settings</h4>
                        <form method="POST" action="{{ route('setting.store') }}">
                            @csrf
                            <input type="hidden" name="type" value="tax">
                            <!-- Titles Row -->
                            <div class="d-flex align-items-center mb-2 fw-bold">
                                <div class="me-2" style="width: 33%;">Tax Name</div>
                                <div class="me-2" style="width: 33%;">Percentage</div>
                                <div class="me-2" style="width: 33%;">Status</div>
                            </div>
                            <div id="tax-container">
                                @foreach ($taxData as $tax)
                                <div class="d-flex align-items-center tax-row mb-2">
                                    <input type="text" name="name[]" class="form-control me-2" value="{{ $tax['name'] ?? '' }}" placeholder="Tax Name" required>
                                    <input type="number" name="percentage[]" class="form-control me-2" value="{{ $tax['percentage'] ?? '' }}" placeholder="Percentage" required>
                                    <select id="statusTax" name="status[]" class="form-control me-2" required>
                                        <option value="">Select Option </option>
                                        @foreach (getGenStatus('bool') as $key => $status)
                                            <option value="{{ ++$key }}" @if($key == $tax['status']) selected @endif>{{ $status }}</option>
                                        @endforeach
                                    </select>
                                    {{-- <button type="button" class="btn btn-danger btn-remove-tax">
                                        <i class="bx bx-plus-circle me-1"></i>
                                    </button> --}}
                                </div>
                                @endforeach
                            </div>
                            {{-- <div class="d-flex justify-content-end">
                                <button type="button" id="btn-add-tax" class="btn btn-success">
                                    <i class="bx bx-plus-circle me-1"></i>
                                </button>
                            </div> --}}
                            <button type="submit" class="btn btn-primary mt-3 w-100">Update Tax</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Terms</h4>
                        <form method="POST" action="{{ route('setting.store') }}">
                            @csrf
                            <input type="hidden" name="type" value="term">
                            <!-- Titles Row -->
                            <div class="d-flex align-items-center mb-2 fw-bold">
                                <div class="me-2" style="width: 30%;">Title</div>
                                <div class="me-2" style="width: 30%;">Link</div>
                                <div class="me-2" style="width: 30%;">Required</div>
                            </div>
                            <div id="terms-container">
                                @foreach ($termsData as $term)
                                <div class="d-flex align-items-center terms-row mb-2">
                                    <input type="text" name="title[]" class="form-control me-2" value="{{ $term['title'] ?? '' }}" placeholder="Title" required>
                                    <input type="text" name="link[]" class="form-control me-2" value="{{ $term['link'] ?? '' }}" placeholder="Link" required>
                                    <select id="is_required" name="is_required[]" class="form-control me-2" required>
                                        <option value="">Select Option </option>
                                        @foreach (getGenStatus('bool') as $key => $status)
                                            <option value="{{ ++$key }}" @if($key == $term['is_required']) selected @endif>{{ $status }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-danger btn-remove-terms">
                                        <i class="bx bx-minus-circle me-1"></i>
                                    </button>
                                </div>
                                @endforeach
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" id="btn-add-terms" class="btn btn-success ">
                                    <i class="bx bx-plus-circle me-1"></i>
                                </button>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3 w-100">Update Terms</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Add Tax Row
        $('#btn-add-tax').on('click', function () {
            $('#tax-container').append(`
                <div class="d-flex align-items-center tax-row mb-2">
                    <input type="text" name="name[]" class="form-control me-2" placeholder="Tax Name" required>
                    <input type="number" name="percentage[]" class="form-control me-2" placeholder="Percentage" required>
                    <select id="status" name="status[]" class="form-control me-2" required>
                        <option value="">Select Option </option>
                        @foreach (getGenStatus('bool') as $key => $status)
                            <option value="{{ ++$key }}">{{ $status }}</option>
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-danger btn-remove-tax">
                        <i class="bx bx-plus-circle me-1"></i>
                    </button>
                </div>
            `);
        });

        // Remove Tax Row
        $(document).on('click', '.btn-remove-tax', function () {
            $(this).closest('.tax-row').remove();
        });

        // Add Terms Row
        $('#btn-add-terms').on('click', function () {
            $('#terms-container').append(`
                <div class="d-flex align-items-center terms-row mb-2">
                    <input type="text" name="title[]" class="form-control me-2" placeholder="Title" required>
                    <input type="text" name="link[]" class="form-control me-2" placeholder="Link" required>
                    <select id="is_required" name="is_required[]" class="form-control me-2" required>
                        <option value="">Select Option </option>
                        @foreach (getGenStatus('bool') as $key => $status)
                            <option value="{{ ++$key }}" @if($key == $term['is_required']) selected @endif>{{ $status }}</option>
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-danger btn-remove-terms">
                        <i class="bx bx-minus-circle me-1"></i>
                    </button>
                </div>
            `);
        });

        // Remove Terms Row
        $(document).on('click', '.btn-remove-terms', function () {
            $(this).closest('.terms-row').remove();
        });
    });
</script>
@endsection
