@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-check-all me-2"></i><strong>Success! </strong>
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ config('app.name', '') }}</a></li>
                                <li class="px-1"> > </li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-4">
                    <div class="card overflow-hidden">
                        <div class="bg-primary-subtle">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-3">
                                        <h5 class="text-primary">Welcome Back !</h5>
                                        <p>{{ config('app.name', '') }} Dashboard</p>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="{{ asset('images/profile-img.png') }}" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-sm-12">
                                    @php
                                        $userPicture = Auth::user()->picture ? asset('images/users/' . Auth::user()->picture) : asset('images/users/default.jpg');
                                    @endphp
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <img  src="{{ $userPicture }}" alt="{{Auth::user()->first_name}}" class="img-thumbnail rounded-circle" onerror="{{ $userPicture}}">
                                    </div>
                                    <h5 class="font-size-15">{{ Auth::user()->first_name .' '. Auth::user()->last_name }}</h5>
                                    <p class="text-muted mb-0 text-truncate">{{ getUsertype('all', Auth::user()->user_type) }} </p>
                                </div>
                                {{-- <div class="col-sm-8">
                                    <div class="pt-4">

                                        <div class="row">
                                            <div class="col-6">
                                                <h5 class="font-size-15">125</h5>
                                                <p class="text-muted mb-0">Projects</p>
                                            </div>
                                            <div class="col-6">
                                                <h5 class="font-size-15">$1245</h5>
                                                <p class="text-muted mb-0">Revenue</p>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <a href="javascript: void(0);" class="btn btn-primary waves-effect waves-light btn-sm">View Profile <i class="mdi mdi-arrow-right ms-1"></i></a>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    {{-- <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Monthly Earning</h4>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="text-muted">This month</p>
                                    <h3>$34,252</h3>
                                    <p class="text-muted"><span class="text-success me-2"> 12% <i class="mdi mdi-arrow-up"></i> </span> From previous period</p>

                                    <div class="mt-4">
                                        <a href="javascript: void(0);" class="btn btn-primary waves-effect waves-light btn-sm">View More <i class="mdi mdi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mt-4 mt-sm-0">
                                        <div id="radialBar-chart" data-colors='["--bs-primary"]' class="apex-charts"></div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-muted mb-0">We craft digital, graphic and dimensional thinking.</p>
                        </div>
                    </div> --}}
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Usage</h4>
                            <div id="tab3"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Number of Orders</p>
                                            <h4 class="mb-0">{{ $data['case_count'] }}</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="bx bx-copy-alt font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Total Amount</p>
                                            <h4 class="mb-0">{{ numberFormat($data['case_total'], 'euro') }}</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="bx bx-archive-in font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Average Price</p>
                                            <h4 class="mb-0">{{ numberFormat($data['case_average'], 'euro') }}</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    {{-- <h4 class="card-title mb-4">Realtime Monitor</h4> --}}
                                    {{-- <div class="text-muted text-center">
                                    </div> --}}
                                    <div id="chart1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Realtime Monitor</h4>
                                    <div class="text-muted text-center">
                                        <h4 class="mb-3 mt-4">INTERNET SPEED</h4>
                                        <p class="mb-3">
                                            <span class="badge badge-soft-primary font-size-11 me-2"> {{$data['upload_speed']}} MB <i class="mdi mdi-arrow-up"></i> </span> Uploading
                                        </p>
                                        <p class="mb-2">
                                            <span class="badge badge-soft-success font-size-11 me-2"> {{$data['download_speed']}} MB <i class="mdi mdi-arrow-down"></i> </span> Downloading
                                        </p>
                                    </div>

                                    <div class="table-responsive mt-4">
                                        <table class="table align-middle mb-0">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <h1 class="font-size-14 mb-1">Memory</h1>
                                                        <p class="text-muted mb-0">7.9% used</p>
                                                    </td>

                                                    <td>
                                                        <div id="radialchart-1" data-colors='["--bs-primary"]' class="apex-charts"></div>
                                                    </td>
                                                    <td>
                                                        <p class="text-muted mb-1">Available</p>
                                                        <h5 class="mb-0">{{$data['memory_info']['memory_percent']}} %</h5>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h1 class="font-size-14 mb-1">Disk</h1>
                                                        <p class="text-muted mb-0">24.9% used</p>
                                                    </td>

                                                    <td>
                                                        <div id="radialchart-2" data-colors='["--bs-success"]' class="apex-charts"></div>
                                                    </td>
                                                    <td>
                                                        <p class="text-muted mb-1">Available</p>
                                                        <h5 class="mb-0">{{$data['memory_info']['disk_percent']}} %</h5>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h1 class="font-size-14 mb-1">CPU</h1>
                                                        <p class="text-muted mb-0">10.5% used</p>
                                                    </td>
                                                    <td>
                                                        <div id="radialchart-3" data-colors='["--bs-success"]' class="apex-charts"></div>
                                                    </td>
                                                    <td>
                                                        <p class="text-muted mb-1">Available</p>
                                                        <h5 class="mb-0">{{$data['cpu_info']['cpu_percent']}} %</h5>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">CPU Information</h4>

                                    <div class="text-center">
                                        <h3>{{$data['cpu_info']['num_cpus']}} Cores</h3>
                                    </div>

                                    <div class="table-responsive mt-4">
                                        <table class="table align-middle table-nowrap">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 30%">
                                                        <p class="mb-0">CURRENT FREQUENCY</p>
                                                    </td>
                                                    <td style="width: 25%">
                                                        <h5 class="mb-0">{{$data['cpu_info']['cpu_freq']['current']}} GHz</h5></td>
                                                    <td>
                                                        <div class="progress bg-transparent progress-sm">
                                                            <div class="progress-bar bg-primary rounded" role="progressbar" style="width: 1000%" aria-valuenow="94" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p class="mb-0">MINIMUM FREQUENCY</p>
                                                    </td>
                                                    <td>
                                                        <h5 class="mb-0">{{$data['cpu_info']['cpu_freq']['min']}} MHz</h5>
                                                    </td>
                                                    <td>
                                                        <div class="progress bg-transparent progress-sm">
                                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 100%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p class="mb-0">MAXIMUM FREQUENCY</p>
                                                    </td>
                                                    <td>
                                                        <h5 class="mb-0">{{$data['cpu_info']['cpu_freq']['max']}} MHz</h5>
                                                    </td>
                                                    <td>
                                                        <div class="progress bg-transparent progress-sm">
                                                            <div class="progress-bar bg-warning rounded" role="progressbar" style="width: 100%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Usage</h4>
                                    <div id="tab3"></div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!-- end row -->
                </div>
            </div>
        </div>
    </div>

<script>
    var statusCount = @json($data['status_count']);

    // Extract labels and series data from the statusCount object
    var labels = Object.keys(statusCount);
    var series = Object.values(statusCount);

    // Options for ApexCharts
    var options = {
        series: series,
        chart: {
            width: 370,
            type: 'donut',
        },
        plotOptions: {
            pie: {
                // Optional settings
            }
        },
        dataLabels: {
            enabled: false
        },
        fill: {
            // Optional settings
        },
        legend: {
            formatter: function(val, opts) {
                return val + " - " + opts.w.globals.series[opts.seriesIndex]
            }
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }],
        // colors: ['#86ea7e', '#f17f7f', '#fcc429',], // Customize colors if needed
        labels: labels, // Set the labels dynamically
    };

    // Create and render the chart
    var chart = new ApexCharts(document.querySelector("#tab3"), options);
    chart.render();


    // Pass the PHP data to JavaScript FOR Monthly chart
    var months = @json($data['months']);
    var productCounts = @json($data['products']);
    var serviceCounts = @json($data['services']);

    var options = {
        series: [
            {
                name: 'Products',
                type: 'column',
                data: productCounts
            },
            {
                name: 'Services',
                type: 'column',
                data: serviceCounts
            },
            // Uncomment and use if you have a line series
            // {
            //     name: 'Revenue',
            //     type: 'line',
            //     data: [/* your data here */]
            // }
        ],
        chart: {
            height: 350,
            type: 'line',
            stacked: false
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            width: [1, 1, 4]
        },
        title: {
            text: 'Monthly Products and Services Count',
            align: 'left',
            offsetX: 110
        },
        xaxis: {
            categories: months,
        },
        yaxis: [
            {
                seriesName: 'Products',
                axisTicks: {
                    show: true,
                },
                axisBorder: {
                    show: true,
                    color: '#008FFB'
                },
                labels: {
                    style: {
                        colors: '#008FFB',
                    }
                },
                title: {
                    text: "Count",
                    style: {
                        color: '#008FFB',
                    }
                },
                tooltip: {
                    enabled: true
                }
            },
            {
                seriesName: 'Services',
                opposite: true,
                axisTicks: {
                    show: true,
                },
                axisBorder: {
                    show: true,
                    color: '#00E396'
                },
                labels: {
                    style: {
                        colors: '#00E396',
                    }
                },
                title: {
                    text: "Count",
                    style: {
                        color: '#00E396',
                    }
                },
            }
        ],
        tooltip: {
            fixed: {
                enabled: true,
                position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
                offsetY: 30,
                offsetX: 60
            },
        },
        legend: {
            horizontalAlign: 'left',
            offsetX: 40
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart1"), options);
    chart.render();
</script>
@endsection
