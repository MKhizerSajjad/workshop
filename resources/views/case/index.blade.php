@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Cases</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class=""><a href="javascript: void(0);">Cases</a></li>
                                <li class="mx-1"><a href="javascript: void(0);"> > </a></li>
                                <li class="breadcrumb-item active">Cases List</li>
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
                            <h4 class="card-title">Cases List</h4>
                            <div class="d-flex justify-content-end gap-2" bis_skin_checked="1">
                                <a href="{{ route('case.create') }}" class="btn btn-primary waves-effect waves-light"> <i class="bx bx-plus me-1"></i> Add New</a>
                            </div>
                            {{-- <div class="card-title-desc card-subtitle" bis_skin_checked="1">Create responsive tables by wrapping any <code>.table</code> in <code>.table-responsive</code>to make them scroll horizontally on small devices (under 768px).</div> --}}
                            @if (count($data) > 0)
                                <div class="table-responsive" bis_skin_checked="1">
                                    <table class="table mb-0 table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Number</th>
                                                <th>Product</th>
                                                {{-- <th>Manufacturer</th> --}}
                                                <th>Technician</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Payment</th>
                                                <th class="text-center">Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $task)
                                                <tr>
                                                    <td  class="text-center">{{ ++$key }}</td>
                                                    <td>{{ $task->code }}</td>
                                                    <td>{{ $task->model .' '. $task->year }}</td>
                                                    {{-- <td>{{ $task->manufacturer }}</td> --}}
                                                    <td>{{ optional($task->technician)->first_name . ' ' . optional($task->technician)->last_name }}</td>
                                                    <td></td>
                                                    <td>{!! getCaseStatus('general', $task->status, 'badge') !!}</td>
                                                    <td>{!! getPayment('status', $task->payment_status, 'badge') !!}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('case.invoice', $task->id) }}"><i class="bx bx-receipt"></i></a>
                                                        <a href="{{ route('case.edit', $task->id) }}"><i class="bx bx-pencil"></i></a>
                                                    </td>
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
