@extends('layouts.app')
@section('title', 'Dashboard |Winngoocoin')
@section('content')

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
                    <h3 class="mb-sm-0">Platform Settings</h3>
                    <button type="submit" form="platformSettingsForm" class="btn btn-success btn-label waves-effect waves-light rounded-pill" id="sa-save"><i class="ri-save-3-line label-icon align-middle rounded-pill fs-16 me-2"></i> Save Settings</button>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Configure global platform behavior and security settings</h5>
                    </div>
                       @include('layouts.success_toast')
                    <form id="platformSettingsForm" method="POST" action="{{ route('settings.platform.save') }}">
                        @csrf
                        <div class="card-body">
                            <div class="row">

                              {{--  <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="miningFreq" class="form-label">
                                            Mining Frequency (hours) <span class="text-danger">*</span>
                                        </label>
                                        <input type="text"
                                            class="form-control "
                                            id="miningFreq"
                                            name="mining_frequency"
                                            placeholder="Enter Mining Frequency"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="6"
                                            value="{{ old('mining_frequency', $settings['mining_frequency'] ?? '') }}">
                                        @error('mining_frequency')
                                        <div class="error-msg text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                --}}

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="sessionTimeout" class="form-label">
                                            Session Timeout (minutes)
                                        </label>
                                        <input type="text"
                                            class="form-control "
                                            id="sessionTimeout"
                                            name="session_timeout"
                                            placeholder="Enter Session Timeout"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="3"
                                            value="{{ old('session_timeout', $settings['session_timeout'] ?? '') }}">
                                        @error('session_timeout')
                                        <div class="error-msg text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="accountLock" class="form-label">
                                            Account Lock Duration (minutes) <span class="text-danger">*</span>
                                        </label>
                                        <input type="text"
                                            class="form-control "
                                            id="accountLock"
                                            name="account_lock_duration"
                                            placeholder="Enter Account Lock Duration"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="3"
                                            value="{{ old('account_lock_duration', $settings['account_lock_duration'] ?? '') }}">
                                        @error('account_lock_duration')
                                        <div class="error-msg text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div> -->

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="failedAttempts" class="form-label">
                                            Failed Attempts Count <span class="text-danger">*</span>
                                        </label>
                                        <input type="text"
                                            class="form-control "
                                            id="failedAttempts"
                                            name="failed_attempts_count"
                                            placeholder="Enter Failed Attempts Count"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="3"
                                            value="{{ old('failed_attempts_count', $settings['failed_attempts_count'] ?? '') }}">
                                        @error('failed_attempts_count')
                                        <div class="error-msg text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <label for="accountRecoveryPeriod" class="form-label">
                                            Account Recovery Period (hours) <span class="text-danger">*</span>
                                        </label>
                                        <input type="text"
                                            class="form-control "
                                            id="accountRecoveryPeriod"
                                            name="account_recovery_period"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="3"
                                            placeholder="Enter Account Recovery Period"
                                            value="{{ old('account_recovery_period', $settings['account_recovery_period'] ?? '') }}">
                                        @error('account_recovery_period')
                                        <div class="error-msg text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><!--end row-->
    </div>
    <!-- container-fluid -->
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



