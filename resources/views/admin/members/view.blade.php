@extends('layouts.app')
@section('title', 'Dashboard |Winngoocoin')
@section('content')
    <style>
        #showModalAdd .is-invalid {
            border-color: #ced4da !important;
            background-image: none !important;
            box-shadow: none !important;
        }
    </style>
    <style>
        /* ── Coin Growth Modal ── */
        #coinGrowthModal .modal-dialog {
            max-width: 800px;
            width: 97vw;
        }
        .user_avatar_div img {
            max-width: 130px;
        }

/* Base Badge Style */
.cg-coin-badge {
    padding: 2px 12px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 12px;
    display: inline-block;
    text-transform: capitalize;
    background-color: #eff2f7; /* Default light grey */
    color: #3e4b5b;
    border: 1px solid #e2e5e8;
}

/* Specific Colors for your known types */
.cg-coin-badge.gold      { background-color: #fff3cd; color: #856404; border-color: #ffeeba; }
.cg-coin-badge.silver    { background-color: #e2e3e5; color: #383d41; border-color: #d6d8db; }
.cg-coin-badge.bronze    { background-color: #f8d7da; color: #721c24; border-color: #f5c6cb; }
.cg-coin-badge.testing   { background-color: #d1ecf1; color: #0c5460; border-color: #bee5eb; }
.cg-coin-badge.developer { background-color: #e2d9f3; color: #512da8; border-color: #d1c4e9; }
        #coinGrowthModal .modal-content {
            border-radius: 12px;
            overflow: hidden;
        }

        #coinGrowthModal .modal-body {
            padding: 20px 28px 14px;
        }

        .cg-top-row {
            margin-bottom: 0;
        }

        .cg-section-heading {
            font-size: .9rem;
            font-weight: 700;
            color: #212529;
            margin-bottom: 12px;
            padding-bottom: 6px;
            border-bottom: 2px solid #f0edf9;
        }

        .cg-left-panel {
            padding-right: 24px;
        }

        .cg-fields-row {
            grid-template-columns: repeat(3, 1fr);
            gap: 0 20px;
        }

        .cg-field-label {
            font-size: .78rem;
            font-weight: 700;
            color: #495057;
            margin-bottom: 3px;
        }

        .cg-field-val {
            font-size: .84rem;
            color: #6c757d;
            margin: 0;
        }

        .cg-right-panel {
            padding-left: 28px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .cg-coin-block {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 2px;
        }

        .cg-coin-img {
            width: 52px;
            height: 52px;
            object-fit: contain;
            margin-bottom: 2px;
        }

        .cg-coin-badge {
            display: inline-block;
            padding: 3px 14px;
            border-radius: 4px;
            font-size: .78rem;
            font-weight: 600;
        }

        .cg-coin-badge.gold,
        .cg-coin-badge.silver,
        .cg-coin-badge.bronze {
            background: linear-gradient(135deg, #f6c344, #e68a00);
            color: #fff;
        }

        .cg-coin-strip {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f3f0fb;
            border-radius: 8px;
            border: 1px solid #e6e0f5;
            padding: 9px 18px;
            margin-bottom: 12px;
        }

        .cg-coin-strip img {
            width: 34px;
            height: 34px;
            object-fit: contain;
        }

        .cg-strip-title {
            font-size: .84rem;
            font-weight: 700;
            color: #6035a1;
        }

        .cg-strip-sub {
            font-size: .73rem;
            color: #9c83c8;
            margin-top: 1px;
        }

        .cg-prog-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
        }

        .cg-prog-label {
            font-size: .78rem;
            font-weight: 600;
            color: #495057;
        }

        .cg-prog-pct {
            font-size: .78rem;
            font-weight: 700;
            color: #f06548;
        }

        .cg-progress {
            height: 10px;
            border-radius: 10px;
            background: #ede8f9;
            overflow: hidden;
            margin-bottom: 14px;
        }

        .cg-progress-fill {
            height: 100%;
            border-radius: 10px;
            background: linear-gradient(90deg, #6f42c1, #a07fd4);
            transition: width .4s ease;
        }

        .cg-act-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .cg-act-header h5 {
            font-size: .95rem;
            font-weight: 700;
            color: #212529;
            margin: 0;
        }

        .cg-legend {
            display: flex;
            gap: 16px;
        }

        .cg-legend span {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: .75rem;
            color: #6c757d;
        }

        .dot-active {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: #5cb85c;
            display: inline-block;
        }

        .dot-inactive {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: #d9534f;
            display: inline-block;
        }

        .cg-year-tag {
            width: 100%;
            font-size: .72rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .6px;
            color: #6f42c1;
            padding: 6px 0 4px;
        }

        .cg-months-wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }

        .cg-month-chip {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 72px;
            padding: 7px 4px 5px;
            border-radius: 8px;
            border: 1px solid #e2ddf0;
            background: #fafafa;
            font-size: .68rem;
            cursor: default;
        }

        .cg-month-chip.is-active {
            background: #f0faf3;
            border-color: #b7dfbf;
        }

        .cg-month-chip.is-inactive {
            background: #fff8f8;
            border-color: #f5c6c6;
        }

        .cg-month-chip .chip-icon {
            font-size: .85rem;
            line-height: 1;
        }

        .cg-month-chip .chip-label {
            font-weight: 600;
            color: #444;
            margin-top: 3px;
            white-space: nowrap;
        }

        .cg-hr {
            border: none;
            border-top: 1px solid #f0edf9;
            margin: 12px 0;
        }

        .btn-growth {
            font-size: .72rem;
            padding: 3px 10px;
            border-radius: 20px;
        }

        /* ── Upgrade Modal ── */
        #upgradeModal .modal-content {
            border-radius: 8px;
            overflow: hidden;
        }

        .up-avatar-wrap {
            text-align: center;
            margin-bottom: 20px;
        }

        .up-avatar-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #e9ecef;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            color: #adb5bd;
            border: 3px solid #f8f9fa;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .1);
            overflow: hidden;
        }

        .up-avatar-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .up-badge-coin {
            display: inline-block;
            font-size: 12px;
            font-weight: 600;
            padding: 3px 12px;
            border-radius: 4px;
        }

        .up-badge-coin.Gold {
            background: #fef9c3;
            color: #854d0e;
            border: 1px solid #fde68a;
        }

        .up-badge-coin.Silver {
            background: #f1f5f9;
            color: #334155;
            border: 1px solid #cbd5e1;
        }

        .up-badge-coin.Bronze {
            background: #fef3c7;
            color: #78350f;
            border: 1px solid #fcd34d;
        }

        .up-badge-coin.empty {
            background: #f8f9fa;
            color: #adb5bd;
            border: 1px solid #dee2e6;
        }

        .up-plans {
            display: grid;
            gap: 10px;
            margin-bottom: 16px;
        }

        .up-plans.cols-2 {
            grid-template-columns: 1fr 1fr;
        }

        .up-plans.cols-1 {
            grid-template-columns: 1fr;
        }

        .up-plan-card {
            border: 1.5px solid #dee2e6;
            border-radius: 8px;
            padding: 13px 15px;
            cursor: pointer;
            transition: all .18s;
            background: #fff;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .up-plan-card:hover {
            border-color: #c4b5e8;
            background: #fbf9ff;
        }

        .up-plan-card.selected {
            border-color: #6f42c1;
            background: #f5f0ff;
            box-shadow: 0 0 0 3px rgba(111, 66, 193, .1);
        }

        .up-plan-radio {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            border: 2px solid #ced4da;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .15s;
        }

        .up-plan-card.selected .up-plan-radio {
            background: #6f42c1;
            border-color: #6f42c1;
        }

        .up-plan-card.selected .up-plan-radio::after {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #fff;
            display: block;
        }

        .up-plan-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            flex-shrink: 0;
        }

        .up-plan-card.Gold .up-plan-icon {
            background: #fef9c3;
        }

        .up-plan-card.Silver .up-plan-icon {
            background: #f1f5f9;
        }

        .up-plan-name {
            font-size: 13px;
            font-weight: 600;
            color: #212529;
            margin-bottom: 2px;
        }

        .up-plan-sub {
            font-size: 11px;
            color: #adb5bd;
        }

        .up-flow-bar {
            display: flex;
            align-items: stretch;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            overflow: hidden;
            background: #f8f9fa;
        }

        .up-flow-cell {
            flex: 1;
            padding: 10px 14px;
            text-align: center;
        }

        .up-flow-cell+.up-flow-cell {
            border-left: 1px solid #dee2e6;
        }

        .up-flow-cell-lbl {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: #adb5bd;
            margin-bottom: 3px;
        }

        .up-flow-cell-val {
            font-size: 13px;
            font-weight: 600;
            color: #495057;
        }

        .up-flow-arrow {
            padding: 0 10px;
            display: flex;
            align-items: center;
            color: #ced4da;
            font-size: 13px;
            flex-shrink: 0;
        }

        .up-flow-cell.to .up-flow-cell-val {
            color: #6f42c1;
        }

        .up-flow-cell.to .up-flow-cell-val.empty {
            color: #dee2e6;
            font-weight: 400;
            font-size: 11px;
        }

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

        /* ── User ID badge ── */
        .wid-badge {
            font-size: 11px;
            font-weight: 600;
            color: #6f42c1;
            background: #f3f0fb;
            border: 1px solid #d8d0f0;
            border-radius: 6px;
            padding: 3px 10px;
            display: inline-block;
        }
    </style>
    <div class="page-content">
        <div class="container-fluid">

            {{-- <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                            <h3 class="mb-sm-0">User Management</h3>
                            <div class="btn-div">
                                <button type="button" class="btn btn-primary btn-label waves-effect waves-light rounded-pill" data-bs-toggle="modal" data-bs-target="#showModalAdd">
                                    <i class="ri-add-line label-icon align-middle rounded-pill fs-16 me-2"></i> Add User
                                </button>
                            </div>

                        </div>
                        
                            @include('layouts.success_toast')
                    </div>
                </div> --}}

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box bg-galaxy-transparent">

                        {{-- Title + Button on same row --}}
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-sm-0">User Management</h3>
                             @if(auth('admin')->check() && auth('admin')->user()->hasPermission('user_management', 'create'))
                            <div class="btn-div">
                                <button type="button" class="btn btn-primary btn-label waves-effect waves-light rounded-pill"
                                    data-bs-toggle="modal" data-bs-target="#showModalAdd">
                                    <i class="ri-add-line label-icon align-middle rounded-pill fs-16 me-2"></i>
                                    Add User
                                </button>
                            </div>
                            @endif
                        </div>

                        {{-- ✅ Toast here — full width below title --}}


                        {{-- @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif --}}
                        @include('layouts.success_toast')


@if(session('error'))
    <div class="alert alert-danger" id="errorAlert">
        {{ session('error') }}
    </div>

    <script>
        setTimeout(function () {
            let alert = document.getElementById('errorAlert');
            if (alert) {
                alert.style.display = 'none';
            }
        }, 2000); // ✅ 2 seconds
    </script>
@endif    

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Manage Your Users and their coin plans.</h5>
                        </div>
                        <div class="card-header d-none">
                            <div class="row g-2">
                                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                                    <h6 class="fw-semibold">Country</h6>
                                    <select class="country-select" name="country">
                                        <option></option>
                                        <option value="UK">UK</option>
                                        <option value="USA">USA</option>
                                        <option value="India">India</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="Singapore">Singapore</option>
                                    </select>
                                </div>
                                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                                    <h6 class="fw-semibold">Coin Type</h6>
                                    <select class="coin-select" name="coin">
                                        <option></option>
                                        <option value="Bronze">Bronze</option>
                                        <option value="Silver">Silver</option>
                                        <option value="Gold">Gold</option>
                                    </select>
                                </div>
                                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                                    <h6 class="fw-semibold">Status</h6>
                                    <select class="status-select" name="status">
                                        <option></option>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>
                                <div class="col-xl-2 col-lg-3 col-md-3 col-sm-6">
                                    <h6 class="fw-semibold">&nbsp;</h6>
                                    <button type="button"
                                        class="btn btn-primary w-xs waves-effect waves-light">Filter</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="manageUser"
                                    class="table table-bordered dt-responsive nowrap table-striped align-middle w-100">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User ID</th>
                                            <th>User</th>
                                            <th>Country</th>
                                            <th>Coin Type</th>
                                            <th>Coin Growth</th>
                                            {{-- <th>Send Invite</th> --}}
                                            <th>Upgrade</th>
                                            <!--<th>Status</th>-->
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    {{-- <tbody>

                                         
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td class="text-center"><span class="wid-badge">WCU23223</span></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-3">
                                                            <a data-bs-toggle="modal" data-bs-target="#viewModal">
                                                                <img class="image avatar-xs rounded-circle" alt="" src="assets/images/users/avatar-3.jpg">
                                                            </a>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h5 class="contact-name fs-13 mb-1">
                                                                <a data-bs-toggle="modal" data-bs-target="#viewModal" class="link text-body">Santhosh Kumar</a>
                                                            </h5>
                                                            <p class="contact-born text-muted mb-0">santhoshkumar@gmail.com</p>
                                                            <p class="contact-born text-muted mb-0">+44 4893432323</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">United Kingdom</td>
                                                <td class="text-center"><span class="badge badge-gradient-warning">Gold</span></td>
                                                <td class="text-center">
                                                    <button class="btn btn-soft-info btn-sm rounded-pill btn-growth"
                                                        data-name="Santhosh Kumar" data-email="santhoshkumar@gmail.com"
                                                        data-joined="Jan 2023" data-coin="Gold" data-active="8"
                                                        onclick="openCoinGrowth(this)">
                                                        <i class="ri-line-chart-line me-1"></i>Growth
                                                    </button>
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-success btn-sm send-invite-btn"
                                                        data-name="Santhosh Kumar" data-email="santhoshkumar@gmail.com">
                                                        Send Invite
                                                    </button>
                                                </td>
                                               
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-sm btn-upgrade-disabled"
                                                        disabled title="Already on highest plan">
                                                        <i class="ri-arrow-up-circle-line me-1"></i> Upgrade
                                                    </button>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-check form-switch text-center status-switch">
                                                        <input class="form-check-input" type="checkbox" id="status1" checked>
                                                        <label class="form-check-label fw-bold" for="status1">Active</label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                                        <button class="btn btn-sm btn-soft-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#viewModal" title="View"><span class="bx bx-show-alt"></span></button>
                                                        <button class="btn btn-sm btn-soft-secondary rounded-pill" data-bs-toggle="modal" data-bs-target="#showModal" title="Edit"><span class="bx bx-pencil"></span></button>
                                                        <button class="btn btn-sm btn-soft-danger rounded-pill" data-bs-toggle="modal" data-bs-target="#deleteRecordModal" title="Delete"><span class="bx bx-trash"></span></button>
                                                     
                                                        <button class="btn btn-sm btn-soft-info rounded-pill tg-notify-btn" title="Send Notification"
                                                            data-name="Santhosh Kumar" data-email="santhoshkumar@gmail.com" data-phone="+44 4893432323">
                                                            <i class="ri-rocket-line"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>

                                        
                                            <tr>
                                                <td class="text-center">2</td>
                                                <td class="text-center"><span class="wid-badge">WCU23224</span></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-3">
                                                            <a data-bs-toggle="modal" data-bs-target="#viewModal">
                                                                <img class="image avatar-xs rounded-circle" alt="" src="assets/images/users/avatar-3.jpg">
                                                            </a>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h5 class="contact-name fs-13 mb-1">
                                                                <a data-bs-toggle="modal" data-bs-target="#viewModal" class="link text-body">Gayathiri</a>
                                                            </h5>
                                                            <p class="contact-born text-muted mb-0">gayathiri@gmail.com</p>
                                                            <p class="contact-born text-muted mb-0">+44 4893432324</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">United Kingdom</td>
                                                <td class="text-center"><span class="badge badge-gradient-warning">Silver</span></td>
                                                <td class="text-center">
                                                    <button class="btn btn-soft-info btn-sm rounded-pill btn-growth"
                                                        data-name="Gayathiri" data-email="gayathiri@gmail.com"
                                                        data-joined="Jun 2024" data-coin="Silver" data-active="10"
                                                        onclick="openCoinGrowth(this)">
                                                        <i class="ri-line-chart-line me-1"></i>Growth
                                                    </button>
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-success btn-sm send-invite-btn"
                                                        data-name="Gayathiri" data-email="gayathiri@gmail.com">
                                                        Send Invite
                                                    </button>
                                                </td>
                                               
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-sm btn-upgrade-active"
                                                        data-bs-toggle="modal" data-bs-target="#upgradeModal"
                                                        data-name="Gayathiri" data-userid="WCU23224"
                                                        data-wingooid="WG5435736"
                                                        data-avatar="assets/images/users/avatar-3.jpg"
                                                        data-coin="Silver">
                                                        <i class="ri-arrow-up-circle-line me-1"></i> Upgrade
                                                    </button>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-check form-switch text-center status-switch">
                                                        <input class="form-check-input" type="checkbox" id="status2" checked>
                                                        <label class="form-check-label fw-bold" for="status2">Active</label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                                        <button class="btn btn-sm btn-soft-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#viewModal" title="View"><span class="bx bx-show-alt"></span></button>
                                                        <button class="btn btn-sm btn-soft-secondary rounded-pill" data-bs-toggle="modal" data-bs-target="#showModal" title="Edit"><span class="bx bx-pencil"></span></button>
                                                        <button class="btn btn-sm btn-soft-danger rounded-pill" data-bs-toggle="modal" data-bs-target="#deleteRecordModal" title="Delete"><span class="bx bx-trash"></span></button>
                                                        <button class="btn btn-sm btn-soft-info rounded-pill tg-notify-btn" title="Send Notification"
                                                            data-name="Gayathiri" data-email="gayathiri@gmail.com" data-phone="+44 4893432324">
                                                            <i class="ri-rocket-line"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>

                                         
                                            <tr>
                                                <td class="text-center">3</td>
                                                <td class="text-center"><span class="wid-badge">WCU23225</span></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-3">
                                                            <a data-bs-toggle="modal" data-bs-target="#viewModal">
                                                                <img class="image avatar-xs rounded-circle" alt="" src="assets/images/users/avatar-3.jpg">
                                                            </a>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h5 class="contact-name fs-13 mb-1">
                                                                <a data-bs-toggle="modal" data-bs-target="#viewModal" class="link text-body">Chandran</a>
                                                            </h5>
                                                            <p class="contact-born text-muted mb-0">chandran@gmail.com</p>
                                                            <p class="contact-born text-muted mb-0">+44 4893431123</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">United Kingdom</td>
                                                <td class="text-center"><span class="badge badge-gradient-warning">Bronze</span></td>
                                                <td class="text-center">
                                                    <button class="btn btn-soft-info btn-sm rounded-pill btn-growth"
                                                        data-name="Chandran" data-email="chandran@gmail.com"
                                                        data-joined="Sep 2024" data-coin="Bronze" data-active="14"
                                                        onclick="openCoinGrowth(this)">
                                                        <i class="ri-line-chart-line me-1"></i>Growth
                                                    </button>
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-success btn-sm send-invite-btn"
                                                        data-name="Chandran" data-email="chandran@gmail.com">
                                                        Send Invite
                                                    </button>
                                                </td>
                                               
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-sm btn-upgrade-active"
                                                        data-bs-toggle="modal" data-bs-target="#upgradeModal"
                                                        data-name="Chandran" data-userid="WCU23225"
                                                        data-wingooid="WG5435737"
                                                        data-avatar="assets/images/users/avatar-3.jpg"
                                                        data-coin="Bronze">
                                                        <i class="ri-arrow-up-circle-line me-1"></i> Upgrade
                                                    </button>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-check form-switch text-center status-switch">
                                                        <input class="form-check-input" type="checkbox" id="status3" checked>
                                                        <label class="form-check-label fw-bold" for="status3">Active</label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                                        <button class="btn btn-sm btn-soft-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#viewModal" title="View"><span class="bx bx-show-alt"></span></button>
                                                        <button class="btn btn-sm btn-soft-secondary rounded-pill" data-bs-toggle="modal" data-bs-target="#showModal" title="Edit"><span class="bx bx-pencil"></span></button>
                                                        <button class="btn btn-sm btn-soft-danger rounded-pill" data-bs-toggle="modal" data-bs-target="#deleteRecordModal" title="Delete"><span class="bx bx-trash"></span></button>
                                                        <button class="btn btn-sm btn-soft-info rounded-pill tg-notify-btn" title="Send Notification"
                                                            data-name="Chandran" data-email="chandran@gmail.com" data-phone="+44 4893431123">
                                                            <i class="ri-rocket-line"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>

                                        </tbody> --}}

                                    <tbody>
                                        @foreach ($users as $index => $user)
                                            <tr>
                                                <td class="text-center">{{ $index + 1 }}</td>

                                                <td class="text-center">
                                                    <span class="wid-badge">{{ $user->user_code }}</span>
                                                </td>

                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-3">
                                                            <a data-bs-toggle="modal" data-bs-target="#viewModal">
                                                                <img class="image avatar-xs rounded-circle" alt=""
                                                                    src="{{ $user->photo ? asset('assets/images/profile/' . $user->photo) : asset('assets/images/users/avatar-3.jpg') }}">
                                                            </a>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h5 class="contact-name fs-13 mb-1">
                                                                <a data-bs-toggle="modal" data-bs-target="#viewModal"
                                                                    class="link text-body">
                                                                    {{ $user->name }}
                                                                </a>
                                                            </h5>
                                                            <p class="contact-born text-muted mb-0">{{ $user->email }}</p>
                                                            <p class="contact-born text-muted mb-0">{{ $user->phone }}</p>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="text-center">
                                                    {{ $user->country->name ?? 'N/A' }}
                                                </td>

                                                <td class="text-center">
                                                    <span class="badge badge-gradient-warning">
                                                        {{ $user->mining->coin_type ?? 'No Plan' }}
                                                    </span>
                                                </td>

                                                <td class="text-center">
<!--                                                  <button class="btn btn-soft-info btn-sm rounded-pill btn-growth"-->
<!--    data-name="{{ $user->name }}"-->
<!--    data-email="{{ $user->email }}"-->
<!--    data-joined="{{ $user->created_at ? $user->created_at->format('d M Y') : 'N/A' }}"-->
<!--    data-coin="{{ $user->mining->coin_type ?? 'Bronze' }}"-->
<!--    data-active="{{ $user->mining->progress ?? 0 }}"-->
<!--    data-coin-image="{{ $user->mining->coin->image ?? '' }}"-->
<!--    onclick="openCoinGrowth(this)">-->
<!--    <i class="ri-line-chart-line me-1"></i>Growth-->
<!--</button>-->




<button class="btn btn-soft-info btn-sm rounded-pill btn-growth"
    data-name="{{ $user->name }}"
    data-email="{{ $user->email }}"
    data-joined="{{ $user->created_at ? $user->created_at->format('d M Y') : 'N/A' }}"
    data-coin="{{ $user->mining->coin_type ?? 'Bronze' }}"
    data-total="{{ $user->mining->coin->mining_period ?? 24 }}"
    data-progress="{{ $user->mining->progress ?? 0 }}"
    data-inactive="{{ $user->mining->inactive_months ?? 0 }}"
    data-coin-image="{{ $user->mining->coin->image ?? '' }}"
    data-coin-image2="{{ $user->mining->coin->image2 ?? '' }}"
    data-history="{{ json_encode($miningHistories[$user->id] ?? []) }}"
    onclick="openCoinGrowth(this)">
    <i class="ri-line-chart-line me-1"></i>Growth
</button>






                                    </td>

                                                {{-- <td class="text-center">
        <button type="button" class="btn btn-success btn-sm send-invite-btn"
            data-name="{{ $user->name }}"
            data-email="{{ $user->email }}">
            Send Invite
        </button>
    </td> --}}




<!--<td class="text-center">-->
<!--    <button type="button"-->
<!--        class="btn btn-sm {{ ($user->mining->coin_type ?? '') == 'Gold' ? 'btn-upgrade-disabled' : 'btn-upgrade-active' }}"-->
<!--        {{ ($user->mining->coin_type ?? '') == 'Gold' ? 'disabled' : '' }}-->

<!--        data-bs-toggle="modal"-->
<!--        data-bs-target="#upgradeModal"-->

<!--        data-user_id="{{ $user->id }}"-->
<!--        data-coin="{{ $user->mining->coin_type ?? 'Bronze' }}"-->
<!--        data-name="{{ $user->name }}"-->
<!--        data-userid="{{ $user->user_code }}"-->
<!--        data-wingooid="{{ $user->winngoo_id ?? '' }}"-->
<!--        data-wingoo-platform="{{ $user->wingoo_platform ?? '' }}"-->
<!--        data-avatar="{{ $user->photo ? asset('assets/images/profile/' . $user->photo) : asset('assets/images/users/avatar-3.jpg') }}">-->

<!--        <i class="ri-arrow-up-circle-line me-1"></i> Upgrade-->
<!--    </button>-->
<!--</td>-->

@php
    $coinType = $user->mining->coin_type ?? 'Bronze';
    $progress = (float)($user->mining->progress ?? 0);
    $isGold = $coinType === 'Gold';
    $canUpgrade = !$isGold;
@endphp

<td class="text-center">
    <button type="button"
        class="btn btn-sm {{ $canUpgrade ? 'btn-upgrade-active' : 'btn-upgrade-disabled' }}"
        {{ $canUpgrade ? '' : 'disabled' }}
        data-bs-toggle="{{ $canUpgrade ? 'modal' : '' }}"
        data-bs-target="{{ $canUpgrade ? '#upgradeModal' : '' }}"
        data-user_id="{{ $user->id }}"
        data-coin="{{ $coinType }}"
        data-progress="{{ $progress }}"
        data-name="{{ $user->name }}"
        data-userid="{{ $user->user_code }}"
        data-wingooid="{{ $user->winngoo_id ?? '' }}"
        data-wingoo-platform="{{ $user->wingoo_platform ?? '' }}"
        data-avatar="{{ $user->photo ? asset('assets/images/profile/' . $user->photo) : asset('assets/images/users/avatar-3.jpg') }}">
        <i class="ri-arrow-up-circle-line me-1"></i> Upgrade
    </button>
</td>




<!--{{-- ✅ Mining is_active based status switch --}}-->
<!--<td class="text-center">-->
<!--    <div class="form-check form-switch text-center status-switch">-->
<!--        <input class="form-check-input mining-status-toggle"-->
<!--               type="checkbox"-->
<!--               id="miningStatus{{ $user->id }}"-->
<!--               data-user-id="{{ $user->id }}"-->
<!--               {{ $user->mining && $user->mining->is_active ? 'checked' : '' }}>-->
<!--        <label class="form-check-label fw-bold" for="miningStatus{{ $user->id }}">-->
<!--            {{ $user->mining && $user->mining->is_active ? 'Active' : 'Inactive' }}-->
<!--        </label>-->
<!--    </div>-->
<!--</td>-->









                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center align-items-center gap-2">

                                                        {{-- <button class="btn btn-sm btn-soft-primary rounded-pill"
                data-bs-toggle="modal" data-bs-target="#viewModal ">
                <span class="bx bx-show-alt"></span>
            </button> --}}

                                                        <button class="btn btn-sm btn-soft-primary rounded-pill"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#viewModal{{ $user->id }}">
                                                            <span class="bx bx-show-alt"></span>
                                                        </button>

                                                        {{-- <button class="btn btn-sm btn-soft-secondary rounded-pill"
                                                            data-bs-toggle="modal" data-bs-target="#showModal">
                                                            <span class="bx bx-pencil"></span>
                                                        </button> --}}
 @if(auth('admin')->check() && auth('admin')->user()->hasPermission('user_management', 'edit'))
<button class="btn btn-sm btn-soft-secondary rounded-pill edit-user-btn"
    data-id="{{ $user->id }}"
    data-bs-toggle="modal"
    data-bs-target="#showModal">
    <span class="bx bx-pencil"></span>
</button>
@endif

                                                        {{-- 
            <button class="btn btn-sm btn-soft-danger rounded-pill"
                data-bs-toggle="modal" data-bs-target="#deleteRecordModal">
                <span class="bx bx-trash"></span>
            </button> --}}
            
             @if(auth('admin')->check() && auth('admin')->user()->hasPermission('user_management', 'delete'))

                                                        <button class="btn btn-sm btn-soft-danger rounded-pill delete-btn"
                                                            data-id="{{ $user->id }}" data-bs-toggle="modal"
                                                            data-bs-target="#deleteRecordModal">
                                                            <span class="bx bx-trash"></span>
                                                        </button>
                                                        @endif
                                                        {{-- 
            <button class="btn btn-sm btn-soft-info rounded-pill tg-notify-btn"
                data-name="{{ $user->name }}"
                data-email="{{ $user->email }}"
                data-phone="{{ $user->phone }}">
                <i class="ri-rocket-line"></i>
            </button> --}}

                                                    </div>
                                                </td>
                                            </tr>



                                            <div id="viewModal{{ $user->id }}" class="modal fade" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-light p-3">
                                                            <h5 class="modal-title">View User</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="mb-3 text-center">
                                                                        <div
                                                                            class="avatar-title bg-transparent rounded-circle user_avatar_div mx-auto">
                                                                            <img src="{{ $user->photo ? asset('assets/images/profile/' . $user->photo) : asset('assets/images/users/avatar-3.jpg') }}"
                                                                                class="rounded-circle user_avatar_div_img" />
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <h5 class="fs-15">User Id</h5>
                                                                        <p><span
                                                                                class="badge badge-gradient-primary">{{ $user->user_code }}</span>
                                                                        </p>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <h5 class="fs-15">User Name</h5>
                                                                        <p class="text-muted">{{ $user->name }}</p>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <h5 class="fs-15">Email Id</h5>
                                                                        <p class="text-muted">{{ $user->email }}</p>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <h5 class="fs-15">Phone Number</h5>
                                                                        <p class="text-muted">{{ $user->phone }}</p>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <h5 class="fs-15">Date of Birth</h5>
                                                                        <p class="text-muted">
                                                                            {{ \Carbon\Carbon::parse($user->dob)->format('d/m/Y') }}
                                                                        </p>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <h5 class="fs-15">Country</h5>
                                                                        <p class="text-muted">
                                                                            {{ $user->country->name ?? '-' }}</p>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <h5 class="fs-15">Post Code</h5>
                                                                        <p class="text-muted">
                                                                            {{ $user->postal_code ?? '-' }}</p>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <h5 class="fs-15">Coin Type</h5>
                                                                        <p><span
                                                                                class="badge badge-gradient-warning">{{ $user->mining->coin_type ?? '-' }}</span>
                                                                        </p>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <h5 class="fs-15">Winngoo Id</h5>
                                                                        <p class="text-muted">
                                                                            {{ $user->winngoo_id ?? '-' }}</p>
                                                                    </div>
                                                                </div>

<!--                                                                <div class="col-lg-6">-->
<!--                                                                    <div class="mb-3">-->
<!--                                                                        <h5 class="fs-15">Status</h5>-->
<!--                                                                  <p>-->
<!--    <span class="badge {{ $user->mining && $user->mining->is_active ? 'bg-success' : 'bg-danger' }}">-->
<!--        {{ $user->mining && $user->mining->is_active ? 'Active' : 'Inactive' }}-->
<!--    </span>-->
<!--</p>-->
<!--                                                                    </div>-->
<!--                                                                </div>-->
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <!--<button class="btn btn-soft-secondary"-->
                <!--    data-bs-toggle="modal"-->
                <!--    data-bs-target="#showModal{{ $user->id }}"-->
                <!--    data-bs-dismiss="modal">Edit</button>-->
            </div> 
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="upgradeModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-light p-3">
                            <h5 class="modal-title">Upgrade Plan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Avatar -->
                            <div class="up-avatar-wrap">
                                <div class="up-avatar-circle">
                                    <img id="upAvatarImg" src="" alt="" style="display:none;">
                                    <span id="upAvatarIcon">👤</span>
                                </div>
                            </div>
                            <!-- Info fields -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <h5 class="fs-15">User Id</h5>
                                        <p><span class="badge badge-gradient-primary" id="upUserId">—</span></p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <h5 class="fs-15">User Name</h5>
                                        <p class="text-muted" id="upName">—</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <h5 class="fs-15">Current Coin</h5>
                                        <p><span class="up-badge-coin" id="upCoinType">—</span></p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <h5 class="fs-15">Upgrade To</h5>
                                        <p><span class="up-badge-coin empty" id="upUpgradeTo">Select plan</span></p>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <h5 class="fs-15">Winngoo Platform</h5>
                                        <input type="text" class="form-control form-control-sm" id="upWingooPlatform"
                                            placeholder="Enter Winngoo Platform" />
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <h5 class="fs-15">Winngoo ID</h5>
                                        <input type="text" class="form-control form-control-sm" id="upWingooIdInput"
                                            placeholder="Enter Winngoo ID" />
                                    </div>
                                </div>

                            </div>
                            <hr>
                            <h5 class="fs-15 mb-3">Select Plan to Upgrade</h5>
                            <div class="up-plans" id="upPlans"></div>
                            <div class="up-flow-bar mt-3">
                                <div class="up-flow-cell">
                                    <div class="up-flow-cell-lbl">Current Plan</div>
                                    <div class="up-flow-cell-val" id="upFlowFrom">—</div>
                                </div>
                                <div class="up-flow-arrow"><i class="ri-arrow-right-line"></i></div>
                                <div class="up-flow-cell to">
                                    <div class="up-flow-cell-lbl">Upgrading To</div>
                                    <div class="up-flow-cell-val empty" id="upFlowTo">Select a plan</div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="upConfirmBtn" disabled
                                onclick="doUpgradeConfirm()">
                                <i class="ri-check-line me-1"></i> Confirm Upgrade
                            </button>
                        </div>
                    </div>
                </div>
            </div>


            <div id="successAlertUpgrade"
                class="alert alert-success alert-dismissible bg-success text-white alert-label-icon fade position-fixed top-0 end-0 m-3 material-shadow"
                role="alert" style="z-index:9999;display:none;">
                <i class="ri-notification-4-line label-icon"></i>
                <strong>Success</strong> — <span id="upgradeAlertText">Upgraded successfully!</span>
            </div>


            <div id="coinGrowthModal" class="modal fade" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-light p-3">
                            <h5 class="modal-title">Coin Growth</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row cg-top-row mb-3">
                                <div class="col-6 cg-left-panel">
                                    <p class="cg-section-heading">User Info</p>
                                    <div class="cg-fields-row">
                                        <div class="mb-2">
                                            <p class="cg-field-label">User Name</p>
                                            <p class="cg-field-val" id="cg-name">—</p>
                                        </div>
                                        <div class="mb-2">
                                            <p class="cg-field-label">Email Id</p>
                                            <p class="cg-field-val" id="cg-email">—</p>
                                        </div>
                                        <div class="mb-2">
                                            <p class="cg-field-label">Date Joined</p>
                                            <p class="cg-field-val" id="cg-joined">—</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 cg-right-panel">
                                    <p class="cg-section-heading">Coin Info</p>
                                    {{-- <div class="cg-coin-block">
                                        <p class="cg-field-label mt-2 mb-1">Coin Image</p>
                                        <img src="assets/images/coin.png" alt="coin" class="cg-coin-img">
                                    </div> --}}

                                    <div class="cg-coin-block">
    <p class="cg-field-label mt-2 mb-1">Coin Image</p>
    {{-- ✅ id="cg-coin-img" add pannunga --}}
    <img id="cg-coin-img" src="assets/images/coin.png" alt="coin" class="cg-coin-img">
</div>
                                    <div class="cg-coin-block">
                                        <p class="cg-field-label mt-2 mb-1">Coin Type</p>
                                        <span class="cg-coin-badge gold" id="cg-coin-badge">Gold</span>
                                    </div>
                                </div>
                            </div>
                            <hr class="cg-hr">
                            <div class="cg-coin-strip">
                                <img id="cg-coin-img-strip" src="assets/images/coin.png" alt="coin" class="cg-coin-img">
                                <div class="text-center">
                                    <div class="cg-strip-title" id="cg-plan-title">Gold Plan · 1 Year Journey</div>
                                    <div class="cg-strip-sub" id="cg-plan-sub">12 months total · 8 active</div>
                                </div>
                               <img id="cg-coin-img2" src="assets/images/coin.png" alt="coin" class="cg-coin-img">
                            </div>
                            <div class="cg-prog-row">
                                <span class="cg-prog-label">Activity Progress</span>
                                <span class="cg-prog-pct" id="cg-pct">0%</span>
                            </div>
                            <div class="cg-progress">
                                <div class="cg-progress-fill" id="cg-bar" style="width:0%"></div>
                            </div>
                            <hr class="cg-hr">
                            <div class="cg-act-header">
                                <h5>Monthly Activity</h5>
                                <!--<div class="cg-legend">-->
                                <!--    <span><span class="dot-active"></span> Active</span>-->
                                <!--    <span><span class="dot-inactive"></span> Inactive</span>-->
                                <!--</div>-->
                            </div>
                            <div class="cg-months-wrap" id="cg-months-grid"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- 
            
                <div id="viewModal" class="modal fade" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-light p-3">
                                <h5 class="modal-title">View User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12"><div class="mb-3 text-center"><div class="avatar-title bg-light rounded-circle user_avatar_div mx-auto"><img src="assets/images/users/avatar-3.jpg" class="rounded-circle user_avatar_div_img" /></div></div></div>
                                    <div class="col-lg-6"><div class="mb-3"><h5 class="fs-15">User Id</h5><p><span class="badge badge-gradient-primary">WCU23223</span></p></div></div>
                                    <div class="col-lg-6"><div class="mb-3"><h5 class="fs-15">User Name</h5><p class="text-muted">Santhosh Kumar</p></div></div>
                                    <div class="col-lg-6"><div class="mb-3"><h5 class="fs-15">Email Id</h5><p class="text-muted">santhoshkumar@gmail.com</p></div></div>
                                    <div class="col-lg-6"><div class="mb-3"><h5 class="fs-15">Phone Number</h5><p class="text-muted">4893432323</p></div></div>
                                    <div class="col-lg-6"><div class="mb-3"><h5 class="fs-15">Date of Birth</h5><p class="text-muted">06/08/1993</p></div></div>
                                    <div class="col-lg-6"><div class="mb-3"><h5 class="fs-15">Country</h5><p class="text-muted">United Kingdom</p></div></div>
                                    <div class="col-lg-6"><div class="mb-3"><h5 class="fs-15">Post Code</h5><p class="text-muted">EN11SP</p></div></div>
                                    <div class="col-lg-6"><div class="mb-3"><h5 class="fs-15">Coin Type</h5><p><span class="badge badge-gradient-warning">Silver</span></p></div></div>
                                    <div class="col-lg-6"><div class="mb-3"><h5 class="fs-15">Winngoo Id</h5><p class="text-muted">WG5435735</p></div></div>
                                    <div class="col-lg-6"><div class="mb-3"><h5 class="fs-15">Status</h5><p><span class="badge bg-danger">Inactive</span></p></div></div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-soft-secondary" data-bs-toggle="modal" data-bs-target="#showModal" data-bs-dismiss="modal">Edit</button>
                            </div>
                        </div>
                    </div>
                </div> --}}





            <div class="modal fade" id="showModalAdd" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"
                data-bs-keyboard="false">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-light p-3">
                            <h5 class="modal-title">Add User</h5><button type="button" class="btn-close"
                                data-bs-dismiss="modal"></button>
                        </div>
                        {{-- <form class="tablelist-form" autocomplete="off"> --}}
                        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3"><label class="form-label">User ID <span
                                                    class="text-danger">*</span></label>

                                            {{-- <input type="text" class="form-control"  value="{{ $nextUserCode }}
                                            " readonly  /> --}}
                                          <input type="text"
       value="{{ $nextUserCode }}"
       readonly
       class="form-control bg-light text-muted">


                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3"><label class="form-label">User Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text"
       name="name"
       class="form-control"
       placeholder="Enter Name"
       value="{{ old('name') }}"
       maxlength="30"
       oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" />
                                                </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3"><label class="form-label">Email Id <span
                                                    class="text-danger">*</span></label><input type="email"
                                                class="form-control" name="email" placeholder="Enter Email" required
                                                value="{{ old('email') }}" /></div>
                                    </div>


                                    <div class="col-lg-6">
                                        <div class="mb-3"><label class="form-label">Upload Photo</label><input
                                                type="file" class="form-control" name="photo" /></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3"><label class="form-label">Date of Birth <span
                                                    class="text-danger">*</span></label><input type="date"
                                                name="dob" class="form-control" required
                                                value="{{ old('dob') }}" /></div>
                                    </div>
                                    <div class="col-lg-6">
                                        {{-- <div class="mb-3"><label class="form-label">Country <span class="text-danger">*</span></label>
                                                
                                                <input type="text" class="form-control" placeholder="Enter Country" required /></div></div> --}}



                                        <div class="mb-3">
                                            <label class="form-label">Country <span class="text-danger">*</span></label>

                                            <select class="form-control" id="countrySelect" name="country_id" required>
                                                <option value="">Select Country</option>

                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}"
                                                        data-phone-min="{{ $country->phone_min }}"
                                                        data-phone-max="{{ $country->phone_max }}"
                                                        data-postal="{{ $country->postal_regex }}"
                                                        {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                                        {{ $country->name }} ({{ $country->phone_code }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>








                                    {{-- <div class="col-lg-6"><div class="mb-3"><label class="form-label">Phone <span class="text-danger">*</span></label><input type="text" class="form-control" placeholder="Enter Phone" required /></div></div> --}}

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Phone <span class="text-danger">*</span></label>
                                            <input type="text" id="phoneInput" class="form-control" name="phone"
                                                placeholder="Enter Phone" value="{{ old('phone') }}" required />
                                            <small id="phoneError" class="text-danger d-none"></small>
                                        </div>
                                    </div>



                                    {{-- <div class="col-lg-6"><div class="mb-3"><label class="form-label">Postal Code <span class="text-danger">*</span></label><input type="text" class="form-control" placeholder="Enter Postal Code" required /></div></div> --}}


                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Postal Code <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="postalInput" class="form-control"
                                                name="postal_code" placeholder="Enter Postal Code"
                                                value="{{ old('postal_code') }}" required maxlength="10" />
                                            <small id="postalError" class="text-danger d-none"></small>
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <div class="mb-3"><label class="form-label">Coin Type <span
                                                    class="text-danger">*</span></label>



                                            {{-- <select class="form-select" id="coinType"><option selected disabled value="">Select Coin Type</option><option value="bronze">Bronze</option><option value="silver">Silver</option><option value="gold">Gold</option></select> --}}
                                            <select class="form-select" name="coin_type" id="coinType">
                                                <option value="">Select Coin Type</option>

                                                @foreach ($coins as $coin)
                                                    <option value="{{ $coin->name }}"
                                                        {{ old('coin_type') == $coin->name ? 'selected' : '' }}>
                                                        {{ ucfirst($coin->name) }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-lg-6" id="platformWrapper">
                                        <div class="mb-3"><label class="form-label">Winngoo Platform <span
                                                    class="text-danger"></span></label><input type="text"
                                                id="addwplatform" class="form-control"  name="wingoo_platform"
                                                placeholder="Enter Winngoo   Platform"  maxlength="50"  value="{{old('wingoo_platform')}}"/></div>
                                    </div>
                                    <div class="col-lg-6" id="memberWrapper">
                                        <div class="mb-3"><label class="form-label">Winngoo Id <span
                                                    class="text-danger"></span></label><input type="text"
                                                id="addwmemberid" class="form-control" name="wingoo_id"  maxlength="50" 
                                                placeholder="Enter Winngoo Id"  value="{{old('wingoo_id')}}"/></div>
                                    </div>
                                    {{-- <div class="col-lg-6">
                                        <div class="mb-3"><label class="form-label">Status</label>
                                            <div class="form-check form-switch my-1">
                                             

                                                <input class="form-check-input" type="checkbox" id="addUser"
                                                    name="status" value="1"
                                                    {{ old('status', $user->is_verified ?? 0) ? 'checked' : '' }}>
                                                <label class="form-check-label text-success fw-bold"
                                                    for="addUser">Active</label>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                {{-- <button type="submit" class="btn btn-success" id="add-btn">Add User</button> --}}

                                <button type="submit" class="btn btn-success" id="add-btn">
                                    <span id="add-btn-text">Add User</span>
                                    <span id="add-btn-spinner" class="spinner-border spinner-border-sm d-none"
                                        role="status"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="successAlertAdd"
                class="alert alert-success alert-dismissible bg-success text-white alert-label-icon fade position-fixed top-0 end-0 m-3 material-shadow"
                role="alert" style="z-index:9999;display:none;"><i
                    class="ri-notification-4-line label-icon"></i><strong>Success</strong> - User Added</div>


            {{-- <div class="modal fade" id="showModal{{ $user->id }}" tabindex="-1" aria-hidden="true"
                data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-light p-3">
                            <h5 class="modal-title">Edit User</h5><button type="button" class="btn-close"
                                data-bs-dismiss="modal"></button>
                        </div>
                        <form class="tablelist-form" autocomplete="off">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="text-center mb-4 pt-2">
                                            <div class="position-relative d-inline-block">
                                                <div class="position-absolute bottom-0 end-0"><label
                                                        for="member-image-input" class="mb-0">
                                                        <div class="avatar-xs">
                                                            <div
                                                                class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                                <i class="ri-pencil-fill text-primary"></i></div>
                                                        </div>
                                                    </label><input class="form-control d-none" id="member-image-input"
                                                        type="file" accept="image/png, image/gif, image/jpeg"></div>
                                                <div class="avatar-lg">
                                                    <div class="avatar-title bg-light rounded-circle user_avatar_div"><img
                                                            src="assets/images/users/avatar-3.jpg" id="member-img"
                                                            width="75" class="rounded-circle user_avatar_div_img" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3"><label class="form-label">User ID</label><input
                                                type="text" class="form-control" value="WCU23223" readonly disabled />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3"><label class="form-label">User Name <span
                                                    class="text-danger">*</span></label><input type="text"
                                                class="form-control" value="John Victor" required /></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3"><label class="form-label">Email Id <span
                                                    class="text-danger">*</span></label><input type="email"
                                                class="form-control" value="johnvictor@gmail.com" required /></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3"><label class="form-label">Phone <span
                                                    class="text-danger">*</span></label><input type="text"
                                                class="form-control" value="4563278932" required /></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3"><label class="form-label">Date of Birth <span
                                                    class="text-danger">*</span></label><input type="date"
                                                class="form-control" value="01-01-1996" required /></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3"><label class="form-label">Country <span
                                                    class="text-danger">*</span></label><input type="text"
                                                class="form-control" value="United Kingdom" required /></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3"><label class="form-label">Postal Code <span
                                                    class="text-danger">*</span></label><input type="text"
                                                class="form-control" value="UK103324" required /></div>
                                    </div>
                                    <div class="col-lg-6 d-none">
                                        <div class="mb-3"><label class="form-label">Coin Type <span
                                                    class="text-danger">*</span></label><select class="form-select"
                                                id="edit-coin">
                                                <option disabled>Select Coin Type</option>
                                                <option value="bronze">Bronze</option>
                                                <option value="silver" selected>Silver</option>
                                                <option value="gold">Gold</option>
                                            </select></div>
                                    </div>
                                    <div class="col-lg-6 d-none" id="editmemberWrapper">
                                        <div class="mb-3"><label class="form-label">Winngoo Id <span
                                                    class="text-danger">*</span></label><input type="text"
                                                id="editwmemberid" class="form-control" value="WG0978075" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 d-none" id="editplatformWrapper">
                                        <div class="mb-3"><label class="form-label">Winngoo Platform <span
                                                    class="text-danger">*</span></label><input type="text"
                                                id="editwplatform" class="form-control"
                                                placeholder="Enter Winngoo Platform" /></div>
                                    </div>
                               
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" id="update-btn">Update &amp; Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> --}}
{{-- ✅ NEW EDIT MODAL --}}
<div class="modal fade" id="showModal" tabindex="-1" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editUserForm" method="POST" action="" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">

                        {{-- Avatar --}}
                        <div class="col-12 text-center mb-3">
                            <div class="position-relative d-inline-block">
                                <div class="position-absolute bottom-0 end-0">
                                    <label for="edit-image-input" class="mb-0">
                                        <div class="avatar-xs">
                                            <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                <i class="ri-pencil-fill text-primary"></i>
                                            </div>
                                        </div>
                                    </label>
                                    <input class="form-control d-none" id="edit-image-input"
                                        type="file" name="photo" accept="image/png,image/jpeg,image/webp">
                                </div>
                                <div class="avatar-lg">
                                    <div class="avatar-title bg-light rounded-circle user_avatar_div">
                                        <img src="" id="edit-member-img" width="75"
                                            class="rounded-circle user_avatar_div_img" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- User ID --}}
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">User ID</label>
                                <input type="text" id="editUserCode" class="form-control" readonly disabled />
                            </div>
                        </div>

                        {{-- Name --}}
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">User Name <span class="text-danger">*</span></label>
                              <input type="text" 
    id="editName" 
    name="name" 
    class="form-control" 
    placeholder="Enter Name"
    maxlength="30"
    pattern="[A-Za-z\s]+"
    oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')"
/>
                                <small class="text-danger" id="err-name"></small>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Email Id <span class="text-danger">*</span></label>
                                <input type="email" id="editEmail"  class="form-control" placeholder="Enter Email" readonly disabled   />
                                <small class="text-danger" id="err-email"></small>
                            </div>
                        </div>

               

                        {{-- DOB --}}
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                <input type="date" id="editDob" name="dob" class="form-control" />
                                <small class="text-danger" id="err-dob"></small>
                            </div>
                        </div>

                        {{-- Country --}}
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Country <span class="text-danger">*</span></label>
                                <select id="editCountry" name="country_id" class="form-control">
                                    <option value="">Select Country</option>
                                    @foreach ($countries as $country)
                                        {{-- <option value="{{ $country->id }}">
                                            {{ $country->name }} ({{ $country->phone_code }})
                                        </option> --}}
<option 
    value="{{ $country->id }}"
    data-phone-min="{{ $country->phone_min }}"
    data-phone-max="{{ $country->phone_max }}"
    data-postal="{{ $country->postal_regex }}"
>
    {{ $country->name }} ({{ $country->phone_code }})
</option>


                                    @endforeach
                                </select>
                                <small class="text-danger" id="err-country"></small>
                            </div>
                        </div>


                                 {{-- Phone --}}
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Phone <span class="text-danger">*</span></label>
                                <input type="text" id="editPhone" name="phone" class="form-control" placeholder="Enter Phone" />
                                <small class="text-danger" id="err-phone"></small>
                            </div>
                        </div>


                        {{-- Postal Code --}}
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Postal Code</label>
                                <input type="text" id="editPostal" name="postal_code"
                                    class="form-control" placeholder="Enter Postal Code" maxlength="10" />
                                    <small class="text-danger" id="err-postal"></small>
                            </div>
                        </div>

                        {{-- Winngoo Platform --}}
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Winngoo Platform</label>
                                <input type="text" id="editWingooPlatform" name="wingoo_platform"
                                    class="form-control" placeholder="Enter Winngoo Platform"   maxlength="50"/>
                            </div>
                        </div>

                        {{-- Winngoo ID --}}
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Winngoo Id</label>
                                <input type="text" id="editWingooId" name="wingoo_id"
                                    class="form-control" placeholder="Enter Winngoo Id"  maxlength="30"/>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="edit-update-btn">
                        <span id="edit-btn-text">Update & Save</span>
                        <span id="edit-btn-spinner" class="spinner-border spinner-border-sm d-none" role="status"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- ✅ END EDIT MODAL --}}

            <div id="successAlertUpdate"
                class="alert alert-success alert-dismissible bg-success text-white alert-label-icon fade position-fixed top-0 end-0 m-3 material-shadow"
                role="alert" style="z-index:9999;display:none;"><i
                    class="ri-notification-4-line label-icon"></i><strong>Success</strong> - Data Updated</div>


            <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header"><button type="button" class="btn-close"
                                data-bs-dismiss="modal"></button></div>
                        <div class="modal-body">
                            <div class="mt-2 text-center">
                                <div class="pt-2 fs-15 mx-4 mx-sm-5">
                                    <h4>Are you Sure ?</h4>
                                    <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Record ?</p>
                                </div>
                            </div>
                            <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                                {{-- <button type="button" class="btn w-sm btn-danger" id="delete-record">Yes, Delete It!</button> --}}

                                <button type="button" class="btn w-sm btn-danger" id="delete-record">
                                    <span class="btn-text">Yes, Delete It!</span>
                                    <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div id="successAlert" class="alert alert-success alert-dismissible bg-success text-white alert-label-icon fade position-fixed top-0 end-0 m-3 material-shadow" role="alert" style="z-index:9999;display:none;"><i class="ri-notification-4-line label-icon"></i><strong>Success</strong> - Data Removed</div> --}}

        </div>
    </div>

    <form id="deleteForm" method="POST">
        @csrf
        @method('DELETE')
    </form>

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <p class="mb-0 text-muted">&copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script> Winngoo Coin. All Rights Reserved
                    </p>
                </div>
            </div>
        </div>
    </footer>
    </div>
    </div>

    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top"><i
            class="ri-arrow-up-line"></i></button>
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status"><span
                    class="visually-hidden">Loading...</span></div>
        </div>
    </div>
    @push('scripts')
        {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/node-waves/waves.min.js"></script>
<script src="assets/libs/feather-icons/feather.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="assets/js/pages/datatables.init.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="assets/js/app.js"></script> --}}

        <script>
//             /* ─── Coin Growth ─── */




// const MN = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
// const PLAN_INFO = {
//     Gold:   { label: "Gold Plan · 1 Year Journey",     months: 12 },
//     Silver: { label: "Silver Plan · 1.5 Year Journey", months: 18 },
//     Bronze: { label: "Bronze Plan · 2 Year Journey",   months: 24 }
// };

// function ordinal(n) {
//     const s = ["th","st","nd","rd"], v = n % 100;
//     return n + (s[(v-20)%10] || s[v] || s[0]);
// }

// function formatJoined(j) {
//     if (!j || j === 'N/A') return 'N/A';
//     const p = j.split(" ");
//     return ordinal(parseInt(p[0])) + " " + p[1] + " " + p[2];
// }

// function openCoinGrowth(btn) {
//     const name        = btn.dataset.name,
//           email       = btn.dataset.email,
//           joined      = btn.dataset.joined,
//           coin        = btn.dataset.coin,
//           startDate   = btn.dataset.start || '',
//           totalMonths = parseInt(btn.dataset.total || 24),
//           inactive    = parseInt(btn.dataset.inactive || 0),
//           coinImage   = btn.dataset.coinImage;

//     // ✅ Calculate active months from start_date to today
//     let activeMonths = 0;
//     if (startDate) {
//         const start = new Date(startDate);
//         const today = new Date();
//         let months = (today.getFullYear() - start.getFullYear()) * 12;
//         months += today.getMonth() - start.getMonth();
//         if (today.getDate() < start.getDate()) months--;
//         activeMonths = Math.max(0, months - inactive);
//         activeMonths = Math.min(activeMonths, totalMonths);
//     }

//     const pct = Math.round((activeMonths / totalMonths) * 100);

//     document.getElementById("cg-name").textContent = name;
//     document.getElementById("cg-email").textContent = email;
//     document.getElementById("cg-joined").textContent = formatJoined(joined);

//     // Coin image
//     const coinImg = document.getElementById("cg-coin-img");
//     coinImg.src = (coinImage && coinImage !== '')
//         ? "{{ asset('') }}" + coinImage
//         : "{{ asset('assets/images/coin.png') }}";

//     // Coin badge
//     const badge = document.getElementById("cg-coin-badge");
//     badge.textContent = coin;
//     badge.className = "cg-coin-badge " + coin.toLowerCase();

//     // Plan info
//     document.getElementById("cg-plan-title").textContent =
//         (PLAN_INFO[coin] || {}).label || (coin + " Plan");
//     document.getElementById("cg-plan-sub").textContent =
//         totalMonths + " months total · " + activeMonths + " active" +
//         (inactive > 0 ? " · " + inactive + " missed" : "");

//     // Progress bar
//     document.getElementById("cg-pct").textContent = pct + "%";
//     document.getElementById("cg-bar").style.width = pct + "%";

//     // Build month grid
//     buildGridFromStart(startDate, totalMonths, activeMonths, inactive);

//     // Open modal
//     bootstrap.Modal.getOrCreateInstance(
//         document.getElementById("coinGrowthModal")
//     ).show();
// }

// function buildGridFromStart(startDateStr, total, activeCount, inactiveCount) {
//     const grid = document.getElementById("cg-months-grid");
//     grid.innerHTML = "";

//     if (!startDateStr) {
//         grid.innerHTML = '<p class="text-muted ps-1">Mining not started yet</p>';
//         return;
//     }

//     const start    = new Date(startDateStr);
//     const startMon = start.getMonth();
//     const startYr  = start.getFullYear();
//     let curYear    = null;

//     // Pattern: active ✅ → missed ⚠️ → pending ❌
//     const pattern = [];
//     for (let i = 0; i < total; i++) {
//         if (i < activeCount) pattern.push('active');
//         else if (i < activeCount + inactiveCount) pattern.push('missed');
//         else pattern.push('pending');
//     }

//     for (let i = 0; i < total; i++) {
//         const mIdx = (startMon + i) % 12;
//         const yr   = startYr + Math.floor((startMon + i) / 12);

//         if (yr !== curYear) {
//             curYear = yr;
//             const t = document.createElement("div");
//             t.className = "cg-year-tag";
//             t.textContent = yr;
//             grid.appendChild(t);
//         }

//         const chip = document.createElement("div");
//         let icon, cls;

//         if (pattern[i] === 'active') {
//             cls = 'is-active'; icon = '&#x2705;';
//         } else if (pattern[i] === 'missed') {
//             cls = 'is-missed'; icon = '&#x26A0;';
//         } else {
//             cls = 'is-inactive'; icon = '&#x274C;';
//         }

//         chip.className = "cg-month-chip " + cls;
//         chip.innerHTML =
//             '<span class="chip-icon">' + icon + '</span>' +
//             '<span class="chip-label">' + MN[mIdx] + '</span>';
//         grid.appendChild(chip);
//     }
// }

//           function buildGrid(joinedStr, total, activeCount) {
//     const grid = document.getElementById("cg-months-grid");
//     grid.innerHTML = "";

//     // ✅ Handle "25 Mar 2026" or "Mar 2026" both formats
//     const parts = joinedStr.split(" ");
//     let startMon, startYr;

//     if (parts.length === 3) {
//         // "25 Mar 2026" format
//         startMon = MN.indexOf(parts[1]);
//         startYr = parseInt(parts[2]);
//     } else if (parts.length === 2) {
//         // "Mar 2026" format
//         startMon = MN.indexOf(parts[0]);
//         startYr = parseInt(parts[1]);
//     } else {
//         grid.innerHTML = '<p class="text-muted">Invalid date</p>';
//         return;
//     }

//     if (startMon === -1 || isNaN(startYr)) {
//         grid.innerHTML = '<p class="text-muted">Date not available</p>';
//         return;
//     }

//     const pattern = spreadActive(total, activeCount);
//     let curYear = null;

//     for (let i = 0; i < total; i++) {
//         const mIdx = (startMon + i) % 12,
//             yr = startYr + Math.floor((startMon + i) / 12);
//         if (yr !== curYear) {
//             curYear = yr;
//             const t = document.createElement("div");
//             t.className = "cg-year-tag";
//             t.textContent = yr;
//             grid.appendChild(t);
//         }
//         const chip = document.createElement("div");
//         chip.className = "cg-month-chip " + (pattern[i] ? "is-active" : "is-inactive");
//         chip.innerHTML = '<span class="chip-icon">' + (pattern[i] ? "&#x2705;" : "&#x274C;") +
//             '</span><span class="chip-label">' + MN[mIdx] + '</span>';
//         grid.appendChild(chip);
//     }
// }
//             function spreadActive(total, count) {
//                 const arr = new Array(total).fill(false);
//                 if (count >= total) return new Array(total).fill(true);
//                 const step = total / count;
//                 for (let i = 0; i < count; i++) {
//                     arr[Math.min(Math.round(i * step), total - 1)] = true;
//                 }
//                 return arr;
//             }


const MN = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];

const PLAN_INFO = {
    Gold:   { label: "Gold Plan · 1 Year Journey",     months: 12 },
    Silver: { label: "Silver Plan · 1.5 Year Journey", months: 18 },
    Bronze: { label: "Bronze Plan · 2 Year Journey",   months: 24 }
};

function ordinal(n) {
    const s = ["th","st","nd","rd"], v = n % 100;
    return n + (s[(v-20)%10] || s[v] || s[0]);
}

function formatJoined(j) {
    if (!j || j === 'N/A') return 'N/A';
    const p = j.split(" ");
    return ordinal(parseInt(p[0])) + " " + p[1] + " " + p[2];
}

// function openCoinGrowth(btn) {
//     const name        = btn.dataset.name,
//           email       = btn.dataset.email,
//           joined      = btn.dataset.joined,
//           coin        = btn.dataset.coin,
//           startDate   = btn.dataset.start || '',
//           totalMonths = parseInt(btn.dataset.total || 24),
//           inactive    = parseInt(btn.dataset.inactive || 0),
//           coinImage   = btn.dataset.coinImage,
//           coinImage2  = btn.dataset.coinImage2;

//     // ✅ Calculate active months
//     let activeMonths = 0;
//     if (startDate) {
//         const start = new Date(startDate);
//         const today = new Date();

//         let months = (today.getFullYear() - start.getFullYear()) * 12;
//         months += today.getMonth() - start.getMonth();

//         if (today.getDate() < start.getDate()) months--;

//         activeMonths = Math.max(0, months - inactive);
//         activeMonths = Math.min(activeMonths, totalMonths);
//     }

//     const pct = Math.round((activeMonths / totalMonths) * 100);

//     document.getElementById("cg-name").textContent = name;
//     document.getElementById("cg-email").textContent = email;
//     document.getElementById("cg-joined").textContent = formatJoined(joined);

// // 1. Update the Main Coin Image
//     const mainImgPath = (coinImage && coinImage !== '') 
//         ? "{{ asset('') }}" + coinImage 
//         : "{{ asset('assets/images/coin.png') }}";

//     if(document.getElementById("cg-coin-img")) {
//         document.getElementById("cg-coin-img").src = mainImgPath;
//     }

//     // 2. Update the Strip version of the First Image
//     if(document.getElementById("cg-coin-img-strip")) {
//         document.getElementById("cg-coin-img-strip").src = mainImgPath;
//     }

//     // 3. Update the Second Coin Image
//     const coinImg2 = document.getElementById("cg-coin-img2");
//     if (coinImg2) {
//         coinImg2.src = (coinImage2 && coinImage2 !== '')
//             ? "{{ asset('') }}" + coinImage2
//             : "{{ asset('assets/images/coin.png') }}"; 
//     }

//     // Coin badge
//     const badge = document.getElementById("cg-coin-badge");
//     badge.textContent = coin;
//     badge.className = "cg-coin-badge " + coin.toLowerCase();

//     // Plan info
//     document.getElementById("cg-plan-title").textContent =
//         (PLAN_INFO[coin] || {}).label || (coin + " Plan");

//     document.getElementById("cg-plan-sub").textContent =
//         totalMonths + " months total · " + activeMonths + " active" +
//         (inactive > 0 ? " · " + inactive + " missed" : "");

//     // Progress bar
//     document.getElementById("cg-pct").textContent = pct + "%";
//     document.getElementById("cg-bar").style.width = pct + "%";

//     // ✅ Build grid (UPDATED FUNCTION)
//     buildGridFromStart(startDate, totalMonths, activeMonths, inactive);

//     bootstrap.Modal.getOrCreateInstance(
//         document.getElementById("coinGrowthModal")
//     ).show();
// }







function openCoinGrowth(btn) {
    const name        = btn.dataset.name,
          email       = btn.dataset.email,
          joined      = btn.dataset.joined,
          coin        = btn.dataset.coin,
          totalMonths = parseInt(btn.dataset.total || 24),
          inactive    = parseInt(btn.dataset.inactive || 0),
          coinImage   = btn.dataset.coinImage,
          coinImage2  = btn.dataset.coinImage2,
          historyData = JSON.parse(btn.dataset.history || '[]'); // ✅ Direct data

    // User Info
    document.getElementById("cg-name").textContent   = name;
    document.getElementById("cg-email").textContent  = email;
    document.getElementById("cg-joined").textContent = formatJoined(joined);

    // Images
    const mainImgPath = (coinImage && coinImage !== '')
        ? "{{ asset('') }}" + coinImage
        : "{{ asset('assets/images/coin.png') }}";

    if (document.getElementById("cg-coin-img"))       document.getElementById("cg-coin-img").src = mainImgPath;
    if (document.getElementById("cg-coin-img-strip")) document.getElementById("cg-coin-img-strip").src = mainImgPath;

    const coinImg2 = document.getElementById("cg-coin-img2");
    if (coinImg2) {
        coinImg2.src = (coinImage2 && coinImage2 !== '')
            ? "{{ asset('') }}" + coinImage2
            : "{{ asset('assets/images/coin.png') }}";
    }

    // Badge
    const badge = document.getElementById("cg-coin-badge");
    if (badge) {
        badge.textContent = coin;
        badge.className   = "cg-coin-badge " + (coin ? coin.toLowerCase() : 'default');
    }

    // Plan info
    document.getElementById("cg-plan-title").textContent = coin + " Plan";
    document.getElementById("cg-plan-sub").textContent   = totalMonths + " Months";

    // ✅ Progress - Active count from history
    // const activeCount = historyData.filter(h => h.mining_status === 'Active').length;
    // const pct = totalMonths > 0 ? Math.round((activeCount / totalMonths) * 100) : 0;
    // document.getElementById("cg-pct").textContent = pct + "%";
    // document.getElementById("cg-bar").style.width = pct + "%";
    
    const pct = parseFloat(btn.dataset.progress || 0);
document.getElementById("cg-pct").textContent = pct + "%";
document.getElementById("cg-bar").style.width = pct + "%";

    // ✅ Build grid directly
    buildGridFromHistory(historyData);

    bootstrap.Modal.getOrCreateInstance(document.getElementById("coinGrowthModal")).show();
}



// function buildGridFromHistory(historyData) {
//     const grid = document.getElementById("cg-months-grid");
//     grid.innerHTML = "";

//     if (!historyData || historyData.length === 0) {
//         grid.innerHTML = '<p class="text-muted ps-1">No history found</p>';
//         return;
//     }

//     let curYear = null;

//     historyData.forEach(function(item) {
//         // ✅ end_date-லேர்ந்து month & year எடு
//         const eParts   = item.end_date.split('.');
//         const endMonth = parseInt(eParts[1]) - 1; // 0-indexed
//         const endYear  = parseInt(eParts[2]);

//         // ✅ Year tag - end year based
//         if (endYear !== curYear) {
//             curYear = endYear;
//             const t = document.createElement("div");
//             t.className   = "cg-year-tag";
//             t.textContent = endYear;
//             grid.appendChild(t);
//         }

//         const chip     = document.createElement("div");
//         const isActive = item.mining_status === 'Active';

//         chip.className = "cg-month-chip " + (isActive ? 'is-active' : 'is-missed');
//         chip.innerHTML =
//             '<span class="chip-icon">' + (isActive ? '&#x2705;' : '&#x274C;') + '</span>' +
//             '<span class="chip-label">' + MN[endMonth] + '</span>';

//         grid.appendChild(chip);
//     });
// // }


function buildGridFromHistory(historyData) {
    const grid = document.getElementById("cg-months-grid");
    grid.innerHTML = "";

    if (!historyData || historyData.length === 0) {
        grid.innerHTML = '<p class="text-muted ps-1">No history found</p>';
        return;
    }

    // ✅ Use END DATE for month label & dedup key (matches the actual billing month)
    const seen   = {};
    const deduped = [];

    historyData.forEach(function(item) {
        // const eParts = item.end_date.split('.');
        // const month  = parseInt(eParts[1]) - 1; // 0-indexed
        // const year   = parseInt(eParts[2]);
        
        const sParts = item.start_date.split('.');
const month  = parseInt(sParts[1]) - 1;
const year   = parseInt(sParts[2]);

// const sParts = item.start_date.split('.');
// const month  = parseInt(sParts[1]) - 1;
// const year   = parseInt(sParts[2]);

// const eParts = item.end_date.split('.');
// const month  = parseInt(eParts[1]) - 1;
// const year   = parseInt(eParts[2]);
        const key    = year + '-' + month;

        if (!seen[key]) {
            seen[key] = { item, month, year, index: deduped.length };
            deduped.push({ item, month, year });
        } else if (item.mining_status === 'Active' && seen[key].item.mining_status !== 'Active') {
            // ✅ Prefer Active over Inactive for same month
            const idx = seen[key].index;
            deduped[idx] = { item, month, year };
            seen[key].item = item;
        }
    });

    let curYear = null;

    deduped.forEach(function({ item, month, year }) {
        if (year !== curYear) {
            curYear = year;
            const t = document.createElement("div");
            t.className   = "cg-year-tag";
            t.textContent = year;
            grid.appendChild(t);
        }

        const chip     = document.createElement("div");
        const isActive = item.mining_status === 'Active';

        chip.className = "cg-month-chip " + (isActive ? 'is-active' : 'is-missed');
        chip.innerHTML =
            '<span class="chip-icon">' + (isActive ? '&#x2705;' : '&#x274C;') + '</span>' +
            '<span class="chip-label">' + MN[month] + '</span>';

        grid.appendChild(chip);
    });
}












        </script>

        <script>
            $(document).ready(function() {
                $(document).on("change", ".status-switch .form-check-input", function() {
                    const lbl = $(this).closest(".status-switch").find("label");
                    if (this.checked) {
                        this.value = "active";
                        lbl.text("Active").removeClass("text-danger").addClass("text-success");
                    } else {
                        this.value = "inactive";
                        lbl.text("Inactive").removeClass("text-success").addClass("text-danger");
                    }
                });
                $(".status-switch .form-check-input").each(function() {
                    const lbl = $(this).closest(".status-switch").find("label");
                    if (this.checked) {
                        lbl.text("Active").removeClass("text-danger").addClass("text-success");
                    } else {
                        lbl.text("Inactive").removeClass("text-success").addClass("text-danger");
                    }
                });
                $(".country-select").select2({
                    placeholder: "Select a country"
                });
                $(".coin-select").select2({
                    placeholder: "Select a coin"
                });
                $(".status-select").select2({
                    placeholder: "Select status"
                });
            });

            // document.getElementById("add-btn").addEventListener("click", function(e) {
            //     e.preventDefault();
            //     bootstrap.Modal.getInstance(document.getElementById("showModalAdd")).hide();
            //     const a=document.getElementById("successAlertAdd");
            //     a.style.display="block"; a.classList.add("show");
            //     setTimeout(function(){a.classList.remove("show");setTimeout(function(){a.style.display="none";},150);},3000);
            // });

            document.getElementById("update-btn").addEventListener("click", function(e) {
                e.preventDefault();
                bootstrap.Modal.getInstance(document.getElementById("showModal")).hide();
                const a = document.getElementById("successAlertUpdate");
                a.style.display = "block";
                a.classList.add("show");
                setTimeout(function() {
                    a.classList.remove("show");
                    setTimeout(function() {
                        a.style.display = "none";
                    }, 150);
                }, 3000);
            });

            // document.getElementById("delete-record").addEventListener("click", function() {
            //     bootstrap.Modal.getInstance(document.getElementById("deleteRecordModal")).hide();
            //     const a=document.getElementById("successAlert");
            //     a.style.display="block";
            //     setTimeout(function(){a.classList.add("show");},10);
            //     setTimeout(function(){a.classList.remove("show");setTimeout(function(){a.style.display="none";},150);},3000);
            // });

            document.getElementById("member-image-input").addEventListener("change", function() {
                const img = document.getElementById("member-img"),
                    file = this.files[0],
                    r = new FileReader();
                r.addEventListener("load", function() {
                    img.src = r.result;
                }, false);
                if (file) {
                    r.readAsDataURL(file);
                }
            });

            const editSwitch = document.getElementById("editUser"),
                editLabel = document.querySelector("label[for='editUser']");
            editSwitch.addEventListener("change", function() {
                if (this.checked) {
                    this.value = "active";
                    editLabel.textContent = "Active";
                    editLabel.classList.remove("text-danger");
                    editLabel.classList.add("text-success");
                } else {
                    this.value = "inactive";
                    editLabel.textContent = "Inactive";
                    editLabel.classList.remove("text-success");
                    editLabel.classList.add("text-danger");
                }
            });

            const addSwitch = document.getElementById("addUser"),
                addLabel = document.querySelector("label[for='addUser']");
            addSwitch.addEventListener("change", function() {
                if (this.checked) {
                    this.value = "active";
                    addLabel.textContent = "Active";
                    addLabel.classList.remove("text-danger");
                    addLabel.classList.add("text-success");
                } else {
                    this.value = "inactive";
                    addLabel.textContent = "Inactive";
                    addLabel.classList.remove("text-success");
                    addLabel.classList.add("text-danger");
                }
            });

            document.addEventListener("DOMContentLoaded", function() {
                var ct = document.getElementById("coinType"),
                    mw = document.getElementById("memberWrapper"),
                    mi = document.getElementById("addwmemberid"),
                    pw = document.getElementById("platformWrapper"),
                    pi = document.getElementById("addwplatform");

                function tr() {
                    if (ct.value === "bronze") {
                        mw.style.display = "none";
                        mi.removeAttribute("required");
                        pw.style.display = "none";
                        pi.removeAttribute("required");
                    } else if (ct.value === "silver" || ct.value === "gold") {
                        mw.style.display = "block";
                        mi.setAttribute("required", "required");
                        pw.style.display = "block";
                        pi.setAttribute("required", "required");
                    } else {
                        mw.style.display = "none";
                        pw.style.display = "none";
                    }
                }
                ct.addEventListener("change", tr);
                tr();

                var ec = document.getElementById("edit-coin"),
                    emw = document.getElementById("editmemberWrapper"),
                    emi = document.getElementById("editwmemberid"),
                    epw = document.getElementById("editplatformWrapper"),
                    epi = document.getElementById("editwplatform");

                function ter() {
                    if (ec.value === "bronze") {
                        emw.style.display = "none";
                        emi.removeAttribute("required");
                        epw.style.display = "none";
                        epi.removeAttribute("required");
                    } else if (ec.value === "silver" || ec.value === "gold") {
                        emw.style.display = "block";
                        emi.setAttribute("required", "required");
                        epw.style.display = "block";
                        epi.setAttribute("required", "required");
                    } else {
                        emw.style.display = "none";
                        epw.style.display = "none";
                    }
                }
                ec.addEventListener("change", ter);
                ter();

                /* ─── Send Invite button ─── */
                document.querySelectorAll(".send-invite-btn").forEach(function(btn) {
                    btn.addEventListener("click", function() {
                        Swal.fire({
                            html: '<div class="mt-3 text-center"><span class="ri-mail-send-line fs-1 text-success"></span><h3 class="text-success mt-4 mb-0">Invite Sent Successfully</h3></div>',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            allowOutsideClick: false
                        });
                    });
                });
            });
        </script>


        <script>
            document.addEventListener("click", function(e) {
                var btn = e.target.closest(".tg-notify-btn");
                if (!btn) return;
                var name = btn.dataset.name || "User";
                var email = btn.dataset.email || "";
                var phone = btn.dataset.phone || "";
                Swal.fire({
                    html: '<div style="text-align:center;padding:20px 0 8px;">' +
                        '<div style="width:72px;height:72px;background:linear-gradient(135deg,#6f42c1,#a07fd4);border-radius:50%;display:inline-flex;align-items:center;justify-content:center;margin-bottom:18px;box-shadow:0 6px 20px rgba(111,66,193,0.35);">' +
                        '<i class="ri-rocket-line" style="font-size:32px;color:#fff;"></i>' +
                        '</div>' +
                        '<h4 style="font-weight:700;color:#212529;margin-bottom:10px;">Notification Sent!</h4>' +
                        '<p style="color:#6c757d;font-size:14px;margin:0 0 6px;">' +
                        'Notification successfully sent to' +
                        '</p>' +
                        '<p style="margin:0;">' +
                        '<strong style="color:#6f42c1;font-size:15px;">' + name + '</strong>' +
                        '</p>' +
                        (email ? '<p style="font-size:12px;color:#aaa;margin:4px 0 0;">' + email + '</p>' :
                        '') +
                        (phone ? '<p style="font-size:12px;color:#aaa;margin:2px 0 0;">📞 ' + phone + '</p>' :
                            '') +
                        '</div>',
                    showConfirmButton: true,
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#6f42c1',
                    timer: 4000,
                    timerProgressBar: true,
                    allowOutsideClick: true
                });
            });
        </script>


<script>
    const ALL_PLANS = @json($coins);
</script>
        <!-- ─── Upgrade Modal Logic ─── -->
<!-- ─── Dynamic Upgrade Modal Logic ─── -->
{{-- <script>
    // Pass upgrade rules from Laravel
    const UPGRADE_RULES = @json($upgradeRules ?? []);

    let _upSelected = null;

    document.getElementById('upgradeModal').addEventListener('show.bs.modal', function(e) {
        const btn = e.relatedTarget;
        if (!btn) return;

        const currentCoin = (btn.dataset.coin || 'Bronze').trim();
        const name = btn.dataset.name || '';
        const userid = btn.dataset.userid || '';
        const avatar = btn.dataset.avatar || '';
     const wingooid       = btn.dataset.wingooid || '';
const wingooPlatform = btn.dataset.wingooPlatform || '';

        _upSelected = null;

        // Fill basic info
        document.getElementById('upUserId').textContent = userid;
        document.getElementById('upName').textContent = name;
   document.getElementById('upWingooPlatform').value = wingooPlatform;
document.getElementById('upWingooIdInput').value  = wingooid;

        // Current coin badge
        const currentBadge = document.getElementById('upCoinType');
        currentBadge.textContent = currentCoin;
        currentBadge.className = `up-badge-coin ${currentCoin}`;

        // Reset upgrade to section
        const upgradeToBadge = document.getElementById('upUpgradeTo');
        upgradeToBadge.textContent = 'Select plan';
        upgradeToBadge.className = 'up-badge-coin empty';

        document.getElementById('upFlowFrom').textContent = currentCoin + ' Plan';
        const flowTo = document.getElementById('upFlowTo');
        flowTo.textContent = 'Select a plan';
        flowTo.className = 'up-flow-cell-val empty';
        document.getElementById('upConfirmBtn').disabled = true;

        // Avatar handling
        const img = document.getElementById('upAvatarImg');
        const icon = document.getElementById('upAvatarIcon');
        if (avatar) {
            img.src = avatar;
            img.style.display = 'block';
            icon.style.display = 'none';
        } else {
            img.style.display = 'none';
            icon.style.display = 'inline';
        }

        // === Dynamic Plans ===
        const allowedUpgrades = UPGRADE_RULES[currentCoin] || [];
        const grid = document.getElementById('upPlans');
        grid.innerHTML = '';
        grid.className = 'up-plans ' + (allowedUpgrades.length >= 2 ? 'cols-2' : 'cols-1');

        if (allowedUpgrades.length === 0) {
            grid.innerHTML = `<p class="text-muted text-center py-4">You are already on the highest plan (Gold).</p>`;
            return;
        }

        // Get full coin details from $coins (passed from controller)
        const allCoins = @json($coins);

        allowedUpgrades.forEach(function(nextPlanName) {
            const coinData = allCoins.find(c => c.name === nextPlanName) || { name: nextPlanName };

            const card = document.createElement('div');
            card.className = `up-plan-card ${nextPlanName}`;
            card.dataset.plan = nextPlanName;

            const iconEmoji = nextPlanName === 'Gold' ? '🥇' : (nextPlanName === 'Silver' ? '🥈' : '🥉');

            card.innerHTML = `
                <div class="up-plan-radio"></div>
                <div class="up-plan-icon">${iconEmoji}</div>
                <div>
                    <div class="up-plan-name">${nextPlanName} Plan</div>
                    <div class="up-plan-sub">${coinData.mining_period ? coinData.mining_period + ' month journey' : '1 year journey'}</div>
                </div>
            `;

            card.addEventListener('click', () => upSelectPlan(nextPlanName));
            grid.appendChild(card);
        });

        // Auto select if only one option (Silver → only Gold)
        if (allowedUpgrades.length === 1) {
            upSelectPlan(allowedUpgrades[0]);
        }
    });

    function upSelectPlan(planName) {
        _upSelected = planName;

        document.querySelectorAll('.up-plan-card').forEach(card => {
            card.classList.toggle('selected', card.dataset.plan === planName);
        });

        // Update badges
        const ut = document.getElementById('upUpgradeTo');
        ut.textContent = planName;
        ut.className = `up-badge-coin ${planName}`;

        const flowTo = document.getElementById('upFlowTo');
        flowTo.textContent = planName + ' Plan';
        flowTo.className = 'up-flow-cell-val';

        document.getElementById('upConfirmBtn').disabled = false;
    }

    // function doUpgradeConfirm() {
    //     if (!_upSelected) return;

    //     const name = document.getElementById('upName').textContent;

    //     bootstrap.Modal.getInstance(document.getElementById('upgradeModal')).hide();

    //     const alertBox = document.getElementById('successAlertUpgrade');
    //     document.getElementById('upgradeAlertText').textContent = 
    //         `${name} successfully upgraded to ${_upSelected} Plan.`;

    //     alertBox.style.display = 'block';
    //     setTimeout(() => alertBox.classList.add('show'), 10);

    //     setTimeout(() => {
    //         alertBox.classList.remove('show');
    //         setTimeout(() => { alertBox.style.display = 'none'; }, 200);
    //     }, 3500);
    // }
function doUpgradeConfirm() {
    if (!_upSelected || !_currentUserId) {
        alert("Please select a plan");
        return;
    }

    if (!confirm(`Upgrade to ${_upSelected} Plan?`)) {
        return;
    }

    const form = document.createElement('form');
    form.method = "POST";
    form.action = "{{ route('admin.users.upgrade') }}";

    form.innerHTML = `
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="user_id" value="${_currentUserId}">
        <input type="hidden" name="coin_type" value="${_upSelected}">
        <input type="hidden" name="wingoo_platform" value="${document.getElementById('upWingooPlatform').value}">
        <input type="hidden" name="wingoo_id" value="${document.getElementById('upWingooIdInput').value}">
    `;

    document.body.appendChild(form);
    form.submit();
}
    
</script> --}}



<script>
    let _upSelected = null;
    let _currentUserId = null;

    // Modal Open ஆகும் போது
    document.getElementById('upgradeModal').addEventListener('show.bs.modal', function(e) {
        const btn = e.relatedTarget;
        if (!btn) return;

        _currentUserId = btn.dataset.user_id;   // ← Real user ID

        const currentCoin = (btn.dataset.coin || 'Bronze').trim();
        const name         = btn.dataset.name || '';
        const userid       = btn.dataset.userid || '';
        const avatar       = btn.dataset.avatar || '';
        const wingooid     = btn.dataset.wingooid || '';
        const wingooPlatform = btn.dataset.wingooPlatform || ''; 
        

        _upSelected = null;

        // Fill details
        document.getElementById('upUserId').textContent = userid;
        document.getElementById('upName').textContent = name;
        document.getElementById('upWingooPlatform').value = wingooPlatform;  
        document.getElementById('upWingooIdInput').value = wingooid;

        // Current coin
        const currentBadge = document.getElementById('upCoinType');
        currentBadge.textContent = currentCoin;
        currentBadge.className = `up-badge-coin ${currentCoin}`;

        // Reset upgrade to
        document.getElementById('upUpgradeTo').textContent = 'Select plan';
        document.getElementById('upUpgradeTo').className = 'up-badge-coin empty';

        document.getElementById('upFlowFrom').textContent = currentCoin + ' Plan';
        const flowTo = document.getElementById('upFlowTo');
        flowTo.textContent = 'Select a plan';
        flowTo.className = 'up-flow-cell-val empty';
        document.getElementById('upConfirmBtn').disabled = true;

        // Avatar
        const img = document.getElementById('upAvatarImg');
        const icon = document.getElementById('upAvatarIcon');
        if (avatar) {
            img.src = avatar;
            img.style.display = 'block';
            icon.style.display = 'none';
        } else {
            img.style.display = 'none';
            icon.style.display = 'inline';
        }

        // Dynamic Plans
        const allowedUpgrades = @json($upgradeRules ?? []);
        const allowed = allowedUpgrades[currentCoin] || [];
        const grid = document.getElementById('upPlans');
        grid.innerHTML = '';
        grid.className = 'up-plans ' + (allowed.length >= 2 ? 'cols-2' : 'cols-1');

        // if (allowed.length === 0) {
        //     grid.innerHTML = `<p class="text-muted text-center py-4">You are already on the highest plan.</p>`;
        //     return;
        // }




// if (allowed.length === 0) {
//     const isHighest = currentCoin === 'Gold';
//     grid.innerHTML = `<p class="text-muted text-center py-4">
//         ${isHighest 
//             ? 'You are already on the highest plan.' 
//             : 'No upgrade plans are currently available.'}
//     </p>`;
//     return;
// }



const progress = parseFloat(btn.dataset.progress || 0);
if (progress >= 100) {
    grid.innerHTML = `
        <div style="width:100%; background:#f0faf3; border:1px solid #b7dfbf; border-radius:8px; padding:12px 16px; display:flex; align-items:center; gap:10px; color:#2d6a4f;">
            <span style="font-size:22px; flex-shrink:0;">🎉</span>
            <div style="font-size:13.5px; line-height:1.6;">
                <strong>Congratulations!</strong> You have completed your 
                <strong>${currentCoin} Plan</strong> (24 months). 
                Upgrade is not allowed.
            </div>
        </div>
    `;
    document.getElementById('upConfirmBtn').disabled = true;
    return;
}
if (allowed.length === 0) {
    const isHighest = currentCoin === 'Gold';
    grid.innerHTML = `<p class="text-muted text-center py-4">
        ${isHighest 
            ? 'You are already on the highest plan.' 
            : 'No upgrade plans are currently available.'}
    </p>`;
    document.getElementById('upConfirmBtn').disabled = true;
    return;
}



        const allCoins = @json($coins);

        allowed.forEach(function(nextPlanName) {
            const coinData = allCoins.find(c => c.name === nextPlanName) || {};
            const iconEmoji = nextPlanName === 'Gold' ? '🥇' : (nextPlanName === 'Silver' ? '🥈' : '🥉');

            const card = document.createElement('div');
            card.className = `up-plan-card ${nextPlanName}`;
            card.dataset.plan = nextPlanName;
            card.innerHTML = `
                <div class="up-plan-radio"></div>
                <div class="up-plan-icon">${iconEmoji}</div>
                <div>
                    <div class="up-plan-name">${nextPlanName} Plan</div>
                    <div class="up-plan-sub">${coinData.mining_period ? coinData.mining_period + ' month journey' : '1 year journey'}</div>
                </div>
            `;
            card.addEventListener('click', () => upSelectPlan(nextPlanName));
            grid.appendChild(card);
        });

        if (allowed.length === 1) upSelectPlan(allowed[0]);
    });

    function upSelectPlan(planName) {
        _upSelected = planName;

        document.querySelectorAll('.up-plan-card').forEach(card => {
            card.classList.toggle('selected', card.dataset.plan === planName);
        });

        const ut = document.getElementById('upUpgradeTo');
        ut.textContent = planName;
        ut.className = `up-badge-coin ${planName}`;

        const flowTo = document.getElementById('upFlowTo');
        flowTo.textContent = planName + ' Plan';
        flowTo.className = 'up-flow-cell-val';

        document.getElementById('upConfirmBtn').disabled = false;
    }

    // Confirm & Submit
    function doUpgradeConfirm() {
        if (!_upSelected) {
            alert("Please select a plan to upgrade");
            return;
        }
        if (!_currentUserId) {
            alert("User ID not found. Please refresh the page and try again.");
            return;
        }

        // if (confirm(`Are you sure you want to upgrade to ${_upSelected} Plan?`)) {
        //     const form = document.createElement('form');
        //     form.method = "POST";
        //     form.action = "{{ route('admin.users.upgrade') }}";

        //     form.innerHTML = `
        //         <input type="hidden" name="_token" value="{{ csrf_token() }}">
        //         <input type="hidden" name="user_id" value="${_currentUserId}">
        //         <input type="hidden" name="coin_type" value="${_upSelected}">
        //         <input type="hidden" name="wingoo_platform" value="${document.getElementById('upWingooPlatform').value}">
        //         <input type="hidden" name="wingoo_id" value="${document.getElementById('upWingooIdInput').value}">
        //     `;

        //     document.body.appendChild(form);
        //     form.submit();
        // }


const form = document.createElement('form');
form.method = "POST";
form.action = "{{ route('admin.users.upgrade') }}";

form.innerHTML = `
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="user_id" value="${_currentUserId}">
    <input type="hidden" name="coin_type" value="${_upSelected}">
    <input type="hidden" name="wingoo_platform" value="${document.getElementById('upWingooPlatform').value}">
    <input type="hidden" name="wingoo_id" value="${document.getElementById('upWingooIdInput').value}">
`;

document.body.appendChild(form);
form.submit();






    }
</script>









        <script>
            $(document).ready(function() {
                if ($.fn.DataTable.isDataTable('#manageUser')) {
                    $('#manageUser').DataTable().destroy();
                }
                $('#manageUser').DataTable({
                    responsive: true,
                    dom: "<'row mb-3'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row mt-3'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                    buttons: [{
                            extend: 'csv',
                            className: 'btn btn-light btn-sm border',
                            text: 'CSV'
                        },
                        {
                            extend: 'excel',
                            className: 'btn btn-light btn-sm border',
                            text: 'Excel'
                        },
                        {
                            extend: 'print',
                            className: 'btn btn-light btn-sm border',
                            text: 'Print'
                        },
                        {
                            extend: 'pdf',
                            className: 'btn btn-light btn-sm border',
                            text: 'PDF'
                        }
                    ],
                    language: {
                        search: "Search:",
                        searchPlaceholder: ""
                    }
                });
            });
        </script>



        <script>
            let deleteUserId = null;

            // Step 1: store user id when button clicked
            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    deleteUserId = this.getAttribute('data-id');
                });
            });

            // Step 2: submit form when "Yes Delete" clicked
            document.getElementById('delete-record').addEventListener('click', function() {

                let form = document.getElementById('deleteForm');

                // route set pannum
                let url = "{{ route('users.delete', ':id') }}";
                url = url.replace(':id', deleteUserId);

                form.action = url;

                form.submit(); // 🔥 this will delete
            });
        </script>
        <script>
            document.getElementById('delete-record').addEventListener('click', function() {
                let btn = this;

                // Disable button + show spinner
                btn.disabled = true;
                btn.querySelector('.btn-text').textContent = 'Processing...';
                btn.querySelector('.spinner-border').classList.remove('d-none');

                // Submit form
                let form = document.getElementById('deleteForm');
                form.action = `/admin/users/${deleteUserId}`;
                form.submit();
            });
        </script>

        <script>
            $(document).ready(function() {

                $('#countrySelect').select2({
                    dropdownParent: $('#showModalAdd'), // ✅ FIX
                    placeholder: "Search Country",
                    width: '100%'
                });

            });
        </script>
        {{-- ✅ FIRST — Laravel errors variable --}}
        <script>
            var laravelErrors = @json($errors->toArray());
        </script>

        {{-- ✅ SECOND — Country/Phone/Postal validation --}}
        <script>
            document.addEventListener("DOMContentLoaded", function() {

                let phone = document.getElementById("phoneInput");
                let postal = document.getElementById("postalInput");
                let phoneError = document.getElementById("phoneError");
                let postalError = document.getElementById("postalError");
                let min = 0;
                let max = 15;
                let postalRegex = null;

                $('#countrySelect').on('change', function() {
                    let selected = this.options[this.selectedIndex];
                    min = selected.getAttribute("data-phone-min") || 6;
                    max = selected.getAttribute("data-phone-max") || 15;
                    postalRegex = selected.getAttribute("data-postal");
                    phone.value = "";
                    postal.value = "";
                    phoneError.classList.add("d-none");
                    postalError.classList.add("d-none");
                });

                phone.addEventListener("input", function() {
                    let value = this.value.replace(/\D/g, '');
                    if (value.length > max) value = value.slice(0, max);
                    this.value = value;
                    if (value.length < min) {
                        phoneError.innerText = `Phone must be ${min} digits`;
                        phoneError.classList.remove("d-none");
                    } else {
                        phoneError.classList.add("d-none");
                    }
                });

                postal.addEventListener("input", function() {
                    let value = this.value;
                    if (postalRegex && postalRegex !== "NULL") {
                        let regex = new RegExp(postalRegex);
                        if (!regex.test(value)) {
                            postalError.innerText = "Invalid postal code format";
                            postalError.classList.remove("d-none");
                        } else {
                            postalError.classList.add("d-none");
                        }
                    } else {
                        postalError.classList.add("d-none");
                    }
                });

            });
        </script>
{{-- ✅ FULL SCRIPT — Form Validation + Backend Errors + DOB 18+ + Email AJAX + Select2 Fix --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {

        // 1. Backend Errors from Laravel
        var laravelErrors = @json($errors->toArray());
        var addForm = document.querySelector('#showModalAdd form');
        if (!addForm) return;

        addForm.setAttribute('novalidate', true);

        // ✅ DOB real-time 18+ check
        let dobInput = addForm.querySelector('[name="dob"]');
        if (dobInput) {
            dobInput.addEventListener('change', function() {
                let old = this.parentNode.querySelector('.inline-error');
                if (old) old.remove();
                if (!this.value) return;

                let birthDate = new Date(this.value);
                let today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
                let m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) age--;

                if (age < 18) {
                    let small = document.createElement('small');
                    small.className = 'text-danger inline-error d-block mt-1';
                    small.textContent = 'User must be at least 18 years old';
                    this.parentNode.appendChild(small);
                }
            });
        }

        // ✅ Photo real-time validation
        let photoInput = addForm.querySelector('[name="photo"]');
        if (photoInput) {
            photoInput.addEventListener('change', function() {
                let old = this.parentNode.querySelector('.inline-error');
                if (old) old.remove();
                if (!this.files || !this.files[0]) return;

                let allowed = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
                if (!allowed.includes(this.files[0].type)) {
                    let small = document.createElement('small');
                    small.className = 'text-danger inline-error d-block mt-1';
                    small.textContent = 'Only JPG, PNG, WEBP formats allowed';
                    this.parentNode.appendChild(small);
                    this.value = ''; 
                }
            });
        }

        // ✅ Real-time Email AJAX Check + Format Check
        let emailInput = addForm.querySelector('[name="email"]');
        if (emailInput) {
            emailInput.addEventListener('blur', function() {
                let email = this.value.trim();
                let el = this;
                
                // Email pattern (Checks for @ and dot)
                let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                
                let old = el.parentNode.querySelector('.inline-error');
                if (old) old.remove();
                el.classList.remove('is-invalid');

                if (!email) return;

                if (!emailPattern.test(email)) {
                    let small = document.createElement('small');
                    small.className = 'text-danger inline-error d-block mt-1';
                    small.textContent = 'Please enter a valid email (e.g. name@example.com)';
                    el.parentNode.appendChild(small);
                    el.classList.add('is-invalid');
                    return;
                }

                // AJAX Check if format is okay
                fetch("{{ route('admin.users.checkEmail') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ email: email })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        let small = document.createElement('small');
                        small.className = 'text-danger inline-error d-block mt-1';
                        small.textContent = 'This email is already registered';
                        el.parentNode.appendChild(small);
                        el.classList.add('is-invalid');
                    }
                });
            });
        }

        // ✅ Backend errors — show under fields + auto open modal
        if (typeof laravelErrors !== 'undefined' && Object.keys(laravelErrors).length > 0) {
            const fieldMap = {
                'name': '[name="name"]',
                'email': '[name="email"]',
                'dob': '[name="dob"]',
                'country_id': '[name="country_id"]',
                'phone': '[name="phone"]',
                'postal_code': '[name="postal_code"]',
                'coin_type': '[name="coin_type"]',
                'platform': '[name="platform"]',
                'wingoo_id': '[name="wingoo_id"]',
            };

            Object.keys(laravelErrors).forEach(function(field) {
                let selector = fieldMap[field];
                if (!selector) return;
                let el = addForm.querySelector(selector);
                if (!el) return;
                let old = el.parentNode.querySelector('.inline-error');
                if (old) old.remove();
                let small = document.createElement('small');
                small.className = 'text-danger inline-error d-block mt-1';
                small.textContent = laravelErrors[field][0];
                el.parentNode.appendChild(small);
            });

            new bootstrap.Modal(document.getElementById('showModalAdd')).show();
        }

        // ✅ Frontend validation on submit
        addForm.addEventListener('submit', function(e) {
            e.preventDefault();
            let isValid = true;

            addForm.querySelectorAll('.inline-error').forEach(el => el.remove());

            function showError(el, message) {
                let small = document.createElement('small');
                small.className = 'text-danger inline-error d-block mt-1';
                small.textContent = message;
                el.parentNode.appendChild(small);
                isValid = false;

                document.getElementById('add-btn-text').textContent = 'Add User';
                document.getElementById('add-btn-spinner').classList.add('d-none');
                document.getElementById('add-btn').disabled = false;
            }

            // Name
            let name = addForm.querySelector('[name="name"]');
            if (name && !name.value.trim()) showError(name, 'User Name is required');

            // Email
            let email = addForm.querySelector('[name="email"]');
            if (email) {
                let val = email.value.trim();
                let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!val) {
                    showError(email, 'Email Id is required');
                } else if (!emailPattern.test(val)) {
                    showError(email, 'Please enter a valid email address');
                } else if (email.classList.contains('is-invalid')) {
                    showError(email, 'This email is already registered');
                }
            }

            // DOB
            let dob = addForm.querySelector('[name="dob"]');
            if (dob && !dob.value.trim()) {
                showError(dob, 'Date of Birth is required');
            } else if (dob && dob.value) {
                let birthDate = new Date(dob.value);
                let today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
                let m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) age--;
                if (age < 18) showError(dob, 'User must be at least 18 years old');
            }

            // Country
            let country = addForm.querySelector('[name="country_id"]');
            if (country && !country.value) showError(country, 'Country is required');

            // Phone
            let phone = addForm.querySelector('[name="phone"]');
            if (phone && !phone.value.trim()) showError(phone, 'Phone Number is required');

            // Postal Code
            let postal = addForm.querySelector('[name="postal_code"]');
            if (postal && !postal.value.trim()) showError(postal, 'Postal Code is required');

            // Coin Type
            let coin = addForm.querySelector('[name="coin_type"]');
            if (coin && !coin.value) showError(coin, 'Coin Type is required');

            if (isValid) {
                document.getElementById('add-btn-text').textContent = 'Processing...';
                document.getElementById('add-btn-spinner').classList.remove('d-none');
                document.getElementById('add-btn').disabled = true;
                addForm.submit();
            }
        });

        // ✅ Clear error on typing
        addForm.querySelectorAll('input, select').forEach(function(el) {
            if (el.name === 'dob') return; 
            el.addEventListener('input', function() {
                let err = this.parentNode.querySelector('.inline-error');
                if (err) err.remove();
                if (this.name === 'email') this.classList.remove('is-invalid');
            });
        });

        // ✅ FIX: Clear Country Error on Select2 Change
        $(document).ready(function() {
            $('#countrySelect').on('change', function() {
                let err = this.parentNode.querySelector('.inline-error');
                if (err) err.remove();
            });
        });

    });
