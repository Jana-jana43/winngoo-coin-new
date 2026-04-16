

@extends('layouts.app')
@section('content')
    <!-- Begin page -->
    <div id="layout-wrapper">

        <div class="vertical-overlay"></div>
   

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div
                            class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                            <h3 class="mb-sm-0">Notifications</h3>
                            <div class="btn-div">
                                <button type="button"
                                    class="btn btn-primary btn-label waves-effect waves-light rounded-pill"
                                    data-bs-toggle="modal" data-bs-target="#showModalAdd"><i
                                        class="ri-add-line label-icon align-middle rounded-pill fs-16 me-2"></i> Create
                                    Notification</button>

                            </div>
                        </div>       @include('layouts.success_toast')
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Manage all the notifications.</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="manage-notification"
                                        class="table table-bordered dt-responsive nowrap table-striped align-middle w-100">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th>Type</th>
                                                <th>Notification</th>
                                                <th>Users</th>
                                                <th>Scheduled on</th>
                                                <th>Medium</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($notifications as $index => $notification)
                                                <tr>
                                                    <td scope="row" class="text-center">{{ $index + 1 }}</td>

                                                    <td class="text-center">
                                                        @php
                                                            $typeClass = match ($notification->type) {
                                                                'Warning' => 'bg-warning',
                                                                'Success' => 'bg-success',
                                                                'Information' => 'bg-info',
                                                                default => 'bg-secondary',
                                                            };
                                                        @endphp
                                                        <span
                                                            class="badge {{ $typeClass }}">{{ $notification->type }}</span>
                                                    </td>

                                                    <td>
                                                        <h5 class="mb-0">{{ $notification->title }}</h5>
                                                        <p class="mb-0 break-spaces">{{ $notification->message }}</p>
                                                    </td>

                                                    <td class="text-center">{{ $notification->audience }}</td>

                                                    <td>
                                                        <div>
                                                            <span class="ri-calendar-check-line me-2 text-danger"></span>
                                                            <span>{{ \Carbon\Carbon::parse($notification->scheduled_date)->format('d-m-Y') }}</span>
                                                        </div>
                                                        <div>
                                                            <span class="ri-time-line me-2 text-danger"></span>
                                                            <span>
<span>
    @php
        $time = trim($notification->scheduled_time);
    @endphp

    @if(!empty($time) && $time != ':' && strtotime($time))
        {{ \Carbon\Carbon::parse($time)->format('h:i A') }}
    @else
        --
    @endif
