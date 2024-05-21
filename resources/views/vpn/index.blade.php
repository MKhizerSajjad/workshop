@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mt-2">
                        {{-- <h1 class="display-2 fw-medium">4<i class="bx bx-buoy bx-spin text-primary display-3"></i>4</h1> --}}
                        <h4>Bravo! You've already applied for VPN.</h4>
                        <div class="mt-3 text-center">
                            <a class="btn btn-primary waves-effect waves-light" href="{{ route('dashboard')}}"> <i class="bx bx-home-circle me-2"></i>Back to Dashboard</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8 col-xl-6">
                    <div>
                        <img src="{{asset('images/error-img.png')}}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
