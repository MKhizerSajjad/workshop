@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Tools</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class=""><a href="javascript: void(0);">Tools</a></li>
                                <li class="mx-1"><a href="javascript: void(0);"> > </a></li>
                                <li class="breadcrumb-item active">Tools List</li>
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
                    {{-- <div class="card"> --}}
                        {{-- <div class="card-body"> --}}

                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="card mini-stats-wid">
                                        <div class="card-body bg-primary bg-gradient text-light rounded">

                                            <div class="d-flex flex-wrap">
                                                <div class="me-3">
                                                    <h4 class="mb-2">Sacn</h4>
                                                    {{-- <h5 class="mb-0">1</h5> --}}
                                                    {{-- <div class="form-check form-switch form-switch-md" dir="ltr">
                                                        <label class="form-check-label" for="SwitchCheckSizelg">1</label>
                                                        <input class="form-check-input" type="checkbox" id="SwitchCheckSizelg" checked>
                                                    </div> --}}
                                                </div>

                                                <div class="avatar-sm ms-auto">
                                                    <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                                        <i class="bx bx-wifi"></i>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="card mini-stats-wid">
                                        <div class="card-body bg-danger bg-gradient text-light rounded">

                                            <div class="d-flex flex-wrap">
                                                <div class="me-3">
                                                    <h4 class="mb-2">Kill <span class="font-size-10">/on</span></h4>
                                                    {{-- <h5 class="mb-0">8</h5> --}}
                                                    {{-- <div class="form-check form-switch form-switch-md" dir="ltr">
                                                        <label class="form-check-label" for="SwitchCheckSizelg">8</label>
                                                        <input class="form-check-input" type="checkbox" id="SwitchCheckSizelg" checked>
                                                    </div> --}}
                                                </div>

                                                <div class="avatar-sm ms-auto">
                                                    <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                                        <i class="bx bx-wifi-off"></i>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="card mini-stats-wid">
                                        <div class="card-body bg-warning bg-gradient text-light rounded">

                                            <div class="d-flex flex-wrap">
                                                <div class="me-3">
                                                    <h4 class="mb-2">H- <span>248</span></h4>
                                                    {{-- <h5 class="mb-0">2</h5> --}}
                                                    {{-- <div class="form-check form-switch form-switch-md" dir="ltr">
                                                        <label class="form-check-label" for="SwitchCheckSizelg">2</label>
                                                        <input class="form-check-input" type="checkbox" id="SwitchCheckSizelg" checked>
                                                    </div> --}}
                                                </div>

                                                <div class="avatar-sm ms-auto">
                                                    <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                                        <i class="bx bx-share-alt"></i>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="card mini-stats-wid">
                                        <div class="card-body bg-success bg-gradient text-light rounded">

                                            <div class="d-flex flex-wrap">
                                                <div class="me-3">
                                                    <h4 class="mb-2">H+ <span>124</span></h4>
                                                    {{-- <h5 class="mb-0">4</h5> --}}
                                                    {{-- <div class="form-check form-switch form-switch-md" dir="ltr">
                                                        <label class="form-check-label" for="SwitchCheckSizelg">4</label>
                                                        <input class="form-check-input" type="checkbox" id="SwitchCheckSizelg" checked>
                                                    </div> --}}
                                                </div>

                                                <div class="avatar-sm ms-auto">
                                                    <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                                        <i class="bx bx-equalizer"></i>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            {{-- <div class="row">
                                <div class="col-sm-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="avatar-xs me-3">
                                                    <span class="avatar-title rounded-circle bg-primary-subtle text-primary font-size-18">
                                                        <i class="bx bx-wifi"></i>
                                                    </span>
                                                </div>
                                                <h5 class="font-size-14 mb-0">SCAN <span class="text-align-right">1</span></h5>
                                            </div>
                                            <div class="form-check form-switch" dir="ltr">
                                                <label class="form-check-label" for="SwitchCheckSizesm">Scan</label>
                                                <input class="form-check-input" type="checkbox" id="SwitchCheckSizesm" checked>
                                            </div>
                                            <div class="text-muted mt-4">
                                                <h4>1</h4>
                                                <div class="d-flex">
                                                    <span class="badge badge-soft-success font-size-12"> + 0.2% </span> <span class="ms-2 text-truncate">From previous period</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="avatar-xs me-3">
                                                    <span class="avatar-title rounded-circle bg-primary-subtle text-primary font-size-18">
                                                        <i class="bx bx-wifi"></i>
                                                    </span>
                                                </div>
                                                <h5 class="font-size-14 mb-0">KILL</h5>
                                            </div>
                                            <div class="text-muted mt-4">
                                                <h4>1,452 <i class="mdi mdi-chevron-up ms-1 text-success"></i></h4>
                                                <div class="d-flex">
                                                    <span class="badge badge-soft-success font-size-12"> + 0.2% </span> <span class="ms-2 text-truncate">From previous period</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="avatar-xs me-3">
                                                    <span class="avatar-title rounded-circle bg-primary-subtle text-primary font-size-18">
                                                        <i class="bx bx-archive-in"></i>
                                                    </span>
                                                </div>
                                                <h5 class="font-size-14 mb-0">H-</h5>
                                            </div>
                                            <div class="text-muted mt-4">
                                                <h4>$ 28,452 <i class="mdi mdi-chevron-up ms-1 text-success"></i></h4>
                                                <div class="d-flex">

                                                <div class="form-check form-switch mb-3" dir="ltr">
                                                    <label class="form-check-label" for="SwitchCheckSizesm">Small Size Switch</label>
                                                    <input class="form-check-input" type="checkbox" id="SwitchCheckSizesm" checked>
                                                </div>
                                                    <span class="badge badge-soft-success font-size-12"> + 0.2% </span> <span class="ms-2 text-truncate">From previous period</span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="avatar-xs me-3">
                                                    <span class="avatar-title rounded-circle bg-primary-subtle text-primary font-size-18">
                                                        <i class="bx bx-purchase-tag-alt"></i>
                                                    </span>
                                                </div>
                                                <h5 class="font-size-14 mb-0">H+</h5>
                                            </div>
                                            <div class="text-muted mt-4">
                                                <h4>$ 16.2 <i class="mdi mdi-chevron-up ms-1 text-success"></i></h4>

                                                <div class="d-flex">
                                                    <span class="badge badge-soft-warning font-size-12"> 0% </span> <span class="ms-2 text-truncate">From previous period</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        {{-- </div> --}}
                    {{-- </div> --}}
                </div>
             </div>
        </div>
    </div>
@endsection
