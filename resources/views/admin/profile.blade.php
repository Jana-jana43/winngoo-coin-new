@extends('layouts.app')
@section('title', 'Profile | Winngoo Coin')
@section('content')
 
<form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
@csrf
            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                                <h3 class="mb-sm-0">Admin Profile</h3>
                            <button type="submit" class="btn btn-success btn-label waves-effect waves-light rounded-pill"  id="sa-save">
                <i class="ri-save-3-line label-icon align-middle rounded-pill fs-16 me-2"></i>
                Save Changes
            </button>
                            </div>
                        </div>
                    </div>

<!--               @if(session('success'))-->
<!--<div class="alert alert-success" id="success-alert">-->
<!--    {{ session('success') }}-->
<!--</div>-->
<!--@endif-->
@include('layouts.success_toast')
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Manage Your Profile Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="text-center mb-3">
                                                <div class="position-relative d-inline-block">
                                                    <div class="position-absolute bottom-0 end-0">
                                                        <label for="member-image-input" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Select Member Image">
                                                            <div class="avatar-xs">
                                                                <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                                    <i class="ri-image-fill"></i>
                                                                </div>
                                                            </div>
                                                        </label>
                                                            <input name="profile" class="form-control d-none" id="member-image-input" type="file" accept="image/png, image/jpeg, image/jpg">
                                                       </div>
                                                    <div class="avatar-lg avatar-10rm">
                                                        <div class="avatar-title bg-light rounded-circle">
                                                            <img 
src="{{ ($admin && $admin->profile) 
    ? asset('assets/adminprofile/'.$admin->profile) 
    : asset('assets/images/user-dummy-img.jpg') }}"
id="member-img" width="120" 
class="rounded-circle h-auto" />
                                                        </div>
                                                    </div>
                                                </div>
                                                @error('profile')
<small class="text-danger error-msg">{{ $message }}</small>
@enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="row">
                                                
                                                <div class="col-md-6">
    <label class="form-label">Staff Id</label> 
    <input type="text" name="last_name" class="form-control input-field" maxlength="30"
    value="{{ old('staff_id', $admin->staff_id ?? '') }}" disabled>

</div>
                                               
                                                <div class="col-md-6">
    <label class="form-label">Username <span class="text-danger">*</span></label>
    <input type="text" name="name" class="form-control input-field" maxlength ="30"
    value="{{ old('name', $admin->username ?? '') }}" oninput="this.value=this.value.replace(/[^A-Za-z\s]/g,'')">

    @error('name')
    <small class="text-danger error-msg">{{ $message }}</small>
    @enderror
</div>

<!-- LAST NAME -->
<!--<div class="col-md-6">-->
<!--    <label class="form-label">Last Name</label> -->
<!--    <input type="text" name="last_name" class="form-control input-field" maxlength="30"-->
<!--    value="{{ old('last_name', $admin->last_name ?? '') }}" oninput="this.value=this.value.replace(/[^A-Za-z\s]/g,'')">-->

<!--    @error('last_name')-->
<!--    <small class="text-danger error-msg">{{ $message }}</small>-->
<!--    @enderror-->
<!--</div>-->

                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="role" class="form-label">Role <span class="text-danger"></span></label>
                                                        <input type="text" class="form-control" id="role" placeholder="Enter Role" required value="Admin" disabled>
                                                    </div>
                                                </div>
                                              <div class="col-md-6">
    <label class="form-label">Email </label>
    <input type="email" name="email" class="form-control input-field" maxlength="50"
    value="{{ old('email', $admin->email ?? '') }}" disabled>

    <!--@error('email')-->
    <!--<small class="text-danger error-msg">{{ $message }}</small>-->
    <!--@enderror-->
</div>

<!-- PHONE -->
<div class="col-md-6">
    <label class="form-label">Phone</label>
    <input type="text" name="phone" class="form-control input-field"
    value="{{ old('phone', $admin->phone ?? '') }}" maxlength ="15"
    oninput="this.value=this.value.replace(/[^0-9]/g,'')">

    @error('phone')
    <small class="text-danger error-msg">{{ $message }}</small>
    @enderror
</div>
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

             @include('layouts.footer')
        
@endsection 
@push('scripts')
<script>
        document.querySelector("#member-image-input").addEventListener("change", function () {
            var e = document.querySelector("#member-img"),
                t = document.querySelector("#member-image-input").files[0],
                r = new FileReader();
            r.addEventListener(
                "load",
                function () {
                    e.src = r.result;
                },
                !1
            ),
                t && r.readAsDataURL(t);
        });
    </script>

<script>
document.querySelectorAll('.input-field').forEach(input => {
    input.addEventListener('input', function () {

        // remove error message near this input
        let error = this.parentElement.querySelector('.error-msg');
        if (error) {
            error.remove();
        }
    });
});
</script>
<!--<script>-->
<!--setTimeout(function () {-->
<!--    let alert = document.getElementById('success-alert');-->
<!--    if (alert) {-->
<!--        alert.style.transition = "opacity 0.5s";-->
<!--        alert.style.opacity = "0";-->
<!--        setTimeout(() => alert.remove(), 500); // remove after fade-->
<!--    }-->
<!--}, 2000);-->
<!--</script>-->
 
@endpush