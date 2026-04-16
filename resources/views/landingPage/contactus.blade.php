<!DOCTYPE html>
<html lang="en" xml:lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('assets/pages/images/coin-favi.png') }}" type="image/x-icon"/>
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800" rel="stylesheet">
    <title>Contact Us – Winngoo Coin</title>
    <link rel="stylesheet" href="{{ asset('assets/pages/css/fontawesome.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/pages/css/bootstrap.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/pages/css/animate.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/pages/css/coin.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/pages/css/style.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/pages/css/responsive.css') }}"/>

    <style>
/* ── ROOT TOKENS ─────────────────────── */
:root {
    --gold: #fbbd18;
    --gold2: #f0931e;
    --dark: #1a1c22;
    --mid:  #616161;
    --lite: #f5f3ee;
    --white: #ffffff;
    --border: #e8e4d8;
}
.copy-text.text-center a{
    color:rgb(251 189 16);
}
a{
    text-decoration:none !important;
}
/* ── INNER BANNER ───────────────────── */
.inner-banner {
    position: relative;
    padding-top: 160px !important;
    padding-bottom: 40px !important;
    min-height: 450px;
    display: flex; align-items: center;
    background-attachment: scroll !important;
    background-size: cover !important;
    background-position: center center !important;
}
.inner-banner:before {
    position: absolute; content: "";
    background: rgba(0,0,0,0.75);
    left:0; top:0; width:100%; height:100%;
}
.inner-banner .container { position:relative; z-index:1; width:100%; }
.hero-main:before {
    position:absolute; content:"";
    background: rgba(0,0,0,0.3);
    left:0; top:0; width:100%; height:100%;
}
.breadcrumb-custom {
    list-style:none; padding:0; margin:0;
    display:flex; flex-wrap:wrap; align-items:center;
    justify-content:center; gap:4px;
}
.breadcrumb-custom li { font-size:14px; font-family:'Poppins',sans-serif; text-transform:uppercase; letter-spacing:1px; }
.breadcrumb-custom li a { color:var(--gold); text-decoration:none; font-weight:600; }
.breadcrumb-custom li a:hover { color:var(--gold2); }
.breadcrumb-custom li.separator { margin:0 6px; color:rgba(255,255,255,.4); }
.breadcrumb-custom li.active { color:#fff; font-weight:400; }
.banner-content h1 { font-family:'Poppins',sans-serif; font-weight:700; font-size:48px; color:#fff; margin-bottom:14px; }
.banner-content h1 span { color:var(--gold); font-weight:300; }



/* ── MAIN CONTACT SECTION ───────────── */
.contact-main {
    background: var(--lite);
    position: relative;
    overflow: hidden;
}

/* animated dot-grid bg */
.contact-main:before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle, rgba(251,189,24,.18) 1px, transparent 1px);
    background-size: 32px 32px;
    pointer-events: none;
    z-index: 0;
    animation: dotDrift 20s linear infinite;
}
@keyframes dotDrift { 0%{background-position:0 0;} 100%{background-position:64px 64px;} }

.contact-main > .container { position:relative; z-index:2; }

/* ── LEFT VISUAL PANEL ──────────────── */
.cp-left {
    padding: 80px 0 80px 0;
    opacity: 0;
    transform: translateX(-40px);
    transition: all .8s ease;
}
.cp-left.in { opacity:1; transform:translateX(0); }

.cp-eyebrow {
    display: inline-flex; align-items: center; gap:8px;
    background: rgba(251,189,24,.12);
    border: 1px solid rgba(251,189,24,.3);
    border-radius: 50px; padding: 5px 16px;
    font-family:'Poppins',sans-serif; font-size:11px;
    font-weight:700; color:var(--gold);
    text-transform:uppercase; letter-spacing:1.5px;
    margin-bottom:20px;
}
.cp-eyebrow-dot { width:6px; height:6px; background:var(--gold); border-radius:50%; animation:blink 1.4s ease-in-out infinite; }
@keyframes blink { 0%,100%{opacity:1;} 50%{opacity:.25;} }

