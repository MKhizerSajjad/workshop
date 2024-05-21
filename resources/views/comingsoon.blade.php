@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container">
            <div class="row">
                {{-- <div class="col-lg-6">
                    <div class="text-center">
                        <div>
                            <img src="{{ asset('images/verification-img.png') }}" alt="" class="img-fluid">
                        </div>
                    </div>
                </div> --}}
                <div class="col-lg-12">
                    <div class="text-center mt-5">
                        <h3 class="display-3 fw-medium">C<i class="bx bx-buoy bx-spin text-primary display-4"></i>ming</h3>
                        <h3 class="display-3 fw-medium">Soon</h3>
                        <div class="mt-3 text-center">
                            <a class="btn btn-primary waves-effect waves-light" href="{{ route('dashboard')}}"> <i class="bx bx-home-circle me-2"></i>Back to Dashboard</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
