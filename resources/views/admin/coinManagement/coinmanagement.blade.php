
@extends('layouts.app')
@section('title', 'Dashboard |Winngoocoin')
@section('content')





<style>
    .w-20 {
      width: 20% !important;
    }
    .w-30{
        width: 30% !important;
    }
    .coin_image{
        width: 40% !important;
    }

    /* Coin Flip Styles */
    .coin-flip-container {
        perspective: 600px;
        display: inline-block;
        position: relative;
        width:100%;
    }
    /* .coin-flip-inner {
        position: relative;
        width: 100%;
        transition: transform 0.6s ease;
        transform-style: preserve-3d;
    } */
        .coin-flip-inner {
    position: relative;
    width: 100%;
    transition: transform 0.6s ease;
    transform-style: preserve-3d;
    /* height: 100px; */
    margin: auto;
}
    .coin-flip-inner.flipped {
        transform: rotateY(180deg);
    }
    .coin-front img, .coin-back img {
    width: 50px !important;
    height: 50px !important;
    object-fit: contain;
}
    .coin-front,
    .coin-back {
        backface-visibility: hidden;
    }
    .coin-back {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        transform: rotateY(180deg);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .coin-back img {
        max-width: 100%;
        height: auto;
    }
    .coin-flip-btn {
        position: absolute;
        bottom: -5px;
        right: -5px;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: linear-gradient(135deg, #cf9b42, #fbbd18);
        border: 2px solid #fff;
        color: #fff;
        font-size: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 2;
        box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
        padding: 0;
        line-height: 1;
    }
    .coin-flip-btn:hover {
        transform: scale(1.15);
        box-shadow: 0 3px 10px rgba(0,0,0,0.3);
        background: linear-gradient(135deg, #fbbd18, #cf9b42);
    }
    .coin-flip-btn i {
        transition: transform 0.3s ease;
    }
    .coin-flip-btn.is-flipped i {
        transform: rotate(180deg);
    }

    /* Modal Coin Flip */
    .modal-coin-flip-container {
        perspective: 800px;
        display: inline-block;
        position: relative;
    }
    .modal-coin-flip-inner {
        position: relative;
        width: 100%;
        transition: transform 0.6s ease;
        transform-style: preserve-3d;
    }
    .modal-coin-flip-inner.flipped {
        transform: rotateY(180deg);
    }
    .modal-coin-front,
    .modal-coin-back {
        backface-visibility: hidden;
    }
    .modal-coin-back {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        transform: rotateY(180deg);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .modal-coin-back img {
        max-width: 100%;
        height: auto;
    }
    .modal-flip-btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        margin-top: 10px;
        padding: 4px 12px;
        border-radius: 20px;
        background: linear-gradient(135deg, #cf9b42, #fbbd18);
        border: none;
        color: #fff;
        font-size: 12px;
        cursor: pointer;
        box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
    }
    .modal-flip-btn:hover {
        transform: scale(1.05);
        box-shadow: 0 3px 10px rgba(0,0,0,0.3);
        background: linear-gradient(135deg, #fbbd18, #cf9b42);
    }
    .modal-flip-btn i {
        transition: transform 0.3s ease;
    }
    .modal-flip-btn.is-flipped i {
        transform: rotate(180deg);
    }
</style>

<div class="vertical-overlay"></div>
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h3 class="mb-sm-0">Coin Management</h3>
                    @if(auth('admin')->check() && auth('admin')->user()->hasPermission('coin_management', 'create'))
                    <div class="btn-div">
                        <button type="button" class="btn btn-primary btn-label waves-effect waves-light rounded-pill" data-bs-toggle="modal" data-bs-target="#showModalAdd"><i class="ri-add-line label-icon align-middle rounded-pill fs-16 me-2"></i>Create Coin</button>
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
                        <h5 class="card-title mb-0">Manage coins and its mining period</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="manageRole" class="table table-bordered dt-responsive nowrap table-striped align-middle w-100">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th>Coin Name</th>

                                        <th>Coin Image</th>
                                        <th>Mining Period</th>
                                        <th>Total Users</th>
                                        <th>Coin Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($coins as $coin)
                                    <tr>
                                        <td scope="row" class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center"><span class="badge badge-gradient-primary">{{ $coin->name ?? '' }}</span></td>

                                        <td class="text-center td_coin_image_div w-20">
                                            <div class="coin-flip-container">
                                                <div class="coin-flip-inner" id="coinFlip{{ $coin->id }}">
                                                    <div class="coin-front">
                                                        <img class="img-fluid td_coin_image w-30" src="{{ asset($coin->image ?? 'assets/images/coin.png') }}" alt="{{ $coin->name ?? 'Coin' }} Front" />
                                                    </div>
                                                    <div class="coin-back">
                                                        <img class="img-fluid td_coin_image w-30" src="{{ asset($coin->image2 ?? 'assets/images/coin.png') }}" alt="{{ $coin->name ?? 'Coin' }} Back" />
                                                    </div>
                                                </div>
                                                <button type="button" class="coin-flip-btn" id="coinFlipBtn{{ $coin->id }}" onclick="flipCoin({{ $coin->id }})" title="Flip Coin">
                                                    <i class="bx bx-revision"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td class="text-center">{{ $coin->mining_period ?? '' }} Months</td>
                                        <td class="text-center">{{ $coin->mining_count ?? 0 }}</td>
                                        <td class="text-center">
                                            <form method="POST" action="{{ route('coin.toggleStatus') }}">
                                                @csrf

                                                <input type="hidden" name="id" value="{{ $coin->id }}">

                                                <div class="form-check form-switch text-center status-switch">
                                                    <input class="form-check-input"
                                                        type="checkbox"
                                                        name="status"
                                                        value="active"
                                                        onchange="this.form.submit()"
                                                        {{ $coin->status === 'active' ? 'checked' : '' }}>

                                                    <label class="form-check-label fw-bold">
                                                        {{ $coin->status === 'active' ? 'Active' : 'Inactive' }}
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
                                                        data-bs-target="#viewModal{{ $coin->id }}">
                                                        <span class="bx bx-show-alt"></span>
                                                    </button>
                                                </div>
                                                @if(auth('admin')->check() && auth('admin')->user()->hasPermission('coin_management', 'edit'))
                                                <div class="edit">
                                                    <button class="btn btn-sm btn-soft-secondary rounded-pill edit-item-btn"
                                                        title="edit"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $coin->id }}">
                                                        <span class="bx bx-pencil"></span>
                                                    </button>
                                                </div>
                                                @endif
                                                
                                                @if(auth('admin')->check() && auth('admin')->user()->hasPermission('coin_management', 'delete'))
                                                <div class="remove">
                                                    <button
                                                        class="btn btn-sm btn-soft-danger rounded-pill"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteRecordModal{{ $coin->id }}">
                                                        <span class="bx bx-trash"></span>
                                                    </button>


                                                </div>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Dynamic Edit Modal -->
                                    <div class="modal fade" id="editModal{{ $coin->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $coin->id }}" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-light p-3">
                                                    <h5 class="modal-title" id="editModalLabel{{ $coin->id }}">Edit Coin</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <form class="tablelist-form" action="{{ route('coin.update', $coin->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                                                    @csrf

                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <!-- Coin Name -->
                                                            <div class="col-lg-6 mb-3">
                                                                <label for="editCoinName{{ $coin->id }}" class="form-label">Coin Name <span class="text-danger">*</span></label>
                                                                <input type="text" id="editCoinName{{ $coin->id }}" name="coin_name" class="form-control" maxlength="50" oninput="this.value = this.value.replace(/[^a-zA-Z]/g, '');" value="{{ $coin->name }}">
                                                                @error('coin_name')
                                                                <small class="error-msg text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>

                                                            <!-- Mining Period -->
                                                            <div class="col-lg-6 mb-3">
                                                                <label for="editMiningPeriod{{ $coin->id }}" class="form-label">Mining Period(Months) <span class="text-danger">*</span></label>
                                                                <input type="number" min="1" oninput="this.value = this.value.replace(/\D/g, ''); if(this.value > 1000) this.value = 1000;" max="1000" id="editMiningPeriod{{ $coin->id }}" name="mining_period" class="form-control" value="{{ $coin->mining_period }}">
                                                                @error('mining_period')
                                                                <small class="error-msg text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <!-- Description -->
                                                            <div class="col-lg-12 mb-3">
                                                                <label for="editDescription{{ $coin->id }}" class="form-label">Coin Description <span class="text-danger">*</span></label>
                                                                <textarea id="editDescription{{ $coin->id }}" name="description" class="form-control" rows="3">{{ $coin->description }}</textarea>
                                                                @error('description')
                                                                <small class="error-msg text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>

                                                            <!-- Coin Image -->
                                                           <div class="row">

                                                                <!-- Image 1 -->
                                                                <div class="col-lg-6 mb-3">
                                                                    <label class="form-label">Coin Front Image</label>
                                                                    <input type="file" accept=".jpg,.jpeg,.png"
                                                                        id="editCoinPhoto{{ $coin->id }}"
                                                                        name="image"
                                                                        class="form-control">

                                                                    @error('image')
                                                                    <small class="error-msg text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>

                                                                <!-- Image 2 -->
                                                                <div class="col-lg-6 mb-3">
                                                                    <label class="form-label">Coin Back Image</label>
                                                                    <input type="file" accept=".jpg,.jpeg,.png"
                                                                        id="editCoinPhoto2{{ $coin->id }}"
                                                                        name="image2"
                                                                        class="form-control">

                                                                    @error('image2')
                                                                    <small class="error-msg text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>

                                                                <!-- Flip Preview -->
                                                                <div class="col-lg-12 text-center mt-3">
                                                                    <label class="form-label d-block">Coin Preview</label>

                                                                    <div class="modal-coin-flip-container">
                                                                        <div class="modal-coin-flip-inner" id="editCoinFlip{{ $coin->id }}">
                                                                            
                                                                            <!-- Front -->
                                                                            <div class="modal-coin-front">
                                                                                <img id="editFrontImg{{ $coin->id }}"
                                                                                    src="{{ $coin->image ? asset($coin->image) : '' }}"
                                                                                    class="img-fluid" width="100">
                                                                            </div>

                                                                            <!-- Back -->
                                                                            <div class="modal-coin-back">
                                                                                <img id="editBackImg{{ $coin->id }}"
                                                                                    src="{{ $coin->image2 ? asset($coin->image2) : '' }}"
                                                                                    class="img-fluid" width="100">
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <br>

                                                                    <button type="button"
                                                                            class="modal-flip-btn"
                                                                            onclick="flipModalCoin('editCoinFlip{{ $coin->id }}', this)">
                                                                        <i class="bx bx-revision"></i> Flip
                                                                    </button>
                                                                </div>

                                                            </div>





                                                            <!-- Status -->
                                                            <div class="col-lg-12 mb-3">
                                                                <div class="mb-3 form-check form-switch">
                                                                    <!-- Hidden field defaults to 'inactive' -->
                                                                    <input type="hidden" name="status" value="inactive">

                                                                    <!-- Checkbox overrides to 'active' if checked -->
                                                                    <input type="checkbox" name="status" id="status{{ $coin->id }}" class="form-check-input" value="active" {{ $coin->status == 'active' ? 'checked' : '' }}>

                                                                    <label class="form-check-label" for="status{{ $coin->id }}">
                                                                        {{ $coin->status == 'active' ? 'Active' : 'Inactive' }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                            <!--<button type="submit" class="btn btn-success">Update & Save</button>-->
                                                            <button type="submit" class="btn btn-success edit-submit-btn">
    <span class="btn-text">Update & Save</span>
    <span class="spinner-border spinner-border-sm d-none ms-2" role="status"></span>
</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Dynamic View Modal -->
                                    <div id="viewModal{{ $coin->id }}" class="modal fade" tabindex="-1" aria-labelledby="viewModalLabel{{ $coin->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-light p-3">
                                                    <h5 class="modal-title" id="viewModalLabel{{ $coin->id }}">View Coin</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="row">
                                                        
                                                        <!-- Coin Image with Flip -->
                                                        <div class="col-lg-6 mb-3">
                                                            <h5 class="fs-15">Coin Image</h5>
                                                            <div class="coin_image_div">
                                                                <div class="modal-coin-flip-container">
                                                                    <div class="modal-coin-flip-inner" id="viewModalCoinFlip{{ $coin->id }}">
                                                                        <div class="modal-coin-front">
                                                                            <img class="img-fluid coin_image"
                                                                                src="{{ asset($coin->image ?? 'assets/images/coin.png') }}"
                                                                                alt="{{ $coin->name }} Front">
                                                                        </div>
                                                                        <div class="modal-coin-back">
                                                                            <img class="img-fluid coin_image"
                                                                                src="{{ asset($coin->image2 ?? 'assets/images/coin.png') }}"
                                                                                alt="{{ $coin->name }} Back">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <button type="button" class="modal-flip-btn" id="viewModalFlipBtn{{ $coin->id }}" onclick="flipModalCoin('viewModalCoinFlip{{ $coin->id }}', 'viewModalFlipBtn{{ $coin->id }}')" title="Flip Coin">
                                                                    <i class="bx bx-revision"></i> Flip
                                                                </button>
                                                            </div>
                                                        </div>
                                                        
                                                        

                                                        <!-- Coin Type -->




                                                        <!-- Mining Period -->
                                                        <div class="col-lg-6 mb-3">
                                                            <h5 class="fs-15">Mining Period</h5>
                                                            <p class="text-success">{{ $coin->mining_period }} Months</p>

                                                            <h5 class="fs-15">Description</h5>
                                                            <p class="text-muted">{{ $coin->description }}</p>
                                                        </div>

                                                        
                                                        <!-- Coin Name -->
                                                        <div class="col-lg-6 mb-3">
                                                            <h5 class="fs-15">Coin Name</h5>
                                                            <p><span class="badge badge-gradient-primary">{{ $coin->name }}</span></p>
                                                        </div>
                                                        

                                                        <!-- Status -->
                                                        <div class="col-lg-12 mb-3">
                                                            <h5 class="fs-15">Status</h5>
                                                            @if($coin->status == 'active')
                                                            <p><span class="badge bg-success">Active</span></p>
                                                            @else
                                                            <p><span class="badge bg-danger">Inactive</span></p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>

                                                </div>

                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div>

                                    <!-- ✅ delete Modal (inside loop with unique ID) -->
                                    <div class="modal fade zoomIn" id="deleteRecordModal{{ $coin->id }}" tabindex="-1" aria-hidden="true">
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
                                                    <form method="POST" action="{{ route('coin.delete', $coin->id) }}">
                                                        @csrf
                                                        @method('DELETE')

                                                        <!--<div class="d-flex gap-2 justify-content-center mt-4 mb-2">-->
                                                        <!--    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>-->
                                                        <!--    <button type="submit" class="btn w-sm btn-danger">Yes, Delete It!</button>-->
                                                        <!--</div>-->
                                                        
                                                        
                                                        <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                            <button type="button" class="btn w-sm btn-light"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit"
                                                                class="btn w-sm btn-danger delete-confirm-btn">Yes,
                                                                Delete It!</button>
                                                        </div>
                                                        
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No Coins Found</td>
                                    </tr>
                                    @endforelse

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- create coin model -->
        <div class="modal fade" id="showModalAdd" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-light p-3">
                        <h5 class="modal-title">Create Coin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form class="tablelist-form" action="{{ route('coin.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf

                        <div class="modal-body">
                            <div class="row">

                                <!-- Coin Name -->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Coin Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="addCoinName" maxlength="50" oninput="this.value = this.value.replace(/[^a-zA-Z]/g, '');" class="form-control">
                                        @error('name')
                                        <small class="error-msg text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Coin Type -->
                                <!-- <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Coin Type <span class="text-danger">*</span></label>
                                        <input type="text" name="type" id="addCoinType" maxlength="50" oninput="this.value = this.value.replace(/[^a-zA-Z]/g, '');" class="form-control">
                                    </div>
                                </div> -->

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Mining Period(Months) <span class="text-danger">*</span></label>
                                        <input type="number"
                                            name="mining_period"
                                            min="1"
                                            max="1000"
                                            id="addMiningPeriod"
                                            class="form-control"
                                            oninput="this.value = this.value.replace(/\D/g, ''); if(this.value > 1000) this.value = 1000;">

                                    </div>
                                </div>

                                <!-- Coin Image 1 (Front) -->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Coin Image 1 (Front) <span class="text-danger">*</span></label>
                                        <input type="file" accept=".jpg,.jpeg,.png" name="image" id="addcoinphoto" class="form-control">
                                        <div id="addCoinImage1Preview" class="mt-2"></div>
                                    </div>
                                </div>

                                <!-- Coin Image 2 (Back) -->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Coin Image 2 (Back) <span class="text-danger">*</span></label>
                                        <input type="file" accept=".jpg,.jpeg,.png" name="image2" id="addcoinphoto2" class="form-control">
                                        <div id="addCoinImage2Preview" class="mt-2"></div>
                                    </div>
                                </div>

                                <!-- Coin Preview with Flip -->
                                <div class="col-lg-12" id="addCoinFlipPreviewWrapper" style="display:none;">
                                    <div class="mb-3 text-center">
                                        <label class="form-label d-block">Coin Preview</label>
                                        <div class="modal-coin-flip-container">
                                            <div class="modal-coin-flip-inner" id="addCoinFlipPreview">
                                                <div class="modal-coin-front">
                                                    <img id="addCoinFlipFrontImg" src="" alt="Front" class="img-fluid" width="100">
                                                </div>
                                                <div class="modal-coin-back">
                                                    <img id="addCoinFlipBackImg" src="" alt="Back" class="img-fluid" width="100">
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <button type="button" class="modal-flip-btn" id="addCoinFlipPreviewBtn" onclick="flipModalCoin('addCoinFlipPreview', 'addCoinFlipPreviewBtn')" title="Flip Coin">
                                            <i class="bx bx-revision"></i> Flip
                                        </button>
                                    </div>
                                </div>

                                <!-- Mining Period -->


                                <!-- Description -->
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Description <span class="text-danger">*</span></label>
                                        <textarea name="description" id="addDescription" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="status" id="coin_status" value="active" checked>
                                            <label class="form-check-label fw-bold" id="statusText">Active</label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                           <button type="button" class="btn btn-success" id="add-btn">

                                <span class="btn-text">Create Coin</span>
                                <span class="spinner-border spinner-border-sm d-none ms-2" role="status"></span>

                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>




    </div>

    @include('layouts.footer')
    @endsection
    
    <!-- create validation for add coin form -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            function clearError(input) {
                let next = input.nextElementSibling;
                if (next && next.classList.contains("error-msg")) {
                    next.remove();
                }
            }

            let addBtn = document.getElementById("add-btn");
         let form = document.querySelector("#showModalAdd .tablelist-form");

            // Get current inputs (no Coin Type)
            let name = document.getElementById("addCoinName");
            let image = document.getElementById("addcoinphoto");
            let image2 = document.getElementById("addcoinphoto2");
            let mining = document.getElementById("addMiningPeriod");
            let desc = document.getElementById("addDescription");
            
            
            let btnText = addBtn.querySelector(".btn-text");
            let spinner = addBtn.querySelector(".spinner-border");

            function setLoading(state) {
                if (state) {
                    addBtn.disabled = true;
                    btnText.innerText = "Processing...";
                    spinner.classList.remove("d-none");
                } else {
                    addBtn.disabled = false;
                    btnText.innerText = "Create Coin";
                    spinner.classList.add("d-none");
                }
            }

            // Live remove error on typing/selecting
            [name, mining, desc].forEach(field => {
                field.addEventListener("input", function() {
                    clearError(this);
                });
            });

            image.addEventListener("change", function() {
                clearError(this);
            });

            image2.addEventListener("change", function() {
                clearError(this);
            });

            // Submit button validation
            addBtn.addEventListener("click", function(e) {
                e.preventDefault();
                let isValid = true;

                // Remove previous error messages
                document.querySelectorAll(".error-msg").forEach(el => el.remove());

                // Show error function
                function showError(input, message) {
                    clearError(input); // remove old
                    let error = document.createElement("small");
                    error.className = "text-danger error-msg d-block mt-1";
                    error.innerText = message;
                    input.insertAdjacentElement("afterend", error);
                    isValid = false;
                }

                // Name validation
                if (name.value.trim() === "") {
                    showError(name, "Coin name is required");
                }

                // Image 1 validation
                if (image.files.length === 0) {
                    showError(image, "Coin image 1 (front) is required");
                } else {
                    let file = image.files[0];
                    let maxSize = 5 * 1024 * 1024; // 5MB
                    let allowedTypes = ["image/jpeg", "image/png", "image/jpg"];

                    if (file.size > maxSize) {
                        showError(image, "Image must be less than 5MB");
                    } else if (!allowedTypes.includes(file.type)) {
                        showError(image, "Only JPG, JPEG, PNG allowed");
                    }
                }

                // Image 2 validation
                if (image2.files.length === 0) {
                    showError(image2, "Coin image 2 (back) is required");
                } else {
                    let file2 = image2.files[0];
                    let maxSize = 5 * 1024 * 1024;
                    let allowedTypes = ["image/jpeg", "image/png", "image/jpg"];

                    if (file2.size > maxSize) {
                        showError(image2, "Image must be less than 5MB");
                    } else if (!allowedTypes.includes(file2.type)) {
                        showError(image2, "Only JPG, JPEG, PNG allowed");
                    }
                }

                // Mining period validation
                if (mining.value.trim() === "") {
                    showError(mining, "Mining period is required");
                } else {
                    let val = parseInt(mining.value);
                    if (val < 1 || val > 1000) {
                        showError(mining, "Mining period must be between 1 and 1000");
                    }
                }

                // Description validation
                if (desc.value.trim() === "") {
                    showError(desc, "Description is required");
                }

                // Submit form if all valid
                if (isValid) {
                     setLoading(true); // ✅ show spinner + disable
                    form.submit();
                }
            });

        });
    </script>



    <script>
document.addEventListener('DOMContentLoaded', function() {
    @if($errors->any())
        // Check if the modal session key contains 'editModal'
        @if(session('modal') && str_starts_with(session('modal'), 'editModal'))
            var modalId = "{{ session('modal') }}"; // e.g., 'editModal5'
            var editModal = new bootstrap.Modal(document.getElementById(modalId));
            editModal.show();
        @endif

        // Check if the modal session key is 'showModalAdd'
        @if(session('modal') === 'showModalAdd')
            var addModal = new bootstrap.Modal(document.getElementById('showModalAdd'));
            addModal.show();
        @endif
    @endif
});
</script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
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
    <!--edit model-->
    <script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('[id^="editModal"]').forEach(function(modal) {
        modal.addEventListener('show.bs.modal', function() {
            const form = this.querySelector('form');
            const submitBtn = this.querySelector('.edit-submit-btn');
            const btnText = submitBtn.querySelector('.btn-text');
            const spinner = submitBtn.querySelector('.spinner-border');

            form.addEventListener('submit', function() {
                submitBtn.disabled = true;
                btnText.innerText = 'Processing...';
                spinner.classList.remove('d-none');
            });
        });
    });
});
</script>
<!--delete-->
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('[id^="deleteRecordModal"]').forEach(function (modal) {
                modal.addEventListener('show.bs.modal', function () {
                    const form = this.querySelector('form');
                    const submitBtn = this.querySelector('.delete-confirm-btn');

                    form.addEventListener('submit', function (e) {
                        e.preventDefault();

                        submitBtn.disabled = true;
                        submitBtn.innerHTML = 'Deleting... <span class="spinner-border spinner-border-sm ms-1" role="status"></span>';

                        setTimeout(function () {
                            form.submit();
                        }, 1000);
                    });
                });
            });
        });
    </script>

    <!-- Coin Flip Scripts -->
    <script>
        // Table column flip
        function flipCoin(coinId) {
            const flipInner = document.getElementById('coinFlip' + coinId);
            const flipBtn = document.getElementById('coinFlipBtn' + coinId);
            flipInner.classList.toggle('flipped');
            flipBtn.classList.toggle('is-flipped');
        }

        // Modal flip (view, edit, create preview)
        function flipModalCoin(innerId, btnId) {
            const flipInner = document.getElementById(innerId);
            const flipBtn = document.getElementById(btnId);
            flipInner.classList.toggle('flipped');
            flipBtn.classList.toggle('is-flipped');
        }

        // Create modal: image preview & flip preview
        document.addEventListener('DOMContentLoaded', function() {
            const image1Input = document.getElementById('addcoinphoto');
            const image2Input = document.getElementById('addcoinphoto2');
            const preview1 = document.getElementById('addCoinImage1Preview');
            const preview2 = document.getElementById('addCoinImage2Preview');
            const flipPreviewWrapper = document.getElementById('addCoinFlipPreviewWrapper');
            const flipFrontImg = document.getElementById('addCoinFlipFrontImg');
            const flipBackImg = document.getElementById('addCoinFlipBackImg');

            let img1Url = null;
            let img2Url = null;

            function updateFlipPreview() {
                if (img1Url && img2Url) {
                    flipFrontImg.src = img1Url;
                    flipBackImg.src = img2Url;
                    flipPreviewWrapper.style.display = 'block';
                    // Reset flip state
                    document.getElementById('addCoinFlipPreview').classList.remove('flipped');
                    document.getElementById('addCoinFlipPreviewBtn').classList.remove('is-flipped');
                } else {
                    flipPreviewWrapper.style.display = 'none';
                }
            }

            image1Input.addEventListener('change', function() {
                preview1.innerHTML = '';
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        img1Url = e.target.result;
                        preview1.innerHTML = '<img src="' + img1Url + '" class="img-fluid" width="80" style="border-radius:8px;">';
                        updateFlipPreview();
                    };
                    reader.readAsDataURL(this.files[0]);
                } else {
                    img1Url = null;
                    updateFlipPreview();
                }
            });

            image2Input.addEventListener('change', function() {
                preview2.innerHTML = '';
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        img2Url = e.target.result;
                        preview2.innerHTML = '<img src="' + img2Url + '" class="img-fluid" width="80" style="border-radius:8px;">';
                        updateFlipPreview();
                    };
                    reader.readAsDataURL(this.files[0]);
                } else {
                    img2Url = null;
                    updateFlipPreview();
                }
            });
        });
    </script>
    <script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('[id^="editCoinPhoto"]').forEach(function (input1) {

        const coinId = input1.id.replace('editCoinPhoto', '');
        const input2 = document.getElementById('editCoinPhoto2' + coinId);

        const frontImg = document.getElementById('editFrontImg' + coinId);
        const backImg = document.getElementById('editBackImg' + coinId);
        const flipBox = document.getElementById('editCoinFlip' + coinId);

        let img1Url = frontImg?.src || null;
        let img2Url = backImg?.src || null;

        function updateFlip() {
            if (img1Url) frontImg.src = img1Url;
            if (img2Url) backImg.src = img2Url;

            // reset flip state
            flipBox.classList.remove('flipped');
        }

        // FRONT IMAGE CHANGE
        input1.addEventListener('change', function () {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    img1Url = e.target.result;
                    updateFlip();
                };
                reader.readAsDataURL(this.files[0]);
            }
        });

        // BACK IMAGE CHANGE
        if (input2) {
            input2.addEventListener('change', function () {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        img2Url = e.target.result;
                        updateFlip();
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });
        }

    });

});
</script>

