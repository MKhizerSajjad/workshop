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
                                <li class="breadcrumb-item active">Update Access</li>
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
                            <h4 class="card-title">Edit Item</h4>
                            @php
                            @endphp
                            <form method="POST" action="{{ route('access.update', $access->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="user">User <span class="text text-danger"> *</span></label>
                                            <select class="form-control select2 @error('user') is-invalid @enderror" title="User" name="user" >
                                                <option value="">Select User </option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}" @if ($user->id == old('user', $access->user_id)) selected @endif> {{ $user->first_name . ' ' . $user->last_name }}</option>
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
                                            <label for="assigned_ip">Assigned IP Address</label>
                                            <input id="assigned_ip" name="assigned_ip" type="text" class="form-control @error('assigned_ip') is-invalid @enderror" placeholder="Assigned IP Address" value="{{ old('assigned_ip', $access->assigned_ip) }}">
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
                                            <input id="hours_start" name="hours_start" type="time" class="form-control @error('hours_start') is-invalid @enderror" value="{{ old('hours_start', $access->hours_start) }}">
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
                                            <input id="hours_end" name="hours_end" type="time" class="form-control @error('hours_end') is-invalid @enderror" value="{{ old('hours_end', $access->hours_end) }}">
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
                                                <option value="Monday" {{ in_array('Monday', old('days', json_decode($access->days, true) ?? [])) ? 'selected' : '' }}>Monday</option>
                                                <option value="Tuesday" {{ in_array('Tuesday', old('days', json_decode($access->days, true) ?? [])) ? 'selected' : '' }}>Tuesday</option>
                                                <option value="Wednesday" {{ in_array('Wednesday', old('days', json_decode($access->days, true) ?? [])) ? 'selected' : '' }}>Wednesday</option>
                                                <option value="Thursday" {{ in_array('Thursday', old('days', json_decode($access->days, true) ?? [])) ? 'selected' : '' }}>Thursday</option>
                                                <option value="Friday" {{ in_array('Friday', old('days', json_decode($access->days, true) ?? [])) ? 'selected' : '' }}>Friday</option>
                                                <option value="Saturday" {{ in_array('Saturday', old('days', json_decode($access->days, true) ?? [])) ? 'selected' : '' }}>Saturday</option>
                                                <option value="Sunday" {{ in_array('Sunday', old('days', json_decode($access->days, true) ?? [])) ? 'selected' : '' }}>Sunday</option>
                                            </select>
                                            @error('days')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light w-10">Update</button>
                                        <a href="{{ route('item.index') }}" class="waves-effect waves-light btn btn-secondary">Cancel</a>
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
