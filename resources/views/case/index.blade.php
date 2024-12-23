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
                            <div class="row mb-3">
                                <div class="col-lg-4 col-sm-12">
                                    <div class="mt-2">
                                        <h4 class="card-title">Products List</h4>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-sm-12">
                                    <form class="mt-4 mt-sm-0 float-sm-end d-sm-flex align-items-center" method="GET">
                                        {{-- <div class="search-box me-2">
                                            <div class="position-relative">
                                                <input type="text" class="form-control border-1" name="product" id="searchProductList" autocomplete="off" placeholder="Search..." value="{{ request()->get('product') }}">
                                                <i class="bx bx-search-alt search-icon"></i>
                                            </div>
                                        </div> --}}
                                        <div class="me-2">
                                            <div class="position-relative">
                                                <select name="limit" id="limit" class="form-select border-1 mr-3" style="width: 70px; border-radius: 30px">
                                                    @php
                                                        $limit = request()->get('limit') ?? 10;
                                                    @endphp
                                                    <option value="10" @if($limit == 10) selected @endif>10</option>
                                                    <option value="25" @if($limit == 25) selected @endif>25</option>
                                                    <option value="50" @if($limit == 50) selected @endif>50</option>
                                                    <option value="100" @if($limit == 100) selected @endif>100</option>
                                                </select>
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-info waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#searchModal">
                                            <i class="bx bx-filter-alt me-1"></i>
                                        </button>
                                        <a href="{{ route('case.index') }}" class="btn btn-secondary waves-effect waves-light mx-2"><i class="bx bx-crosshair me-1"></i> </a>
                                        {{-- <div class="d-flex justify-content-end me-2" bis_skin_checked="1"> --}}
                                        <a href="{{ route('case.create') }}" class="btn btn-primary waves-effect waves-light"> <i class="bx bx-plus me-1"></i></a>
                                        {{-- </div> --}}
                                    </form>
                                </div>
                            </div>


                            {{-- <h4 class="card-title">Cases List</h4> --}}
                            {{-- <div class="card-title-desc card-subtitle" bis_skin_checked="1">Create responsive tables by wrapping any <code>.table</code> in <code>.table-responsive</code>to make them scroll horizontally on small devices (under 768px).</div> --}}
                            @if (count($data) > 0)
                                <div class="table-responsive" bis_skin_checked="1">
                                    <table class="table mb-0 table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Number</th>
                                                <th>Item</th>
                                                {{-- <th>Manufacturer</th> --}}
                                                <th>Technician</th>
                                                <th>Date</th>
                                                <th>Total</th>
                                                {{-- <th>Paid</th>
                                                <th>Pending</th> --}}
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
                                                    <td>{{ $task->item->name . ' - ' . $task->item->manufacturer }}</td>
                                                    {{-- <td>{{ $task->model . ' ' . $task->year }}</td> --}}
                                                    <td>{{ optional($task->technician)->first_name . ' ' . optional($task->technician)->last_name }}</td>
                                                    <td>{{ date('d M Y', strtotime($task->date_opened)) }}</td>
                                                    <td>{{ numberFormat($task->total, 'euro') }}</td>
                                                    {{-- <td>{{ numberFormat($task->paid, 'euro') }}</td>
                                                    <td>{{ numberFormat($task->pending, 'euro') }}</td> --}}
                                                    <td>{!! getCaseStatus('general', $task->status, 'badge') !!}</td>
                                                    <td>{!! getPayment('status', $task->payment_status, 'badge') !!}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('case.invoice', $task->id) }}"><i class="bx bx-receipt"></i></a>
                                                        {{-- @if ($task->payment_status != 1)
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#paymentModal-{{ $task->id }}"><i class="bx bx-euro"></i></a>
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#commentsModal-{{ $task->id }}"><i class="bx bx-message"></i></a>
                                                        @endif --}}
                                                        <a href="{{ route('case.show', $task->id) }}"><i class="bx bx-bullseye"></i></a>
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

    {{-- Search Modal --}}
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="GET" action="{{ route('case.index') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="searchModalLabel">Select Service Location</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <label for="fname" class="col-form-label">Name</label>
                                <input type="text" id="fname" name="fname" class="form-control @error('fname') is-invalid @enderror" value="{{ request()->get('fname', '') }}" placeholder="Search by First Name">
                                @error('fname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="lname" class="col-form-label">Surname</label>
                                <input type="text" id="lname" name="lname" class="form-control @error('lname') is-invalid @enderror" value="{{ request()->get('lname', '') }}" placeholder="Search by Last Name">
                                @error('lname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label for="cno" class="col-form-label">Case Number</label>
                                <input type="text" id="cno" name="cno" class="form-control @error('cno') is-invalid @enderror" value="{{ request()->get('cno', '') }}" placeholder="Search by Case Number">
                                @error('cno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label for="cst" class="col-form-label">Case Status</label>
                                <select id="cst" name="cst" class="select2 form-control @error('cst') is-invalid @enderror">
                                    <option value="">Select Case Status</option>
                                    @foreach (getCaseStatus('general') as $cstKey => $cStatus)
                                        <option value="{{ $cstKey }}" {{ old('cst', request()->get('cst', '')) == $cstKey ? 'selected' : '' }}>{{ $cStatus }}</option>
                                    @endforeach
                                </select>
                                @error('cst')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label for="pst" class="col-form-label">Payment Status</label>
                                <select id="pst" name="pst" class="select2 form-control @error('pst') is-invalid @enderror">
                                    <option value="">Select Payment Status</option>
                                    @foreach (getPayment('status') as $pstKey => $pStatus)
                                        <option value="{{ $pstKey }}" {{ old('pst', request()->get('pst', '')) == $pstKey ? 'selected' : '' }}>{{ $pStatus }}</option>
                                    @endforeach
                                </select>
                                @error('pst')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="tech" class="col-form-label">Technician</label>
                                <select id="tech" name="tech" class="select2 form-control @error('tech') is-invalid @enderror">
                                    <option value="">Select Technician</option>
                                    @foreach (getUsers(3) as $tech)
                                        <option value="{{ $tech->id }}" {{ old('tech', request()->get('tech', '')) == $tech->id ? 'selected' : '' }}>{{ $tech->first_name .' '. $tech->last_name }}</option>
                                    @endforeach
                                </select>
                                @error('tech')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="date" class="col-form-label">Date</label>
                                <input type="date" id="date" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ request()->get('date', '') }}">
                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="phone" class="col-form-label">Phone Number</label>
                                <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ request()->get('phone', '') }}" placeholder="Search by Phone">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="email" class="col-form-label">Email Address</label>
                                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ request()->get('email', '') }}" placeholder="Search by Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="ust" class="col-form-label">Customer Status</label>
                                <select id="ust" name="ust" class="select2 form-control @error('ust') is-invalid @enderror">
                                    <option value="">Select Status</option>
                                    @foreach (getGenStatus('user') as $key => $stat)
                                        <option value="{{ ++$key }}" {{ old('ust', request()->get('ust', '')) == $key ? 'selected' : '' }}>{{ $stat }}</option>
                                    @endforeach
                                </select>
                                @error('ust')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="plat" class="col-form-label">Where Customer Found Us</label>
                                <select id="plat" name="plat" class="select2 form-control @error('plat') is-invalid @enderror">
                                    <option value="">Select Platform</option>
                                    @foreach (getPlatforms() as $platform)
                                        <option value="{{ $platform->id }}" {{ old('plat', request()->get('plat', '')) == $platform->id ? 'selected' : '' }}>{{ $platform->name }}</option>
                                    @endforeach
                                </select>
                                @error('plat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
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
