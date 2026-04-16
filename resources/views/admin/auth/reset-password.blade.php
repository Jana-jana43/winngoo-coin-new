@extends('layouts.auth')
@section('title','Reset Password | Winngoocoin')
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
                        <div class="text-center mt-sm-5 mb-0 text-white-50">
                            <h5 class="text-white">Reset Password</h5>
                            <p class="mt-2 fs-15 fw-medium">You are ready to go</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4 card-bg-fill">
                            <div class="card-body p-4" id="resetFormCard">
                                <div class="text-center">
                                    <div class="auth-logo"><img src="{{ asset('assets/images/winngoo-coin.png') }}" alt="winngoo-coin" height="75"></div>
                                </div>
                                <div class="p-2">
                                    <!-- <form> -->
                                     <form method="POST" action="{{ route('admin.password.update') }}" id="resetPasswordForm">

    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <input type="hidden" name="email" value="{{ $email }}">

    <!-- New Password -->
    <div class="mb-3">
        <label class="form-label" for="new-password-input">
            New Password <span class="text-danger">*</span>
        </label>
        <div class="position-relative auth-pass-inputgroup mb-1 two-icon-sec">
            <input type="password"
                   class="form-control pe-5 password-input form-control-icon"
                   name="password"
                   placeholder="Enter New Password"
                   id="new-password-input"
                   >
            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon material-shadow-none"
                    type="button"
                    id="new-password-addon">
                <i class="ri-eye-fill align-middle"></i>
            </button>
            <i class="ri-lock-line form-i"></i>
        </div>

        <!-- Password Rules -->
       <!-- Password Rules - single line -->
<small id="password-rules" class="d-block mt-1"></small>
    </div>

    <!-- Confirm Password -->
    <div class="mb-3">
        <label class="form-label" for="confirm-password-input">
            Confirm Password <span class="text-danger">*</span>
        </label>
        <div class="position-relative auth-pass-inputgroup mb-1 two-icon-sec">
            <input type="password"
                   class="form-control pe-5 form-control-icon"
                   placeholder="Enter Confirm Password"
                   name="password_confirmation"
                   id="confirm-password-input"
                   >
            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted material-shadow-none"
                    type="button"
                    id="confirm-password-addon">
                <i class="ri-eye-fill align-middle"></i>
            </button>
            <i class="ri-lock-line form-i"></i>
        </div>

        <!-- Match Message -->
        <small id="password-match-msg" class="d-block mt-1"></small>
    </div>

    <!-- Submit -->
    <div class="mt-4">
<button class="btn btn-primary w-100" type="submit" id="submit-btn">
    <span id="btn-text">Reset Password</span>
    <span id="btn-loader" class="d-none">
        <i class="spinner-border spinner-border-sm"></i> Loading...
    </span>
</button>
    </div>
</form>
                                </div>
                            </div>

                            <div class="card-body p-4 d-none" id="successCard">
                                <div class="text-center mb-2">
                                    <div class="auth-logo">
                                        <img src="{{ asset('assets/images/winngoo-coin.png') }}" alt="winngoo-coin" height="75">
                                    
                                    
                                    </div>
                                </div>                               
                                <div class="alert border-0 alert-success text-center mb-2 mx-2" role="alert">                                    
                                    <strong>Password Reset Successful!</strong><br>
                                    You can now login using your new password.
                                </div>
                            

                                   <div class="p-2">
        <div class="text-center mt-3">
            <a href="{{ route('login') }}" class="btn btn-primary w-100">
                Go To Login
            </a>
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

        <!-- footer -->
        <!-- <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                <script>document.write(new Date().getFullYear())</script> Winngoo Coin. All Rights Reserved
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer> -->
        <!-- end Footer -->
    </div>
  @include('layouts.footer')
