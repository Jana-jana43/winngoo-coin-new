@extends('layouts.auth')
@section('title','Forgot Password | Winngoocoin')
@section('content')

<div class="auth-page-wrapper pt-4">

    <!-- auth page bg -->
    <div class="auth-one-bg-position" id="auth-particles">
        <div class="bg-overlay"></div>

        <div class="shape">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120">
                <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
            </svg>
        </div>
    </div>

    <!-- auth page content -->
    <div class="auth-page-content">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mt-sm-5 mb-0 text-white-50">
                        <h5 class="text-white">Forgot Password?</h5>
                        <p class="mt-2 fs-15 fw-medium">Reset password now</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">

                    <div class="card mt-4 card-bg-fill">

                        <div class="card-body p-4">

                            {{-- LOGO --}}
                            <div class="text-center mb-3">
                                <img src="{{ asset('assets/images/winngoo-coin.png') }}" height="75">
                            </div>

                            {{-- SUCCESS MESSAGE --}}
                            @if(session('success'))

                                <div class="text-center mb-3">
                                    <img src="{{ asset('assets/images/send-mail.gif') }}" width="100">
                                </div>

                                <div class="alert border-0 alert-success text-center">
                                    Password reset instructions have been sent to your email.
                                </div>

                                <div class="text-center mt-3">
                                    <a href="{{route('login')}}" class="btn btn-primary w-100">
                                        Go To Login
                                    </a>
                                </div>

                            @else

                                {{-- FORM --}}
                                <div class="alert border-0 alert-warning text-center mb-2">
                                    Enter your email to receive the reset instructions
                                </div>

                                <!-- <form method="POST" action="{{route('admin.forgot.password.send')}}">
                                    @csrf

                                    <div class="mb-4">
                                        <label class="form-label">
                                            Email Id <span class="text-danger">*</span>
                                        </label>

                                        <div class="form-icon">
                                            <input type="email"
                                                class="form-control form-control-icon @error('email') is-invalid @enderror"
                                                name="email"
                                                placeholder="Enter Registered Email Id"
                                                >

                                            <i class="ri-mail-unread-line"></i>
                                        </div>
                                         @error('email')
        <small class="text-danger">{{ $message }}</small>
    @enderror
                                    </div>

                                    <div class="row">

                                        <div class="col-6">
                                            <a href="{{route('login')}}" class="btn btn-light w-100">
                                                Back To Login
                                            </a>
                                        </div>

                                        <div class="col-6">
                                            <button class="btn btn-primary w-100">
                                                Send Reset Link
                                            </button>
                                        </div>

                                    </div>

                                </form> -->

<form method="POST" action="{{route('admin.forgot.password.send')}}" novalidate>
@csrf

<div class="mb-4">

<label class="form-label">
Email Id <span class="text-danger">*</span>
</label>

<div class="form-icon">

<input
type="text"
name="email"
value="{{ old('email') }}"
class="form-control form-control-icon @error('email') @enderror"
placeholder="Enter Registered Email Id">

<i class="ri-mail-unread-line"></i>

</div>

@error('email')
<small class="text-danger error-msg">{{ $message }}</small>
@enderror

</div>

<div class="row">

<div class="col-6">
<a href="{{route('login')}}" class="btn btn-light w-100">
Back To Login
</a>
</div>

<div class="col-6">
<button type="submit" id="resetBtn" class="btn btn-primary w-100">
Send Reset Link
</button>
</div>

</div>

</form>

                                
                            @endif

                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>

@include('layouts.footer')

@endsection

@push('scripts')
<script>
document.querySelector("input[name='email']").addEventListener("input", function () {
    let error = document.querySelector(".error-msg");
    if(error){
        error.style.display = "none";
    }
});
</script>
<script>
document.querySelector("form").addEventListener("submit", function () {
    let btn = document.getElementById("resetBtn");
    btn.innerText = "Processing...";
    btn.disabled = true;
});
</script>
@endpush