</script>

     <script>
        $(document).on('change', '.mining-status-toggle', function () {
            const checkbox = $(this);
            const userId   = checkbox.data('user-id');
            const label    = checkbox.closest('.status-switch').find('label');

            $.ajax({
                url: `/admin/users/${userId}/toggle-mining`,
                method: 'POST',
                data: { _token: '{{ csrf_token() }}' },
                success: function (res) {
                    if (res.is_active) {
                        label.text('Active')
                             .removeClass('text-danger')
                             .addClass('text-success');
                    } else {
                        label.text('Inactive')
                             .removeClass('text-success')
                             .addClass('text-danger');
                    }
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: res.message,
                        showConfirmButton: false,
                        timer: 2000
                    });
                },
                error: function (xhr) {
                    // ❌ Revert toggle if failed
                    checkbox.prop('checked', !checkbox.prop('checked'));
                    Swal.fire('Error', xhr.responseJSON?.message || 'Something went wrong', 'error');
                }
            });
        });
    </script>



<script>
// ✅ Edit button click → load data
$(document).on('click', '.edit-user-btn', function () {
    const userId = $(this).data('id');

    $('.edit-error').text('');

    $.ajax({
        url: `/admin/users/${userId}/edit`,
        method: 'GET',
        success: function (res) {
            $('#editUserForm').attr('action', `/admin/users/${res.id}`);

            document.getElementById('editUserCode').value       = res.user_code;
            document.getElementById('editName').value           = res.name;
            document.getElementById('editEmail').value          = res.email;
            document.getElementById('editPhone').value          = res.phone;
            document.getElementById('editDob').value            = res.dob;
            document.getElementById('editPostal').value         = res.postal_code ?? '';
            document.getElementById('editWingooPlatform').value = res.wingoo_platform ?? '';
            document.getElementById('editWingooId').value       = res.winngoo_id ?? '';
            document.getElementById('edit-member-img').src      = res.photo;

            // ✅ Set country with Select2
            $('#editCountry').val(res.country_id).trigger('change');

            // ✅ Load validation rules WITHOUT clearing loaded phone/postal
            setTimeout(function () {
                let selected = document.getElementById('editCountry');
                let option = selected.options[selected.selectedIndex];
                if (option) {
                    window._editMin = parseInt(option.getAttribute("data-phone-min")) || 6;
                    window._editMax = parseInt(option.getAttribute("data-phone-max")) || 15;
                    window._editPostalRegex = option.getAttribute("data-postal");

                    // Push into the closure variables via a custom event
                    document.getElementById('editCountry').dispatchEvent(
                        new CustomEvent('applyOnly')
                    );
                }
            }, 100);
        },
        error: function () {
            Swal.fire('Error', 'Failed to load user data', 'error');
        }
    });
});

