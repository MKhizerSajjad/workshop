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
                                <li class="breadcrumb-item active">Customer List</li>
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
                            <h4 class="card-title">Customer List</h4>
                            {{-- <div class="d-flex justify-content-end gap-2" bis_skin_checked="1">
                                <a href="{{ route('customer.create') }}" class="btn btn-primary waves-effect waves-light"> <i class="bx bx-plus me-1"></i> Add New</a>
                            </div> --}}
                            {{-- <div class="card-title-desc card-subtitle" bis_skin_checked="1">Create responsive tables by wrapping any <code>.table</code> in <code>.table-responsive</code>to make them scroll horizontally on small devices (under 768px).</div> --}}
                            @if (count($data) > 0)
                                <div class="table-responsive" bis_skin_checked="1">
                                    <table class="table mb-0 table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th class="text-center">Case Count</th>
                                                <th class="text-center">Total Spent</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $customer)
                                                @php
                                                    $total = 0;
                                                @endphp
                                                @foreach ($customer->tasks as $task)
                                                    @php
                                                        $total = $total + $task->total;
                                                    @endphp
                                                @endforeach
                                                <tr>
                                                    <td  class="text-center">{{ ++$key }}</td>
                                                    <td>{{ $customer->first_name .' '. $customer->last_name }}</td>
                                                    <td>{{ $customer->email }}</td>
                                                    <td>{{ $customer->phone }}</td>
                                                    <td class="text-center">{{ COUNT($customer->tasks) }}</td>
                                                    <td class="text-center">{{ $total }}</td>
                                                    <td class="text-center">{!! getGenStatus('user', $customer->status, 'badge') !!}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('customer.edit', $customer->id) }}"><i class="bx bx-pencil"></i></a>
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