.cp-heading {
    font-family:'Poppins',sans-serif; font-weight:800;
    font-size:44px; line-height:1.1; color:var(--dark);
    margin-bottom:18px;
}
.cp-heading em { font-style:normal; color:var(--gold); }
.cp-heading span.stroke {
    -webkit-text-stroke: 2px var(--gold);
    color: transparent;
}

.cp-sub {
    font-family:'Open Sans',sans-serif; font-size:15px;
    color:var(--mid); line-height:1.75; margin-bottom:40px;
    max-width:400px;
}

/* Orbit visual */
.cp-orbit-wrap {
    position: relative;
    width: 320px; height: 320px;
    margin: 0 auto 40px;
}
.cp-orbit-ring {
    position: absolute; top:50%; left:50%;
    border-radius:50%;
    border: 1px dashed rgba(251,189,24,.25);
    transform: translate(-50%,-50%);
    animation: spinRing var(--spd,20s) linear infinite var(--dir,normal);
}
.cp-orbit-ring:nth-child(1){ width:100%; height:100%; --spd:30s; --dir:normal; }
.cp-orbit-ring:nth-child(2){ width:74%;  height:74%;  --spd:22s; --dir:reverse; border-color:rgba(251,189,24,.18); }
.cp-orbit-ring:nth-child(3){ width:48%;  height:48%;  --spd:14s; --dir:normal;  border-color:rgba(251,189,24,.35); border-style:solid; }
@keyframes spinRing { from{transform:translate(-50%,-50%) rotate(0deg);} to{transform:translate(-50%,-50%) rotate(360deg);} }

/* Center icon */
.cp-orbit-center {
    position: absolute; top:50%; left:50%;
    transform: translate(-50%,-50%);
    width:80px; height:80px;
    background: var(--gold);
    border-radius:50%;
    display:flex; align-items:center; justify-content:center;
    box-shadow: 0 0 0 12px rgba(251,189,24,.12), 0 0 0 24px rgba(251,189,24,.06);
    animation: centerPulse 3s ease-in-out infinite;
    z-index:3;
}
@keyframes centerPulse { 0%,100%{box-shadow:0 0 0 12px rgba(251,189,24,.12),0 0 0 24px rgba(251,189,24,.06);} 50%{box-shadow:0 0 0 18px rgba(251,189,24,.18),0 0 0 36px rgba(251,189,24,.08);} }
.cp-orbit-center i { font-size:32px; color:var(--dark); }

