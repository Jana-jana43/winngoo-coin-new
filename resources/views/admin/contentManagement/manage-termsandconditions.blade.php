
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
                                <h3 class="mb-sm-0">Manage Terms & Conditions</h3>
                                @if(auth('admin')->check() && auth('admin')->user()->hasPermission('content_management', 'edit'))
                                <button type="button" class="btn btn-success btn-label waves-effect waves-light rounded-pill" id="sa-save"><i class="ri-save-3-line label-icon align-middle rounded-pill fs-16 me-2"></i> Save</button>
                                @endif
                            </div>
                                    @include('layouts.success_toast')
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Content Area</h5>
                                </div>
                               <form id="termsForm" method="POST" action="{{ route('admin.save.terms') }}">
    @csrf

    <div class="card-body">

        <!-- Hidden textarea -->
        <textarea id="content" name="content" class="d-none">{{ old('content', $terms->content ?? '') }}</textarea>

        <div id="summernoteContent1"></div>

        <!-- Validation Error -->
        @if ($errors->has('content'))
            <span class="text-danger">{{ $errors->first('content') }}</span>
        @endif

    </div>
</form>
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

    <!-- JAVASCRIPT -->
@endsection
@push('scripts')
 <script>
$(document).ready(function() {
    $('#summernoteContent1').summernote({
        placeholder: 'Type Your Content Here...',
        tabsize: 2,
        height: 300
    });

    // Load DB / old content
    let content = `{!! old('content', $terms->content ?? '') !!}`;
    $('#summernoteContent1').summernote('code', content);
});
</script>
 <script>
document.getElementById("sa-save").addEventListener("click", function () {

    let content = $('#summernoteContent1').summernote('code');

    // Validation
    if (content.trim() === '' || content === '<p><br></p>') {
        Swal.fire({
            title: "Error",
            text: "Terms & Conditions content is required!",
            icon: "error"
        });
        return;
    }

    // Set value
    document.getElementById("content").value = content;

    // Submit form
    document.getElementById("termsForm").submit();
});
</script>
@endpush