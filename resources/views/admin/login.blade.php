@extends('layouts.auth')
@section('title', 'Login | Winngoo Coin')
@section('content')
   
 <div class="auth-page-wrapper pt-4">
        <!-- auth page bg -->
        <div class="auth-one-bg-position" id="auth-particles">
            <div class="bg-overlay"></div>
            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-2 text-white-50">
                            <h5 class="text-white">Welcome Back !</h5>
                            <p class="mt-2 fs-15 fw-medium">Login to continue to dashboard</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4 card-bg-fill">
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <div class="auth-logo">
                                        
                                      
                                        <img src="{{ asset('assets/images/winngoo-coin.png') }}" height="75">
                                        
                                        </div>
                                </div>
                                <div class="p-2">
                                    <form action="{{route('login.submit')}} " method="POST">
                                        @if(session('error'))
    <div class="alert alert-danger text-center" id="errorAlert">
        {{ session('error') }}
    </div>
@endif
                                        @csrf
                                        <div class="mb-3">
                                            <label for="login" class="form-label">Username <span class="text-danger">*</span></label>
                                            <div class="form-icon">
                                                <input type="text" name="login" id="login" class="form-control form-control-icon"  placeholder="Email Id / Username" value="{{ old('login') }}" >
                                                <i class="ri-mail-unread-line"></i>
                                            </div>
                                             @error('login')
            <small class="text-danger login-error">{{ $message }}</small>
        @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                                            <div class="position-relative auth-pass-inputgroup mb-3 two-icon-sec">
                                                <input type="password" name="password" class="form-control pe-5 password-input form-control-icon" placeholder="Enter password" id="password-input">
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon material-shadow-none" type="button" id="password-toggle"><i class="ri-eye-fill align-middle"></i></button>
                                                <i class="ri-lock-line form-i"></i>
                                            </div>
                                              @error('password')
            <small class="text-danger password-error">{{ $message }}</small>
        @enderror
                                        </div>

                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="auth-remember-check">
                                                <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                                <div class="float-end">
                                                    <a href="{{ route('admin.forgot.password') }}">Forgot password?</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <button class="btn btn-primary w-100" type="submit">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

          @include('layouts.footer')

    </div>
    <!-- end auth-page-wrapper -->



@endsection 
@push('scripts')
<script>
$(document).ready(function () {

    // Hide login error when typing
    $('#login').on('keyup', function () {
        $('.login-error').fadeOut(200, function () {
            $(this).remove();
        });
    });

    // Hide password error when typing
    $('#password-input').on('keyup', function () {
        $('.password-error').fadeOut(200, function () {
            $(this).remove();
        });
    });

});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const errorBox = document.getElementById("errorAlert");

    if (errorBox) {
        setTimeout(() => {
            errorBox.style.display = "none";
        }, 4000); // 2 seconds
    }
});
</script>
@endpush
