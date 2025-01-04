@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Logs</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class=""><a href="javascript: void(0);">Logs</a></li>
                                <li class="mx-1"><a href="javascript: void(0);"> > </a></li>
                                <li class="breadcrumb-item active">Logs List</li>
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
                            <h4 class="card-title">Logs List</h4>
                            @if (count($data) > 0)
                                <div class="table-responsive" bis_skin_checked="1">
                                    <table class="table mb-0 table">
                                        <thead>
                                            <tr>
                                                <th class="text-center" width="50px">#</th>
                                                <th>User</th>
                                                <th>Module</th>
                                                <th>Action</th>
                                                <th>IP</th>
                                                <th>Platform</th>
                                                <th>Time</th>
                                                <th>Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $log)
                                                @php
                                                    // Get the raw User-Agent from the database
                                                    $userAgent = $log->user_agent;

                                                    // Extract the operating system using regex (e.g., Windows NT, Mac OS X)
                                                    preg_match('/\(([^)]+)\)/', $userAgent, $osMatches);
                                                    $os = isset($osMatches[1]) ? $osMatches[1] : 'Unknown';

                                                    // Extract the basic User-Agent string (e.g., Mozilla/5.0)
                                                    preg_match('/Mozilla\/5\.0/', $userAgent, $browserMatches);
                                                    $browserBasic = isset($browserMatches[0]) ? $browserMatches[0] : 'Unknown';

                                                    // Alternatively, you can extract just the OS name (Windows, Linux, Mac, etc.)
                                                    preg_match('/(Windows|Mac OS X|Linux|Android|iPhone|iPad)/', $userAgent, $osShortMatches);
                                                    $osShort = isset($osShortMatches[1]) ? $osShortMatches[1] : 'Unknown';
                                                @endphp

                                                <tr>
                                                    <td class="text-center">{{ ++$key }}</td>
                                                    <td>{{ $log->user_id ? $log->user->first_name : '' }}</td>
                                                    <td>{{ ucfirst($log->model_name) }}</td>
                                                    <td>{{ $log->action }}</td>
                                                    <td>{{ $log->ip_address }}</td>
                                                    <td>{{ $osShort .' - '. $browserBasic }}</td>
                                                    <td>{{ $log->created_at }}</td>
                                                    <td class="text-center">
                                                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#logModal{{ $log->id }}"><i class="bx bx-bullseye"></i></button>
                                                    </td>
                                                </tr>

                                                <!-- Modal for each log entry -->
                                                <div class="modal fade" id="logModal{{ $log->id }}" tabindex="-1" aria-labelledby="logModalLabel{{ $log->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="logModalLabel{{ $log->id }}"><strong>Log Details</strong></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body p-4">
                                                                <!-- Log Details in Grid Layout -->
                                                                <div class="row border p-2 mb-0">
                                                                    <div class="col-6">
                                                                        <strong>Module:</strong>
                                                                        {{ ucfirst($log->model_name) }}
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <strong>Action:</strong>
                                                                        {{ $log->action }}
                                                                    </div>
                                                                </div>
                                                                <div class="row border p-2 mb-0">
                                                                    <div class="col-6">
                                                                        <strong>IP Address:</strong>
                                                                        {{ $log->ip_address }}
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <strong>Platform:</strong>
                                                                        {{ $osShort .' - '. $browserBasic }}
                                                                    </div>
                                                                </div>

                                                                <!-- Time Section -->
                                                                <div class="row border p-2 mb-0">
                                                                    @if ($log->user_id)
                                                                        <div class="col-6">
                                                                            <strong>User:</strong>
                                                                            {{ $log->user->first_name .' '. $log->user->last_name }}
                                                                        </div>
                                                                    @endif
                                                                    <div class="col-6">
                                                                        <strong>Time:</strong> {{ $log->created_at }}
                                                                    </div>
                                                                </div>

                                                                <!-- Changes Section -->
                                                                <h5 class="mt-2">Changes:</h5>
                                                                <div class="row border p-3">
                                                                    @if ($log->changes)
                                                                        <div class="col-12">
                                                                            <div class="row border-bottom mb-2 pb-2">
                                                                                <div class="col-4">
                                                                                    <strong>Field</strong>
                                                                                </div>
                                                                                @if ($log->action == 'Update')
                                                                                    <div class="col-4">
                                                                                        <strong>Previous Value</strong>
                                                                                    </div>
                                                                                @endif
                                                                                <div class="col-4">
                                                                                    <strong>Current Value</strong>
                                                                                </div>
                                                                            </div>
                                                                            @foreach (json_decode($log->changes, true) as $attribute => $values)
                                                                                <div class="row border-bottom mb-2 pb-2">
                                                                                    <div class="col-4">
                                                                                        <strong>{{ ucfirst($attribute) }}</strong>
                                                                                    </div>
                                                                                    @if ($log->action == 'Update')
                                                                                        <div class="col-4">
                                                                                            <span>{{ $values['previous'] ?? 'N/A' }}</span>
                                                                                        </div>
                                                                                    @endif
                                                                                    <div class="col-4">
                                                                                        <span>{{ $values['current'] ?? 'N/A' }}</span>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    @else
                                                                        <div class="col-12 text-center">
                                                                            <p>No changes available</p>
                                                                        </div>
                                                                    @endif
                                                                </div>

                                                            </div>
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
