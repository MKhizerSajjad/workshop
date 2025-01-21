@extends('layouts.app')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- Page Title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Translations</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li><a href="javascript:void(0);">Settings</a></li>
                            <li class="mx-1"> > </li>
                            <li class="breadcrumb-item active">Translations</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alerts -->
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i><strong>Oops!</strong> There were some problems with your input.
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="ri-check-double-line me-3"></i><strong>Success!</strong> {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Add Translation Modal -->
        <div class="modal fade" id="addTranslationModal" tabindex="-1" aria-labelledby="addTranslationModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTranslationModalLabel">Add New Translation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('translations.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="key" class="form-label">Translation Key</label>
                                <input type="text" class="form-control" id="key" name="key" required placeholder="e.g., 'welcome_message'">
                            </div>

                            <div class="form-group">
                                <label for="language" class="form-label">Language</label>
                                <select name="language" class="form-control" required>
                                    @foreach($languages as $language)
                                        <option value="{{ $language }}">{{ strtoupper($language) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="value" class="form-label">Translation Value</label>
                                <textarea class="form-control" id="value" name="value" required rows="3" placeholder="Enter translation value here..."></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Translation</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Translations List -->
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-lg border-light">
                    <div class="card-body">
                        @php
                            $lang = request()->get('lang') ?? 'en';
                        @endphp
                        <!-- Filters and Actions -->
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <h4 class="card-title">Translations List</h4>
                            </div>
                            <div class="col-lg-8 text-end">
                                <form method="GET" class="d-inline-flex align-items-center">
                                    <select name="lang" id="lang" class="form-select" style="max-width: 150px;">
                                        <option value=""> Select Language </option>
                                        @foreach($languages as $language)
                                            <option value="{{ $language }}" {{ $lang == $language ? 'selected' : '' }}>{{ strtoupper($language) }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-info ms-2"><i class="bx bx-filter-alt"></i> Filter</button>
                                </form>
                                <button class="btn btn-primary ms-1" data-bs-toggle="modal" data-bs-target="#addTranslationModal">
                                    <i class="bx bx-plus"></i> Add Translation
                                </button>
                            </div>
                        </div>

                        <!-- Existing Translations Table -->
                        <form action="{{ route('translations.updateMultiple') }}" method="POST">
                            @csrf
                            <input type="hidden" name="language" value="{{$lang}}">

                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Key</th>
                                        <th>Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($keys as $key)
                                        <tr>
                                            <input type="hidden" name="keys[]" value="{{ $key }}">
                                            <td>{{ $key }}</td>
                                            <td>
                                                <input type="text" class="form-control" name="values[{{ $key }}]" value="{{ $translations[$key] ?? '' }}" placeholder="Enter translation value">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <button type="submit" class="btn btn-primary w-100">Save Translations</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@section('scripts')
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#translationsTable').DataTable();
    });
</script>
@endsection
@endsection
