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
                // Check if $data[type] is not null
                $taxData = $data['tax'] ?? ['type' => 'tax', 'data' => [['name' => '', 'percentage' => '', 'tax_status' => '']]];
                $termsData = $data['term'] ?? ['type' => 'term', 'data' => [['title' => '', 'link' => '', 'status' => '']]];
                // Check if 'data' is a JSON string that needs to be decoded
                if (is_string($taxData['data'])) {
                    $taxDecodedData = json_decode($taxData['data'], true); // true to get an associative array
                } else {
                    $taxDecodedData = $termsData['data']; // If 'data' is already an array or object
                }
                // Check if 'data' is a JSON string that needs to be decoded
                if (is_string($termsData['data'])) {
                    $termDecodedData = json_decode($termsData['data'], true); // true to get an associative array
                } else {
                    $termDecodedData = $termsData['data']; // If 'data' is already an array or object
                }
            @endphp

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
                                        <div class="col-12 mb-5">
                                            <div data-repeater-list="group-a">
                                                <!-- Initial template for a single row -->
                                                <div class="row">
                                                    <div class="mb-3 col-lg-4">
                                                        <label for="tax_name">Name</label>
                                                    </div>
                                                    <div class="mb-3 col-lg-4">
                                                        <label for="percentage">Percentage (%)</label>
                                                    </div>
                                                    <div class="mb-3 col-lg-3">
                                                        <label for="tax_status">Status</label>
                                                    </div>
                                                    <div class="mb-3 col-lg-1">
                                                    </div>
                                                </div>

                                                @foreach ($taxDecodedData as $tax)
                                                    <div data-repeater-item class="row taxTemplateRow">
                                                        <div class="mb-3 col-lg-4">
                                                            <input type="text" name="name[]" class="form-control name @error('name.*') is-invalid @enderror" placeholder="Enter Name" value="{{ $tax['name'] }}">
                                                            @error('name.*')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3 col-lg-4">
                                                            <input type="text" name="percentage[]" class="form-control percentage @error('percentage.*') is-invalid @enderror" placeholder="Enter Place Holder" value="{{ $tax['percentage'] }}">
                                                            @error('percentage.*')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3 col-lg-3">
                                                            <select id="tax_status" name="tax_status[]" class="form-control @error('tax_status.*') is-invalid @enderror">
                                                                <option value="">Select status </option>
                                                                @foreach (getGenStatus('general') as $key => $status)
                                                                    <option value="{{ ++$key }}" @if($key == $tax['tax_status']) selected @endif>{{ $status }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('tax_status.*')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-lg-1">
                                                            <button type="button" class="btn btn-danger tax-remove-btn">
                                                                <i class="bx bx-minus-circle me-1"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <!-- Button to add new rows -->
                                            <div class="row">
                                                <div class="col-lg-1 offset-lg-11">
                                                    <button type="button" class="btn btn-success tax-add-btn text-bold">
                                                        <i class="bx bx-plus-circle me-1"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end gap-2" bis_skin_checked="1">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light w-10">Update Tax</button>
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
                                        <div class="col-12 mb-5">
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
                                                        <label for="type">Status</label>
                                                    </div>
                                                    <div class="mb-3 col-lg-1">
                                                    </div>
                                                </div>
                                                @foreach ($termDecodedData as $term)
                                                    <div data-repeater-item class="row termTemplateRow">
                                                        <div class="mb-3 col-lg-4">
                                                            <input type="text" name="title[]" class="form-control title @error('title.*') is-invalid @enderror" placeholder="Enter title" value="{{ $term['title'] }}">
                                                            @error('title.*')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3 col-lg-4">
                                                            <input type="text" name="link[]" class="form-control link @error('link.*') is-invalid @enderror" placeholder="Enter Place Holder" value="{{ $term['link'] }}">
                                                            @error('link.*')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3 col-lg-3">
                                                            <select id="term_status" name="status[]" class="form-control @error('status.*') is-invalid @enderror">
                                                                <option value="">Select Status </option>
                                                                @foreach (getGenStatus('general') as $key => $status)
                                                                    <option value="{{ ++$key }}" @if($key == $term['status']) selected @endif>{{ $status }}</option>
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
                                        <button type="submit" class="btn btn-primary waves-effect waves-light w-10">Update Terms</button>
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
                removetermRow(row);
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
