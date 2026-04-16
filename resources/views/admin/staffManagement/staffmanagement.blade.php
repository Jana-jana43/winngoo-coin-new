@extends('layouts.app')
@section('title', 'Dashboard |Winngoocoin')
@section('content')

<style>
     /* DataTable buttons styling */
        .dt-buttons {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .dt-buttons .btn {
            background: #fff !important;
            color: #495057 !important;
            border: 1px solid #dee2e6 !important;

            font-size: 13px !important;
            font-weight: 500 !important;
            padding: 5px 16px !important;
            box-shadow: none !important;
        }

        .dt-buttons .btn:hover {
            background: #f8f9fa !important;
            border-color: #adb5bd !important;
        }

        div.dataTables_wrapper div.dataTables_filter input {
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 5px 10px;
            font-size: 13px;
        }

        div.dataTables_wrapper div.dataTables_filter label {
            display: flex;
            align-items: center;
            gap: 8px;
            justify-content: flex-end;
        }

        div.dataTables_info {
            font-size: 13px;
            color: #6c757d;
            padding-top: 8px;
        }

        .dataTables_paginate .paginate_button.current {
            background: #6f42c1 !important;
            border-color: #6f42c1 !important;
            color: #fff !important;
            border-radius: 6px !important;
        }

        .dataTables_paginate .paginate_button:hover {
            background: #f3f0fb !important;
            border-color: #d8d0f0 !important;
            color: #6f42c1 !important;
            border-radius: 6px !important;
        }

        /* CHANGE 3: Upgrade button — distinct purple gradient (not green like Send Invite) */
        .btn-upgrade-active {
            background: linear-gradient(135deg, #9568e9, #8f5fe8) !important;
            border-color: #ac84f7 !important;
            color: #fff !important;

        }

        .btn-upgrade-active:hover {
            background: linear-gradient(135deg, #5a32a3, #7b4dd4) !important;
            border-color: #5a32a3 !important;
            color: #fff !important;
        }

        .btn-upgrade-disabled {
            background: #e9ecef !important;
            color: #adb5bd !important;
            border: 1px solid #dee2e6 !important;
            cursor: not-allowed !important;
            opacity: 1 !important;
        }
</style>



<div class="vertical-overlay"></div>

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h3 class="mb-sm-0">Staff Management</h3>
                    @if(auth('admin')->check() && auth('admin')->user()->hasPermission('team_management', 'create'))
                    <div class="btn-div">
                        <button type="button" class="btn btn-primary btn-label waves-effect waves-light rounded-pill" data-bs-toggle="modal" data-bs-target="#showModalAdd"><i class="ri-add-line label-icon align-middle rounded-pill fs-16 me-2"></i> Add Member</button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @include('layouts.success_toast')
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Manage Your Staff Members and their roles.</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="manageTeam" class="table table-bordered dt-responsive nowrap table-striped align-middle w-100">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th>Role Id</th>
                                        <th>Userame</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($staffs as $staff)
                                    <tr>
                                        <td scope="row" class="text-center">{{$loop->iteration}}</td>
                                        <td class="text-center">{{$staff->staff_id ?? ''}}</td>
                                        <td>
                                            <h5 class="contact-name fs-13 mb-1">{{$staff->username ?? ''}}</h5>
                                        </td>
                                        <td>{{$staff->email ?? ''}}</td>
                                        <td class="text-center">{{$staff->roles?->rolename}}</td>
                                        <td class="text-center">
                                            <form method="POST" action="{{ route('staff.toggleStatus') }}">
                                                @csrf

                                                <input type="hidden" name="id" value="{{ $staff->id }}">

                                                <div class="form-check form-switch text-center status-switch">
                                                    <input class="form-check-input"
                                                        type="checkbox"
                                                        name="status"
                                                        value="active"
                                                        onchange="this.form.submit()"
                                                        {{ $staff->status === 'active' ? 'checked' : '' }}>

                                                    <label class="form-check-label fw-bold">
                                                        {{ $staff->status === 'active' ? 'Active' : 'Inactive' }}
                                                    </label>
                                                </div>
                                            </form>
                                        </td>
                                        <!--<td class="text-center">-->
                                        <!--    <button type="button" class="btn btn-success btn-sm invite-btn">Send Invite</button>-->
                                        <!--</td>-->
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                @if(auth('admin')->check() && auth('admin')->user()->hasPermission('team_management', 'edit'))
                                                <div class="edit">
                                                    <!-- <button class="btn btn-sm btn-soft-secondary rounded-pill edit-item-btn" title="edit" data-bs-toggle="modal" data-bs-target="#showModal"><span class="bx bx-pencil"></span></button> -->
                                                    <button class="btn btn-sm btn-soft-secondary" data-bs-toggle="modal" data-bs-target="#showModal{{ $staff->id }}">
                                                        <span class="bx bx-pencil"></span>
                                                    </button>
                                                </div>
                                                @endif
                                                @if(auth('admin')->check() && auth('admin')->user()->hasPermission('team_management', 'delete'))
                                                <div class="remove">
                                                    <button
                                                        class="btn btn-sm btn-soft-danger rounded-pill"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteRecordModal{{ $staff->id }}">
                                                        <span class="bx bx-trash"></span>
                                                    </button>


                                                </div>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- edit staff modal -->

                                    <!-- Modal for this staff -->
                                    <div class="modal fade" id="showModal{{ $staff->id }}" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form method="POST" action="{{ route('staff.update', $staff->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit - {{ $staff->username }} ({{ $staff->staff_id }})</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <!-- Email -->
                                                        <div class="mb-3">
                                                            <label for="email{{ $staff->id }}">Email</label>
                                                            <input type="text" name="email" id="email{{ $staff->id }}" class="form-control" value="{{ $staff->email }}" disabled>
                                                        </div>
                                                         <!-- Staff Name -->
                                                        <div class="mb-3">
                                                            <label for="staffname{{ $staff->id }}">Userame</label>
                                                            <input type="text" name="username" id="staffname{{ $staff->id }}" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g,'')" maxlength="50"  style="background-color: var(--vz-tertiary-bg); cursor: not-allowed;" class="form-control" value="{{ $staff->username }}" readonly>
                                                            @error('username')
                                                            <div class="error-msg text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <!-- Role -->
                                                        <div class="mb-3">
                                                            <label for="roleSelect{{ $staff->id }}">Role</label>
                                                            <select name="Role" id="roleSelect{{ $staff->id }}" class="form-select">
                                                                @foreach($roles as $role)
                                                                    <option value="{{ $role->id }}" title="{{ $role->rolename }}"
                                                                        {{ $staff->role_id == $role->id ? 'selected' : '' }}>
                                                                        {{ \Illuminate\Support\Str::limit($role->rolename, 25, '...') }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('Role')
                                                            <div class="error-msg text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                       

                                                        <!-- Status -->
                                                        <div class="mb-3 form-check form-switch">
                                                            <!-- Hidden field defaults to 'inactive' -->
                                                            <input type="hidden" name="staff_status" value="inactive">

                                                            <!-- Checkbox overrides to 'active' if checked -->
                                                            <input type="checkbox" name="staff_status" id="status{{ $staff->id }}" class="form-check-input" value="active" {{ $staff->status == 'active' ? 'checked' : '' }}>

                                                            <label class="form-check-label" for="status{{ $staff->id }}">
                                                                {{ $staff->status == 'active' ? 'Active' : 'Inactive' }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success">Update & Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ✅ delete Modal (inside loop with unique ID) -->
                                    <div class="modal fade zoomIn" id="deleteRecordModal{{ $staff->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="mt-2 text-center">
                                                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                                            colors="primary:#f7b84b,secondary:#f06548"
                                                            style="width:100px;height:100px">
                                                        </lord-icon>

                                                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                            <h4>Are you Sure ?</h4>
                                                            <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Record ?</p>
                                                        </div>
                                                    </div>

                                                    <!-- Form to delete this staff -->
                                                    <form method="POST" action="{{ route('admin.destroy', $staff->id) }}">
                                                        @csrf
                                                        @method('DELETE')

                                                        <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                            <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn w-sm btn-danger">Yes, Delete It!</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No Staff Found</td>
                                    </tr>
                                    @endforelse




                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- create staff model -->


        <div class="modal fade" id="showModalAdd" tabindex="-1" aria-labelledby="exampleModalLabelAdd" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-light p-3">
                        <h5 class="modal-title" id="exampleModalLabelAdd">Add Staff Member</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                    </div>
                    <form class="tablelist-form" id="addForm" method="POST" action="{{ route('staff.store') }}" autocomplete="off">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3" id="">
                                        <label for="id-role" class="form-label">Staff ID <span class="text-danger">*</span></label>
                                        <input type="text" id="id-role" value="{{ $staffId }}" name="staff_id" class="form-control" placeholder="WCR23223" readonly disabled />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="role-field" class="form-label">Role <span class="text-danger">*</span></label>


                                        <select class="form-select" name="role" id="role-field">
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}" title="{{ $role->rolename }}">
                                                    {{ \Illuminate\Support\Str::limit($role->rolename, 25, '...') }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('role')
                                        <div class="error-msg text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="addstaffname" class="form-label">Username <span class="text-danger">*</span></label>
                                        <input type="text" id="addstaffname" maxlength="50" name="staff_name" value="{{old('staff_name')}}" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g,'')" class="form-control" placeholder="Enter Name">
                                        @error('staff_name')
                                        <div class="error-msg text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="addstaffname" class="form-label">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" id="addstaffname" maxlength="50" name="last_name" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g,'')" class="form-control" placeholder="Enter Last Name">
                                        @error('last_name')
                                        <div class="error-msg text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div> -->


                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="addemail-field" class="form-label">Email Id <span class="text-danger">*</span></label>
                                        <input type="text" id="addemail-field" maxlength="50" name="email" value="{{old('staff_name')}}" class="form-control" placeholder="Enter Email">
                                        @error('email')
                                        <div class="error-msg text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="passwordAdd" class="form-label">Password <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" maxlength="50" id="passwordAdd" name="password" placeholder="Enter Password">
                                            <button class="btn btn-outline-secondary" type="button" id="togglePasswordAdd">
                                                <i class="ri-eye-line" id="togglePasswordIconAdd"></i>
                                            </button>
                                        </div>
                                        @error('password')
                                        <div class="error-msg text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="confirmPasswordAdd" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" maxlength="50" name="password_confirmation" id="confirmPasswordAdd" placeholder="Re-enter Password">
                                            <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPasswordAdd">
                                                <i class="ri-eye-line" id="toggleConfirmPasswordIconAdd"></i>
                                            </button>
                                        </div>
                                        @error('password_confirmation')
                                        <div class="error-msg text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div> -->


                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="staff_status" class="form-label">Status</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input"
                                                type="checkbox"
                                                name="staff_status"
                                                id="staff_status"
                                                value="active"
                                                {{ old('staff_status', 'active') == 'active' ? 'checked' : '' }}>
                                            <label class="form-check-label fw-bold"
                                                for="staff_status"
                                                id="statusText"
                                                style="color: {{ old('staff_status', 'active') == 'active' ? '#198754' : '#dc3545' }};">
                                                {{ old('staff_status', 'active') == 'active' ? 'Active' : 'Inactive' }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>

                                <button type="submit" class="btn btn-success" id="add-btn">
                                    <span id="add-btn-text">Add Member</span>
                                    <span id="add-btn-loader" class="d-none">
                                        <span class="spinner-border spinner-border-sm"></span> Processing...
                                    </span>
                                </button>
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

@include('layouts.footer')


@endsection

<!--datatable js-->



<script>
    document.getElementById("add-btn").addEventListener("click", function(e) {
        e.preventDefault(); // prevent form submission/refresh

        // Close modal
        let modalAdd = bootstrap.Modal.getInstance(document.getElementById("showModalAdd"));
        modalAdd.hide();

        // Show success alert
        let alertBoxAdd = document.getElementById("successAlertAdd");
        alertBoxAdd.style.display = "block"; // make visible
        alertBoxAdd.classList.add("show"); // bootstrap fade-in

        // Auto-hide after 3s
        setTimeout(function() {
            alertBoxAdd.classList.remove("show"); // fade-out
            setTimeout(() => {
                alertBoxAdd.style.display = "none"; // hide completely
            }, 150); // wait for fade transition
        }, 3000);
    });
</script>
<script>
    document.getElementById("update-btn").addEventListener("click", function(e) {
        e.preventDefault(); // prevent form submission/refresh

        // Close modal
        let modal = bootstrap.Modal.getInstance(document.getElementById("showModal"));
        modal.hide();

        // Show success alert
        let alertBox = document.getElementById("successAlertUpdate");
        alertBox.style.display = "block"; // make visible
        alertBox.classList.add("show"); // bootstrap fade-in

        // Auto-hide after 3s
        setTimeout(function() {
            alertBox.classList.remove("show"); // fade-out
            setTimeout(() => {
                alertBox.style.display = "none"; // hide completely
            }, 150); // wait for fade transition
        }, 3000);
    });
</script>


<!-- toggle password -->

<script>
    document.addEventListener('DOMContentLoaded', () => {
        function togglePassword(buttonId, inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            const button = document.getElementById(buttonId);

            if (!input || !icon || !button) return;

            button.addEventListener('click', () => {
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('ri-eye-line');
                    icon.classList.add('ri-eye-off-line');
                } else {
                    input.type = 'password';
                    icon.classList.remove('ri-eye-off-line');
                    icon.classList.add('ri-eye-line');
                }
            });
        }

        togglePassword('togglePasswordAdd', 'passwordAdd', 'togglePasswordIconAdd');
        togglePassword('toggleConfirmPasswordAdd', 'confirmPasswordAdd', 'toggleConfirmPasswordIconAdd');
    });
</script>

<!-- staus active / inactive  -->

<script>
    document.addEventListener('DOMContentLoaded', function() {

        document.querySelectorAll('.form-check.form-switch').forEach(function(wrapper) {

            const checkbox = wrapper.querySelector('.form-check-input');
            const label = wrapper.querySelector('.form-check-label');

            function updateStatus() {
                if (checkbox.checked) {
                    label.textContent = 'Active';
                    label.style.color = '#198754';
                } else {
                    label.textContent = 'Inactive';
                    label.style.color = '#dc3545';
                }
            }

            updateStatus(); // on load

            checkbox.addEventListener('change', updateStatus);

        });

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

<!-- processing button -->

<script>
document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById('addForm');
    const btn = document.getElementById('add-btn');
    const btnText = document.getElementById('add-btn-text');
    const btnLoader = document.getElementById('add-btn-loader');

    if (form) {
        form.addEventListener('submit', function () {

            // Disable button
            btn.disabled = true;

            // Show loader
            btnText.classList.add('d-none');
            btnLoader.classList.remove('d-none');
        });
    }

});
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if($errors-> any() && session('modal') === 'edit')
        var staffId = "{{ session('editStaffId') }}";
        var editModal = new bootstrap.Modal(document.getElementById('showModal' + staffId));
        editModal.show();
        @endif

        @if($errors-> any() && session('modal') === 'add')
        var addModal = new bootstrap.Modal(document.getElementById('showModalAdd'));
        addModal.show();
        @endif
    });
</script>