</span>          
                                                        </div>
                                                    </td>

                                                    <td class="text-center">
                                                        <div class="d-flex flex-wrap gap-1 justify-content-center">
                                                            @foreach (explode(',', $notification->medium) as $medium)
                                                                <span
                                                                    class="badge bg-primary-subtle text-primary badge-border">
                                                                    {{ trim($medium) }}
                                                                </span>
                                                            @endforeach
                                                        </div>
                                                    </td>

                                                    <td class="text-center">
                                                        @php
                                                            $statusClass = match ($notification->status) {
                                                                'Sent' => 'bg-success',
                                                                'Pending' => 'bg-warning',
                                                                'Failed' => 'bg-danger',
                                                                default => 'bg-secondary',
                                                            };
                                                        @endphp
                                                        <span
                                                            class="badge rounded-pill {{ $statusClass }}">{{ $notification->status }}</span>
                                                    </td>

                                                    <td class="text-center">
                                                        <div class="d-flex justify-content-center gap-2">
                                                            <div class="edit">
                                                                <button
                                                                    class="btn btn-sm btn-soft-secondary rounded-pill edit-item-btn"
                                                                    title="Edit" data-bs-toggle="modal"
                                                                    data-bs-target="#showModal"
                                                                    data-id="{{ $notification->id }}"
                                                                    data-title="{{ $notification->title }}"
                                                                    data-message="{{ $notification->message }}"
                                                                    data-type="{{ $notification->type }}"
                                                                    data-audience="{{ $notification->audience }}"
                                                                    data-medium="{{ $notification->medium }}"
                                                                    data-date="{{ \Carbon\Carbon::parse($notification->scheduled_date)->format('Y-m-d') }}"
                                                                    data-time="{{ $notification->scheduled_time }}">
                                                                    <span class="bx bx-pencil"></span>
                                                                </button>
                                                            </div>
                                                            <div class="remove">
                                                                <button
                                                                    class="btn btn-sm btn-soft-danger rounded-pill remove-item-btn"
                                                                    title="Delete" data-bs-toggle="modal"
                                                                    data-bs-target="#deleteRecordModal"
                                                                    data-id="{{ $notification->id }}">
                                                                    <span class="bx bx-trash"></span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center py-4 text-muted">
                                                        <i class="bx bx-bell-off fs-3 d-block mb-2"></i>
                                                        No notifications found.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end row-->

                <div class="modal fade" id="showModalAdd" tabindex="-1" aria-labelledby="exampleModalLabelAdd"
                    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-light p-3">
                                <h5 class="modal-title" id="exampleModalLabelAdd">Create Notifications</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                    id="close-modal"></button>
                            </div>
                            <form class="tablelist-form" method="POST" action="{{ route('admin.notifications.store') }}"
                                autocomplete="off">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="addtitle" class="form-label">Title <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="addtitle" name="title" class="form-control"
                                                    placeholder="Enter Title" required />
                                                <span id="title-error" class="inline-error text-danger small d-none"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="addMessage" class="form-label">Message <span
                                                        class="text-danger">*</span></label>
                                                <textarea class="form-control" name="message" id="addMessage" rows="3" required=""
                                                    placeholder="Type Message Here..."></textarea>
                                                <span id="message-error"
                                                    class="inline-error text-danger small d-none"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="addtype-field" class="form-label">Type <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select" id="addtype-field" name="type"
                                                    aria-label="Select Type" required>
                                                    <option selected disabled>Select Type</option>
                                                    <option value="Information">Information</option> {{-- ✅ was empty --}}
                                                    <option value="Warning">Warning</option> {{-- ✅ was empty --}}
                                                    <option value="Success">Success</option> {{-- ✅ was empty --}}
                                                </select>
                                                <span id="type-error"
                                                    class="inline-error text-danger small d-none"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="addaudience-field" class="form-label">Target Audience <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select" id="addaudience-field"
                                                    aria-label="Select Audience" name="audience">
                                                    {{-- <option selected disabled>Select Audience</option> --}}
                                                    <option value="" disabled selected>Select Audience</option>
                                                    <option value="All Users">All Users</option>
                                                    <option value="Premium Users">Premium Users</option>
                                                    <option value="Subscribed Users">Subscribed Users</option>
                                                </select>
                                                <span id="audience-error"
                                                    class="inline-error text-danger small d-none"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="inapp"
                                                        name="medium[]" value="In-App">
                                                    <label class="form-check-label" for="inapp">In-App</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="emailWay"
                                                        name="medium[]" value="Email">
                                                    <label class="form-check-label" for="emailWay">Email</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="smsWay"
                                                        name="medium[]" value="SMS">
                                                    <label class="form-check-label" for="smsWay">SMS</label>
                                                </div>
                                                <br>
                                                <span id="medium-error"
                                                    class="inline-error text-danger small d-none"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="addDate" class="form-label">Scheduled Date <span
                                                        class="text-danger">*</span></label>
                                                <input type="date" id="addDate" min="{{ date('Y-m-d') }}"
                                                    class="form-control" placeholder="Enter Date" name="scheduled_date"
                                                    required />
                                                <span id="date-error"
                                                    class="inline-error text-danger small d-none"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="addtime" class="form-label">Scheduled Time</label>
                                                <div class="slot d-flex align-items-center gap-2 flex-wrap">
                                                    <div class="time-group">
                                                        <select name="hour" class="hour">
                                                            @for ($h = 1; $h <= 12; $h++)
                                                                <option>{{ $h }}</option>
                                                            @endfor
                                                        </select>
                                                        :
                                                        <select name="minute" class="minute">
                                                            @foreach (['00', '05', '10', '15', '20', '25', '30', '35', '40', '45', '50', '55'] as $m)
                                                                <option>{{ $m }}</option>
                                                            @endforeach
                                                        </select>
                                                        <select name="ampm" class="ampm">
                                                            <option>AM</option>
                                                            <option>PM</option>
                                                        </select>
                                                    </div>
                                                    <span id="time-error"
                                                        class="inline-error text-danger small d-none"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success" id="add-btn">Create
                                            Notification</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Success Alert (Hidden by default) -->
                <div id="successAlertAdd"
                    class="alert alert-success alert-dismissible bg-success text-white alert-label-icon fade position-fixed top-0 end-0 m-3 material-shadow"
                    role="alert" style="z-index: 9999; display: none;">
                    <i class="ri-notification-4-line label-icon"></i>
                    <strong>Success</strong> - Data Addedd
                </div>

                <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-light p-3">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Notification</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                    id="close-modal"></button>
                            </div>
                            <form class="tablelist-form" autocomplete="off">
                                @csrf
                                @method('PUT')
                                <input type="hidden" id="editId">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="edittitle" class="form-label">Title <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="title" id="edittitle" class="form-control"
                                                    placeholder="Enter Title" required />
                                                <span id="edit-title-error"
                                                    class="inline-error text-danger small d-none"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="editMessage" class="form-label">Message <span
                                                        class="text-danger">*</span></label>
                                                <textarea class="form-control" name="message" id="editMessage" rows="3" required
                                                    placeholder="Type Message Here..."></textarea>
                                                <span id="edit-message-error"
                                                    class="inline-error text-danger small d-none"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="edittype-field" class="form-label">Type <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select" id="edittype-field" name="type"
                                                    aria-label="Select Type">
                                                    <option disabled>Select Type</option>
                                                    <option selected value="Information">Information</option>
                                                    <option value="Warning">Warning</option>
                                                    <option value="Success">Success</option>
                                                </select>
                                                <span id="edit-type-error"
                                                    class="inline-error text-danger small d-none"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="editaudience-field" class="form-label">Target Audience <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select" name="audience" id="editaudience-field"
                                                    aria-label="Select Audience">
                                                    <option disabled>Select Audience</option>
                                                    <option selected value="All Users">All Users</option>
                                                    <option value="Premium Users">Premium Users</option>
                                                    <option value="Subscribed Users">Subscribed Users</option>
                                                </select>
                                                <span id="edit-audience-error"
                                                    class="inline-error text-danger small d-none"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="editinapp"
                                                        name="medium[]" value="In-App"> {{-- ✅ fixed name & value --}}
                                                    <label class="form-check-label" for="editinapp">In-App</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="editemailWay"
                                                        name="medium[]" value="Email"> {{-- ✅ fixed name & value --}}
                                                    <label class="form-check-label" for="editemailWay">Email</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="editsmsWay"
                                                        name="medium[]" value="SMS"> {{-- ✅ fixed name & value --}}
                                                    <label class="form-check-label" for="editsmsWay">SMS</label>
                                                </div>
                                                <span id="edit-medium-error"
                                                    class="inline-error text-danger small d-none"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="editDate" class="form-label">Scheduled Date <span
                                                        class="text-danger">*</span></label>
                                                <input type="date" id="editDate" class="form-control"
                                                    placeholder="Enter Date" name="scheduled_date" required
                                                    min="{{ date('Y-m-d') }}" />
                                                <span id="edit-date-error"
                                                    class="inline-error text-danger small d-none"></span>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="edittime" class="form-label">Scheduled Time</label>
                                                <div class="slot d-flex align-items-center gap-2 flex-wrap">
                                                    <div class="time-group">
                                                        <select class="hour">
                                                            <option>1</option>
                                                            <option>2</option>
                                                            <option selected>3</option>
                                                            <option>4</option>
                                                            <option>5</option>
                                                            <option>6</option>
                                                            <option>7</option>
                                                            <option>8</option>
                                                            <option>9</option>
                                                            <option>10</option>
                                                            <option>11</option>
                                                            <option>12</option>
                                                        </select>
                                                        :
                                                        <select class="minute">
                                                            <option>00</option>
                                                            <option>05</option>
                                                            <option>10</option>
                                                            <option>15</option>
                                                            <option>20</option>
                                                            <option>25</option>
                                                            <option selected>30</option>
                                                            <option>35</option>
                                                            <option>40</option>
                                                            <option>45</option>
                                                            <option>50</option>
                                                            <option>55</option>
                                                        </select>
                                                        <select class="ampm">
                                                            <option>AM</option>
                                                            <option>PM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Scheduled Time</label>
                                                <div class="slot d-flex align-items-center gap-2 flex-wrap">
                                                    <div class="time-group">
                                                        <select name="edit_hour" id="editHour">
                                                            @for ($h = 1; $h <= 12; $h++)
                                                                <option>{{ $h }}</option>
                                                            @endfor
                                                        </select>
                                                        :
                                                        <select name="edit_minute" id="editMinute">
                                                            @foreach (['00', '05', '10', '15', '20', '25', '30', '35', '40', '45', '50', '55'] as $m)
                                                                <option>{{ $m }}</option>
                                                            @endforeach
                                                        </select>
                                                        <select name="edit_ampm" id="editAmpm">
                                                            <option>AM</option>
                                                            <option>PM</option>
                                                        </select>
                                                    </div>
                                                    <span id="edit-time-error"
                                                        class="inline-error text-danger small d-none"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-success" id="update-btn">Update &
                                            Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Success Alert (Hidden by default) -->
                <div id="successAlertUpdate"
                    class="alert alert-success alert-dismissible bg-success text-white alert-label-icon fade position-fixed top-0 end-0 m-3 material-shadow"
                    role="alert" style="z-index: 9999; display: none;">
                    <i class="ri-notification-4-line label-icon"></i>
                    <strong>Success</strong> - Data Updated
                </div>

                <!-- Modal -->
                <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                    id="btn-close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mt-2 text-center">
                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                        colors="primary:#f7b84b,secondary:#f06548"
                                        style="width:100px;height:100px"></lord-icon>
                                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                        <h4>Are you Sure ?</h4>
                                        <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Record ?</p>
                                    </div>
                                </div>
                                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                    <button type="button" class="btn w-sm btn-light"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn w-sm btn-danger " id="delete-record">Yes, Delete
                                        It!</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end modal -->
                <!-- Success Alert (Hidden by default) -->
                <div id="successAlert"
                    class="alert alert-success alert-dismissible bg-success text-white alert-label-icon fade position-fixed top-0 end-0 m-3 material-shadow"
                    role="alert" style="z-index: 9999; display: none;">
                    <i class="ri-notification-4-line label-icon"></i>
                    <strong>Success</strong> - Data Removed
                </div>

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <p class="mb-0 text-muted">&copy;
                            <script>
                                document.write(new Date().getFullYear())
                            </script> Winngoo Coin. All Rights Reserved
                        </p>
                    </div>
                </div>
            </div>
        </footer>
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
        document.getElementById('add-btn').addEventListener('click', function(e) {
            e.preventDefault();
            clearErrors();

            const title = document.getElementById('addtitle').value.trim();
            const message = document.getElementById('addMessage').value.trim();
            const type = document.getElementById('addtype-field').value;
            const audience = document.getElementById('addaudience-field').value;
            const date = document.getElementById('addDate').value;
            const mediums = [...document.querySelectorAll('input[name="medium[]"]:checked')].map(cb => cb.value);

            const hour = document.querySelector('select[name="hour"]').value;
            const minute = document.querySelector('select[name="minute"]').value;
            const ampm = document.querySelector('select[name="ampm"]').value;
            const time = `${hour}:${minute} ${ampm}`;

            let hasError = false;

            if (!title) {
                showError('title-error', 'Title is required.');
                hasError = true;
            }
            if (!message) {
                showError('message-error', 'Message is required.');
                hasError = true;
            }
            if (!type || type === 'Select Type') {
                showError('type-error', 'Please select a notification type.');
                hasError = true;
            }
            if (!audience || audience === 'Select Audience') {
                showError('audience-error', 'Please select a target audience.');
                hasError = true;
            }
            if (mediums.length === 0) {
                showError('medium-error', 'Please select at least one delivery medium.');
                hasError = true;
            }
            if (!date) {
                showError('date-error', 'Scheduled date is required.');
                hasError = true;
            }

            if (hasError) return;

            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('title', title);
            formData.append('message', message);
            formData.append('type', type);
            formData.append('audience', audience);
            formData.append('scheduled_date', date);
            formData.append('scheduled_time', time);
            mediums.forEach(m => formData.append('medium[]', m));

            fetch('{{ route('admin.notifications.store') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    }
                })
              .then(async res => {
                    if (res.ok) {
                        const data = await res.json();

                        // ✅ Store message before reload
                        localStorage.setItem('toast_message', data.message);

                        const openModal = document.querySelector('.modal.show');
                        if (openModal) {
                            const modalInstance = bootstrap.Modal.getInstance(openModal)
                                                ?? new bootstrap.Modal(openModal);
                            modalInstance.hide();
                        }
                        window.location.reload();
                    } else {
                        const data = await res.json();
                        if (data.errors) {
                            if (data.errors.title)          showError('title-error',    data.errors.title[0]);
                            if (data.errors.message)        showError('message-error',  data.errors.message[0]);
                            if (data.errors.type)           showError('type-error',     data.errors.type[0]);
                            if (data.errors.audience)       showError('audience-error', data.errors.audience[0]);
                            if (data.errors.medium)         showError('medium-error',   data.errors.medium[0]);
                            if (data.errors.scheduled_date) showError('date-error',     data.errors.scheduled_date[0]);
                            if (data.errors.scheduled_time) showError('time-error',     data.errors.scheduled_time[0]);
                        }
                    }
                })

        });

        document.getElementById('addtitle').addEventListener('input', () => clearError('title-error'));
        document.getElementById('addMessage').addEventListener('input', () => clearError('message-error'));
        document.getElementById('addtype-field').addEventListener('change', () => clearError('type-error'));
        document.getElementById('addaudience-field').addEventListener('change', () => clearError('audience-error'));
        document.getElementById('addDate').addEventListener('change', () => clearError('date-error'));

        document.querySelectorAll('input[name="medium[]"]').forEach(cb => {
            cb.addEventListener('change', () => clearError('medium-error'));
        });

        document.querySelectorAll('select[name="hour"], select[name="minute"], select[name="ampm"]').forEach(sel => {
            sel.addEventListener('change', () => clearError('time-error'));
        });

        function showError(id, message) {
            const el = document.getElementById(id);
            if (el) {
                el.textContent = message;
                el.classList.remove('d-none');
            }
        }

        function clearError(id) {
            const el = document.getElementById(id);
            if (el) {
                el.textContent = '';
                el.classList.add('d-none');
            }
        }

        function clearErrors() {
            document.querySelectorAll('.inline-error').forEach(el => {
                el.textContent = '';
                el.classList.add('d-none');
            });
        }
    </script>
