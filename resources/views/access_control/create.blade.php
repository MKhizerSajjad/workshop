@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Access Control</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class=""><a href="javascript: void(0);">Access Control</a></li>
                                <li class="mx-1"><a href="javascript: void(0);"> > </a></li>
                                <li class="breadcrumb-item active">Add New</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->


            @if ($errors->any())
                <div class="alert alert-danger alert-border-left alert-dismissible fade show auto-colse-3" role="alert">
                    <i class="fa fa-ban me-1 align-middle fs-16"></i><strong>Alert! </strong>
                        @foreach ($errors->all() as $error)
                            <br>{{ $error }}
                        @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

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
                            <h4 class="card-title">Access Control Settings</h4>
                            <form method="POST" action="{{ route('access.store') }}">
                                @csrf
                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="user">User <span class="text text-danger"> *</span></label>
                                            <select class="form-control select2 @error('user') is-invalid @enderror" title="User" name="user" >
                                                <option value="">Select User </option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}" @if ($user->id == old('user')) selected @endif> {{ $user->first_name . ' ' . $user->last_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('user')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="assigned_ip">Assigned IP Address </label>
                                            <input id="assigned_ip" name="assigned_ip" type="text" class="form-control @error('assigned_ip') is-invalid @enderror" placeholder="Assigned IP Address" value="{{ old('assigned_ip') }}">
                                            @error('assigned_ip')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="hours_start">Working Hours Start</label>
                                            <input id="hours_start" name="hours_start" type="time" class="form-control @error('hours_start') is-invalid @enderror" value="{{ old('hours_start') }}">
                                            @error('hours_start')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="hours_end">Working Hours End</label>
                                            <input id="hours_end" name="hours_end" type="time" class="form-control @error('hours_end') is-invalid @enderror" value="{{ old('hours_end') }}">
                                            @error('hours_end')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label for="working_days">Working Days <span class="text text-danger"> *</span></label>
                                            <select id="working_days" name="days[]" multiple class="form-control @error('days') is-invalid @enderror">
                                                <option value="Monday" {{ in_array('Monday', old('days', [])) ? 'selected' : '' }}>Monday</option>
                                                <option value="Tuesday" {{ in_array('Tuesday', old('days', [])) ? 'selected' : '' }}>Tuesday</option>
                                                <option value="Wednesday" {{ in_array('Wednesday', old('days', [])) ? 'selected' : '' }}>Wednesday</option>
                                                <option value="Thursday" {{ in_array('Thursday', old('days', [])) ? 'selected' : '' }}>Thursday</option>
                                                <option value="Friday" {{ in_array('Friday', old('days', [])) ? 'selected' : '' }}>Friday</option>
                                                <option value="Saturday" {{ in_array('Saturday', old('days', [])) ? 'selected' : '' }}>Saturday</option>
                                                <option value="Sunday" {{ in_array('Sunday', old('days', [])) ? 'selected' : '' }}>Sunday</option>
                                            </select>
                                            @error('days')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light w-10">Submit</button>
                                        <a href="{{ route('access.index') }}" class="waves-effect waves-light btn btn-secondary">Cancel</a>
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
