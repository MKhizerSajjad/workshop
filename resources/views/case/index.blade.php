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
                                                <th>Total</th>
                                                <th>Paid</th>
                                                <th>Pending</th>
                                                <th>Status</th>
                                                <th>Payment</th>
                                                <th class="text-center">Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $task)
                                                <tr>
                                                    <td class="text-center">{{ ++$key }}</td>
                                                    <td>{{ $task->code }}</td>
                                                    <td>{{ $task->model . ' ' . $task->year }}</td>
                                                    <td>{{ optional($task->technician)->first_name . ' ' . optional($task->technician)->last_name }}</td>
                                                    <td>{{ numberFormat($task->total, 'euro') }}</td>
                                                    <td>{{ numberFormat($task->paid, 'euro') }}</td>
                                                    <td>{{ numberFormat($task->pending, 'euro') }}</td>
                                                    <td>{!! getCaseStatus('general', $task->status, 'badge') !!}</td>
                                                    <td>{!! getPayment('status', $task->payment_status, 'badge') !!}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('case.invoice', $task->id) }}"><i class="bx bx-receipt"></i></a>
                                                        @if ($task->payment_status != 1)
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#paymentModal-{{ $task->id }}"><i class="bx bx-euro"></i></a>
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#commentsModal-{{ $task->id }}"><i class="bx bx-message"></i></a>
                                                        @endif
                                                        <a href="{{ route('case.edit1', $task->id) }}"><i class="bx bx-pencil"></i></a>
                                                    </td>
                                                </tr>

                                                <!-- Payment Modal -->
                                                <div class="modal fade" id="paymentModal-{{ $task->id }}" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="paymentModalLabel">Add New Payment for <b>{{$task->code}}</b></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form method="POST" action="{{ route('case.status-update', $task->id) }}" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-body">
                                                                    <div>
                                                                        <label class="col-form-label amount">Payment Amount <span class="text-danger">*</span></label>
                                                                        <input type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" placeholder="Payment Amount" step="0.01" min="0.01" max="{{$task->pending}}" required>
                                                                        @error('amount')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div>
                                                                        <label class="col-form-label payment_method mt-1">Payment Method <span class="text-danger">*</span></label>
                                                                        <select class="form-control select2 @error('payment_method') is-invalid @enderror" name="payment_method" required>
                                                                            <option value="">Select Payment Method</option>
                                                                            @foreach (getPayment('via') as $payKey => $status)
                                                                                <option value="{{ ++$payKey }}">{{ $status }}</option>
                                                                            @endforeach
                                                                            @error('payment_method')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </select>
                                                                    </div>
                                                                    <div>
                                                                        <label for="note" class="col-form-label">Note</label>
                                                                        <textarea class="form-control" name="note" placeholder="Note"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Add Payment</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Comments Modal -->
                                                <div class="modal fade" id="commentsModal-{{ $task->id }}" tabindex="-1" aria-labelledby="commentsModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="commentsModalLabel">Add New Comments for <b>{{$task->code}}</b></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form method="POST" action="{{ route('case.comment', $task->id) }}" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div>
                                                                        <label for="comment" class="col-form-label">Comment</label>
                                                                        <textarea class="form-control" name="comment" placeholder="Comment"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Add Comment</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
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