<script>
    // ── Populate edit modal ──────────────────────────────────
    document.querySelectorAll('.edit-item-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id       = this.dataset.id;
            const title    = this.dataset.title;
            const message  = this.dataset.message;
            const type     = this.dataset.type;
            const audience = this.dataset.audience;
            const mediums  = this.dataset.medium.split(',').map(m => m.trim());
            const date     = this.dataset.date;
            const time     = this.dataset.time;

            document.getElementById('editId').value              = id;
            document.getElementById('edittitle').value           = title;
            document.getElementById('editMessage').value         = message;
            document.getElementById('editDate').value            = date;
            document.getElementById('edittype-field').value      = type;
            document.getElementById('editaudience-field').value  = audience;

            document.querySelectorAll('#showModal input[name="medium[]"]').forEach(cb => {
                cb.checked = mediums.includes(cb.value);
            });

            // const [timePart, ampm] = time.split(' ');
            // const [hour, minute]   = timePart.split(':');
            // document.getElementById('editHour').value   = parseInt(hour);
            // document.getElementById('editMinute').value = minute;
            // document.getElementById('editAmpm').value   = ampm;




// ✅ FIXED TIME CONVERSION
if (time && time !== ':' && time !== '') {

    let [hour, minute] = time.split(':');

    hour = parseInt(hour);

    let ampm = 'AM';

    if (hour >= 12) {
        ampm = 'PM';
        if (hour > 12) hour -= 12;
    } else if (hour === 0) {
        hour = 12;
    }

    document.getElementById('editHour').value   = hour.toString();
    document.getElementById('editMinute').value = minute;
    document.getElementById('editAmpm').value   = ampm;

} else {
    // fallback if invalid time
    document.getElementById('editHour').value   = "1";
    document.getElementById('editMinute').value = "00";
    document.getElementById('editAmpm').value   = "AM";
}





        });
    });

    // ── Update submit ────────────────────────────────────────
    document.getElementById('update-btn').addEventListener('click', function () {
        clearEditErrors();

        const id       = document.getElementById('editId').value;
        const title    = document.getElementById('edittitle').value.trim();
        const message  = document.getElementById('editMessage').value.trim();
        const type     = document.getElementById('edittype-field').value;
        const audience = document.getElementById('editaudience-field').value;
        const date     = document.getElementById('editDate').value;
        const mediums  = [...document.querySelectorAll('#showModal input[name="medium[]"]:checked')].map(cb => cb.value);
        const hour     = document.getElementById('editHour').value;
        const minute   = document.getElementById('editMinute').value;
        const ampm     = document.getElementById('editAmpm').value;
        const time     = `${hour}:${minute} ${ampm}`;

        let hasError = false;

        if (!title)                              { showEditError('edit-title-error',    'Title is required.');                          hasError = true; }
        if (!message)                            { showEditError('edit-message-error',  'Message is required.');                        hasError = true; }
        if (!type || type === 'Select Type')     { showEditError('edit-type-error',     'Please select a notification type.');          hasError = true; }
        if (!audience || audience === 'Select Audience') { showEditError('edit-audience-error', 'Please select a target audience.');  hasError = true; }
        if (mediums.length === 0)                { showEditError('edit-medium-error',   'Please select at least one delivery medium.'); hasError = true; }
        if (!date)                               { showEditError('edit-date-error',     'Scheduled date is required.');                hasError = true; }

        if (hasError) return;

        const formData = new FormData();
        formData.append('title',          title);
        formData.append('message',        message);
        formData.append('type',           type);
        formData.append('audience',       audience);
        formData.append('scheduled_date', date);
      
        formData.append('hour',           hour);
        formData.append('minute',         minute);
        formData.append('ampm',           ampm);
        mediums.forEach(m => formData.append('medium[]', m));

        fetch(`/admin/notifications/${id}/update`, {  // ✅ plain POST route
            method: 'POST',
            body:   formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept':           'application/json',
                'X-CSRF-TOKEN':     document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // ✅
            }
        })
        .then(async res => {
            if (res.ok) {
                const data = await res.json();
                localStorage.setItem('toast_message', data.message); // ✅ toast

                const openModal = document.querySelector('.modal.show');
                if (openModal) {
                    const modalInstance = bootstrap.Modal.getInstance(openModal)
                                        ?? new bootstrap.Modal(openModal);
                    modalInstance.hide();
                }
                window.location.reload();
            } else {
                const data = await res.json();
                if (data.errors) {
                    if (data.errors.title)          showEditError('edit-title-error',    data.errors.title[0]);
                    if (data.errors.message)        showEditError('edit-message-error',  data.errors.message[0]);
                    if (data.errors.type)           showEditError('edit-type-error',     data.errors.type[0]);
                    if (data.errors.audience)       showEditError('edit-audience-error', data.errors.audience[0]);
                    if (data.errors.medium)         showEditError('edit-medium-error',   data.errors.medium[0]);
                    if (data.errors.scheduled_date) showEditError('edit-date-error',     data.errors.scheduled_date[0]);
                    if (data.errors.scheduled_time) showEditError('edit-time-error',     data.errors.scheduled_time[0]);
                }
            }
        })
        .catch(err => console.error('Update error:', err));
    });

    // ── Clear errors on interaction ──────────────────────────
    document.getElementById('edittitle').addEventListener('input',           () => clearEditError('edit-title-error'));
    document.getElementById('editMessage').addEventListener('input',         () => clearEditError('edit-message-error'));
    document.getElementById('edittype-field').addEventListener('change',     () => clearEditError('edit-type-error'));
    document.getElementById('editaudience-field').addEventListener('change', () => clearEditError('edit-audience-error'));
    document.getElementById('editDate').addEventListener('change',           () => clearEditError('edit-date-error'));

    document.querySelectorAll('#showModal input[name="medium[]"]').forEach(cb => {
        cb.addEventListener('change', () => clearEditError('edit-medium-error'));
    });

    // ── Helpers ───────────────────────────────────────────────
    function showEditError(id, message) {
        const el = document.getElementById(id);
        if (el) { el.textContent = message; el.classList.remove('d-none'); }
    }

    function clearEditError(id) {
        const el = document.getElementById(id);
        if (el) { el.textContent = ''; el.classList.add('d-none'); }
    }

    function clearEditErrors() {
        ['edit-title-error','edit-message-error','edit-type-error',
         'edit-audience-error','edit-medium-error','edit-date-error','edit-time-error']
        .forEach(id => clearEditError(id));
    }
