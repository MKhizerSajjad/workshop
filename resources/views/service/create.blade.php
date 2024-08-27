@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Service</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class=""><a href="javascript: void(0);">Service</a></li>
                                <li class="mx-1"><a href="javascript: void(0);"> > </a></li>
                                <li class="breadcrumb-item active">Add New</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add New Service</h4>
                            {{-- <p class="card-title-desc">Fill all information below</p> --}}
                            <form method="POST" action="{{ route('service.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label for="name">Name <span class="text text-danger"> *</span></label>
                                            <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ old('name') }}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="time">Parent Service <span class="text text-danger"> (if any)</span></label>
                                            <select id="service_id" name="service_id" class="select2 form-control">
                                                <option value="">Select Parent Service </option>
                                                @foreach ($services as $key => $loopService)
                                                    <option value="{{ $loopService->id }}" {{ old('service_id') == $loopService->id ? 'selected' : '' }}>{{ $loopService->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="sort_order">Sort Order </label>
                                            <input id="sort_order" name="sort_order" type="number" class="form-control" placeholder="Sort Order" value="{{ old('sort_order') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label for="time">Time <span class="text text-danger"> *</span></label>
                                            <input id="time" name="time" type="text" class="form-control @error('time') is-invalid @enderror" placeholder="Time" value="{{ old('time') }}">
                                            @error('time')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label for="status">Status <span class="text text-danger"> *</span></label>
                                            <select id="service_status" name="status" class="select2 form-control @error('status') is-invalid @enderror">
                                                <option value="">Select Status </option>
                                                @foreach (getGenStatus('service') as $key => $price)
                                                    <option value="{{ ++$key }}" {{ old('status') == $key ? 'selected' : '' }}>{{ $price }}</option>
                                                @endforeach
                                                @error('status')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label for="time">Show Price <span class="text text-danger"> *</span></label>
                                            <select id="show_price" name="show_price" class="select2 form-control @error('show_price') is-invalid @enderror">
                                                <option value="">Select Show Price </option>
                                                @foreach (getGenStatus('bool') as $key => $price)
                                                    <option value="{{ ++$key }}" {{ old('show_price') == $key ? 'selected' : '' }}>{{ $price }}</option>
                                                @endforeach
                                            </select>
                                            @error('show_price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label for="price">Price <span class="text text-danger"> *</span></label>
                                            <input id="price" name="price" type="number" step="any" class="form-control cal @error('price') is-invalid @enderror" placeholder="Price" value="{{ old('price') }}">
                                            @error('price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label for="tax">Tax <span class="text text-danger"> *</span></label>
                                            <input id="tax" name="tax" type="number" step="any" class="form-control cal @error('tax') is-invalid @enderror" placeholder="Tax" value="{{ old('tax') }}">
                                            @error('tax')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div> --}}
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label for="add_tax">Add Tax <span class="text text-danger"> *</span></label>
                                            <select id="add_tax" name="add_tax" class="select2 form-control @error('add_tax') is-invalid @enderror">
                                                <option value="">Add Tax </option>
                                                @foreach (getGenStatus('bool') as $key => $price)
                                                    <option value="{{ ++$key }}" {{ old('add_tax', 1) == $key ? 'selected' : '' }}>{{ $price }}</option>
                                                @endforeach
                                            </select>
                                            @error('add_tax')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label for="total">Total Price </label>
                                            <input id="total" name="total" type="number" step="any" class="form-control" placeholder="Total" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label for="detail">Detail </label>
                                            <textarea id="detail" name="detail" rows="4" class="form-control" placeholder="Detail">{{ old('detail') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end gap-2" bis_skin_checked="1">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light w-10">Submit</button>
                                        <a href="{{ route('service.index') }}" class="waves-effect waves-light btn btn-secondary"> Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var priceInput = document.getElementById('price');
        // var taxInput = document.getElementById('tax');
        var addTax = document.getElementById('add_tax');
        var totalInput = document.getElementById('total');

        // if (priceInput && taxInput) {
            // priceInput.addEventListener('keyup', calculateSum);
            // taxInput.addEventListener('keyup', calculateSum);
            priceInput.addEventListener('keyup', calculateTotal);
            addTax.addEventListener('change', calculateTotal);
        // }

        function calculateTotal() {
            var price = parseFloat(priceInput.value) || 0;
            var tax = parseFloat(addTax.value) || 0;
            var taxAmount = 0;
            var taxPercentage = 0;

            if (tax === 1) {
                taxPercentage = {{ $tax }}
                taxAmount = (price * taxPercentage) / 100;
            }

            var total = price + taxAmount;
            totalInput.value = total.toFixed(2);
        }

        function calculateSum() {
            var price = parseFloat(priceInput.value) || 0;
            var tax = parseFloat(taxInput.value) || 0;
            var total = price + tax;
            totalInput.value = total.toFixed(2);
        }
    });
</script>
