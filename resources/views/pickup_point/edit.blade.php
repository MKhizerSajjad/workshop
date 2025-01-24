@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Pickup Point</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class=""><a href="javascript: void(0);">Pickup Point</a></li>
                                <li class="mx-1"><a href="javascript: void(0);"> > </a></li>
                                <li class="breadcrumb-item active">Update Pickup Point</li>
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
                            <h4 class="card-title">Edit Pickup Point</h4>
                            <form method="POST" action="{{ route('pickup-point.update', $pickupPoint->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-sm-9">
                                        <div class="mb-3">
                                            <label for="name">Name <span class="text text-danger"> *</span></label>
                                            <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ $pickupPoint->name }}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label for="time">Status <span class="text text-danger"> *</span></label>
                                            <select id="priority_status" name="status" class="select2 form-control">
                                                <option value="">Select Priority </option>
                                                @foreach (getGenStatus('general') as $key => $status)
                                                    <option value="{{ ++$key }}" @if($key == $pickupPoint->status) selected @endif>{{ $status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label for="response_msg">Response Message </label>
                                            <textarea id="response_msg" name="response_msg" rows="4" class="form-control @error('response_msg') is-invalid @enderror" placeholder="Response Message">{{ $pickupPoint->response_msg }}</textarea>
                                            @error('response_msg')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end gap-2" bis_skin_checked="1">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light w-10">Update</button>
                                        <a href="{{ route('pickup-point.index') }}" class="waves-effect waves-light btn btn-secondary"> Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- container-fluid -->
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var priceInput = document.getElementById('price');
        var taxInput = document.getElementById('tax');
        var totalInput = document.getElementById('total');

        if (priceInput && taxInput) {
            priceInput.addEventListener('keyup', calculateSum);
            taxInput.addEventListener('keyup', calculateSum);
        }

        function calculateSum() {
            var price = parseFloat(priceInput.value) || 0;
            var tax = parseFloat(taxInput.value) || 0;
            var total = price + tax;
            totalInput.value = total.toFixed(2);
        }
    });
</script>