@endsection
@push('scripts')
@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {

    function togglePassword(inputId, buttonId) {
        const input = document.getElementById(inputId);
        const button = document.getElementById(buttonId);
        if (!input || !button) return;

        button.addEventListener("click", function () {
            input.type = input.type === "password" ? "text" : "password";
            button.innerHTML = input.type === "password"
                ? '<i class="ri-eye-fill align-middle"></i>'
                : '<i class="ri-eye-off-fill align-middle"></i>';
        });
    }

    togglePassword("new-password-input", "new-password-addon");
    togglePassword("confirm-password-input", "confirm-password-addon");

    const form          = document.getElementById("resetPasswordForm");
    const passwordInput = document.getElementById("new-password-input");
    const confirmInput  = document.getElementById("confirm-password-input");
    const rulesMsg      = document.getElementById("password-rules");
    const matchMsg      = document.getElementById("password-match-msg");

    let isPasswordDirty = false;
    let isConfirmDirty  = false;

    function validateAll() {
        const val     = passwordInput.value;
        const confirm = confirmInput.value;

        const [length, upper, lower, number, special] = [
            val.length >= 8,
            /[A-Z]/.test(val),
            /[a-z]/.test(val),
            /[0-9]/.test(val),
            /[!@#$%^&*(),.?":{}|<>]/.test(val)
        ];

        const allPassed = length && upper && lower && number && special;

        //  PASSWORD VALIDATION
        if (isPasswordDirty) {
            if (val === "") {
                rulesMsg.className = "d-block mt-1 text-danger";
                rulesMsg.innerHTML = 'Password is required.';
            } 
            else if (!allPassed) {
                const missing = [
                    !length  && "at least 8 characters",
                    !upper   && "one uppercase letter",
                    !lower   && "one lowercase letter",
                    !number  && "one number",
                    !special && "one special character"
                ].filter(Boolean).join(", ");

                rulesMsg.className = "d-block mt-1 text-danger";
                rulesMsg.innerHTML = `Password must contain ${missing}.`;
            } 
            else {
                rulesMsg.innerHTML = "";
            }
        }


    //  CONFIRM PASSWORD VALIDATION (SMART UX)
if (isConfirmDirty) {

    if (confirm === "") {
        matchMsg.className = "d-block mt-1 text-danger";
        matchMsg.innerHTML = 'Please confirm your password.';
    } 
    else if (confirm.length < val.length) {
        //  User still typing → don't show error
        matchMsg.innerHTML = "";
    }
    else if (val === confirm) {
        matchMsg.className = "d-block mt-1 text-success";
        matchMsg.innerHTML = '';
    } 
    else {
        matchMsg.className = "d-block mt-1 text-danger";
        matchMsg.innerHTML = 'Passwords do not match.';
    }

} else {
    matchMsg.innerHTML = "";
}
    }

    //  EVENTS
    passwordInput.addEventListener("input", function () {
        isPasswordDirty = true;
        validateAll();
    });

    confirmInput.addEventListener("input", function () {
        isConfirmDirty = true;
        validateAll();
    });

    //  FORM SUBMIT
form.addEventListener("submit", function (e) {

    if (!form.checkValidity()) {
        return;
    }

    const val     = passwordInput.value;
    const confirm = confirmInput.value;

    const isValid =
        val.length >= 8 &&
        /[A-Z]/.test(val) &&
        /[a-z]/.test(val) &&
        /[0-9]/.test(val) &&
        /[!@#$%^&*(),.?":{}|<>]/.test(val) &&
        val === confirm;

    if (!isValid) {
        e.preventDefault();

        isPasswordDirty = true;
        isConfirmDirty  = true;

        validateAll();
    } else {
        //  SHOW LOADER ONLY WHEN VALID
        const btn = document.getElementById("submit-btn");
        document.getElementById("btn-text").classList.add("d-none");
        document.getElementById("btn-loader").classList.remove("d-none");
        btn.disabled = true;
    }
});

});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    @if(session('success'))
        document.getElementById("resetFormCard").classList.add("d-none");
        document.getElementById("successCard").classList.remove("d-none");
    @endif

});
</script>

@endpush

