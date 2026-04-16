@extends('layouts.app')
@section('title', 'Dashboard |Winngoocoin')
@section('content')

    <!-- Left Sidebar End -->
    <!-- Vertical Overlay-->
    <div class="vertical-overlay"></div>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->


    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h3 class="mb-sm-0">Change Password</h3>
                        
                        @if(auth('admin')->check() && auth('admin')->user()->hasPermission('settings', 'edit'))
                     <button type="button" class="btn btn-success btn-label waves-effect waves-light rounded-pill" id="sa-save">
    <span id="sa-btn-content">
        <i class="ri-save-3-line label-icon align-middle rounded-pill fs-16 me-2"></i>
        Update Password
    </span>
    <span id="sa-btn-loader" class="d-none">
        <i class="spinner-border spinner-border-sm me-2"></i>
        Processing...
    </span>
</button>
@endif
                   
                </div>
                 @include('layouts.success_toast')
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Manage your password</h5>
                        </div>
                        <div class="card-body">
                            <form id="changePasswordForm" method="POST" action="{{ route('admin.change.password') }}">
                                @csrf
                                <div class="row">

                                    {{-- Current Password --}}
                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="current-password">
                                                Current Password <span class="text-danger">*</span>
                                            </label>
                                            <div class="position-relative auth-pass-inputgroup mb-1 two-icon-sec">
                         <input type="password" name="current_password"
    class="form-control pe-5 password-input form-control-icon"
    placeholder="Enter current password" id="current-password"
    value="{{ session('old_current_password') ?? old('current_password') }}" required>
                                                <button
                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted material-shadow-none"
                                                    type="button" onclick="togglePassword('current-password', this)">
                                                    <i class="ri-eye-fill align-middle"></i>
                                                </button>
                                                <i class="ri-lock-line form-i"></i>
                                            </div>
                                            @error('current_password')
                                                <span class="text-danger small"><i class="ri-error-warning-line"></i>
                                                    {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
{{-- New Password --}}
<div class="col-lg-4 col-md-6">
    <div class="mb-3">
        <label class="form-label" for="new-password">
            New Password <span class="text-danger">*</span>
        </label>
        <div class="position-relative auth-pass-inputgroup mb-1 two-icon-sec">
            <input type="password" name="new_password"
                class="form-control pe-5 password-input form-control-icon"
                placeholder="Enter new password" id="new-password"
                value="{{ old('new_password') }}" required>
            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted material-shadow-none"
                type="button" onclick="togglePassword('new-password', this)">
                <i class="ri-eye-fill align-middle"></i>
            </button>
            <i class="ri-lock-line form-i"></i>
        </div>
        @error('new_password')
            <span class="text-danger small"><i class="ri-error-warning-line"></i> {{ $message }}</span>
        @else
            {{-- Hint shown only when no error --}}
        
        @enderror
    </div>
</div>

                                    {{-- Confirm Password --}}
                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="confirm-password">
                                                Confirm New Password <span class="text-danger">*</span>
                                            </label>
                                            <div class="position-relative auth-pass-inputgroup mb-1 two-icon-sec">
                                                <input type="password" name="new_password_confirmation"
                                                    class="form-control pe-5 password-input form-control-icon"
                                                    placeholder="Re-enter new password" id="confirm-password"
                                                    value="{{ old('new_password_confirmation') }}" required>
                                                <button
                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted material-shadow-none"
                                                    type="button" onclick="togglePassword('confirm-password', this)">
                                                    <i class="ri-eye-fill align-middle"></i>
                                                </button>
                                                <i class="ri-lock-line form-i"></i>
                                            </div>
                                            @error('new_password_confirmation')
                                                <span class="text-danger small"><i class="ri-error-warning-line"></i>
                                                    {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div><!--end row-->
            <!-- end page title -->
            <div class="row d-none">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Two-Factor Authentication</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-9">
                                    <h5>Secure your account with 2FA</h5>
                                    <p>Add an Extra Layour of security to your accoun</p>
                                </div>
                                <div class="col-lg-3 text-center">
                                    <button type="button"
                                        class="btn btn-primary btn-label waves-effect waves-light rounded-pill"
                                        id="sa-twofactor"><i
                                            class="ri-shield-user-line label-icon align-middle rounded-pill fs-16 me-2"></i>
                                        Enable 2FA</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


    </div>
    <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
@endsection
@push('scripts')
   


    <script>
function togglePassword(inputId, btn) {
    var input = document.getElementById(inputId);
    var icon = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('ri-eye-fill');
        icon.classList.add('ri-eye-off-fill');
    } else {
        input.type = 'password';
        icon.classList.remove('ri-eye-off-fill');
        icon.classList.add('ri-eye-fill');
    }
}

document.addEventListener("DOMContentLoaded", function () {

    const form         = document.getElementById("changePasswordForm");
    const currentInput = document.getElementById("current-password");
    const newInput     = document.getElementById("new-password");
    const confirmInput = document.getElementById("confirm-password");

    function createMsg(afterElement) {
        const small = document.createElement("small");
        small.className = "d-block mt-1";
        afterElement.closest(".position-relative").insertAdjacentElement("afterend", small);
        return small;
    }

    const currentMsg = createMsg(currentInput);
    const newMsg     = createMsg(newInput);
    const matchMsg   = createMsg(confirmInput);

    let isDirty = { current: false, new: false, confirm: false };

    // ── Current password AJAX check (blur) — NO spinner ──────────────────
    currentInput.addEventListener("blur", function () {
        const val = currentInput.value.trim();

        const serverErr = currentInput.closest(".mb-3").querySelector(".text-danger.small");
        if (serverErr) serverErr.style.display = "none";

        if (val === "") {
            isDirty.current = true;
            currentInput.dataset.valid = "false";
            currentMsg.className = "d-block mt-1 text-danger";
            currentMsg.innerHTML = "Current password is required.";
            return;
        }

        // Silent check — no spinner, no message while checking
        currentInput.dataset.valid = "pending";
        currentMsg.innerHTML = "";

        fetch("{{ route('admin.check.current.password') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            },
            body: JSON.stringify({ password: val })
        })
        .then(res => res.json())
        .then(data => {
            isDirty.current = true;
            if (data.valid) {
                currentInput.dataset.valid = "true";
                currentMsg.className = "d-block mt-1 text-success";
                currentMsg.innerHTML = '';
            } else {
                currentInput.dataset.valid = "false";
                currentMsg.className = "d-block mt-1 text-danger";
                currentMsg.innerHTML = ' ' + data.message;
            }
        })
        .catch(() => {
            currentInput.dataset.valid = "false";
            currentMsg.innerHTML = "";
        });
    });

    // ── Current: reset when user types again ─────────────────────────────
    currentInput.addEventListener("input", function () {
        isDirty.current = true;
        currentInput.dataset.valid = "pending";

        const serverErr = currentInput.closest(".mb-3").querySelector(".text-danger.small");
        if (serverErr) serverErr.style.display = "none";

        if (currentInput.value.trim() === "") {
            currentMsg.className = "d-block mt-1 text-danger";
            currentMsg.innerHTML = "Current password is required.";
        } else {
            currentMsg.innerHTML = "";
        }
    });

    // ── New password validator ────────────────────────────────────────────
    function validateNew() {
        const val = newInput.value;

        const serverErr = newInput.closest(".mb-3").querySelector(".text-danger.small");
        if (serverErr) serverErr.style.display = "none";

        if (!isDirty.new) return true;

        if (val === "") {
            newMsg.className = "d-block mt-1 text-danger";
            newMsg.innerHTML = "New password is required.";
            return false;
        }

        const rules = {
            length : val.length >= 6,
            upper  : /[A-Z]/.test(val),
            lower  : /[a-z]/.test(val),
            number : /[0-9]/.test(val),
            special: /[!@#$%^&*(),.?":{}|<>]/.test(val),
        };
        const allPassed = Object.values(rules).every(Boolean);

        if (!allPassed) {
            const missing = [
                !rules.length  && "at least 6 characters",
                !rules.upper   && "one uppercase letter",
                !rules.lower   && "one lowercase letter",
                !rules.number  && "one number",
                !rules.special && "one special character",
            ].filter(Boolean).join(", ");

            newMsg.className = "d-block mt-1 text-danger";
            newMsg.innerHTML = `Password must contain ${missing}.`;
            return false;
        }

        newMsg.innerHTML = "";
        return true;
    }

    // ── Confirm password validator ────────────────────────────────────────
// ── Confirm password validator ────────────────────────────────────────
function validateConfirm(forceCheck = false) {
    const val     = newInput.value;
    const confirm = confirmInput.value;

    const serverErr = confirmInput.closest(".mb-3").querySelector(".text-danger.small");
    if (serverErr) serverErr.style.display = "none";

    if (!isDirty.confirm) return true;

    if (confirm === "") {
        matchMsg.className = "d-block mt-1 text-danger";
        matchMsg.innerHTML = "Please confirm your new password.";
        return false;
    }

    // Still typing & not forced → don't show mismatch yet
    if (!forceCheck && confirm.length < val.length) {
        matchMsg.innerHTML = "";
        return false;
    }

    if (val === confirm) {
        matchMsg.className = "d-block mt-1 text-success";
        matchMsg.innerHTML = '';
        return true;
    }

    matchMsg.className = "d-block mt-1 text-danger";
    matchMsg.innerHTML = "Passwords do not match.";
    return false;
}

// ── Input event (typing-ல் smart check) ──────────────────────────────
confirmInput.addEventListener("input", function () {
    isDirty.confirm = true;
    validateConfirm(false); // still typing — length check active
});

// ── Blur event (stop பண்ணினா force check) ────────────────────────────
confirmInput.addEventListener("blur", function () {
    isDirty.confirm = true;
    validateConfirm(true); // force — length check bypass
});

    // ── Input events ──────────────────────────────────────────────────────
    newInput.addEventListener("input", function () {
        isDirty.new = true;
        validateNew();
        if (isDirty.confirm) validateConfirm();
    });

    confirmInput.addEventListener("input", function () {
        isDirty.confirm = true;
        validateConfirm();
    });

    // ── Save button ───────────────────────────────────────────────────────
   document.getElementById("sa-save").addEventListener("click", function (e) {
    e.preventDefault();

    isDirty = { current: true, new: true, confirm: true };

    const okNew     = validateNew();
    const okConfirm = validateConfirm(true); // ← forceCheck true

    const currentValid = currentInput.dataset.valid;
    let okCurrent = true;

    if (currentInput.value.trim() === "") {
        currentMsg.className = "d-block mt-1 text-danger";
        currentMsg.innerHTML = "Current password is required.";
        okCurrent = false;
    } else if (!currentValid || currentValid === "pending") {
        currentMsg.className = "d-block mt-1 text-warning";
        currentMsg.innerHTML = '<i class="ri-error-warning-line"></i> Please click outside the field first.';
        okCurrent = false;
    } else if (currentValid === "false") {
        currentMsg.className = "d-block mt-1 text-danger";
        currentMsg.innerHTML = '<i class="ri-error-warning-line"></i> Current password is incorrect.';
        okCurrent = false;
    }

    if (!okCurrent || !okNew || !okConfirm) return;

    // ── Show processing state ──────────────────────────────────────────
    const btn = document.getElementById("sa-save");
    document.getElementById("sa-btn-content").classList.add("d-none");
    document.getElementById("sa-btn-loader").classList.remove("d-none");
    btn.disabled = true;

    form.submit();
});

});
    </script>
@endpush
