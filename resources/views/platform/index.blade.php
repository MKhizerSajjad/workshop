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
                                <li class="breadcrumb-item active">General Setting</li>
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

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Plaforms List</h4>
                            <div class="d-flex justify-content-end gap-2" bis_skin_checked="1">
                                <a href="{{ route('platform.create') }}" class="btn btn-primary waves-effect waves-light"> <i class="bx bx-plus me-1"></i> Add New</a>
                            </div>
                            {{-- <div class="card-title-desc card-subtitle" bis_skin_checked="1">Create responsive tables by wrapping any <code>.table</code> in <code>.table-responsive</code>to make them scroll horizontally on small devices (under 768px).</div> --}}
                            @if (count($data) > 0)
                                <div class="table-responsive" bis_skin_checked="1">
                                    <table class="table mb-0 table">
                                        <thead>
                                            <tr>
                                                <th class="text-center" width="50px">#</th>
                                                <th>Name</th>
                                                <th>Short</th>
                                                <th class="text-center" width="50px">Status</th>
                                                <th class="text-center" width="50px">Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $platform)
                                                <tr>
                                                    <td class="text-center">{{ ++$key }}</td>
                                                    <td>{{ $platform->name }}</td>
                                                    <td>{{ $platform->short }}</td>
                                                    <td class="text-center">{!! getGenStatus('general', $platform->status, 'badge') !!}</td>
                                                    <td class="text-center"> <a href="{{ route('platform.edit', $platform->id) }}"><i class="bx bx-pencil"></i></a></td>
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
                <div class="col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Terms</h4>
                            <form method="POST" action="{{ route('setting.store') }}">
                                @csrf
                                <input type="hidden" name="type" value="term">
                                <!-- Titles Row -->
                                <div class="d-flex align-items-center mb-2 fw-bold">
                                    <div class="me-2" style="width: 30%;">Title</div>
                                    <div class="me-2" style="width: 30%;">Link</div>
                                    <div class="me-2" style="width: 30%;">Required</div>
                                </div>
                                <div id="terms-container">
                                    @foreach (getSettingData('term') as $term)
                                    <div class="d-flex align-items-center terms-row mb-2">
                                        <input type="text" name="title[]" class="form-control me-2" value="{{ $term->title ?? '' }}" placeholder="Title" required>
                                        <input type="text" name="link[]" class="form-control me-2" value="{{ $term->link ?? '' }}" placeholder="Link" required>
                                        <select id="is_required" name="is_required[]" class="form-control me-2" required>
                                            <option value="">Select Option </option>
                                            @foreach (getGenStatus('bool') as $key => $status)
                                                <option value="{{ ++$key }}" @if($key == $term->is_required) selected @endif>{{ $status }}</option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn btn-danger btn-remove-terms">
                                            <i class="bx bx-minus-circle me-1"></i>
                                        </button>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="button" id="btn-add-terms" class="btn btn-success ">
                                        <i class="bx bx-plus-circle me-1"></i>
                                    </button>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3 w-100">Update Terms</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Language</h4>
                            <form method="POST" action="{{ route('setting.store') }}">
                                @csrf
                                <input type="hidden" name="type" value="language">
                                <!-- Titles Row -->
                                <div class="d-flex align-items-center mb-2 fw-bold">
                                    <div class="me-2">Language</div>
                                </div>
                                <div id="tax-container">
                                    <div class="d-flex align-items-center tax-row mb-2">
                                        <select name="language" class="form-control" required>
                                            <option value="">Select Language</option>
                                            @foreach (getLang('lang') as $keyL => $lang)
                                                <option value="{{ $lang }}"  @if($lang == getSettingData('language')->language) selected @endif>{{ $lang }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3 w-100">Update inspection and diagnostics amount</button>
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

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Add Terms Row
        $('#btn-add-terms').on('click', function () {
            $('#terms-container').append(`
                <div class="d-flex align-items-center terms-row mb-2">
                    <input type="text" name="title[]" class="form-control me-2" placeholder="Title" required>
                    <input type="text" name="link[]" class="form-control me-2" placeholder="Link" required>
                    <select id="is_required" name="is_required[]" class="form-control me-2" required>
                        <option value="">Select Option </option>
                        @foreach (getGenStatus('bool') as $key => $status)
                            <option value="{{ ++$key }}" @if($key == $term->is_required']) selected @endif>{{ $status }}</option>
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-danger btn-remove-terms">
                        <i class="bx bx-minus-circle me-1"></i>
                    </button>
                </div>
            `);
        });

        // Remove Terms Row
        $(document).on('click', '.btn-remove-terms', function () {
            $(this).closest('.terms-row').remove();
        });

    });
</script>
