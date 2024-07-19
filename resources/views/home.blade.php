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
                        <h4 class="mb-sm-0 font-size-18">User Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                <li class="px-1"> > </li>
                                <li class="breadcrumb-item active">User Dashboard</li>
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
                                        <p>Killnet Dashboard</p>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="{{ asset('images/profile-img.png') }}" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-sm-4">
                                    @php
                                        $userPicture = Auth::user()->picture ? asset('images/users/' . Auth::user()->picture) : asset('images/users/default.jpg');
                                    @endphp
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <img  src="{{ $userPicture }}" alt="{{Auth::user()->first_name}}" class="img-thumbnail rounded-circle" onerror="{{ $userPicture}}">
                                    </div>
                                    <h5 class="font-size-15 text-truncate">{{ Auth::user()->first_name .' '. Auth::user()->last_name }}</h5>
                                    {{-- <p class="text-muted mb-0 text-truncate">UI/UX Designer</p> --}}
                                </div>

                                <div class="col-sm-12">
                                    <div class="pt-4">
                                        <div class="row">
                                            <div class="col-6">
                                                <p class="text-muted mb-0">IP</p>
                                                <h5 class="font-size-15">{{$data['client_ip']}}</h5>
                                            </div>
                                            <div class="col-6">
                                                <p class="text-muted mb-0">DNS IP</p>
                                                <h5 class="font-size-15">{{$data['dns_server']}}</h5>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <p class="text-muted mb-0">Ping Latency(s)</p>
                                                <h5 class="font-size-15">{{$data['ping_latency']}}s</h5>
                                            </div>
                                            <div class="col-6">
                                                <p class="text-muted mb-0">Country</p>
                                                <h5 class="font-size-15">{{$data['country']}}</h5>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <p class="text-muted mb-0">Region</p>
                                                <h5 class="font-size-15">{{$data['client_isp']}}</h5>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <p class="text-muted mb-0">ISP</p>
                                                <h5 class="font-size-15">{{$data['client_isp']}}</h5>
                                            </div>
                                            <div class="col-12">
                                                <p class="text-muted mb-0">ASN Host </p>
                                                <h5 class="font-size-15">47-72-253-252.dsl.dyn.ihug.co.nz</h5>
                                            </div>
                                            <div class="col-12">
                                                <p class="text-muted mb-0">ASN Org </p>
                                                <h5 class="font-size-15">AS9500 One New Zealand Group Limited</h5>
                                            </div>
                                        </div>
                                        <!-- <div class="mt-4">
                                            <a href="javascript: void(0);" class="btn btn-primary waves-effect waves-light btn-sm">View Profile <i class="mdi mdi-arrow-right ms-1"></i></a>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="row">

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
                                                        <!-- <p class="text-muted mb-0">7.9% used</p> -->
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
                                                        <!-- <p class="text-muted mb-0">24.9% used</p> -->
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
                                                        <!-- <p class="text-muted mb-0">10.5% used</p> -->
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
                    </div>
                    <!-- end row -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">NETWORK ADAPTER STATISTICS(NOTE THAT lo IS THE LOOPBACK ADAPTER)</h4>
                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="align-middle">Sr#</th>
                                            <th class="align-middle">Adapter</th>
                                            <th class="align-middle">Data Sent</th>
                                            <th class="align-middle">Data Received</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>lo</td>
                                            <td>{{$data['network_info']['lo']['data_sent']}} </td>
                                            <td>{{$data['network_info']['lo']['data_received']}} </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>eth0</td>
                                            <td>{{$data['network_info']['eth0']['data_sent']}} </td>
                                            <td>{{$data['network_info']['eth0']['data_received']}} </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>wlan0</td>
                                            <td>{{$data['network_info']['wlan0']['data_sent']}} </td>
                                            <td>{{$data['network_info']['wlan0']['data_received']}} </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- end table-responsive -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // var options = {
        //     series: [92.1],
        //     chart: {
        //         height: 100,
        //         type: 'radialBar',
        //     },
        //     plotOptions: {
        //         radialBar: {
        //             hollow: {
        //                 size: '35%',
        //             }
        //         },
        //     },
        //     colors: ['#FF5733'],
        //     labels: [''],
        // };

        // // Initialize the chart
        // var chart = new ApexCharts(document.querySelector("#chartTesting"), options);
        // chart.render();
        var available = {{$data['cpu_info']['cpu_percent']}};
        var used = {{100 - $data['cpu_info']['cpu_percent']}};
        var options = {
        series: [ available, used],
        chart: {
        width: 305,
        type: 'donut',
        },
        plotOptions: {
        pie: {
            // startAngle: -90,
            // endAngle: 270
        }
        },
        dataLabels: {
        enabled: false
        },
        fill: {
        //   type: 'gradient',
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
        colors: ['#86ea7e', '#f17f7f'],
        labels: ['Available', 'Used']
        };

        var chart = new ApexCharts(document.querySelector("#tab3"), options);
        chart.render();

    </script>
@endsection
