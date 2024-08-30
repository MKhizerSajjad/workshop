@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Project Overview</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Project</a></li>
                                <li class="breadcrumb-item active">Project Overview</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-4">
                                    <img src="assets/images/companies/img-1.png" alt="" class="avatar-sm">
                                </div>

                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="text-truncate font-size-15">Skote Dashboard UI</h5>
                                    <p class="text-muted">Separate existence is a myth. For science, music, sport, etc.</p>
                                </div>
                            </div>

                            <h5 class="font-size-15 mt-4">Project Details :</h5>

                            <p class="text-muted">To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental is. The European languages are members of the same family. Their separate existence is a myth. For science, music, sport, etc,</p>

                            <div class="text-muted mt-4">
                                <p><i class="mdi mdi-chevron-right text-primary me-1"></i> To achieve this, it would be necessary</p>
                                <p><i class="mdi mdi-chevron-right text-primary me-1"></i> Separate existence is a myth.</p>
                                <p><i class="mdi mdi-chevron-right text-primary me-1"></i> If several languages coalesce</p>
                            </div>

                            <div class="row task-dates">
                                <div class="col-sm-4 col-6">
                                    <div class="mt-4">
                                        <h5 class="font-size-14"><i class="bx bx-calendar me-1 text-primary"></i> Start Date</h5>
                                        <p class="text-muted mb-0">08 Sept, 2019</p>
                                    </div>
                                </div>

                                <div class="col-sm-4 col-6">
                                    <div class="mt-4">
                                        <h5 class="font-size-14"><i class="bx bx-calendar-check me-1 text-primary"></i> Due Date</h5>
                                        <p class="text-muted mb-0">12 Oct, 2019</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Team Members</h4>

                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap">
                                    <tbody>
                                        <tr>
                                            <td style="width: 50px;"><img src="assets/images/users/avatar-2.jpg" class="rounded-circle avatar-xs" alt=""></td>
                                            <td><h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">Daniel Canales</a></h5></td>
                                            <td>
                                                <div>
                                                    <a href="javascript: void(0);" class="badge bg-primary-subtle text-primary font-size-11">Frontend</a>
                                                    <a href="javascript: void(0);" class="badge bg-primary-subtle text-primary font-size-11">UI</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="assets/images/users/avatar-1.jpg" class="rounded-circle avatar-xs" alt=""></td>
                                            <td><h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">Jennifer Walker</a></h5></td>
                                            <td>
                                                <div>
                                                    <a href="javascript: void(0);" class="badge bg-primary-subtle text-primary font-size-11">UI / UX</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-primary text-white font-size-16">
                                                        C
                                                    </span>
                                                </div>
                                            </td>
                                            <td><h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">Carl Mackay</a></h5></td>
                                            <td>
                                                <div>
                                                    <a href="javascript: void(0);" class="badge bg-primary-subtle text-primary font-size-11">Backend</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="assets/images/users/avatar-4.jpg" class="rounded-circle avatar-xs" alt=""></td>
                                            <td><h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">Janice Cole</a></h5></td>
                                            <td>
                                                <div>
                                                    <a href="javascript: void(0);" class="badge bg-primary-subtle text-primary font-size-11">Frontend</a>
                                                    <a href="javascript: void(0);" class="badge bg-primary-subtle text-primary font-size-11">UI</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-primary text-white font-size-16">
                                                        T
                                                    </span>
                                                </div>
                                            </td>
                                            <td><h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">Tony Brafford</a></h5></td>
                                            <td>
                                                <div>
                                                    <a href="javascript: void(0);" class="badge bg-primary-subtle text-primary font-size-11">Backend</a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Overview</h4>

                            <div id="overview-chart" class="apex-charts" dir="ltr" style="min-height: 305px;"><div id="apexchartsg46srphp" class="apexcharts-canvas apexchartsg46srphp apexcharts-theme-light" style="width: 351px; height: 290px;"><svg id="SvgjsSvg1139" width="351" height="290" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><foreignObject x="0" y="0" width="351" height="290"><div class="apexcharts-legend" xmlns="http://www.w3.org/1999/xhtml" style="max-height: 145px;"></div></foreignObject><g id="SvgjsG1226" class="apexcharts-yaxis" rel="0" transform="translate(21.340991020202637, 0)"><g id="SvgjsG1227" class="apexcharts-yaxis-texts-g"><text id="SvgjsText1229" font-family="Helvetica, Arial, sans-serif" x="20" y="31.4" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1230">80</tspan><title>80</title></text><text id="SvgjsText1232" font-family="Helvetica, Arial, sans-serif" x="20" y="79.05879907417298" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1233">60</tspan><title>60</title></text><text id="SvgjsText1235" font-family="Helvetica, Arial, sans-serif" x="20" y="126.71759814834596" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1236">40</tspan><title>40</title></text><text id="SvgjsText1238" font-family="Helvetica, Arial, sans-serif" x="20" y="174.37639722251893" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1239">20</tspan><title>20</title></text><text id="SvgjsText1241" font-family="Helvetica, Arial, sans-serif" x="20" y="222.0351962966919" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1242">0</tspan><title>0</title></text></g><g id="SvgjsG1243" class="apexcharts-yaxis-title"><text id="SvgjsText1244" font-family="Helvetica, Arial, sans-serif" x="34.69650936126709" y="125.31759814834595" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="900" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-title-text " style="font-family: Helvetica, Arial, sans-serif;" transform="rotate(-90 -9.190990447998047 121.71760702133179)">% (Percentage)</text></g></g><g id="SvgjsG1141" class="apexcharts-inner apexcharts-graphical" transform="translate(51.34099102020264, 30)"><defs id="SvgjsDefs1140"><linearGradient id="SvgjsLinearGradient1146" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1147" stop-opacity="0.4" stop-color="rgba(216,227,240,0.4)" offset="0"></stop><stop id="SvgjsStop1148" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop><stop id="SvgjsStop1149" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop></linearGradient><clipPath id="gridRectMaskg46srphp"><rect id="SvgjsRect1151" width="293.65900897979736" height="194.6351962966919" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMaskg46srphp"></clipPath><clipPath id="nonForecastMaskg46srphp"></clipPath><clipPath id="gridRectMarkerMaskg46srphp"><rect id="SvgjsRect1152" width="293.65900897979736" height="194.6351962966919" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><rect id="SvgjsRect1150" width="4.505806806352403" height="190.6351962966919" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke-dasharray="3" fill="url(#SvgjsLinearGradient1146)" class="apexcharts-xcrosshairs" y2="190.6351962966919" filter="none" fill-opacity="0.9"></rect><line id="SvgjsLine1180" x1="0" y1="191.6351962966919" x2="0" y2="197.6351962966919" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1181" x1="32.18433433108859" y1="191.6351962966919" x2="32.18433433108859" y2="197.6351962966919" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1182" x1="64.36866866217719" y1="191.6351962966919" x2="64.36866866217719" y2="197.6351962966919" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1183" x1="96.55300299326578" y1="191.6351962966919" x2="96.55300299326578" y2="197.6351962966919" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1184" x1="128.73733732435437" y1="191.6351962966919" x2="128.73733732435437" y2="197.6351962966919" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1185" x1="160.92167165544296" y1="191.6351962966919" x2="160.92167165544296" y2="197.6351962966919" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1186" x1="193.10600598653156" y1="191.6351962966919" x2="193.10600598653156" y2="197.6351962966919" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1187" x1="225.29034031762015" y1="191.6351962966919" x2="225.29034031762015" y2="197.6351962966919" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1188" x1="257.47467464870874" y1="191.6351962966919" x2="257.47467464870874" y2="197.6351962966919" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1189" x1="289.65900897979736" y1="191.6351962966919" x2="289.65900897979736" y2="197.6351962966919" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><g id="SvgjsG1176" class="apexcharts-grid"><g id="SvgjsG1177" class="apexcharts-gridlines-horizontal"></g><g id="SvgjsG1178" class="apexcharts-gridlines-vertical"></g><line id="SvgjsLine1191" x1="0" y1="190.6351962966919" x2="289.65900897979736" y2="190.6351962966919" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine1190" x1="0" y1="1" x2="0" y2="190.6351962966919" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line></g><g id="SvgjsG1179" class="apexcharts-grid-borders"><line id="SvgjsLine1225" x1="0" y1="191.6351962966919" x2="289.65900897979736" y2="191.6351962966919" stroke="#e0e0e0" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"></line></g><g id="SvgjsG1153" class="apexcharts-bar-series apexcharts-plot-series"><g id="SvgjsG1154" class="apexcharts-series" rel="1" seriesName="Overview" data:realIndex="0"><path id="SvgjsPath1159" d="M 13.839263762368095 190.6361962966919 L 13.839263762368095 90.55271824092866 L 18.345070568720498 90.55271824092866 L 18.345070568720498 190.6361962966919 Z" fill="rgba(16,41,92,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskg46srphp)" pathTo="M 13.839263762368095 190.6361962966919 L 13.839263762368095 90.55271824092866 L 18.345070568720498 90.55271824092866 L 18.345070568720498 190.6361962966919 Z" pathFrom="M 13.839263762368095 190.6361962966919 L 13.839263762368095 190.6361962966919 L 18.345070568720498 190.6361962966919 L 18.345070568720498 190.6361962966919 L 18.345070568720498 190.6361962966919 L 18.345070568720498 190.6361962966919 L 18.345070568720498 190.6361962966919 L 13.839263762368095 190.6361962966919 Z" cy="90.55171824092865" cx="46.023598093456684" j="0" val="42" barHeight="100.08347805576325" barWidth="4.505806806352403"></path><path id="SvgjsPath1161" d="M 46.023598093456684 190.6361962966919 L 46.023598093456684 57.191558889007574 L 50.52940489980909 57.191558889007574 L 50.52940489980909 190.6361962966919 Z" fill="rgba(16,41,92,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskg46srphp)" pathTo="M 46.023598093456684 190.6361962966919 L 46.023598093456684 57.191558889007574 L 50.52940489980909 57.191558889007574 L 50.52940489980909 190.6361962966919 Z" pathFrom="M 46.023598093456684 190.6361962966919 L 46.023598093456684 190.6361962966919 L 50.52940489980909 190.6361962966919 L 50.52940489980909 190.6361962966919 L 50.52940489980909 190.6361962966919 L 50.52940489980909 190.6361962966919 L 50.52940489980909 190.6361962966919 L 46.023598093456684 190.6361962966919 Z" cy="57.190558889007576" cx="78.20793242454528" j="1" val="56" barHeight="133.44463740768433" barWidth="4.505806806352403"></path><path id="SvgjsPath1163" d="M 78.20793242454528 190.6361962966919 L 78.20793242454528 95.31859814834596 L 82.71373923089769 95.31859814834596 L 82.71373923089769 190.6361962966919 Z" fill="rgba(16,41,92,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskg46srphp)" pathTo="M 78.20793242454528 190.6361962966919 L 78.20793242454528 95.31859814834596 L 82.71373923089769 95.31859814834596 L 82.71373923089769 190.6361962966919 Z" pathFrom="M 78.20793242454528 190.6361962966919 L 78.20793242454528 190.6361962966919 L 82.71373923089769 190.6361962966919 L 82.71373923089769 190.6361962966919 L 82.71373923089769 190.6361962966919 L 82.71373923089769 190.6361962966919 L 82.71373923089769 190.6361962966919 L 78.20793242454528 190.6361962966919 Z" cy="95.31759814834595" cx="110.39226675563387" j="2" val="40" barHeight="95.31759814834595" barWidth="4.505806806352403"></path><path id="SvgjsPath1165" d="M 110.39226675563387 190.6361962966919 L 110.39226675563387 38.12803925933837 L 114.89807356198628 38.12803925933837 L 114.89807356198628 190.6361962966919 Z" fill="rgba(16,41,92,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskg46srphp)" pathTo="M 110.39226675563387 190.6361962966919 L 110.39226675563387 38.12803925933837 L 114.89807356198628 38.12803925933837 L 114.89807356198628 190.6361962966919 Z" pathFrom="M 110.39226675563387 190.6361962966919 L 110.39226675563387 190.6361962966919 L 114.89807356198628 190.6361962966919 L 114.89807356198628 190.6361962966919 L 114.89807356198628 190.6361962966919 L 114.89807356198628 190.6361962966919 L 114.89807356198628 190.6361962966919 L 110.39226675563387 190.6361962966919 Z" cy="38.127039259338375" cx="142.57660108672246" j="3" val="64" barHeight="152.50815703735353" barWidth="4.505806806352403"></path><path id="SvgjsPath1167" d="M 142.57660108672246 190.6361962966919 L 142.57660108672246 128.67975750026704 L 147.08240789307487 128.67975750026704 L 147.08240789307487 190.6361962966919 Z" fill="rgba(16,41,92,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskg46srphp)" pathTo="M 142.57660108672246 190.6361962966919 L 142.57660108672246 128.67975750026704 L 147.08240789307487 128.67975750026704 L 147.08240789307487 190.6361962966919 Z" pathFrom="M 142.57660108672246 190.6361962966919 L 142.57660108672246 190.6361962966919 L 147.08240789307487 190.6361962966919 L 147.08240789307487 190.6361962966919 L 147.08240789307487 190.6361962966919 L 147.08240789307487 190.6361962966919 L 147.08240789307487 190.6361962966919 L 142.57660108672246 190.6361962966919 Z" cy="128.67875750026704" cx="174.76093541781106" j="4" val="26" barHeight="61.95643879642487" barWidth="4.505806806352403"></path><path id="SvgjsPath1169" d="M 174.76093541781106 190.6361962966919 L 174.76093541781106 90.55271824092866 L 179.26674222416347 90.55271824092866 L 179.26674222416347 190.6361962966919 Z" fill="rgba(16,41,92,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskg46srphp)" pathTo="M 174.76093541781106 190.6361962966919 L 174.76093541781106 90.55271824092866 L 179.26674222416347 90.55271824092866 L 179.26674222416347 190.6361962966919 Z" pathFrom="M 174.76093541781106 190.6361962966919 L 174.76093541781106 190.6361962966919 L 179.26674222416347 190.6361962966919 L 179.26674222416347 190.6361962966919 L 179.26674222416347 190.6361962966919 L 179.26674222416347 190.6361962966919 L 179.26674222416347 190.6361962966919 L 174.76093541781106 190.6361962966919 Z" cy="90.55171824092865" cx="206.94526974889965" j="5" val="42" barHeight="100.08347805576325" barWidth="4.505806806352403"></path><path id="SvgjsPath1171" d="M 206.94526974889965 190.6361962966919 L 206.94526974889965 57.191558889007574 L 211.45107655525206 57.191558889007574 L 211.45107655525206 190.6361962966919 Z" fill="rgba(16,41,92,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskg46srphp)" pathTo="M 206.94526974889965 190.6361962966919 L 206.94526974889965 57.191558889007574 L 211.45107655525206 57.191558889007574 L 211.45107655525206 190.6361962966919 Z" pathFrom="M 206.94526974889965 190.6361962966919 L 206.94526974889965 190.6361962966919 L 211.45107655525206 190.6361962966919 L 211.45107655525206 190.6361962966919 L 211.45107655525206 190.6361962966919 L 211.45107655525206 190.6361962966919 L 211.45107655525206 190.6361962966919 L 206.94526974889965 190.6361962966919 Z" cy="57.190558889007576" cx="239.12960407998824" j="6" val="56" barHeight="133.44463740768433" barWidth="4.505806806352403"></path><path id="SvgjsPath1173" d="M 239.12960407998824 190.6361962966919 L 239.12960407998824 107.2332979168892 L 243.63541088634065 107.2332979168892 L 243.63541088634065 190.6361962966919 Z" fill="rgba(16,41,92,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskg46srphp)" pathTo="M 239.12960407998824 190.6361962966919 L 239.12960407998824 107.2332979168892 L 243.63541088634065 107.2332979168892 L 243.63541088634065 190.6361962966919 Z" pathFrom="M 239.12960407998824 190.6361962966919 L 239.12960407998824 190.6361962966919 L 243.63541088634065 190.6361962966919 L 243.63541088634065 190.6361962966919 L 243.63541088634065 190.6361962966919 L 243.63541088634065 190.6361962966919 L 243.63541088634065 190.6361962966919 L 239.12960407998824 190.6361962966919 Z" cy="107.2322979168892" cx="271.31393841107683" j="7" val="35" barHeight="83.4028983798027" barWidth="4.505806806352403"></path><path id="SvgjsPath1175" d="M 271.31393841107683 190.6361962966919 L 271.31393841107683 42.89391916675569 L 275.8197452174292 42.89391916675569 L 275.8197452174292 190.6361962966919 Z" fill="rgba(16,41,92,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskg46srphp)" pathTo="M 271.31393841107683 190.6361962966919 L 271.31393841107683 42.89391916675569 L 275.8197452174292 42.89391916675569 L 275.8197452174292 190.6361962966919 Z" pathFrom="M 271.31393841107683 190.6361962966919 L 271.31393841107683 190.6361962966919 L 275.8197452174292 190.6361962966919 L 275.8197452174292 190.6361962966919 L 275.8197452174292 190.6361962966919 L 275.8197452174292 190.6361962966919 L 275.8197452174292 190.6361962966919 L 271.31393841107683 190.6361962966919 Z" cy="42.89291916675569" cx="303.49827274216545" j="8" val="62" barHeight="147.7422771299362" barWidth="4.505806806352403"></path><g id="SvgjsG1156" class="apexcharts-bar-goals-markers"><g id="SvgjsG1158" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMaskg46srphp)"></g><g id="SvgjsG1160" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMaskg46srphp)"></g><g id="SvgjsG1162" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMaskg46srphp)"></g><g id="SvgjsG1164" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMaskg46srphp)"></g><g id="SvgjsG1166" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMaskg46srphp)"></g><g id="SvgjsG1168" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMaskg46srphp)"></g><g id="SvgjsG1170" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMaskg46srphp)"></g><g id="SvgjsG1172" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMaskg46srphp)"></g><g id="SvgjsG1174" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMaskg46srphp)"></g></g><g id="SvgjsG1157" class="apexcharts-bar-shadows apexcharts-hidden-element-shown"></g></g><g id="SvgjsG1155" class="apexcharts-datalabels apexcharts-hidden-element-shown" data:realIndex="0"></g></g><line id="SvgjsLine1192" x1="0" y1="0" x2="289.65900897979736" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1193" x1="0" y1="0" x2="289.65900897979736" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1194" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1195" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"><text id="SvgjsText1197" font-family="Helvetica, Arial, sans-serif" x="16.092167165544296" y="219.6351962966919" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1198">1</tspan><title>1</title></text><text id="SvgjsText1200" font-family="Helvetica, Arial, sans-serif" x="48.27650149663289" y="219.6351962966919" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1201">2</tspan><title>2</title></text><text id="SvgjsText1203" font-family="Helvetica, Arial, sans-serif" x="80.46083582772148" y="219.6351962966919" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1204">3</tspan><title>3</title></text><text id="SvgjsText1206" font-family="Helvetica, Arial, sans-serif" x="112.64517015881007" y="219.6351962966919" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1207">4</tspan><title>4</title></text><text id="SvgjsText1209" font-family="Helvetica, Arial, sans-serif" x="144.82950448989868" y="219.6351962966919" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1210">5</tspan><title>5</title></text><text id="SvgjsText1212" font-family="Helvetica, Arial, sans-serif" x="177.01383882098725" y="219.6351962966919" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1213">6</tspan><title>6</title></text><text id="SvgjsText1215" font-family="Helvetica, Arial, sans-serif" x="209.19817315207587" y="219.6351962966919" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1216">7</tspan><title>7</title></text><text id="SvgjsText1218" font-family="Helvetica, Arial, sans-serif" x="241.38250748316443" y="219.6351962966919" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1219">8</tspan><title>8</title></text><text id="SvgjsText1221" font-family="Helvetica, Arial, sans-serif" x="273.56684181425305" y="219.6351962966919" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1222">9</tspan><title>9</title></text></g><g id="SvgjsG1223" class="apexcharts-xaxis-title"><text id="SvgjsText1224" font-family="Helvetica, Arial, sans-serif" x="144.82950448989868" y="251.19999885559082" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="900" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-title-text " style="font-family: Helvetica, Arial, sans-serif;">Week</text></g></g><g id="SvgjsG1245" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1246" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1247" class="apexcharts-point-annotations"></g></g></svg><div class="apexcharts-tooltip apexcharts-theme-light"><div class="apexcharts-tooltip-title" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"></div><div class="apexcharts-tooltip-series-group" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(16, 41, 92);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
                        </div>
                    </div>
                </div>
                <!-- end col -->

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Attached Files</h4>
                            <div class="table-responsive">
                                <table class="table table-nowrap align-middle table-hover mb-0">
                                    <tbody>
                                        <tr>
                                            <td style="width: 45px;">
                                                <div class="avatar-sm">
                                                    <span class="avatar-title rounded-circle bg-primary-subtle text-primary font-size-24">
                                                        <i class="bx bxs-file-doc"></i>
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="font-size-14 mb-1"><a href="javascript: void(0);" class="text-dark">Skote Landing.Zip</a></h5>
                                                <small>Size : 3.25 MB</small>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <a href="javascript: void(0);" class="text-dark"><i class="bx bx-download h3 m-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="avatar-sm">
                                                    <span class="avatar-title rounded-circle bg-primary-subtle text-primary font-size-24">
                                                        <i class="bx bxs-file-doc"></i>
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="font-size-14 mb-1"><a href="javascript: void(0);" class="text-dark">Skote Admin.Zip</a></h5>
                                                <small>Size : 3.15 MB</small>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <a href="javascript: void(0);" class="text-dark"><i class="bx bx-download h3 m-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="avatar-sm">
                                                    <span class="avatar-title rounded-circle bg-primary-subtle text-primary font-size-24">
                                                        <i class="bx bxs-file-doc"></i>
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="font-size-14 mb-1"><a href="javascript: void(0);" class="text-dark">Skote Logo.Zip</a></h5>
                                                <small>Size : 2.02 MB</small>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <a href="javascript: void(0);" class="text-dark"><i class="bx bx-download h3 m-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="avatar-sm">
                                                    <span class="avatar-title rounded-circle bg-primary-subtle text-primary font-size-24">
                                                        <i class="bx bxs-file-doc"></i>
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="font-size-14"><a href="javascript: void(0);" class="text-dark">Veltrix admin.Zip</a></h5>
                                                <small>Size : 2.25 MB</small>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <a href="javascript: void(0);" class="text-dark"><i class="bx bx-download h3 m-0"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Comments</h4>

                            <div class="d-flex mb-4">
                                <div class="flex-shrink-0 me-3">
                                    <img class="d-flex-object rounded-circle avatar-xs" alt="" src="assets/images/users/avatar-2.jpg">
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="font-size-13 mb-1">David Lambert</h5>
                                    <p class="text-muted mb-1">
                                        Separate existence is a myth.
                                    </p>
                                </div>
                                <div class="ms-3">
                                    <a href="javascript: void(0);" class="text-primary">Reply</a>
                                </div>
                            </div>

                            <div class="d-flex mb-4">
                                <div class="flex-shrink-0 me-3">
                                    <img class="d-flex-object rounded-circle avatar-xs" alt="" src="assets/images/users/avatar-3.jpg">
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="font-size-13 mb-1">Steve Foster</h5>
                                    <p class="text-muted mb-1">
                                        <a href="javascript: void(0);" class="text-success">@Henry</a>
                                        To an English person it will like simplified
                                    </p>
                                    <div class="d-flex mt-3">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle bg-primary-subtle text-primary font-size-16">
                                                    J
                                                </span>
                                            </div>
                                        </div>

                                        <div class="flex-grow-1">
                                            <h5 class="font-size-13 mb-1">Jeffrey Walker</h5>
                                            <p class="text-muted mb-1">
                                                as a skeptical Cambridge friend
                                            </p>
                                        </div>
                                        <div class="ms-3">
                                            <a href="javascript: void(0);" class="text-primary">Reply</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <a href="javascript: void(0);" class="text-primary">Reply</a>
                                </div>
                            </div>

                            <div class="d-flex mb-4">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar-xs">
                                        <span class="avatar-title rounded-circle bg-primary-subtle text-primary font-size-16">
                                            S
                                        </span>
                                    </div>
                                </div>

                                <div class="flex-grow-1">
                                    <h5 class="font-size-13 mb-1">Steven Carlson</h5>
                                    <p class="text-muted mb-1">
                                        Separate existence is a myth.
                                    </p>
                                </div>
                                <div class="ms-3">
                                    <a href="javascript: void(0);" class="text-primary">Reply</a>
                                </div>
                            </div>

                            <div class="text-center mt-4 pt-2">
                                <a href="javascript: void(0);" class="btn btn-primary btn-sm">View more</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
@endsection
