@extends('layouts.app')
@section('title', 'Dashboard |Winngoocoin')
@section('content')


<div class="vertical-overlay"></div>

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h3 class="mb-sm-0">Role Management</h3>
                    @if(auth('admin')->check() && auth('admin')->user()->hasPermission('role_management', 'create'))
                    <div class="btn-div">
                        <button type="button" class="btn btn-primary btn-label waves-effect waves-light rounded-pill" data-bs-toggle="modal" data-bs-target="#showModalAdd"><i class="ri-add-line label-icon align-middle rounded-pill fs-16 me-2"></i> Create Role</button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- end page title -->
{{--
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header p-0 border-0 bg-light-subtle">
                        <div class="row g-0 text-center">
                            <div class="col-6 col-sm-4">
                                <div class="p-3 border border-dashed border-start-0">
                                    <h5 class="mb-1"><span class="counter-value">{{$total_roles_count}}</span></h5>
                                    <p class="text-muted mb-0">Total Roles</p>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-6 col-sm-4">
                                <div class="p-3 border border-dashed border-start-0">

                                    <h5 class="mb-1"><span class="counter-value">{{$active_roles_count}}</span></h5>
                                    <p class="text-muted mb-0">Active Roles</p>
                                </div>
                            </div>
                            <!--end col-->
                            <!-- <div class="col-6 col-sm-3">
                                <div class="p-3 border border-dashed border-start-0">
                                    <h5 class="mb-1"><span class="counter-value">0</span></h5>
                                    <p class="text-muted mb-0">Total Permissions</p>
                                </div>
                            </div> -->
                            <!--end col-->
                            <div class="col-6 col-sm-4">
                                <div class="p-3 border border-dashed border-start-0 border-end-0">
                                    <h5 class="mb-1"><span class="counter-value">{{$inactive_roles_count}}</span></h5>
                                    <p class="text-muted mb-0">Inactive Roles</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        --}}
        @include('layouts.success_toast')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Manage roles and permissions for team members</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="manageRole" class="table table-bordered dt-responsive nowrap table-striped align-middle w-100">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th>Role</th>
                                        <!-- <th>Permissions</th> -->
                                        <th>Created On</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($roles as $role)
                                    <tr>
                                        <td scope="row" class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center"><span class="badge badge-gradient-primary">{{ $role->rolename ?? ''}}</span></td>

                                        <td class="text-center">{{ $role->created_at->format('d/m/Y') ?? '' }}</td>
                                        <td class="text-center">
                                            <form method="POST" action="{{ route('roles.toggleStatus') }}">
                                                @csrf

                                                <input type="hidden" name="id" value="{{ $role->id }}">

                                                <div class="form-check form-switch text-center status-switch">
                                                    <input class="form-check-input"
                                                        type="checkbox"
                                                        name="status"
                                                        value="active"
                                                        onchange="this.form.submit()"
                                                        {{ $role->status === 'active' ? 'checked' : '' }}>

                                                    <label class="form-check-label fw-bold">
                                                        {{ $role->status === 'active' ? 'Active' : 'Inactive' }}
                                                    </label>
                                                </div>
                                            </form>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">


                                                <div class="view">
                                                    <button class="btn btn-sm btn-soft-primary rounded-pill view-item-btn"
                                                        title="view"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#viewModal"

                                                        data-role="{{ $role->rolename }}"
                                                        data-status="{{ $role->status }}"

                                                        data-permissions='@json(
                                                            $role->permissions
                                                                ->where("pivot.is_checked", 1)
                                                                ->groupBy("module")
                                                                ->map(fn($group) => $group->pluck("permission_name"))
                                                        )'>

                                                        <span class="bx bx-show-alt"></span>
                                                    </button>
                                                </div>
                                                @if(auth('admin')->check() && auth('admin')->user()->hasPermission('role_management', 'edit'))
                                                <div class="edit">

                                                    <!-- Edit button – unique modal ID -->
                                                    <button class="btn btn-sm btn-soft-secondary rounded-pill"
                                                        title="Edit"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editModal-{{ $role->id }}">
                                                        <span class="bx bx-pencil"></span>
                                                    </button>
                                                </div>
                                                @endif
                                                
                                                @if(auth('admin')->check() && auth('admin')->user()->hasPermission('role_management', 'delete'))

                                                <div class="remove">

                                                    <button
                                                        class="btn btn-sm btn-soft-danger rounded-pill remove-item-btn"
                                                        title="delete"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteRecordModal"
                                                        data-role-id="{{ $role->id }}">
                                                        <span class="bx bx-trash"></span>
                                                    </button>
                                                </div>
                                                @endif

                                            </div>
                                        </td>
                                    </tr>


                                    <!-- ====================== -->
                                    <!-- EDIT MODAL – one per role -->
                                    <!-- ====================== -->

                                    <div class="modal fade" id="editModal-{{ $role->id }}" tabindex="-1"
                                        data-bs-backdrop="static" data-bs-keyboard="false">
                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                            <div class="modal-content">

                                                <div class="modal-header bg-light p-3">
                                                    <h5 class="modal-title">Edit Role: {{ $role->rolename }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <form method="POST" action="{{ route('roles.update', $role->id) }}">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="modal-body">

                                                        <!-- Role Name -->
                                                        <div class="mb-3">
                                                            <label class="form-label" for="edit_role_name_{{ $role->id }}">
                                                                Role Name <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text"
                                                                id="edit_role_name_{{ $role->id }}"
                                                                name="role_name"
                                                                maxlength="50"
                                                                class="form-control"
                                                                value="{{ old('role_name', $role->rolename) }}"
                                                                required>
                                                            @error('role_name')
                                                            <div class="text-danger error-msg mt-1">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <!-- Permissions -->
                                                        <div class="mb-3">
                                                            <label class="form-label">Permissions</label>

                                                            @php
                                                            // Get array of permission IDs where is_checked = 1 for this role
                                                            $checkedPermissionIds = $role->permissions()
                                                            ->wherePivot('is_checked', 1)
                                                            ->pluck('permissions.id')
                                                            ->toArray();
                                                            @endphp

                                                            @php
                                                            $dashboardIds = [1,2,3,4];
                                                            $isDashboardFull = count(array_intersect($dashboardIds, $checkedPermissionIds)) === count($dashboardIds);

                                                            $userIds = [5,6,7,8];
                                                            $isUserFull = count(array_intersect($userIds, $checkedPermissionIds)) === count($userIds);

                                                            $teamIds = [9,10,11,12];
                                                            $isTeamFull = count(array_intersect($teamIds, $checkedPermissionIds)) === count($teamIds);

                                                            $roleIds = [13,14,15,16];
                                                            $isRoleFull = count(array_intersect($roleIds, $checkedPermissionIds)) === count($roleIds);

                                                            $coinIds = [17,18,19,20];
                                                            $isCoinFull = count(array_intersect($coinIds, $checkedPermissionIds)) === count($coinIds);

                                                            $notificationIds = [21,22,23,24];
                                                            $isNotificationFull = count(array_intersect($notificationIds, $checkedPermissionIds)) === count($notificationIds);


                                                            $contentIds = [25,26,27,28];
                                                            $isContentFull = count(array_intersect($contentIds, $checkedPermissionIds)) === count($contentIds);


                                                            $settingsIds = [29,30,31,32];
                                                            $isSettingsFull = count(array_intersect($settingsIds, $checkedPermissionIds)) === count($settingsIds);

                                                            @endphp



                                                            <!-- Dashboard -->
                                                           {{-- <div class="card mb-3 permission-card">
                                                                <div class="card-header d-flex justify-content-between align-items-center p-2">
                                                                    <strong>Dashboard</strong>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input module-check"
                                                                            type="checkbox"
                                                                            id="editDashboardFull_{{ $role->id }}"
                                                                            {{ $isDashboardFull ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="editDashboardFull_{{ $role->id }}">
                                                                            Full Access
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body row">
                                                                    @foreach([1=>'View', 2=>'Create', 3=>'Edit', 4=>'Delete'] as $id => $label)
                                                                    <div class="col-md-3 form-check">
                                                                        <input type="checkbox"
                                                                            name="permissions[]"
                                                                            value="{{ $id }}"
                                                                            class="form-check-input permission-checkbox"
                                                                            id="editDash{{ $label }}_{{ $role->id }}"
                                                                            {{ in_array($id, $checkedPermissionIds) ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="editDash{{ $label }}_{{ $role->id }}">{{ $label }}</label>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            --}}

                                                            <!-- User Management -->
                                                            <div class="card mb-3 permission-card">
                                                                <div class="card-header d-flex justify-content-between align-items-center p-2">
                                                                    <strong>User Management</strong>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input module-check"
                                                                            type="checkbox"
                                                                            id="editUserFull_{{ $role->id }}"
                                                                            {{ $isUserFull ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="editUserFull_{{ $role->id }}">Full Access</label>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body row">
                                                                    @foreach([5=>'View', 6=>'Create', 7=>'Edit', 8=>'Delete'] as $id => $label)
                                                                    <div class="col-md-3 col-6 form-check">
                                                                        <input type="checkbox"
                                                                            name="permissions[]"
                                                                            value="{{ $id }}"
                                                                            class="form-check-input permission-checkbox"
                                                                            id="editUser{{ $label }}_{{ $role->id }}"
                                                                            {{ in_array($id, $checkedPermissionIds) ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="editUser{{ $label }}_{{ $role->id }}">{{ $label }}</label>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>

                                                            <!-- Team Management -->
                                                            <div class="card mb-3 permission-card">
                                                                <div class="card-header d-flex justify-content-between align-items-center p-2">
                                                                    <strong>Team Management</strong>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input module-check"
                                                                            type="checkbox"
                                                                            id="editTeamFull_{{ $role->id }}"
                                                                            {{ $isTeamFull ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="editTeamFull_{{ $role->id }}">Full Access</label>
                                                                    </div>
                                                                </div>

                                                                <div class="card-body row">
                                                                    @foreach([9=>'View',10=>'Create',11=>'Edit',12=>'Delete'] as $id => $label)
                                                                    <div class="col-md-3 col-6 form-check">
                                                                        <input type="checkbox"
                                                                            name="permissions[]"
                                                                            value="{{ $id }}"
                                                                            class="form-check-input permission-checkbox"
                                                                            id="editTeam{{ $label }}_{{ $role->id }}"
                                                                            {{ in_array($id, $checkedPermissionIds) ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="editTeam{{ $label }}_{{ $role->id }}">
                                                                            {{ $label }}
                                                                        </label>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>

                                                            <!-- Rols and Permissions -->
                                                            <div class="card mb-3 permission-card">
                                                                <div class="card-header d-flex justify-content-between align-items-center p-2">
                                                                    <strong>Roles and Permissions</strong>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input module-check"
                                                                            type="checkbox"
                                                                            id="editRoles{{ $role->id }}"
                                                                            {{ $isRoleFull ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="editRoles{{ $role->id }}">Full Access</label>
                                                                    </div>
                                                                </div>

                                                                <div class="card-body row">
                                                                    @foreach([13=>'View',14=>'Create',15=>'Edit',16=>'Delete'] as $id => $label)
                                                                    <div class="col-md-3 col-6 form-check">
                                                                        <input type="checkbox"
                                                                            name="permissions[]"
                                                                            value="{{ $id }}"
                                                                            class="form-check-input permission-checkbox"
                                                                            id="editRoles{{ $label }}_{{ $role->id }}"
                                                                            {{ in_array($id, $checkedPermissionIds) ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="editRoles{{ $label }}_{{ $role->id }}">
                                                                            {{ $label }}
                                                                        </label>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>


                                                            <!-- Coin Management -->
                                                            <div class="card mb-3 permission-card">
                                                                <div class="card-header d-flex justify-content-between align-items-center p-2">
                                                                    <strong>Coin Management</strong>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input module-check"
                                                                            type="checkbox"
                                                                            id="editCoin{{ $role->id }}"
                                                                            {{ $isCoinFull ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="editCoin{{ $role->id }}">Full Access</label>
                                                                    </div>
                                                                </div>

                                                                <div class="card-body row">
                                                                    @foreach([17=>'View',18=>'Create',19=>'Edit',20=>'Delete'] as $id => $label)
                                                                    <div class="col-md-3 col-6 form-check">
                                                                        <input type="checkbox"
                                                                            name="permissions[]"
                                                                            value="{{ $id }}"
                                                                            class="form-check-input permission-checkbox"
                                                                            id="editCoin{{ $label }}_{{ $role->id }}"
                                                                            {{ in_array($id, $checkedPermissionIds) ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="editCoin{{ $label }}_{{ $role->id }}">
                                                                            {{ $label }}
                                                                        </label>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>

                                                            <!-- Notification -->
                                                            <div class="card mb-3 permission-card">
                                                                <div class="card-header d-flex justify-content-between align-items-center p-2">
                                                                    <strong>Notification</strong>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input module-check"
                                                                            type="checkbox"
                                                                            id="editnotification{{ $role->id }}"
                                                                            {{ $isNotificationFull ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="editnotification{{ $role->id }}">Full Access</label>
                                                                    </div>
                                                                </div>

                                                                <div class="card-body row">
                                                                    @foreach([21=>'View',22=>'Create',23=>'Edit',24=>'Delete'] as $id => $label)
                                                                    <div class="col-md-3 col-6 form-check">
                                                                        <input type="checkbox"
                                                                            name="permissions[]"
                                                                            value="{{ $id }}"
                                                                            class="form-check-input permission-checkbox"
                                                                            id="editnotification{{ $label }}_{{ $role->id }}"
                                                                            {{ in_array($id, $checkedPermissionIds) ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="editnotification{{ $label }}_{{ $role->id }}">
                                                                            {{ $label }}
                                                                        </label>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>


                                                         <!-- Content Management -->
                                                          
                                                            <!-- settings -->
                                                            <div class="card mb-3 permission-card">
                                                                <div class="card-header d-flex justify-content-between align-items-center p-2">
                                                                    <strong>Settings</strong>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input module-check"
                                                                            type="checkbox"
                                                                            id="editSettings{{ $role->id }}"
                                                                            {{ $isSettingsFull ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="editSettings{{ $role->id }}">Full Access</label>
                                                                    </div>
                                                                </div>

                                                                <div class="card-body row">
                                                                    @foreach([29=>'View',30=>'Create',31=>'Edit',32=>'Delete'] as $id => $label)
                                                                    <div class="col-md-3 col-6 form-check">
                                                                        <input type="checkbox"
                                                                            name="permissions[]"
                                                                            value="{{ $id }}"
                                                                            class="form-check-input permission-checkbox"
                                                                            id="editSettings{{ $label }}_{{ $role->id }}"
                                                                            {{ in_array($id, $checkedPermissionIds) ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="editSettings{{ $label }}_{{ $role->id }}">
                                                                            {{ $label }}
                                                                        </label>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>




                                                        </div>

                                                        <!-- Status -->
                                                        <div class="mb-3">
                                                            <label class="form-label">Status</label>

                                                            <input type="hidden" name="status" value="inactive">

                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input"
                                                                    type="checkbox"
                                                                    name="status"
                                                                    id="editRoleStatus_{{ $role->id }}"
                                                                    value="active"
                                                                    {{ old('status', $role->status) === 'active' ? 'checked' : '' }}>

                                                                <label class="form-check-label fw-bold"
                                                                    for="editRoleStatus_{{ $role->id }}"
                                                                    id="editStatusText_{{ $role->id }}"
                                                                    style="color: {{ old('status', $role->status) === 'active' ? '#198754' : '#dc3545' }};">
                                                                    {{ old('status', $role->status) === 'active' ? 'Active' : 'Inactive' }}
                                                                </label>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success">Update Role</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>



                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No roles found.</td>
                                    </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>



<div id="viewModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-header bg-light p-3">
                <h5 class="modal-title">View Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <!-- Role -->
                <div class="row mb-3">
                    <div class="col-4 fw-semibold text-muted">Role</div>
                    <div class="col-8">
                        <span id="viewRoleName" class="badge badge-gradient-primary"></span>
                    </div>
                </div>

                <hr>

                <!-- Permissions -->
                <h6 class="mb-3">Permissions</h6>

                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>Module</th>
                                <th>Allowed Actions</th>
                            </tr>
                        </thead>
                        <tbody id="viewPermissions"></tbody>
                    </table>
                </div>

                <!-- Status -->
                <div class="row mt-3">
                    <div class="col-4 fw-semibold text-muted">Status</div>
                    <div class="col-8">
                        <span id="viewStatusBadge" class="badge"></span>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button"
                    class="btn btn-light"
                    data-bs-dismiss="modal">
                    Close
                </button>


            </div>

        </div>



    </div>
</div>




<!-- =====Role create  MODAL ===== -->
<div class="modal fade" id="showModalAdd" tabindex="-1"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-header bg-light p-3">
                <h5 class="modal-title">Create New Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" action="{{ route('roles.store') }}">
                @csrf
                <div class="modal-body">

                    <!-- Role Name -->
                    <div class="mb-3">
                        <label class="form-label" for="roleName">
                            Role Name <span class="text-danger">*</span>
                        </label>

                        <input type="text" id="role_name" name="role_name" maxlength="50" class="form-control">
                        @error('role_name')
                        <div class="text-danger error-msg" id="role_name_error">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Permissions -->
                    <div class="mb-3">
                        <label class="form-label">Permissions</label>

                        <!-- ================= Dashboard ================= -->
                      {{--  <div class="card mb-3 permission-card">
                            <div class="card-header d-flex justify-content-between align-items-center p-2">
                                <strong>Dashboard</strong>
                                <div class="form-check">
                                    <input class="form-check-input module-check" type="checkbox" id="dashboardFull">
                                    <label class="form-check-label" for="dashboardFull">
                                        Full Access
                                    </label>
                                </div>
                            </div>

                            <div class="card-body row">
                                <div class="col-md-3 form-check">
                                    <input type="checkbox" name="permissions[]" value="1" class="form-check-input permission-checkbox" id="dashView">
                                    <label>View</label>
                                </div>
                                <div class="col-md-3 form-check">
                                    <input type="checkbox" name="permissions[]" value="2" class="form-check-input permission-checkbox" id="dashCreate">
                                    <label>Create</label>
                                </div>
                                <div class="col-md-3 form-check">
                                    <input type="checkbox" name="permissions[]" value="3" class="form-check-input permission-checkbox" id="dashEdit">
                                    <label>Edit</label>
                                </div>
                                <div class="col-md-3 form-check">
                                    <input type="checkbox" name="permissions[]" value="4" class="form-check-input permission-checkbox" id="dashDelete">
                                    <label>Delete</label>
                                </div>
                            </div>


                        </div>
                        --}}


                        <!-- ================= USERS ================= -->
                        <div class="card mb-3 permission-card">
                            <div class="card-header d-flex justify-content-between align-items-center p-2">
                                <strong>User Management</strong>
                                <div class="form-check">
                                    <input class="form-check-input module-check"
                                        type="checkbox"
                                        id="userFull">
                                    <label class="form-check-label" for="userFull">
                                        Full Access
                                    </label>
                                </div>
                            </div>

                            <div class="card-body row">
                                <div class="col-md-3 col-6 form-check">
                                    <input type="checkbox"
                                        name="permissions[]"
                                        value="5"
                                        class="form-check-input permission-checkbox"
                                        id="userView">
                                    <label class="form-check-label" for="userView">View</label>
                                </div>

                                <div class="col-md-3 col-6 form-check">
                                    <input type="checkbox"
                                        name="permissions[]"
                                        value="6"
                                        class="form-check-input permission-checkbox"
                                        id="userCreate">
                                    <label class="form-check-label" for="userCreate">Create</label>
                                </div>

                                <div class="col-md-3 col-6 form-check">
                                    <input type="checkbox"
                                        name="permissions[]"
                                        value="7"
                                        class="form-check-input permission-checkbox"
                                        id="userEdit">
                                    <label class="form-check-label" for="userEdit">Edit</label>
                                </div>

                                <div class="col-md-3 col-6 form-check">
                                    <input type="checkbox"
                                        name="permissions[]"
                                        value="8"
                                        class="form-check-input permission-checkbox"
                                        id="userDelete">
                                    <label class="form-check-label" for="userDelete">Delete</label>
                                </div>
                            </div>
                        </div>

                        <!-- ================= TEAM ================= -->
                        <div class="card mb-3 permission-card">
                            <div class="card-header d-flex justify-content-between align-items-center p-2">
                                <strong>Team Management</strong>
                                <div class="form-check">
                                    <input class="form-check-input module-check"
                                        type="checkbox"
                                        id="teamFull">
                                    <label class="form-check-label" for="teamFull">
                                        Full Access
                                    </label>
                                </div>
                            </div>

                            <div class="card-body row">
                                <div class="col-md-3 col-6 form-check">
                                    <input type="checkbox"
                                        name="permissions[]"
                                        value="9"
                                        class="form-check-input permission-checkbox"
                                        id="teamView">
                                    <label class="form-check-label" for="teamView">View</label>
                                </div>

                                <div class="col-md-3 col-6 form-check">
                                    <input type="checkbox"
                                        name="permissions[]"
                                        value="10"
                                        class="form-check-input permission-checkbox"
                                        id="teamCreate">
                                    <label class="form-check-label" for="teamCreate">Create</label>
                                </div>

                                <div class="col-md-3 col-6 form-check">
                                    <input type="checkbox"
                                        name="permissions[]"
                                        value="11"
                                        class="form-check-input permission-checkbox"
                                        id="teamEdit">
                                    <label class="form-check-label" for="teamEdit">Edit</label>
                                </div>

                                <div class="col-md-3 col-6 form-check">
                                    <input type="checkbox"
                                        name="permissions[]"
                                        value="12"
                                        class="form-check-input permission-checkbox"
                                        id="teamDelete">
                                    <label class="form-check-label" for="teamDelete">Delete</label>
                                </div>
                            </div>
                        </div>
                        <!-- ================= Roles ================= -->
                        <div class="card mb-3 permission-card">
                            <div class="card-header d-flex justify-content-between align-items-center p-2">
                                <strong>Roles and Permissions</strong>
                                <div class="form-check">
                                    <input class="form-check-input module-check"
                                        type="checkbox"
                                        id="rolesFull">
                                    <label class="form-check-label" for="rolesFull">
                                        Full Access
                                    </label>
                                </div>
                            </div>

                            <div class="card-body row">
                                <div class="col-md-3 col-6 form-check">
                                    <input type="checkbox"
                                        name="permissions[]"
                                        value="13"
                                        class="form-check-input permission-checkbox"
                                        id="rolesView">
                                    <label class="form-check-label" for="rolesView">View</label>
                                </div>

                                <div class="col-md-3 col-6 form-check">
                                    <input type="checkbox"
                                        name="permissions[]"
                                        value="14"
                                        class="form-check-input permission-checkbox"
                                        id="rolesCreate">
                                    <label class="form-check-label" for="rolesCreate">Create</label>
                                </div>

                                <div class="col-md-3 col-6 form-check">
                                    <input type="checkbox"
                                        name="permissions[]"
                                        value="15"
                                        class="form-check-input permission-checkbox"
                                        id="rolesEdit">
                                    <label class="form-check-label" for="rolesEdit">Edit</label>
                                </div>

                                <div class="col-md-3 col-6 form-check">
                                    <input type="checkbox"
                                        name="permissions[]"
                                        value="16"
                                        class="form-check-input permission-checkbox"
                                        id="rolesDelete">
                                    <label class="form-check-label" for="rolesDelete">Delete</label>
                                </div>
                            </div>
                        </div>

                        <!-- ================= COIN ================= -->
                        <div class="card mb-3 permission-card">
                            <div class="card-header d-flex justify-content-between align-items-center p-2">
                                <strong>Coin Management</strong>
                                <div class="form-check">
                                    <input class="form-check-input module-check"
                                        type="checkbox"
                                        id="coinFull">
                                    <label class="form-check-label" for="coinFull">
                                        Full Access
                                    </label>
                                </div>
                            </div>

                            <div class="card-body row">
                                <div class="col-md-3 col-6 form-check">
                                    <input type="checkbox"
                                        name="permissions[]"
                                        value="17"
                                        class="form-check-input permission-checkbox"
                                        id="coinView">
                                    <label class="form-check-label" for="coinView">View</label>
                                </div>

                                <div class="col-md-3 col-6 form-check">
                                    <input type="checkbox"
                                        name="permissions[]"
                                        value="18"
                                        class="form-check-input permission-checkbox"
                                        id="coinCreate">
                                    <label class="form-check-label" for="coinCreate">Create</label>
                                </div>

                                <div class="col-md-3 col-6 form-check">
                                    <input type="checkbox"
                                        name="permissions[]"
                                        value="19"
                                        class="form-check-input permission-checkbox"
                                        id="coinEdit">
                                    <label class="form-check-label" for="coinEdit">Edit</label>
                                </div>

                                <div class="col-md-3 col-6 form-check">
                                    <input type="checkbox"
                                        name="permissions[]"
                                        value="20"
                                        class="form-check-input permission-checkbox"
                                        id="coinDelete">
                                    <label class="form-check-label" for="coinDelete">Delete</label>
                                </div>
                            </div>
                        </div>


                        <!-- ================= Notification ================= -->
                        <div class="card mb-3 permission-card">
                            <div class="card-header d-flex justify-content-between align-items-center p-2">
                                <strong>Notification</strong>
                                <div class="form-check">
                                    <input class="form-check-input module-check"
                                        type="checkbox"
                                        id="notificationFull">
                                    <label class="form-check-label" for="notificationFull">
                                        Full Access
                                    </label>
                                </div>
                            </div>

                            <div class="card-body row">
                                <div class="col-md-3 col-6 form-check">
                                    <input type="checkbox"
                                        name="permissions[]"
                                        value="21"
                                        class="form-check-input permission-checkbox"
                                        id="notificationView">
                                    <label class="form-check-label" for="notificationView">View</label>
                                </div>

                                <div class="col-md-3 col-6 form-check">
                                    <input type="checkbox"
                                        name="permissions[]"
                                        value="22"
                                        class="form-check-input permission-checkbox"
                                        id="notificationCreate">
                                    <label class="form-check-label" for="notificationCreate">Create</label>
                                </div>

                                <div class="col-md-3 col-6 form-check">
                                    <input type="checkbox"
                                        name="permissions[]"
                                        value="23"
                                        class="form-check-input permission-checkbox"
                                        id="notificationEdit">
                                    <label class="form-check-label" for="notificationEdit">Edit</label>
                                </div>

                                <div class="col-md-3 col-6 form-check">
                                    <input type="checkbox"
                                        name="permissions[]"
                                        value="24"
                                        class="form-check-input permission-checkbox"
                                        id="notificationDelete">
                                    <label class="form-check-label" for="notificationDelete">Delete</label>
                                </div>
                            </div>
                        </div>
                      <!-- ================= Content Management ================= -->




                        <!-- ================= SETTINGS ================= -->
                        <div class="card mb-3 permission-card">
                            <div class="card-header d-flex justify-content-between align-items-center p-2">
                                <strong>Settings</strong>
                                <div class="form-check">
                                    <input class="form-check-input module-check"
                                        type="checkbox"
                                        id="settingsFull">
                                    <label class="form-check-label" for="settingsFull">
                                        Full Access
                                    </label>
                                </div>
                            </div>

                            <div class="card-body row">
                                <div class="col-md-3 col-6 form-check">
                                    <input type="checkbox"
                                        name="permissions[]"
                                        value="29"
                                        class="form-check-input permission-checkbox"
                                        id="settingsProfile">
                                    <label class="form-check-label" for="settingsProfile">View</label>
                                </div>

                                <div class="col-md-3 col-6 form-check">
                                    <input type="checkbox"
                                        name="permissions[]"
                                        value="30"
                                        class="form-check-input permission-checkbox"
                                        id="settingsPassword">
                                    <label class="form-check-label" for="settingsPassword">Create</label>
                                </div>

                                <div class="col-md-3 col-6 form-check">
                                    <input type="checkbox"
                                        name="permissions[]"
                                        value="31"
                                        class="form-check-input permission-checkbox"
                                        id="settingsPlatform">
                                    <label class="form-check-label" for="settingsPlatform">Edit</label>
                                </div>

                                <div class="col-md-3 col-6 form-check">
                                    <input type="checkbox"
                                        name="permissions[]"
                                        value="32"
                                        class="form-check-input permission-checkbox"
                                        id="settingsEmail">
                                    <label class="form-check-label" for="settingsEmail">Delete</label>
                                </div>


                            </div>
                        </div>

                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label class="form-label">Status</label>

                        <!-- Hidden field for unchecked -->
                        <input type="hidden" name="status" value="inactive">

                        <div class="form-check form-switch">
                            <input class="form-check-input"
                                type="checkbox"
                                name="status"
                                id="roleStatus"
                                value="active"
                                {{ old('status', 'active') == 'active' ? 'checked' : '' }}>

                            <label class="form-check-label fw-bold"
                                for="roleStatus"
                                id="statusText"
                                style="color: {{ old('status', 'active') == 'active' ? '#198754' : '#dc3545' }};">
                                {{ old('status', 'active') == 'active' ? 'Active' : 'Inactive' }}
                            </label>
                        </div>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button"
                        class="btn btn-light"
                        data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit"
                        class="btn btn-success" id="add-btn">
                        Create Role
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- Modal -->
@if($roles->isNotEmpty())
<!-- <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>Are you Sure ?</h4>
                        <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Record ?</p>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                    <form id="delete-role-form" style="margin-bottom:0;" method="POST" action="{{ route('roles.destroy', $role->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn w-sm btn-danger">Yes, Delete It!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->

<!-- ==================== DELETE MODAL (Keep this ONLY ONCE) ==================== -->
<!-- DELETE MODAL - Place this AFTER the create modal (#showModalAdd) and before </div> of container-fluid -->
<div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" 
                    colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                <h4 class="mt-4">Are you Sure?</h4>
                <p class="text-muted">This action cannot be undone.</p>

                <div class="d-flex gap-2 justify-content-center mt-4">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    
                    <form id="delete-role-form" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Yes, Delete It!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif



</div>
<!-- container-fluid -->
</div>

@include('layouts.footer')


@endsection

<!--datatable js-->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>



<script>
    document.addEventListener('DOMContentLoaded', function() {

        document.querySelectorAll('.permission-card').forEach(card => {

            const fullAccess = card.querySelector('.module-check');
            const permissions = card.querySelectorAll('.permission-checkbox');

            if (!fullAccess || permissions.length === 0) return;

            // Full Access → select/unselect all permissions in same card
            fullAccess.addEventListener('change', function() {
                permissions.forEach(p => p.checked = this.checked);
            });

            // Individual permission → sync Full Access
            permissions.forEach(p => {
                p.addEventListener('change', function() {
                    const allChecked = Array.from(permissions).every(x => x.checked);
                    fullAccess.checked = allChecked;
                });
            });

        });

    });
</script>





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

    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const input = document.getElementById('role_name');

        if (input) {
            input.addEventListener('input', function() {
                const error = document.getElementById('role_name_error');
                if (error) {
                    error.style.display = 'none';
                }
            });

            input.addEventListener('change', function() {
                const error = document.getElementById('role_name_error');
                if (error) {
                    error.style.display = 'none';
                }
            });
        }

    });
</script>

@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var myModal = new bootstrap.Modal(document.getElementById('showModalAdd'));
        myModal.show();
    });
</script>
@endif



<script>
    document.addEventListener('DOMContentLoaded', function() {

        document.querySelectorAll('.view-item-btn').forEach(button => {

            button.addEventListener('click', function() {

                const role = this.dataset.role;
                const status = this.dataset.status;
                const permissions = JSON.parse(this.dataset.permissions);

                // Role name
                document.getElementById('viewRoleName').textContent = role;

                // Status
                const statusBadge = document.getElementById('viewStatusBadge');
                statusBadge.textContent = status.charAt(0).toUpperCase() + status.slice(1);
                statusBadge.className = 'badge ' + (status === 'active' ? 'bg-success' : 'bg-danger');

                // Permissions
                const tbody = document.getElementById('viewPermissions');
                tbody.innerHTML = '';

                if (Object.keys(permissions).length === 0) {
                    tbody.innerHTML = `
                    <tr>
                        <td colspan="2" class="text-center text-muted">
                            No permissions assigned
                        </td>
                    </tr>`;
                    return;
                }

                for (const module in permissions) {
                    const actions = permissions[module].join(', ');

                    tbody.innerHTML += `
                    <tr>
                        <td>${module.charAt(0).toUpperCase() + module.slice(1)}</td>
                        <td>${actions}</td>
                    </tr>`;
                }

            });

        });

    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForm = document.getElementById('delete-role-form');

        document.querySelectorAll('.remove-item-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                const roleId = this.getAttribute('data-role-id');
                
                if (roleId) {
                    // CORRECT URL with admin prefix
                    deleteForm.action = "{{ url('admin/roles/delete') }}/" + roleId;
                    console.log('Delete URL set to: ' + deleteForm.action);
                }
            });
        });
    });
</script>