</script>
    <script>
// ── Delete ───────────────────────────────────────────────────
let deleteNotificationId = null;

document.querySelectorAll('.remove-item-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        deleteNotificationId = this.dataset.id;
    });
});

document.getElementById('delete-record').addEventListener('click', function () {
    if (!deleteNotificationId) return;

    fetch(`/admin/notifications/${deleteNotificationId}`, {
        method: 'DELETE', // ✅ use DELETE directly
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept':           'application/json',
            'Content-Type':     'application/json',
            'X-CSRF-TOKEN':     '{{ csrf_token() }}', // ✅ token in header
        }
    })
    .then(async res => {
        if (res.ok) {
            const data = await res.json();
            localStorage.setItem('toast_message', data.message); // ✅ toast
            const openModal = document.querySelector('.modal.show');
            if (openModal) {
                const modalInstance = bootstrap.Modal.getInstance(openModal)
                                    ?? new bootstrap.Modal(openModal);
                modalInstance.hide();
            }
            window.location.reload();
        } else {
            const data = await res.json();
            console.error('Delete failed:', data);
        }
    })
    .catch(err => console.error('Delete error:', err));
});
    </script>    <script>
setTimeout(function () {
    let alert = document.getElementById('success-alert');
    if (alert) {
        alert.style.transition = "opacity 0.5s";
        alert.style.opacity = "0";
        setTimeout(() => alert.remove(), 500); // remove after fade
    }
}, 2000);
</script>
@endpush
