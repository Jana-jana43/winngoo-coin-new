@extends('layouts.app')
@section('title', 'Dashboard |Winngoocoin')
@section('content')

    <!-- Vertical Overlay-->

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h3 class="mb-sm-0">Edit FAQ</h3>
                        <div class="btn-div">
                            <button type="submit" form="faqForm"
                                class="btn btn-success btn-label waves-effect waves-light rounded-pill">
                                <i class="ri-save-3-line me-2"></i>
                                Update & Save
                            </button>
                            <a href="{{ route('admin.faq') }}" type="button"
                                class="btn btn-dark btn-label waves-effect waves-light rounded-pill"><i
                                    class="ri-arrow-go-back-line label-icon align-middle rounded-pill fs-16 me-2"></i>
                                Back</a>
                        </div>
                    </div>
                </div>
            </div>


            <form action="{{ route('admin.update.faq', $faq->id) }}" method="POST" id="faqForm">
                @csrf
                @method('PUT')

                <div class="row">

                    <!-- Question No -->
                    <div class="col-lg-2 col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Question No.</label>
                            <input type="text" class="form-control" value="{{ $faq->id }}" readonly>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <div class="form-check form-switch my-1">
                                <input class="form-check-input" type="checkbox" id="statusSwitch" name="status"
                                    value="active" {{ $faq->status == 'active' ? 'checked' : '' }}>

                                <label
                                    class="form-check-label fw-bold 
                        {{ $faq->status == 'active' ? 'text-success' : 'text-danger' }}"
                                    for="statusSwitch">
                                    {{ $faq->status == 'active' ? 'Active' : 'Inactive' }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Question -->
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label">
                                Type Question <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="question"
                                class="form-control @error('question') is-invalid @enderror"
                                value="{{ old('question', $faq->question) }}">

                            @error('question')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Answer -->
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label">
                                Type Answer <span class="text-danger">*</span>
                            </label>

                            <!-- Hidden textarea -->
                            <textarea name="answer" id="answerInput" hidden>{{ old('answer', $faq->answer) }}</textarea>

                            <!-- Summernote -->
                            <div id="summernoteContent1" class="@error('answer') border border-danger @enderror"></div>

                            @error('answer')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>

                <!-- Submit -->

            </form>
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    </div>
    </div>
    <!-- end main content-->


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
<!-- JAVASCRIPT -->
@push('scripts')
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
                height: 300
            });

            // Load existing value
            $('#summernoteContent1').summernote('code', $('#answerInput').val());

            // On submit, store value
            $('#faqForm').on('submit', function() {
                $('#answerInput').val($('#summernoteContent1').summernote('code'));
            });

        });
    </script>
    <script>
        const switchInput = document.getElementById("statusSwitch");
        const switchLabel = document.querySelector("label[for='statusSwitch']");

        switchInput.addEventListener("change", function() {
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
