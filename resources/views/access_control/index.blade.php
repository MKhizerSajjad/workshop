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
                                <li class="breadcrumb-item active">Access Control List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <!-- Success Message -->
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-border-left alert-dismissible fade show auto-colse-3" role="alert">
                    <i class="ri-check-double-line me-3 align-middle fs-16"></i><strong>Success! </strong>
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Error Message -->
            @if ($errors->any())
                <div class="alert alert-danger alert-border-left alert-dismissible fade show auto-colse-3" role="alert">
                    <i class="ri-error-warning-line me-3 align-middle fs-16"></i><strong>Error! </strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Access Control List</h4>
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('access.create') }}" class="btn btn-primary waves-effect waves-light">
                                    <i class="bx bx-plus me-1"></i> Add New Access Control
                                </a>
                            </div>

                            @if (count($accessControls) > 0)
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>User</th>
                                                <th>IP</th>
                                                <th>Days</th>
                                                <th>Hours</th>
                                                <th class="text-center">Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($accessControls as $key => $accessControl)
                                                <tr>
                                                    <td class="text-center">{{ ++$key }}</td>
                                                    <td>{{ $accessControl->user->first_name }}</td>
                                                    <td>{{ $accessControl->assigned_ip ?? ' - ' }}</td>
                                                    <td>{{ $accessControl->days ? implode(', ', json_decode($accessControl->days)) : ' - ' }}</td>
                                                    <td>{{ $accessControl->hours_start }} - {{ $accessControl->hours_end }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('access.edit', $accessControl->id) }}" class="text-primary"><i class="bx bx-pencil"></i></a>
                                                        {{-- <form action="{{ route('access.destroy', $accessControl->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="border-0 bg-transparent text-danger p-0" style="cursor: pointer;">
                                                                <i class="bx bx-trash"></i>
                                                            </button>
                                                        </form> --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $accessControls->links() }}
                                </div>
                            @else
                                <div class="noresult">
                                    <div class="text-center">
                                        <h4 class="mt-2 text-danger">Sorry! No Record Found</h4>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- container-fluid -->
    </div> <!-- page-content -->
@endsection

<!-- Custom Styling for Table -->
<style>
    .w-5 {
        width: 10px !important;
    }

    .h-5 {
        height: 10px !important;
    }

    .flex.justify-between.flex-1 {
        display: none !important;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