/* Orbit badges */
.cp-badge {
    position: absolute;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 10px 14px;
    display: flex; align-items: center; gap:10px;
    box-shadow: 0 4px 20px rgba(0,0,0,.08);
    white-space: nowrap;
    animation: floatBadge var(--fb-dur,4s) ease-in-out var(--fb-del,0s) infinite;
}
@keyframes floatBadge { 0%,100%{transform:translateY(0);} 50%{transform:translateY(-8px);} }
.cp-badge-ico { width:32px; height:32px; border-radius:8px; background:rgba(251,189,24,.1); display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.cp-badge-ico i { font-size:14px; color:var(--gold); }
.cp-badge-label { font-family:'Poppins',sans-serif; font-size:11px; font-weight:700; color:var(--dark); line-height:1.2; }
.cp-badge-val { font-family:'Open Sans',sans-serif; font-size:11px; color:var(--mid); line-height:1.2; }

.cp-badge-1 { top: 6%;  left:-10%; --fb-dur:4s;   --fb-del:0s; }
.cp-badge-2 { top: 6%;  right:-8%; --fb-dur:4.5s; --fb-del:1s; }
.cp-badge-3 { bottom:8%; left:-8%; --fb-dur:5s;   --fb-del:.5s; }
.cp-badge-4 { bottom:8%; right:-6%;--fb-dur:4.2s; --fb-del:1.5s;}

/* Info list */
.cp-info-list { list-style:none; padding:0; margin:0; }
.cp-info-item {
    display: flex; align-items: center; gap:14px;
    padding: 14px 0;
    border-bottom: 1px solid var(--border);
    opacity:0; transform:translateX(-20px);
    transition: all .5s ease;
}
.cp-info-item.in { opacity:1; transform:translateX(0); }
.cp-info-item:last-child { border-bottom:none; }
.cp-info-icon {
    width:40px; height:40px; border-radius:10px;
    background:var(--gold); display:flex; align-items:center;
    justify-content:center; flex-shrink:0;
    transition:transform .3s;
}
.cp-info-item:hover .cp-info-icon { transform:rotate(-8deg) scale(1.1); }
.cp-info-icon i { font-size:15px; color:var(--dark); }
.cp-info-text { flex:1; }
.cp-info-text strong { font-family:'Poppins',sans-serif; font-size:12px; font-weight:700; color:var(--dark); display:block; text-transform:uppercase; letter-spacing:.5px; margin-bottom:2px; }
.cp-info-text a, .cp-info-text span { font-family:'Open Sans',sans-serif; font-size:13px; color:var(--mid); text-decoration:none; transition:color .3s; line-height:1.5; }
.cp-info-text a:hover { color:var(--gold); }

/* ── RIGHT FORM PANEL ───────────────── */
.cp-right {
    padding: 80px 0;
    opacity:0; transform:translateX(40px);
    transition: all .8s ease .2s;
}
.cp-right.in { opacity:1; transform:translateX(0); }

.cp-form-card {
    background: var(--white);
    border-radius: 20px;
    border: 1px solid var(--border);
    box-shadow: 0 20px 60px rgba(0,0,0,.06);
    padding: 48px 44px;
    position: relative;
    overflow: hidden;
}
/* top gold bar */
.cp-form-card:before {
    content:''; position:absolute; top:0; left:0;
    width:100%; height:4px;
    background: linear-gradient(90deg, var(--gold), var(--gold2), var(--gold));
    background-size:200% 100%;
    animation: barShift 3s linear infinite;
}
@keyframes barShift { 0%{background-position:0% 50%;} 100%{background-position:200% 50%;} }

/* Decorative corner circle */
.cp-form-card:after {
    content:''; position:absolute; bottom:-60px; right:-60px;
    width:180px; height:180px;
    border-radius:50%;
    background: radial-gradient(circle, rgba(251,189,24,.08) 0%, transparent 70%);
    pointer-events:none;
}

.cp-form-title {
    font-family:'Poppins',sans-serif; font-weight:800;
    font-size:28px; color:var(--dark); margin-bottom:6px;
}
.cp-form-title span { color:var(--gold); }
.cp-form-desc { font-family:'Open Sans',sans-serif; font-size:14px; color:var(--mid); margin-bottom:32px; line-height:1.6; }

/* Step dots */
.cp-steps {
    display:flex; align-items:center; gap:6px;
    margin-bottom:28px;
}
.cp-step-dot {
    width:8px; height:8px; border-radius:50%;
    background: var(--border);
    transition: all .3s;
}
.cp-step-dot.active { background:var(--gold); width:24px; border-radius:4px; }

/* Fields */
.cpf-group { margin-bottom:22px; position:relative; }
.cpf-group label {
    font-family:'Poppins',sans-serif; font-size:12px; font-weight:700;
    color:var(--dark); text-transform:uppercase; letter-spacing:.6px;
    display:block; margin-bottom:8px;
}
.cpf-group label span { color:var(--gold); }

.cpf-input-wrap { position:relative; }
.cpf-ico {
    position:absolute; left:14px; top:50%;
    transform:translateY(-50%);
    color:rgba(0,0,0,.2); font-size:14px;
    pointer-events:none; transition:color .3s;
}
.cpf-group textarea ~ .cpf-ico { top:16px; transform:none; }

.cpf-input {
    width:100%; 
    font-family:'Open Sans',sans-serif; font-size:14px;
    color:var(--dark);
    background:#fafaf8;
    border: 1px solid var(--border);
    border-radius:10px; outline:none;
    transition: border-color .3s, box-shadow .3s, background .3s;
    appearance:none; -webkit-appearance:none;
}
.cpf-input::placeholder { color:#bbb; }
.cpf-input:focus {
    border-color:var(--gold);
    background:var(--white);
    box-shadow: 0 0 0 3px rgba(251,189,24,.12);
}
.cpf-input:focus ~ .cpf-ico { color:var(--gold); }
textarea.cpf-input { resize:vertical; min-height:120px; padding-top:14px; }

/* Select arrow */
.cpf-select-arrow { position:absolute; right:14px; top:50%; transform:translateY(-50%); color:var(--gold); font-size:11px; pointer-events:none; }

/* Submit */
.cp-submit-row { display:flex; align-items:center; gap:16px; flex-wrap:wrap; margin-top:8px; }
.cp-btn-submit {
    display:inline-flex; align-items:center; gap:12px;
    background: var(--dark);
    color:#fff;
    font-family:'Poppins',sans-serif; font-size:13px; font-weight:700;
    text-transform:uppercase; letter-spacing:1.2px;
    padding:15px 36px; border:none; border-radius:50px;
    cursor:pointer; position:relative; overflow:hidden;
    transition: all .35s ease;
}
.cp-btn-submit:before {
    content:''; position:absolute; inset:0;
    /*background: linear-gradient(90deg, var(--gold), var(--gold2));*/
    opacity:0; transition:opacity .35s;
}
.cp-btn-submit span, .cp-btn-submit i { position:relative; z-index:1; }
.cp-btn-submit:hover:before { opacity:1; }
.cp-btn-submit:hover  { color:#fff; box-shadow:0 8px 28px rgba(251,189,24,.4); transform:translateY(-2px); }
.cp-btn-submit i { transition:transform .3s; }
.cp-btn-submit:hover:before{background: transparent !important;}
.cp-btn-submit:hover i { transform:translateX(5px); }
.cp-required-note { font-family:'Open Sans',sans-serif; font-size:12px; color:#656565; }

/* Messages */
.cp-msg {
    display:none; margin-top:18px; padding:14px 18px;
    border-radius:10px; font-family:'Open Sans',sans-serif;
    font-size:14px; line-height:22px;
    animation:msgIn .4s ease;
}
@keyframes msgIn { from{opacity:0;transform:translateY(-6px);} to{opacity:1;transform:translateY(0);} }
.cp-msg.success { background:#f0fdf4; border:1px solid #bbf7d0; color:#166534; }
.cp-msg.error   { background:#fef2f2; border:1px solid #fecaca; color:#991b1b; }


/* ── MAP SECTION ────────────────────── */
.cp-map-section {
    background: var(--white);
    padding: 70px 0 80px;
}
.cp-map-head {
    margin-bottom:40px;
    opacity:0; transform:translateY(20px);
    transition:all .6s ease;
}
.cp-map-head.in { opacity:1; transform:translateY(0); }
.cp-map-head h3 { font-family:'Poppins',sans-serif; font-weight:800; font-size:30px; color:var(--dark); margin-bottom:8px; }
.cp-map-head h3 span { color:var(--gold); }
.cp-map-head p { font-family:'Open Sans',sans-serif; font-size:14px; color:var(--mid); }

.cp-map-frame {
    border-radius:16px; overflow:hidden;
    border:2px solid var(--border);
    box-shadow:0 16px 50px rgba(0,0,0,.07);
    opacity:0; transform:translateY(30px);
    transition:all .8s ease .2s;
    position:relative;
}
.cp-map-frame.in { opacity:1; transform:translateY(0); }
.cp-map-frame:before {
    content:'';
    position:absolute; top:0; left:0;
    width:100%; height:4px;
    background:linear-gradient(90deg,var(--gold),var(--gold2));
    z-index:1;
}
.cp-map-frame iframe { display:block; width:100%; height:420px; border:none; }


/* ── RESPONSIVE ─────────────────────── */
@media(max-width:991px){
    .cp-left,.cp-right { padding:50px 0; }
    .cp-orbit-wrap { width:260px; height:260px; }
    .cp-badge { display:none; }
    .cp-heading { font-size:34px; }
}
@media(max-width:767px){
    .cp-sub{
        text-align:justify;
        max-width:500px;
    }
    .inner-banner { padding-top:110px !important; min-height:280px !important; }
    .banner-content h1 { font-size:28px; }
    .breadcrumb-custom li { font-size:12px; }
    .cp-left,.cp-right { padding:40px 0; }
    .cp-form-card { padding:28px 20px; }
    .cp-heading { font-size:28px; }
    .cp-stat-num { font-size:26px; }
    .cp-bs-card { margin-bottom:16px; }
}
@media(max-width:480px){
    .inner-banner { padding-top:95px !important; }
    .banner-content h1 { font-size:24px; }
    .breadcrumb-custom li { font-size:11px; }
}

/* ── SUCCESS MODAL ── */
.cp-modal-overlay {
    position: fixed; inset: 0;
    background: rgba(0,0,0,0.55);
    backdrop-filter: blur(4px);
    z-index: 9999;
    display: flex; align-items: center; justify-content: center;
    opacity: 0; pointer-events: none;
    transition: opacity .35s ease;
}
.cp-modal-overlay.show {
    opacity: 1; pointer-events: all;
}

.cp-modal {
    background: var(--white);
    border-radius: 20px;
    padding: 48px 40px;
    max-width: 480px; width: 90%;
    text-align: center;
    position: relative;
    transform: scale(.88) translateY(20px);
    transition: transform .4s cubic-bezier(.34,1.56,.64,1);
    box-shadow: 0 30px 80px rgba(0,0,0,.18);
    overflow: hidden;
}
.cp-modal-overlay.show .cp-modal {
    transform: scale(1) translateY(0);
}

/* animated top bar */
.cp-modal:before {
    content: '';
    position: absolute; top: 0; left: 0;
    width: 100%; height: 4px;
    background: linear-gradient(90deg, var(--gold), var(--gold2), var(--gold));
    background-size: 200% 100%;
    animation: barShift 2.5s linear infinite;
}

/* confetti dots */
.cp-modal:after {
    content: '';
    position: absolute; inset: 0;
    background-image:
        radial-gradient(circle, rgba(251,189,24,.15) 2px, transparent 2px),
        radial-gradient(circle, rgba(240,147,30,.1) 2px, transparent 2px);
    background-size: 40px 40px, 60px 60px;
    background-position: 0 0, 20px 20px;
    pointer-events: none;
    animation: dotDrift 12s linear infinite;
}

/* close button */
.cp-modal-close {
    position: absolute; top: 16px; right: 18px;
    width: 32px; height: 32px; border-radius: 50%;
    background: #f5f5f5; border: none; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    color: #999; font-size: 14px;
    transition: all .25s;
    z-index: 2;
}
.cp-modal-close:hover { background: var(--gold); color: var(--dark); transform: rotate(90deg); }

/* icon ring */
.cp-modal-icon-wrap {
    position: relative; z-index: 1;
    width: 88px; height: 88px;
    margin: 0 auto 24px;
}
.cp-modal-icon-ring {
    position: absolute; inset: 0;
    border-radius: 50%;
    border: 2px solid rgba(251,189,24,.3);
    animation: modalRingPulse 2s ease-in-out infinite;
}
.cp-modal-icon-ring:nth-child(2) {
    inset: -10px;
    border-color: rgba(251,189,24,.15);
    animation-delay: .5s;
}
@keyframes modalRingPulse {
    0%,100%{ transform:scale(1); opacity:1; }
    50%{ transform:scale(1.12); opacity:.5; }
}
.cp-modal-icon {
    position: absolute; inset: 0;
    background: var(--gold);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    z-index: 1;
    animation: iconPop .5s cubic-bezier(.34,1.56,.64,1) .1s both;
}
@keyframes iconPop {
    from{ transform:scale(0); } to{ transform:scale(1); }
}
.cp-modal-icon i { font-size: 34px; color: var(--dark); }

/* checkmark draw animation */
.cp-modal-icon i {
    animation: checkBounce .6s cubic-bezier(.34,1.56,.64,1) .3s both;
}
@keyframes checkBounce {
    0%{ transform:scale(0) rotate(-30deg); opacity:0; }
    100%{ transform:scale(1) rotate(0deg); opacity:1; }
}

.cp-modal-title {
    font-family: 'Poppins', sans-serif;
    font-weight: 800; font-size: 24px;
    color: var(--dark); margin-bottom: 10px;
    position: relative; z-index: 1;
}
.cp-modal-title span { color: var(--gold); }

.cp-modal-msg {
    font-family: 'Open Sans', sans-serif;
    font-size: 15px; color: var(--mid);
    line-height: 1.7; margin-bottom: 28px;
    position: relative; z-index: 1;
}

/* info chips */
.cp-modal-chips {
    display: flex; justify-content: center;
    gap: 10px; flex-wrap: wrap;
    margin-bottom: 28px;
    position: relative; z-index: 1;
}
.cp-modal-chip {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(251,189,24,.1);
    border: 1px solid rgba(251,189,24,.25);
    border-radius: 50px; padding: 6px 14px;
    font-family: 'Poppins', sans-serif;
    font-size: 12px; font-weight: 600; color: var(--dark);
}
.cp-modal-chip i { color: var(--gold); font-size: 11px; }

.cp-modal-btn {
    display: inline-flex; align-items: center; gap: 10px;
    background: var(--dark); color: #fff;
    font-family: 'Poppins', sans-serif;
    font-size: 13px; font-weight: 700;
    text-transform: uppercase; letter-spacing: 1px;
    padding: 13px 32px; border: none; border-radius: 50px;
    cursor: pointer; position: relative; overflow: hidden;
    transition: all .3s ease; z-index: 1;
}
.cp-modal-btn:before {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(90deg, var(--gold), var(--gold2));
    opacity: 0; transition: opacity .3s;
}
.cp-modal-btn span, .cp-modal-btn i { position: relative; z-index: 1; }
.cp-modal-btn:hover:before { opacity: 1; }
.cp-modal-btn:hover { color: var(--dark); box-shadow: 0 8px 24px rgba(251,189,24,.4); transform: translateY(-2px); }

@media(max-width:480px){
    .cp-modal { padding: 36px 22px; }
    .cp-modal-title { font-size: 20px; }
}
    </style>
</head>
<body>
<div class="wrapper" id="top">

    <!-- ── HEADER ─────────────────────── -->
  @include('landingPage.header')
    <div class="midd-container">

        <!-- ── BANNER ─────────────────── -->
        <div class="hero-main inner-banner white-sec"
             style="background:url('{{ asset('assets/pages/images/banner/contact-banner.jpeg') }}') no-repeat center center/cover;">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-sm-12 col-md-8">
                        <div class="banner-content"><h1>Contact <span>Us</span></h1></div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb-custom">
                                <li><a href="{{url('/')}}">Home</a></li>
                                <li class="separator">/</li>
                                <li class="active">Contact Us</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        
        <!-- ── MAIN SPLIT SECTION ─────── -->
        <section class="contact-main">
            <div class="container">
                <div class="row align-items-start">

                    <!-- LEFT: visual + info -->
                    <div class="col-lg-5 col-md-12">
                        <div class="cp-left" id="cpLeft">

                            <div class="cp-eyebrow"><div class="cp-eyebrow-dot"></div>Get in Touch</div>
                            <h2 class="cp-heading">We're Here<br>to <em>Help You</em><br><span class="stroke">Grow.</span></h2>
                            <p class="cp-sub">Whether it's a question about your mining tier, account access, or anything else — our dedicated team is ready to respond within 24 hours.</p>

                            

                            <!-- Info list -->
                            <ul class="cp-info-list" id="cpInfoList">
                                <li class="cp-info-item">
                                    <div class="cp-info-icon"><i class="fas fa-phone"></i></div>
                                    <div class="cp-info-text">
                                        <strong>Phone</strong>
                                        <a href="tel:02033765250">020 3376 5250</a>
                                    </div>
                                </li>
                                <li class="cp-info-item">
                                    <div class="cp-info-icon"><i class="fas fa-envelope"></i></div>
                                    <div class="cp-info-text">
                                        <strong>Email</strong>
                                        <a href="mailto:support@winngoocoin.com">support@winngoocoin.com</a>
                                    </div>
                                </li>
                                <li class="cp-info-item">
                                    <div class="cp-info-icon"><i class="fas fa-map-marker-alt"></i></div>
                                    <div class="cp-info-text">
                                        <strong>Address</strong>
                                        <span>Unit 5, Martinbridge Trading Estate,<br>240-242 Lincoln Road, Enfield, EN1 1SP, United Kingdom.</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- RIGHT: form -->
                    <div class="col-lg-7 col-md-12">
                        <div class="cp-right" id="cpRight">
                            <div class="cp-form-card">

                                <div class="cp-form-title">Send a <span>Message</span></div>
                                <p class="cp-form-desc">Fill in the fields below — we'll get back to you as soon as possible.</p>

                                <!-- Progress dots (cosmetic) -->
                                <div class="cp-steps" id="cpSteps">
                                    <div class="cp-step-dot active"></div>
                                    <div class="cp-step-dot"></div>
                                    <div class="cp-step-dot"></div>
                                    <div class="cp-step-dot"></div>
                                    <div class="cp-step-dot"></div>
                                </div>

                               <form id="cpForm" method="POST" action="{{ route('contact.submit') }}" novalidate>
    @csrf

    <div class="row">
        <div class="col-md-6">
            <div class="cpf-group">
                <label>Full Name <span>*</span></label>
                <div class="cpf-input-wrap">
                    <input type="text" name="name" maxlength="50" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" class="cpf-input" value="{{ old('name') }}">
                    @error('name')
                        <div class="error-msg text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="cpf-group">
                <label>Email Address <span>*</span></label>
                <div class="cpf-input-wrap">
                    <input type="text" maxlength="60" name="email" class="cpf-input" value="{{ old('email') }}">
                    @error('email')
                        <div class="error-msg text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="cpf-group">
                <label>Phone Number <span>*</span></label>
                <div class="cpf-input-wrap">
                    <input type="text" maxlength="15" oninput="this.value = this.value.replace(/[^0-9]/g, '')"   name="phone" class="cpf-input" value="{{ old('phone') }}">
                    @error('phone')
                        <div class="error-msg text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="cpf-group">
                <label>Subject <span>*</span></label>
                <div class="cpf-input-wrap">
                    <input type="text" name="subject" class="cpf-input" value="{{ old('subject') }}">
                    @error('subject')
                        <div class="error-msg text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="cpf-group">
        <label>Your Message <span>*</span></label>
        <div class="cpf-input-wrap">
            <textarea name="message" class="cpf-input">{{ old('message') }}</textarea>
            @error('message')
                <div class="error-msg text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="cp-submit-row">
        <button type="submit" class="cp-btn-submit">Submit</button>
        <span class="cp-required-note">* Please enter required fields</span>
    </div>
</form>
                            </div>
                        </div>
                    </div>

                </div><!-- /row -->
            </div>
        </section>

       

        <!-- ── MAP ────────────────────── -->
        <section class="cp-map-section">
            <div class="container">
                <div class="cp-map-head" id="cpMapHead">
                    <h3>Find Our <span>Office</span></h3>
                    <p>Unit 5, Martinbridge Trading Estate, 240-242 Lincoln Road, Enfield, EN1 1SP, United Kingdom</p>
                </div>
                <div class="cp-map-frame" id="cpMapFrame">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2477.4!2d-0.0782!3d51.6512!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48761e2be9a33cd7%3A0x6db7e1cd93db89c3!2s240%20Lincoln%20Rd%2C%20Enfield%20EN1%201SP%2C%20UK!5e0!3m2!1sen!2suk!4v1700000000000"
                        allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Winngoo Coin Office">
                    </iframe>
                </div>
            </div>
        </section>

      
      

    </div><!-- /midd-container -->
    <div class="clear"></div>

    <!-- ── FOOTER ─────────────────────── -->
   @include('landingPage.footer')
    <!-- ── SUCCESS MODAL ── -->

    
<!-- Bootstrap Modal -->
<div class="modal fade" id="cpBootstrapModal" tabindex="-1" aria-labelledby="cpBootstrapModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center p-4 position-relative">

      <!-- Close button (X at top-right) -->
      <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>

      <!-- Icon -->
      <div class="cp-modal-icon-wrap my-4 position-relative">
        <div class="cp-modal-icon-ring"></div>
        <div class="cp-modal-icon-ring"></div>
        <div class="cp-modal-icon">
          <i class="fas fa-check fa-2x text-success"></i>
        </div>
      </div>

      <!-- Title -->
      <h5 class="modal-title cp-modal-title mb-3" id="cpBootstrapModalLabel">Message <span>Sent!</span></h5>

      <!-- Message -->
      <p class="cp-modal-msg mb-4">Thank you for reaching out. Our team has received your message and will get back to you shortly.</p>

      <!-- Button centered -->
      <div class="d-flex justify-content-center">
        <button type="button" class="cp-modal-btn" data-bs-dismiss="modal">
          Got It <i class="fas fa-arrow-right ms-2"></i>
        </button>
      </div>

    </div>
  </div>
</div>


</div><!-- /wrapper -->

<script src="{{ asset('assets/pages/js/jquery.min.js') }}"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('assets/pages/js/onpagescroll.js') }}"></script>
<script src="{{ asset('assets/pages/js/wow.min.js') }}"></script>
<script src="{{ asset('assets/pages/js/script.js') }}"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".cpf-input").forEach(function (input) {
        input.addEventListener("input", function () {
            let error = this.closest('.cpf-input-wrap').querySelector('.error-msg');
            if (error) {
                error.style.display = 'none';
            }
        });
    });
});


</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    @if(session('success'))
        var myModal = new bootstrap.Modal(document.getElementById('cpBootstrapModal'));
        myModal.show();
    @endif
});
</script>

