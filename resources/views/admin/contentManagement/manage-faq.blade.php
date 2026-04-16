@extends('layouts.app')
@section('title', 'Dashboard |Winngoocoin')
@section('content')  

<style>
     /*Force word wrap for FAQ content */
    .faq-ques, .faq-ans {
        white-space: normal !important;
        word-wrap: break-word;
        word-break: break-word; /* Specifically for long strings without spaces 
        overflow-wrap: break-word;
        max-width: 100%;
        display: block;
    }

     Ensure the table itself is constrained 
    #manageFaq {
        table-layout: fixed !important;
        width: 100% !important;
    }
</style>
            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                    
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                                    
                                
                                <h3 class="mb-sm-0">Manage FAQ</h3>
                                 @if(auth('admin')->check() && auth('admin')->user()->hasPermission('content_management', 'create'))
                                <div class="btn-div">
                                    <a href="{{ route('admin.create.faq') }}" type="button" class="btn btn-primary btn-label waves-effect waves-light rounded-pill"><i class="ri-add-line label-icon align-middle rounded-pill fs-16 me-2"></i> Add FAQ</a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-lg-12">
                               @include('layouts.success_toast')
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Manage all FAQs in one place.</h5>
                                </div>
                               
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="manageFaq" class="table table-bordered dt-responsive  table-striped align-middle w-100">
                                            <thead>
                                                <tr>
                                                    <th scope="col">S.No</th>
                                                    <th>Q & A</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                         
                                            <tbody>
@forelse($faqs as $key => $faq)
<tr>
    <td class="text-center">
{{ $loop->iteration }}
    </td>

    <td>
        <h5 class="faq-ques">{{ $faq->question }}</h5>
        <p class="faq-ans">{!! $faq->answer !!}</p>
    </td>

    {{-- <td class="text-center">
        <div class="form-check form-switch text-center status-switch">
            <input class="form-check-input" type="checkbox" 
                   id="status{{ $faq->id }}" 
                   {{ $faq->status == 'active' ? 'checked' : '' }}>
            <label class="form-check-label fw-bold" for="status{{ $faq->id }}">
                Active
            </label>
        </div>
    </td> --}}

    <td class="text-center">
    <div class="form-check form-switch text-center status-switch">
        <input class="form-check-input" type="checkbox" 
               id="status{{ $faq->id }}" 
               {{ $faq->status == 'active' ? 'checked' : '' }}>
        <label class="form-check-label fw-bold" for="status{{ $faq->id }}">
            Active
        </label>
    </div>

    {{-- ✅ Hidden text so DataTable search can find "active" / "inactive" --}}
    <span class="d-none status-text">{{ $faq->status }}</span>

</td>

    <td class="text-center">
        <div class="d-flex justify-content-center gap-2">
            
             @if(auth('admin')->check() && auth('admin')->user()->hasPermission('content_management', 'edit'))

            <!-- EDIT -->
            <a href="{{ route('admin.edit.faq', $faq->id) }}" 
               class="btn btn-sm btn-soft-secondary rounded-pill">
               <span class="bx bx-pencil"></span>
            </a>
            @endif
            
             @if(auth('admin')->check() && auth('admin')->user()->hasPermission('content_management', 'delete'))

            <!-- DELETE -->
            <button class="btn btn-sm btn-soft-danger rounded-pill"
                    data-id="{{ $faq->id }}"
                    data-bs-toggle="modal"
                    data-bs-target="#deleteRecordModal">
                <span class="bx bx-trash"></span>
            </button>
            @endif
        </div>
    </td>
</tr>

@empty
<tr>
    <td colspan="4" class="text-center text-muted py-4">
        No FAQs Found
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

                    <!-- Modal -->
                    <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mt-2 text-center">
                                        {{-- <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon> --}}
                                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                            <h4>Are you Sure ?</h4>
                                            <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Record ?</p>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                 <form id="deleteForm" method="POST">
    @csrf
    @method('DELETE')

    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">
        Close
    </button>

    <button type="submit" class="btn w-sm btn-danger">
        Yes, Delete It!
    </button>
</form>
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
$(document).ready(function () {

    // ✅ Initialize DataTable — NO responsive plugin (fixes collapsed + icon bug)
    var table = $('#manageFaq').DataTable({
    destroy: true,   
    responsive: false, // Keep this false if you want fixed layout
    autoWidth: false,  // Set to false so our CSS/ColumnDefs take control
    pageLength: 10,
    columnDefs: [
        { width: "5%",  targets: 0 },
        { width: "65%", targets: 1, className: "text-wrap" }, // Added text-wrap class
        { width: "15%", targets: 2, orderable: false },
        { width: "15%", targets: 3, orderable: false }
    ],

        language: {
            search: "Search FAQs:",
            searchPlaceholder: "Type to search...",
            lengthMenu: "Show _MENU_ FAQs per page",
            info: "Showing _START_ to _END_ of _TOTAL_ FAQs",
            infoEmpty: "No FAQs found",
            paginate: {
                previous: "<i class='ri-arrow-left-s-line'></i>",
                next:     "<i class='ri-arrow-right-s-line'></i>"
            }
        }
    });

    // ✅ Update switch labels (Active/Inactive text + color)
    // function updateSwitchLabels() {
    //     $(".status-switch .form-check-input").each(function () {
    //         const switchLabel = $(this).closest(".status-switch").find("label");
    //         if (this.checked) {
    //             this.value = "active";
    //             switchLabel.text("Active").removeClass("text-danger").addClass("text-success");
    //         } else {
    //             this.value = "inactive";
    //             switchLabel.text("Inactive").removeClass("text-success").addClass("text-danger");
    //         }
    //     });
    // }

function updateSwitchLabels() {
    $(".status-switch .form-check-input").each(function () {
        const switchLabel = $(this).closest(".status-switch").find("label");
        const hiddenSpan = $(this).closest("td").find(".status-text"); // ✅ sync hidden span

        if (this.checked) {
            this.value = "active";
            switchLabel.text("Active").removeClass("text-danger").addClass("text-success");
            hiddenSpan.text("active"); // ✅
        } else {
            this.value = "inactive";
            switchLabel.text("Inactive").removeClass("text-success").addClass("text-danger");
            hiddenSpan.text("inactive"); // ✅
        }
    });
}

    // Run on load
    updateSwitchLabels();

    // Run on every page change / search
    table.on("draw.dt", function () {
        updateSwitchLabels();
    });

    // ✅ Toggle switch label on change
$(document).on("change", ".status-switch .form-check-input", function () {
    let checkbox = $(this);
    let id = checkbox.attr("id").replace("status", "");
    let status = checkbox.is(":checked") ? "active" : "inactive";

    const switchLabel = checkbox.closest(".status-switch").find("label");
    const hiddenSpan = checkbox.closest("td").find(".status-text"); // ✅ sync hidden span

    if (status === "active") {
        switchLabel.text("Active").removeClass("text-danger").addClass("text-success");
        hiddenSpan.text("active"); // ✅
    } else {
        switchLabel.text("Inactive").removeClass("text-success").addClass("text-danger");
        hiddenSpan.text("inactive"); // ✅
    }

    // ✅ AJAX call
$.ajax({
    url: `/admin/faq/status/${id}`,
    type: "POST",
    data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        status: status
    },
    success: function(response) {
        console.log("Status updated", response);
    },
    error: function(xhr) {
        console.log(xhr.responseText);
        alert("Something went wrong!");
    }
});

});

    // ✅ Capture delete ID when modal opens
    var deleteId = null;
    $(document).on("click", "[data-bs-target='#deleteRecordModal']", function () {
        deleteId = $(this).data("id");
    });

    // // ✅ Delete confirmation
    // document.getElementById("delete-record").addEventListener("click", function () {
    //     console.log("Deleting FAQ ID:", deleteId); // replace with AJAX call

    //     var deleteModal = bootstrap.Modal.getInstance(document.getElementById("deleteRecordModal"));
    //     deleteModal.hide();

    //     var successAlert = document.getElementById("successAlert");
    //     successAlert.style.display = "block";
    //     setTimeout(() => successAlert.classList.add("show"), 10);
    //     setTimeout(() => {
    //         successAlert.classList.remove("show");
    //         setTimeout(() => { successAlert.style.display = "none"; }, 150);
    //     }, 3000);
    // });

});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    let deleteButtons = document.querySelectorAll('[data-bs-target="#deleteRecordModal"]');
    let deleteForm = document.getElementById('deleteForm');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            let id = this.getAttribute('data-id');

            // ✅ use route with placeholder
            let url = "{{ route('admin.delete.faq', ':id') }}";
            url = url.replace(':id', id);

            deleteForm.action = url;
        });
    });

});
</script>
@endpush