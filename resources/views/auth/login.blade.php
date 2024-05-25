@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter Email" value="{{ old('email') }}" autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="input-group auth-pass-inputgroup">
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter Password" aria-label="Password" aria-describedby="password-addon" @error('password') is-invalid @enderror autocomplete="current-password">
                                <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember-check">
                            <label class="form-check-label" for="remember-check">
                                {{ __('Remember Me') }}
                            </label>
                        </div>

                        <div class="mt-3 d-grid">
                            <button class="btn btn-primary waves-effect waves-light" type="submit">Log In</button>
                        </div>

                        <!-- <div class="mt-4 text-center">
                            <h5 class="font-size-14 mb-3">Sign in with</h5>

                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="javascript::void()" class="social-list-item bg-primary text-white border-primary">
                                        <i class="mdi mdi-facebook"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript::void()" class="social-list-item bg-info text-white border-info">
                                        <i class="mdi mdi-twitter"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript::void()" class="social-list-item bg-danger text-white border-danger">
                                        <i class="mdi mdi-google"></i>
                                    </a>
                                </li>
                            </ul>
                        </div> -->

                        {{-- <div class="mt-4 text-center">
                            <a href="artiests.html" class="text-muted"><i class="mdi mdi-lock me-1"></i> Forgot your password?</a>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