<script>
document.getElementById('cpForm').addEventListener('submit', function () {
    const btn = document.getElementById('cpSubmitBtn');

    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Processing...';
    btn.disabled = true;
});
</script>




<script>
/* ── Scroll reveal ── */
(function(){
    const io = new IntersectionObserver(entries=>{
        entries.forEach(e=>{
            if(!e.isIntersecting) return;
            e.target.classList.add('in');
            if(e.target.id==='cpInfoList'){
                e.target.querySelectorAll('.cp-info-item').forEach((item,i)=>{
                    setTimeout(()=>item.classList.add('in'), i*120);
                });
            }
            io.unobserve(e.target);
        });
    },{threshold:.12});
    ['cpLeft','cpRight','cpInfoList','cpMapHead','cpMapFrame'].forEach(id=>{
        const el=document.getElementById(id); if(el) io.observe(el);
    });
})();

/* ── Step dots ── */
(function(){
    const fieldIds = ['cpName','cpEmail','cpPhone','cpSubject','cpMessage'];
    const dots = document.querySelectorAll('.cp-step-dot');
    function update(){
        let filled = 0;
        fieldIds.forEach(id=>{
            const el = document.getElementById(id);
            if(el && el.value.trim()) filled++;
        });
        dots.forEach((d,i)=>{ d.classList.toggle('active', i <= filled); });
    }
    fieldIds.forEach(id=>{
        const el = document.getElementById(id);
        if(el) el.addEventListener('input', update);
    });
})();



