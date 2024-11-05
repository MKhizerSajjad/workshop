@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Customer</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class=""><a href="javascript: void(0);">Customer</a></li>
                                <li class="mx-1"><a href="javascript: void(0);"> > </a></li>
                                <li class="breadcrumb-item active">Update Customer</li>
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
                            <h4 class="card-title">Edit Customer</h4>
                            <form method="POST" action="{{ route('customer.update', $user->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="first_name">First Name <span class="text text-danger"> *</span></label>
                                            <input id="first_name" name="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" placeholder="First Name" value="{{ old('first_name', $user->first_name) }}">
                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="last_name">Last Name <span class="text text-danger"> *</span></label>
                                            <input id="last_name" name="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" placeholder="Last Name" value="{{ old('last_name', $user->last_name) }}">
                                            @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="email">Email <span class="text text-danger"> *</span></label>
                                            <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email', $user->email) }}">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="phone">Phone <span class="text text-danger"> *</span></label>
                                            <input id="phone" name="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone" value="{{ old('phone', $user->phone) }}">
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="company">Company <span class="text text-danger"> *</span></label>
                                            <input id="company" name="company" type="text" class="form-control @error('company') is-invalid @enderror" placeholder="Company" value="{{ old('company', $user->company) }}">
                                            @error('company')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="city">City <span class="text text-danger"> *</span></label>
                                            <input id="city" name="city" type="text" class="form-control @error('city') is-invalid @enderror" placeholder="City" value="{{ old('city', $user->city) }}">
                                            @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label for="address">Address <span class="text text-danger"> *</span></label>
                                            <textarea id="address" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Address" rows="3">{{ old('address', $user->address) }}</textarea>
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light w-10">Update</button>
                                        <a href="{{ route('customer.index') }}" class="waves-effect waves-light btn btn-secondary">Cancel</a>
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