// ✅ Photo preview
document.getElementById('edit-image-input').addEventListener('change', function () {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = e => document.getElementById('edit-member-img').src = e.target.result;
        reader.readAsDataURL(file);
    }
});

// ✅ Backend validation errors — modal re-open
// @if(session('edit_user_id'))
//     $(document).ready(function () {
//         new bootstrap.Modal(document.getElementById('showModal')).show();

//         @foreach($errors->edit->toArray() as $field => $messages)
//             $('#err-{{ $field }}').text('{{ $messages[0] }}');
//         @endforeach
//     });
// @endif
</script>


<script>
document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById('editUserForm');
    if (!form) return;

    let phone = document.getElementById("editPhone");
    let postal = document.getElementById("editPostal");
    let country = document.getElementById("editCountry");
    let dob = document.getElementById("editDob");

    let min = 0;
    let max = 15;
    let postalRegex = null;

    // ✅ Initialize Select2 on Edit Country
    $('#editCountry').select2({
        dropdownParent: $('#showModal'),
        placeholder: "Search Country",
        width: '100%'
    });

    // ✅ Apply country attributes function
    function applyCountryAttributes(skipClear = false) {
        let selected = country.options[country.selectedIndex];
        if (!selected) return;

        min = parseInt(selected.getAttribute("data-phone-min")) || 6;
        max = parseInt(selected.getAttribute("data-phone-max")) || 15;
        postalRegex = selected.getAttribute("data-postal");

        if (!skipClear) {
            phone.value = "";
            postal.value = "";
            document.getElementById('err-phone').innerText = '';
            document.getElementById('err-postal').innerText = '';
        }
    }

    // ✅ Select2 country change — user manually selects
    $('#editCountry').on('select2:select', function () {
        applyCountryAttributes(false);
    });

    // ✅ Phone validation
    phone.addEventListener("input", function () {
        let value = this.value.replace(/\D/g, '');

        if (value.length > max) value = value.slice(0, max);
        this.value = value;

        if (value && value.length < min) {
            document.getElementById('err-phone').innerText = `Phone must be at least ${min} digits`;
        } else {
            document.getElementById('err-phone').innerText = '';
        }
    });

    // ✅ Postal validation
    postal.addEventListener("input", function () {
        let value = this.value;

        if (postalRegex && postalRegex !== "NULL") {
            let regex = new RegExp(postalRegex);

            if (value && !regex.test(value)) {
                document.getElementById('err-postal').innerText = "Invalid postal code format";
            } else {
                document.getElementById('err-postal').innerText = '';
            }
        } else {
            document.getElementById('err-postal').innerText = '';
        }
    });

    // ✅ DOB 18+ validation
    dob.addEventListener('change', function () {

        if (!this.value) {
            document.getElementById('err-dob').innerText = '';
            return;
        }

        let birthDate = new Date(this.value);
        let today = new Date();

        let age = today.getFullYear() - birthDate.getFullYear();
        let m = today.getMonth() - birthDate.getMonth();

        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }

        if (age < 18) {
            document.getElementById('err-dob').innerText = 'User must be at least 18 years old';
        } else {
            document.getElementById('err-dob').innerText = '';
        }
    });

    // ✅ Submit validation
    // form.addEventListener('submit', function (e) {

    //     let isValid = true;

    //     // Clear old errors
    //     document.querySelectorAll('#editUserForm small.text-danger').forEach(el => el.innerText = '');

    //     // DOB check
    //     if (dob.value) {
    //         let birthDate = new Date(dob.value);
    //         let today = new Date();

    //         let age = today.getFullYear() - birthDate.getFullYear();
    //         let m = today.getMonth() - birthDate.getMonth();

    //         if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
    //             age--;
    //         }

    //         if (age < 18) {
    //             document.getElementById('err-dob').innerText = 'User must be at least 18 years old';
    //             isValid = false;
    //         }
    //     }

    //     // Phone error check
    //     if (document.getElementById('err-phone').innerText !== '') {
    //         isValid = false;
    //     }

    //     // Postal error check
    //     if (document.getElementById('err-postal').innerText !== '') {
    //         isValid = false;
    //     }

    //     if (!isValid) {
    //         e.preventDefault();
    //         return;
    //     }

    //     // ✅ Loader
    //     document.getElementById('edit-btn-text').textContent = 'Processing...';
    //     document.getElementById('edit-btn-spinner').classList.remove('d-none');
    //     document.getElementById('edit-update-btn').disabled = true;
    // });


