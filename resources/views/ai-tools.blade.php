@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">AI Tools</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Blogs</a></li>
                                <li class="px-1"> > </li>
                                <li class="breadcrumb-item active">AI Tools</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-tabs-custom justify-content-center pt-2" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active font-size-18" data-bs-toggle="tab" role="tab">
                                   Blogs / AI Tools
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content p-4">
                            <div class="tab-pane active" id="all-post" role="tabpanel">
                                <div>
                                    <div class="row"> <!--justify-content-center-->
                                        <div class="col-xl-12">
                                            <div>
                                                <div class="row mt-4">

                                                    <div class="col-sm-4">
                                                        <div class="card p-1 border shadow-none">
                                                            <div class="p-3">
                                                                <h5><a href="#" class="text-dark">Identify Threats</a></h5>
                                                                <p class="text-muted mb-0"><i class="bx bx-calendar text-muted"></i> 10 Apr, 2020</p>
                                                            </div>

                                                            <div class="position-relative">
                                                                <img src="{{ asset('images/blogs/threats.e414fa19fee6851803a4.jpg') }}" alt="" style="height: 265px;" class="img-thumbnail">
                                                            </div>

                                                            <div class="p-3">
                                                                <p>Malicious activities or actors targeting computer systems, networks, or digital data, posing risks to confidentiality, integrity, and availability.</p>

                                                                <div>
                                                                    <div class="btn-group btn-group-example mb-3 col-12" role="group">
                                                                        <a href="javascript: void(0);" type="button" class="btn btn-primary w-xs"><i class="mdi mdi-eye"></i> Read More</a>
                                                                        <a href="javascript: void(0);" type="button" class="btn btn-info w-xs"><i class="mdi mdi-robot"></i> Fix Using AI</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="card p-1 border shadow-none">
                                                            <div class="p-3">
                                                                <h5><a href="#" class="text-dark">Malware</a></h5>
                                                                <p class="text-muted mb-0"><i class="bx bx-calendar text-muted"></i> 10 Apr, 2020</p>
                                                            </div>

                                                            <div class="position-relative">
                                                                <img src="{{ asset('images/blogs/malware.7082428bdd936258b6fa.jpg') }}" alt="" style="height: 265px;" class="img-thumbnail">
                                                            </div>

                                                            <div class="p-3">
                                                                <p>Utilize advanced algorithms to detect and neutralize malicious software, safeguarding systems from harmful attacks.</p>

                                                                <div>
                                                                    <div class="btn-group btn-group-example mb-3 col-12" role="group">
                                                                        <a href="javascript: void(0);" type="button" class="btn btn-primary w-xs"><i class="mdi mdi-eye"></i> Read More</a>
                                                                        <a href="javascript: void(0);" type="button" class="btn btn-info w-xs"><i class="mdi mdi-robot"></i> Fix Using AI</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="card p-1 border shadow-none">
                                                            <div class="p-3">
                                                                <h5><a href="#" class="text-dark">Email Phishing</a></h5>
                                                                <p class="text-muted mb-0"><i class="bx bx-calendar text-muted"></i> 10 Apr, 2020</p>
                                                            </div>

                                                            <div class="position-relative">
                                                                <img src="{{ asset('images/blogs/phishemail.7f7c689756bd18fa90fb.png') }}" alt="" style="height: 265px;" class="img-thumbnail">
                                                            </div>

                                                            <div class="p-3">
                                                                <p>Employ sophisticated algorithms to identify fraudulent emails, protecting users from phishing attempts and unauthorized access.</p>

                                                                <div>
                                                                    <div class="btn-group btn-group-example mb-3 col-12" role="group">
                                                                        <a href="javascript: void(0);" type="button" class="btn btn-primary w-xs"><i class="mdi mdi-eye"></i> Read More</a>
                                                                        <a href="javascript: void(0);" type="button" class="btn btn-info w-xs"><i class="mdi mdi-robot"></i> Fix Using AI</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="card p-1 border shadow-none">
                                                            <div class="p-3">
                                                                <h5><a href="#" class="text-dark">Threats</a></h5>
                                                                <p class="text-muted mb-0"><i class="bx bx-calendar text-muted"></i> 10 Apr, 2020</p>
                                                            </div>

                                                            <div class="position-relative">
                                                                <img src="{{ asset('images/blogs/T.d1ab89914a25575f5c79.jpg') }}" alt="" style="height: 265px;" class="img-thumbnail">
                                                            </div>

                                                            <div class="p-3">
                                                                <p>Threats encompass a range of malicious activities, including hacking, malware, phishing, and ransomware, aimed at exploiting vulnerabilities in digital systems and networks.</p>

                                                                <div>
                                                                    <div class="btn-group btn-group-example mb-3 col-12" role="group">
                                                                        <a href="javascript: void(0);" type="button" class="btn btn-primary w-xs"><i class="mdi mdi-eye"></i> Read More</a>
                                                                        <a href="javascript: void(0);" type="button" class="btn btn-info w-xs"><i class="mdi mdi-robot"></i> Fix Using AI</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="card p-1 border shadow-none">
                                                            <div class="p-3">
                                                                <h5><a href="#" class="text-dark">Ransomware</a></h5>
                                                                <p class="text-muted mb-0"><i class="bx bx-calendar text-muted"></i> 10 Apr, 2020</p>
                                                            </div>

                                                            <div class="position-relative">
                                                                <img src="{{ asset('images/blogs/ransomware.2787c0ecec79d7e1121e.jpg') }}" alt="" style="height: 265px;" class="img-thumbnail">
                                                            </div>

                                                            <div class="p-3">
                                                                <p>Implement robust security protocols to prevent, detect, and respond to ransomware attacks, safeguarding data integrity and system availability.</p>

                                                                <div>
                                                                    <div class="btn-group btn-group-example mb-3 col-12" role="group">
                                                                        <a href="javascript: void(0);" type="button" class="btn btn-primary w-xs"><i class="mdi mdi-eye"></i> Read More</a>
                                                                        <a href="javascript: void(0);" type="button" class="btn btn-info w-xs"><i class="mdi mdi-robot"></i> Fix Using AI</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="card p-1 border shadow-none">
                                                            <div class="p-3">
                                                                <h5><a href="#" class="text-dark">Threat Hunting</a></h5>
                                                                <p class="text-muted mb-0"><i class="bx bx-calendar text-muted"></i> 10 Apr, 2020</p>
                                                            </div>

                                                            <div class="position-relative">
                                                                <img src="{{ asset('images/blogs/threathunt.d024640cd3d59c4f995d.jpg') }}" alt="" style="height: 265px;" class="img-thumbnail">
                                                            </div>

                                                            <div class="p-3">
                                                                <p>Employ proactive strategies and advanced analytics to identify and neutralize potential threats before they cause harm to systems or networks.</p>

                                                                <div>
                                                                    <div class="btn-group btn-group-example mb-3 col-12" role="group">
                                                                        <a href="javascript: void(0);" type="button" class="btn btn-primary w-xs"><i class="mdi mdi-eye"></i> Read More</a>
                                                                        <a href="javascript: void(0);" type="button" class="btn btn-info w-xs"><i class="mdi mdi-robot"></i> Fix Using AI</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="card p-1 border shadow-none">
                                                            <div class="p-3">
                                                                <h5><a href="#" class="text-dark">Vulnerability Scaning</a></h5>
                                                                <p class="text-muted mb-0"><i class="bx bx-calendar text-muted"></i> 10 Apr, 2020</p>
                                                            </div>

                                                            <div class="position-relative">
                                                                <img src="{{ asset('images/blogs/vulscan.ecf129e3d7e32ba2869f.webp') }}" alt="" style="height: 265px;" class="img-thumbnail">
                                                            </div>

                                                            <div class="p-3">
                                                                <p>Conduct comprehensive assessments of system weaknesses and potential entry points for cyber threats, enabling proactive patching and mitigation measures.</p>

                                                                <div>
                                                                    <div class="btn-group btn-group-example mb-3 col-12" role="group">
                                                                        <a href="javascript: void(0);" type="button" class="btn btn-primary w-xs"><i class="mdi mdi-eye"></i> Read More</a>
                                                                        <a href="javascript: void(0);" type="button" class="btn btn-info w-xs"><i class="mdi mdi-robot"></i> Fix Using AI</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div>
    </div>
@endsection
