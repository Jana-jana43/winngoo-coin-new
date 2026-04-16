@extends('layouts.app')
@section('title', 'Dashboard |Winngoocoin')
@section('content')  

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                                <h3 class="mb-sm-0">Create FAQ</h3>
                                <div class="btn-div">
                                    <button type="submit" form="faqForm"
    class="btn btn-success btn-label waves-effect waves-light rounded-pill">
    <i class="ri-save-3-line label-icon align-middle rounded-pill fs-16 me-2"></i>
    Save
</button>
                                    <a href="{{ route('admin.faq') }}" type="button" class="btn btn-dark btn-label waves-effect waves-light rounded-pill"><i class="ri-arrow-go-back-line label-icon align-middle rounded-pill fs-16 me-2"></i> Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Create Question & Answer</h5>
                                </div>
                                <div class="card-body">
                                    {{-- <div class="row">
                                        <div class="col-lg-2 col-md-3">
                                            <div class="mb-3">
                                                <label for="quesno" class="form-label">Question No. <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="quesno" readonly disabled value="1">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="quesno" class="form-label">Status</label>
                                                <div class="form-check form-switch my-1">
                                                    <input class="form-check-input" type="checkbox" id="statusSwitch" name="status" value="active" checked>
                                                    <label class="form-check-label text-success fw-bold" for="statusSwitch">Active</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="question" class="form-label">Type Question <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="question" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="summernoteContent1" class="form-label">Type Answer <span class="text-danger">*</span></label>                                            
                                                <div id="summernoteContent1"></div>
                                            </div>
                                        </div>
                                    </div> --}}

<form id="faqForm" action="{{ route('admin.store.faq') }}" method="POST">
    @csrf

    <div class="row">

        <!-- Question No -->
        <div class="col-lg-2 col-md-3">
            <div class="mb-3">
                <label class="form-label">Question No.</label>
             <input type="text" 
       class="form-control" 
       value="{{ $nextId }}" 
       readonly 
       style="background-color: var(--vz-tertiary-bg);">
            </div>
        </div>

        <!-- Status -->
        <div class="col-md-3">
            <div class="mb-3">
                <label class="form-label">Status</label>
                <div class="form-check form-switch my-1">
                    <input class="form-check-input" type="checkbox" 
                           id="statusSwitch" name="status" value="active" checked>
                    <label class="form-check-label text-success fw-bold" for="statusSwitch">
                        Active
                    </label>
                </div>
            </div>
        </div>

        <!-- Question -->
        <div class="col-12">
            <div class="mb-3">
                <label class="form-label">Type Question <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="question" >

        @error('question')
            <small class="text-danger">{{ $message }}</small>
        @enderror
            </div>
        </div>

        {{-- <!-- Answer -->
        <div class="col-12">
            <div class="mb-3">
                <label class="form-label">Type Answer <span class="text-danger">*</span></label>
                
                <!-- Hidden textarea for submit -->
                <textarea name="answer" id="answerInput" hidden></textarea>

                <!-- Summernote UI -->
                <div id="summernoteContent1"></div>
                 @error('answer')
            <small class="text-danger">{{ $message }}</small>
        @enderror
            </div> --}}




            <div class="col-12">
    <div class="mb-3">
        <label class="form-label">
            Type Answer <span class="text-danger">*</span>
        </label>

        @error('answer')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
        <!-- Hidden textarea -->
        <textarea name="answer" id="answerInput" hidden>{{ old('answer') }}</textarea>

        <!-- Summernote -->
        <div id="summernoteContent1" 
             class="@error('answer') border border-danger @enderror"></div>

    </div>
</div>
        </div>

    </div>
</form>
                                </div>
                            </div>
                        </div>
                    </div><!--end row-->
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
@endsection
@push('scripts')
    <!-- JAVASCRIPT -->

    <script>
        $(document).ready(function() {
            $('#summernoteContent1').summernote({
                placeholder: 'Type Your Content Here...',
                tabsize: 2,
                height: 300
            });
        });
    </script>

    <script>
$(document).ready(function() {
    $('#summernoteContent1').summernote({
        placeholder: 'Type Your Content Here...',
        height: 300
    });

    // ✅ SET OLD VALUE AFTER VALIDATION FAIL
    let oldAnswer = `{!! old('answer') !!}`;
    if (oldAnswer) {
        $('#summernoteContent1').summernote('code', oldAnswer);
    }

    // ✅ BEFORE SUBMIT SET VALUE
    $('#faqForm').on('submit', function () {
        let content = $('#summernoteContent1').summernote('code');
        $('#answerInput').val(content);
    });
});
</script>
    <script>
        document.getElementById("sa-save").addEventListener("click", function () {
            Swal.fire({
                title: "Saved",
                text: "Data Saved Successfully",
                icon: "success",
                timer: 2000,
                showCancelButton: false,
                customClass: { confirmButton: "btn btn-primary w-xs me-2 mt-2"},
                buttonsStyling: !1,
                showCloseButton: !0,
            });
        });
    </script>
    <script>
        $('input[name="question"]').on('input', function () {
    if ($(this).val().trim() !== '') {
        $(this).removeClass('is-invalid');
        $(this).next('.text-danger').hide();
    }
});
        const switchInput = document.getElementById("statusSwitch");
        const switchLabel = document.querySelector("label[for='statusSwitch']");

        switchInput.addEventListener("change", function () {
            if (this.checked) {
            this.value = "active"; // ✅ ensures form submits "active"
            switchLabel.textContent = "Active";
            switchLabel.classList.remove("text-danger");
            switchLabel.classList.add("text-success");
            } else {
            this.value = "inactive"; // ✅ ensures form submits "inactive"
            switchLabel.textContent = "Inactive";
            switchLabel.classList.remove("text-success");
            switchLabel.classList.add("text-danger");
            }
        });
    </script>
@endpush