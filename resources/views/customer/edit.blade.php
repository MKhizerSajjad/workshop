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

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-border-left alert-dismissible fade show auto-colse-3" role="alert">
                    <i class="ri-check-double-line me-3 align-middle fs-16"></i><strong>Success! </strong>
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                <h4 class="card-title">Edit Customer</h4>
                                </div>
                                <div class="col-sm-6">
                                    <h4 class="card-title float-right">
                                        Status : {!! getGenStatus('user', $user->status, 'badge') !!}
                                        <button class="badge bg-primary" data-bs-toggle="modal" data-bs-target="#editStatusModal-{{ $user->id }}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </h4>

                                </div>
                            </div>
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
                                            <label for="email">Email</label>
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
                                            <label for="company">Company </label>
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
                                            <label for="city">City </label>
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
                                            <label for="address">Address </label>
                                            <textarea id="address" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Address" rows="3">{{ old('address', $user->address) }}</textarea>
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="platform_id">Where Customer Found Us </label>
                                            <select id="platform_id" name="platform_id" class="select2 form-control @error('platform_id') is-invalid @enderror">
                                                <option value="">Select Platform </option>
                                                @foreach (getPlatforms() as $platform)
                                                    <option value="{{ $platform->id }}" {{ old('platform_id', $user->platform_id ) == $platform->id ? 'selected' : '' }}>{{ $platform->name }}</option>
                                                @endforeach
                                                @error('platform_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </select>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light w-10" name="action" value="update">Update</button>
                                        <a href="{{ route('customer.index') }}" class="waves-effect waves-light btn btn-secondary">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Cases</h4>
                            @if (count($cases) > 0)
                                <div class="table-responsive" bis_skin_checked="1">
                                    <table class="table mb-0 table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Case Number</th>
                                                <th>Date</th>
                                                <th>Spent Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @php
                                                $count = 0;
                                                $total = 0;
                                            @endphp
                                            @foreach ($cases as $key => $task)
                                                @php
                                                    ++$count;
                                                    $total = $total + $task->total;
                                                @endphp
                                                <tr>
                                                    <td  class="text-center">{{ ++$key }}</td>
                                                    <td>{{ $task->code }}</td>
                                                    <td>{{ $task->date_opened }}</td>
                                                    <td>{{ $task->total }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td><b>Total Count : {{$count}} </b></td>
                                                <td></td>
                                                <td><b>Total Amount : {{$total}} </b></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            @else
                                <div class="noresult">
                                    <div class="text-center">
                                        <h4 class="mt-2 text-danger">Sorry! No Case Exist.</h4>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div>

    <!-- Edit Comment Modal -->
    <div class="modal fade" id="editStatusModal-{{ $user->id }}" tabindex="-1" aria-labelledby="editStatusModalLabel-{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStatusModalLabel-{{ $user->id }}">Edit Status </b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('customer.update', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div>
                            <label for="status" class="col-form-label">Status</label>
                            <select id="user_status" name="status" class="select2 form-control @error('status') is-invalid @enderror" required>
                                <option value="">Select Status</option>
                                @foreach (getGenStatus('user') as $key => $stat)
                                    <option value="{{ ++$key }}" {{ old('status', $user->status) == $key ? 'selected' : '' }}>{{ $stat }}</option>
                                @endforeach
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </select>
                        </div>

                        <div>
                            <label for="status_detail" class="col-form-label">Reason for status update</label>
                            <textarea class="form-control" name="status_detail" placeholder="Reason for status update" required>{{ $user->status_detail }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning" name="action" value="update-comment">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