form.addEventListener('submit', function (e) {

    let isValid = true;

    // Clear old errors
    document.querySelectorAll('#editUserForm small.text-danger').forEach(el => el.innerText = '');

    // ✅ Name check
    let name = document.getElementById('editName');
    if (!name.value.trim()) {
        document.getElementById('err-name').innerText = 'User Name is required';
        isValid = false;
    }

    // ✅ DOB check
    if (!dob.value) {
        document.getElementById('err-dob').innerText = 'Date of Birth is required';
        isValid = false;
    } else {
        let birthDate = new Date(dob.value);
        let today = new Date();
        let age = today.getFullYear() - birthDate.getFullYear();
        let m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) age--;
        if (age < 18) {
            document.getElementById('err-dob').innerText = 'User must be at least 18 years old';
            isValid = false;
        }
    }

    // ✅ Country check
    let countryVal = document.getElementById('editCountry').value;
    if (!countryVal) {
        document.getElementById('err-country').innerText = 'Country is required';
        isValid = false;
    }

    // ✅ Phone check
    if (!phone.value.trim()) {
        document.getElementById('err-phone').innerText = 'Phone is required';
        isValid = false;
    } else if (document.getElementById('err-phone').innerText !== '') {
        isValid = false;
    }

    // ✅ Postal error check
    if (document.getElementById('err-postal').innerText !== '') {
        isValid = false;
    }

    if (!isValid) {
        e.preventDefault();
        return;
    }

    // ✅ Show loader only if valid
    document.getElementById('edit-btn-text').textContent = 'Processing...';
    document.getElementById('edit-btn-spinner').classList.remove('d-none');
    document.getElementById('edit-update-btn').disabled = true;
});



});
</script>





    @endpush
@endsection
