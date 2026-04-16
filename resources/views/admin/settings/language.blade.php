@extends('layouts.app')
@section('title', 'Dashboard |Winngoocoin')
@section('content')
        <!--<div class="vertical-overlay"></div>-->

      
        <!--<div class="main-content">-->

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                                <h3 class="mb-sm-0">Language Settings</h3>
                                <!-- <div>
                                    <button type="button" class="btn btn-success btn-label waves-effect waves-light rounded-pill" id="sa-save"><i class="ri-save-3-line label-icon align-middle rounded-pill fs-16 me-2"></i> Save Settings</button>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Configure plateform language preference</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6">
                                            <div class="mb-3">
    <label for="language-default" class="form-label text-muted">Default Language</label>
    <select class="form-control" id="language-default" disabled>
        <option value="English" selected>English</option>
    </select>
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
        </div>
       

           @include('layouts.footer')
    
     


@endsection






 
