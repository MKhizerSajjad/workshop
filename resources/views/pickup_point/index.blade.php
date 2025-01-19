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
                                <li class="breadcrumb-item active">Case Setting</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            @if ($errors->any())
                <div class="alert alert-danger alert-border-left alert-dismissible fade show auto-colse-3" role="alert">
                    <i class="fa fa-ban me-1 align-middle fs-16"></i><strong>Alert! </strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-border-left alert-dismissible fade show auto-colse-3" role="alert">
                    <i class="ri-check-double-line me-3 align-middle fs-16"></i><strong>Success! </strong>
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @php
                $priorities = getPriorities();
            @endphp

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Pickup Points List</h4>
                            <div class="d-flex justify-content-end gap-2" bis_skin_checked="1">
                                <a href="{{ route('pickup-point.create') }}" class="btn btn-primary waves-effect waves-light"> <i class="bx bx-plus me-1"></i> Add New</a>
                            </div>
                            {{-- <div class="card-title-desc card-subtitle" bis_skin_checked="1">Create responsive tables by wrapping any <code>.table</code> in <code>.table-responsive</code>to make them scroll horizontally on small devices (under 768px).</div> --}}
                            @if (count($data) > 0)
                                <div class="table-responsive" bis_skin_checked="1">
                                    <table class="table mb-0 table">
                                        <thead>
                                            <tr>
                                                <th class="text-center" width=100>#</th>
                                                <th>Name</th>
                                                <th lass="text-center"  width=100>Status</th>
                                                <th class="text-center"  width=100>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $point)
                                                <tr>
                                                    <td  class="text-center">{{ ++$key }}</td>
                                                    <td>{{ $point->name }}</td>
                                                    <td>{!! getGenStatus('general', $point->status, 'badge') !!}</td>
                                                    <td class="text-center"> <a href="{{ route('pickup-point.edit', $point->id) }}"><i class="bx bx-pencil"></i></a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $data->links() }}
                                </div>
                            @else
                                <div class="noresult">
                                    <div class="text-center">
                                        <h4 class="mt-2 text-danger">Sorry! No Result Found</h4>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Priorities List</h4>
                            <div class="d-flex justify-content-end gap-2" bis_skin_checked="1">
                                <a href="{{ route('priority.create') }}" class="btn btn-primary waves-effect waves-light"> <i class="bx bx-plus me-1"></i> Add New</a>
                            </div>
                            {{-- <div class="card-title-desc card-subtitle" bis_skin_checked="1">Create responsive tables by wrapping any <code>.table</code> in <code>.table-responsive</code>to make them scroll horizontally on small devices (under 768px).</div> --}}
                            @if (count($priorities) > 0)
                                <div class="table-responsive" bis_skin_checked="1">
                                    <table class="table mb-0 table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th lass="text-center"  width=100>Status</th>
                                                <th class="text-center"  width=100>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($priorities as $key => $priority)
                                                <tr>
                                                    <td  class="text-center">{{ ++$key }}</td>
                                                    <td>{{ $priority->name }}</td>
                                                    <td>{{ $priority->price }}</td>
                                                    <td>{!! getGenStatus('general', $priority->status, 'badge') !!}</td>
                                                    @if ($priority->id !== 1)
                                                        <td class="text-center"> <a href="{{ route('priority.edit', $priority->id) }}"><i class="bx bx-pencil"></i></a></td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{-- {{ $data->links() }} --}}
                                </div>
                            @else
                                <div class="noresult">
                                    <div class="text-center">
                                        <h4 class="mt-2 text-danger">Sorry! No Result Found</h4>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Case Prefix</h4>
                            <form method="POST" action="{{ route('setting.store') }}">
                                @csrf
                                <input type="hidden" name="type" value="case">
                                <!-- Titles Row -->
                                {{-- <div class="d-flex align-items-center mb-2 fw-bold">
                                    <div class="me-2">Case Prefix</div>
                                </div> --}}
                                <div id="tax-container">
                                    <div class="d-flex align-items-center tax-row mb-2">
                                        <input type="text" name="case_prefix" class="form-control" value="{{ getSettingData('case')->case_prefix ?? '' }}" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3 w-100">Update Case Prefix</button>
                            </form>
                        </div>
                    </div>
                </div>
             </div>
        </div>
    </div>
@endsection


<style>
    .w-5 {
        width: 10px !important;
    }
    .h-5 {
        height: 10px !important;
    }
    .flex.justify-between.flex-1
    {
        display: none !important;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
