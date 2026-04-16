@extends('layouts.app')
@section('title', 'Dashboard |Winngoocoin')
@section('content')



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
                    <h3 class="mb-sm-0">Email Configuration</h3>
                    <div>
                        <button type="button" onclick="sendTestMail()" class="btn btn-primary btn-label waves-effect waves-light rounded-pill" id="sa-test"><i class="ri-mail-send-line label-icon align-middle rounded-pill fs-16 me-2"></i> Send Test Mail</button>
                        <button type="submit" form="emailSettingsForm" class="btn btn-success btn-label waves-effect waves-light rounded-pill" id="sa-save"><i class="ri-save-3-line label-icon align-middle rounded-pill fs-16 me-2"></i> Save Settings</button>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.success_toast')
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Manage mail settings</h5>
                    </div>
                    <form id="emailSettingsForm" method="POST" action="{{ route('settings.email.save') }}">
                        @csrf

                        <div class="card-body">
                            <div class="row">

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">SMTP Server <span class="text-danger">*</span></label>
                                        <input type="text" name="smtp_server" class="form-control"
                                           value="{{ old('smtp_server', $settings['smtp_server'] ?? '') }}" maxlength="50">

                                        @error('smtp_server')
                                        <div class="text-danger mt-1 error-msg">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">SMTP Port <span class="text-danger">*</span></label>
                                        <input type="text" name="smtp_port" class="form-control"
                                            value="{{ old('smtp_port', $settings['smtp_port'] ?? '') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="3">
                                        @error('smtp_port')
                                        <div class="text-danger mt-1 error-msg">{{ $message }}</div>

                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">SMTP Username <span class="text-danger">*</span></label>
                                        <input type="text" name="smtp_username" class="form-control"
                                            value="{{ old('smtp_username', $settings['smtp_username'] ?? '') }}">
                                        @error('smtp_username')
                                        <div class="text-danger mt-1 error-msg">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Encryption <span class="text-danger">*</span></label>
                                        <select name="encryption_type" class="form-control">
                                            <option value="tls" {{ old('encryption_type', $settings['encryption_type'] ?? '') == 'tls' ? 'selected' : '' }}>TLS - 587</option>
                                            <option value="ssl" {{ old('encryption_type', $settings['encryption_type'] ?? '') == 'ssl' ? 'selected' : '' }}>SSL - 465</option>
                                        </select>
                                        @error('encryption_type')
                                        <div class="text-danger mt-1 error-msg">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Password <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="password" name="smtp_password" id="smtp_password" class="form-control"
                                                placeholder="Leave blank to keep current password">
                                            <span class="input-group-text toggle-password" toggle="#smtp_password" style="cursor: pointer;">
                                                <i class="ri-eye-line"></i>
                                            </span>
                                        </div>

                                        @error('smtp_password')
                                        <div class="text-danger mt-1 error-msg">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">From Email <span class="text-danger">*</span></label>
                                        <input type="text" name="from_email" class="form-control"
                                            value="{{ old('from_email', $settings['from_email'] ?? '') }}">
                                        @error('from_email')
                                        <div class="text-danger mt-1 error-msg">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">From Name <span class="text-danger">*</span></label>
                                        <input type="text" name="from_name" class="form-control"
                                            value="{{ old('from_name', $settings['from_name'] ?? '') }}">

                                        @error('from_name')
                                        <div class="text-danger mt-1 error-msg">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- End Page-content -->

@include('layouts.footer')


@endsection

<!-- JAVASCRIPT -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/node-waves/waves.min.js"></script>
<script src="assets/libs/feather-icons/feather.min.js"></script>
<script src="assets/js/plugins.js"></script>


<!-- App js -->
<script src="assets/js/app.js"></script>

<script>
    function sendTestMail() {
        Swal.fire({
            title: 'Send Test Mail?',
            text: 'A test email will be sent to the configured address.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Send it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Sending...',
                    text: 'Please wait while we send the test email.',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: '{{ route("settings.email.test") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        Swal.fire({
                            icon: res.success ? 'success' : 'error',
                            title: res.success ? 'Email Sent!' : 'Failed!',
                            text: res.message,
                            confirmButtonColor: '#3085d6'
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: xhr.responseJSON?.message || 'Something went wrong. Please try again.',
                            confirmButtonColor: '#d33'
                        });
                    }
                });
            }
        });
    }
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {



        // hide error message

        // Select all input and select fields inside the form
        const formFields = document.querySelectorAll('input, select, textarea');

        formFields.forEach(field => {
            field.addEventListener('input', () => {
                // Find the nearest error message container
                const errorMsg = field.closest('.mb-3').querySelector('.error-msg, .invalid-feedback');
                if (errorMsg) {
                    errorMsg.style.display = 'none'; // hide error message
                    field.classList.remove('is-invalid'); // remove red border
                }
            });
        });

    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.querySelector('.toggle-password');
        const passwordField = document.querySelector(togglePassword.getAttribute('toggle'));

        togglePassword.addEventListener('click', function() {
            // Toggle type
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            // Toggle icon
            this.querySelector('i').classList.toggle('ri-eye-line');
            this.querySelector('i').classList.toggle('ri-eye-off-line');
        });
    });
</script>


