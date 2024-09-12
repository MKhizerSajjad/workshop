@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Service Locations</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class=""><a href="javascript: void(0);">Service Locations</a></li>
                                <li class="mx-1"><a href="javascript: void(0);"> > </a></li>
                                <li class="breadcrumb-item active">Add New</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="mdi mdi-check-all me-2"></i><strong>Success! </strong>
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add New Service Location</h4>
                            {{-- <p class="card-title-desc">Fill all information below</p> --}}
                            <form method="POST" action="{{ route('service-location.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label for="title">Title <span class="text text-danger"> *</span></label>
                                            <input id="title" name="title" type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Title" value="{{ old('title') }}">
                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label for="status">Status <span class="text text-danger"> *</span></label>
                                            <select id="loc_status" name="status" class="form-control @error('status') is-invalid @enderror">
                                                <option value="">Select Status</option>
                                                @foreach (getGenStatus('general') as $key => $status)
                                                    <option value="{{ ++$key }}" {{ old('status') == $status ? 'selected' : '' }}>{{ $status }}</option>
                                                @endforeach
                                            </select>
                                            @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label for="detail">Detail </label>
                                            <textarea id="detail" name="detail" rows="3" class="form-control" placeholder="Detail">{{ old('detail') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mb-5">
                                            <h4 class="card-title mb-4">Input Fields</h4>
                                            <div data-repeater-list="group-a">
                                                <!-- Initial template for a single row -->
                                                <div class="row">
                                                    <div class="mb-3 col-lg-3">
                                                        <label for="name">Input Field Name</label>
                                                    </div>
                                                    <div class="mb-3 col-lg-3">
                                                        <label for="place_holder">Input Field Place Holder</label>
                                                    </div>
                                                    <div class="mb-3 col-lg-3">
                                                        <label for="type">Input Field Type</label>
                                                    </div>
                                                    <div class="mb-3 col-lg-2">
                                                        <label for="is_mandatory">Is Mandatory</label>
                                                    </div>
                                                    <div class="mb-3 col-lg-1"></div>
                                                </div>
                                                @if (!old('name') || (is_array(old('name')) && count(old('name')) == 0))
                                                    <div data-repeater-item class="row templateRow">
                                                        <div class="mb-3 col-lg-3">
                                                            <input type="text" name="name[]" class="form-control @error('name.*') is-invalid @enderror" placeholder="Enter Name" value="{{ old('name.0', '') }}">
                                                            @error('name.*')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3 col-lg-3">
                                                            <input type="text" name="place_holder[]" class="form-control @error('place_holder.*') is-invalid @enderror" placeholder="Enter Place Holder" value="{{ old('place_holder.0', '') }}">
                                                            @error('place_holder.*')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3 col-lg-3">
                                                            <select name="type[]" class="form-control @error('type.*') is-invalid @enderror">
                                                                <option value="">Select Field Type</option>
                                                                @foreach (getFields('types') as $key => $status)
                                                                    <option value="{{ $status }}" {{ old('type.0') == $status ? 'selected' : '' }}>{{ $status }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('type.*')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3 col-lg-2">
                                                            <select name="is_mandatory[]" class="form-control @error('is_mandatory.*') is-invalid @enderror">
                                                                <option value="">Is Input Mandatory?</option>
                                                                @foreach (getGenStatus('bool') as $key => $status)
                                                                    <option value="{{ ++$key }}" {{ old('is_mandatory.0') == $key ? 'selected' : '' }}>{{ $status }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('is_mandatory.*')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-lg-1">
                                                            <button type="button" class="btn btn-danger remove-btn">
                                                                <i class="bx bx-minus-circle me-1"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endif

                                                <!-- Loop through existing rows -->
                                                @if (old('name') && count(old('name')) > 0)
                                                    @foreach(old('name', []) as $index => $name)
                                                        <div data-repeater-item class="row templateRow">
                                                            <div class="mb-3 col-lg-3">
                                                                <input type="text" name="name[]" class="form-control @error('name.' . $index) is-invalid @enderror" placeholder="Enter Name" value="{{ old('name.' . $index, '') }}">
                                                                @error('name.' . $index)
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3 col-lg-3">
                                                                <input type="text" name="place_holder[]" class="form-control @error('place_holder.' . $index) is-invalid @enderror" placeholder="Enter Place Holder" value="{{ old('place_holder.' . $index, '') }}">
                                                                @error('place_holder.' . $index)
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3 col-lg-3">
                                                                <select name="type[]" class="form-control @error('type.' . $index) is-invalid @enderror">
                                                                    <option value="">Select Field Type</option>
                                                                    @foreach (getFields('types') as $key => $status)
                                                                        <option value="{{ $status }}" {{ old('type.' . $index) == $status ? 'selected' : '' }}>{{ $status }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('type.' . $index)
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3 col-lg-2">
                                                                <select name="is_mandatory[]" class="form-control @error('is_mandatory.' . $index) is-invalid @enderror">
                                                                    <option value="">Is Input Mandatory?</option>
                                                                    @foreach (getGenStatus('bool') as $key => $status)
                                                                        <option value="{{ ++$key }}" {{ old('is_mandatory.' . $index) == $key ? 'selected' : '' }}>{{ $status }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('is_mandatory.' . $index)
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <button type="button" class="btn btn-danger remove-btn">
                                                                    <i class="bx bx-minus-circle me-1"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif

                                            </div>

                                            <!-- Button to add new rows -->
                                            <div class="row">
                                                <div class="col-lg-1 offset-lg-11">
                                                    <button type="button" class="btn btn-success add-btn text-bold">
                                                        <i class="bx bx-plus-circle me-1"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                    <div class="d-flex justify-content-end gap-2" bis_skin_checked="1">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light w-10">Submit</button>
                                        <a href="{{ route('service-location.index') }}" class="waves-effect waves-light btn btn-secondary"> Cancel</a>
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
        function duplicateRow() {
            var template = $('.templateRow').first().clone();
            template.find('input, select').val(''); // Clear the values of the new row
            template.appendTo('[data-repeater-list="group-a"]');
            bindRowEvents(template); // Bind events to new row
        }

        // Function to bind events to a row
        function bindRowEvents(row) {
            row.find('.remove-btn').on('click', function() {
                remove(row);
            });
        }

        // Function to remove a specific row
        function remove(row) {
            row.remove();
        }
        // Event listener for adding new row
        $('.add-btn').on('click', function() {
            duplicateRow();
        });

        // Initial event binding for the first row
        bindRowEvents($('.templateRow'));

    });
</script>
