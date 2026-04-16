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
                    <h3 class="mb-sm-0">Notification Preferences</h3>
                </div>
            </div>
        </div>
      
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Configure notification preference</h5>
                    </div>
                       @include('layouts.success_toast')
                     
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="list-group">
                                   <form id="notificationForm" action="{{ route('settings.notifications.save') }}" method="POST">
    @csrf

    <div class="list-group-item list-group-item-action">
        <div class="float-end">
            <div class="form-check form-switch form-switch-success">
                <input
                    class="form-check-input"
                    type="checkbox"
                    role="switch"
                    id="email_notifications"
                    name="email_notifications"
                    value="1"
                    {{ ($settings['email_notifications'] ?? 0) ? 'checked' : '' }}
                    onchange="document.getElementById('notificationForm').submit();"
                >
            </div>
        </div>

        <div class="d-flex mb-2 align-items-center">
            <div class="flex-grow-1">
                <h5 class="list-title fs-15 mb-1">Email Notifications</h5>
                <p class="list-text mb-0 fs-12">Receive notifications via email</p>
            </div>
        </div>
    </div>
</form>

                                    <!-- <div class="list-group-item list-group-item-action">
                                                    <div class="float-end">
                                                        <div class="form-check form-switch form-switch-success">
                                                            <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck2" checked>
                                                            <label class="form-check-label" for="SwitchCheck2"></label>
                                                        </div> 
                                                    </div>
                                                    <div class="d-flex mb-2 align-items-center">
                                                        <div class="flex-grow-1">
                                                            <h5 class="list-title fs-15 mb-1">SMS Notifications</h5>
                                                            <p class="list-text mb-0 fs-12">Receive notifications via SMS</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="list-group-item list-group-item-action">
                                                    <div class="float-end">
                                                        <div class="form-check form-switch form-switch-success">
                                                            <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck3" checked>
                                                            <label class="form-check-label" for="SwitchCheck3"></label>
                                                        </div> 
                                                    </div>
                                                    <div class="d-flex mb-2 align-items-center">
                                                        <div class="flex-grow-1">
                                                            <h5 class="list-title fs-15 mb-1">New User Registrations</h5>
                                                            <p class="list-text mb-0 fs-12">Get notified when new user registers</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="list-group-item list-group-item-action">
                                                    <div class="float-end">
                                                        <div class="form-check form-switch form-switch-success">
                                                            <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck4" checked>
                                                            <label class="form-check-label" for="SwitchCheck4"></label>
                                                        </div> 
                                                    </div>
                                                    <div class="d-flex mb-2 align-items-center">
                                                        <div class="flex-grow-1">
                                                            <h5 class="list-title fs-15 mb-1">Support Tickets</h5>
                                                            <p class="list-text mb-0 fs-12">Get notifies on new tickets</p>
                                                        </div>
                                                    </div>
                                                </div> -->


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->
    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->



<!-- end main content-->
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



