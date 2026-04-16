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
                                <h3 class="mb-sm-0">Manage About</h3>
                                {{-- <button type="button" class="btn btn-success btn-label waves-effect waves-light rounded-pill" id="sa-save"><i class="ri-save-3-line label-icon align-middle rounded-pill fs-16 me-2"></i> Save</button> --}}
                            
                            <button type="submit" form="aboutForm"
    class="btn btn-success btn-label waves-effect waves-light rounded-pill">
    <i class="ri-save-3-line label-icon align-middle rounded-pill fs-16 me-2"></i>
    Save
</button>
                            </div>
                            @include('layouts.success_toast')
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Content Area 1</h5>
                                </div>
  
                                {{-- <div class="card-body">
                                    <div id="summernoteContent1"></div>
                                </div> --}}

                                <form id="aboutForm" action="{{ url('admin/about/save') }}" method="POST">
    @csrf

    <div class="card-body">
        <div id="summernoteContent1"></div>
    </div>

    <input type="hidden" name="content" id="content">
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
         // ✅ Load existing content from DB
    $('#summernoteContent1').summernote('code', `{!! $about->content ?? '' !!}`);
        });
    </script>
<script>
document.getElementById("aboutForm").addEventListener("submit", function () {
    let content = $('#summernoteContent1').summernote('code');
    document.getElementById("content").value = content;
});
</script>
@endpush