</script>


    <script>
(function($) {
    'use strict';

    $(document).ready(function() {

        // Remove any previous click handlers
        $('.menu-icon').off('click');
        $('nav.onepage ul li a').off('click');

        // Hamburger toggle
        $(document).on('click', '.menu-icon', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var $this = $(this);
            var $nav  = $('nav.onepage');

            if ($this.hasClass('active')) {
                $this.removeClass('active');
                $nav.stop(true, true).slideUp(300);
            } else {
                $this.addClass('active');
                $nav.stop(true, true).slideDown(300);
            }
        });

        // Close menu when any nav link is clicked
        $(document).on('click', 'nav.onepage ul li a', function() {
            var $icon = $('.menu-icon');
            var $nav  = $('nav.onepage');

            if ($icon.is(':visible')) {
                $icon.removeClass('active');
                $nav.stop(true, true).slideUp(300);
            }
        });

        // Close menu when clicking outside
        $(document).on('click', function(e) {
            var $icon = $('.menu-icon');
            var $nav  = $('nav.onepage');

            if (
                $icon.is(':visible') &&
                $nav.is(':visible') &&
                !$(e.target).closest('.menu-icon').length &&
                !$(e.target).closest('nav.onepage').length
            ) {
                $icon.removeClass('active');
                $nav.stop(true, true).slideUp(300);
            }
        });

    });

})(jQuery);
</script>

</body>
</html>