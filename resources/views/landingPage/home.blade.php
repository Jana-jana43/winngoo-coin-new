<!DOCTYPE html>
<html lang="en" xml:lang="en">


<head>
    <meta charset="UTF-8">
    <!-- Responsive Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- favicon & bookmark -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/bookmark.png" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ asset('assets/pages/images/coin-favi.png') }}" type="image/x-icon" />
    <!-- Font Family -->
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800" rel="stylesheet">
    <!-- Website Title -->
    <title>Winngoo Coin</title>
    <!-- Stylesheets Start -->
    <link rel="stylesheet" href="{{ asset('assets/pages/css/fontawesome.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/pages/css/bootstrap.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/pages/css/animate.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/pages/css/owl.carousel.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/pages/css/coin.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/pages/css/style.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/pages/css/responsive.css') }}" type="text/css" />

    <style>
        .top-coin {
            background: url(assets/pages/images/w-coin-top.png) no-repeat scroll center center;
            top: 40px;
        }
        
        @media (min-width: 378px) and (max-width: 1024px) {
            .hero-main .col-md-6{
                flex: 0 0 48%;
            }    
            .diamond-animation .base {
                left: 51%;
            }
        }

        @media only screen and (max-width: 1400px) {
            .diamond-animation {
                transform: scale(1);
            }
        }
        
        @media (min-width: 389px) and (max-width: 431px) {
            .diamond-animation .base {
                left: 45% !important;
            }
        }
        @media only screen and (max-width: 378px) {
            .diamond-animation .base {
                left: 51% !important;
            }
        }

        /* Hide static mobile image, always show animation */
        .mobile-visible {
            display: none !important;
        }

        .diamond-animation {
            display: block !important;
        }

        /* ── MOBILE / TABLET: Stack text above, animation centered below ── */
        @media only screen and (max-width: 991px) {

            /* Force vertical stacking */
            .hero-main .container>.row.align-items-center {
                display: block !important;
            }

            /* Both columns go full width */
            .hero-main .col-sm-12.col-md-6 {
                width: 100% !important;
                max-width: 100% !important;
                float: none !important;
                text-align: center !important;
                margin-bottom: 50px;
            }

            .hero-btns {
                text-align: center !important;
            }

            /* Animation column */
            .hero-main .col-sm-12.col-md-6:last-child {
                margin-top: 10px;
                padding-bottom: 40px;
                overflow: visible;
                justify-self: anchor-center;
            }

            /* Scale and center the animation */
            .diamond-animation {
                transform: scale(0.75) !important;
                transform-origin: top center !important;
                margin: 0 auto !important;
                margin-bottom: -120px !important;
            }

            .diamond-animation .base {
                left: 42%;
            }

            .hero-main {
                padding-top: 160px;
            }
        }

        @media only screen and (max-width: 480px) {
            .diamond-animation {
                /* transform: scale(0.38) !important; */
                margin-bottom: -170px !important;
            }

            .hero-main {
                padding-top: 140px;
            }
        }
        /* ========================================
   iPhone 13 / 12 / 14 FIX
======================================== */

@media only screen and (max-width: 768px) {

    /* Fix diamond animation container */
    .diamond-animation {
        position: relative !important;
        width: 100% !important;
        max-width: 100% !important;
        transform: scale(0.7) !important;
        transform-origin: top center !important;
        margin: 0 auto !important;
        margin-bottom: -180px !important;
        left: 0 !important;
        right: 0 !important;
    }

    /* Fix the main coin element */
    .diamond-animation .main {
        position: absolute !important;
        left: 50% !important;
        right: auto !important;
        transform: translateX(-50%) !important;
        margin: 0 !important;
        width: 685px !important;
        max-width: none !important;
    }

    /* Fix the base (platform under coin) */
    .diamond-animation .base {
        position: absolute !important;
        left: 50% !important;
        transform: translateX(-50%) !important;
        right: auto !important;
        margin: 0 auto !important;
    }

    /* Prevent horizontal scroll */
    body {
        overflow-x: hidden !important;
        max-width: 100vw !important;
    }

    .hero-main .col-sm-12.col-md-6:last-child {
        overflow: hidden !important;
    }

}
    </style>
</head>

<body>
    <!--Main Wrapper Start-->
    <div class="wrapper" id="top">
        @include('landingPage.header')

        <!-- Content Section Start -->
        <div class="midd-container">
            <!-- Hero Section Start -->
            <div class="hero-main diamond-layout white-sec" style="background:url(assets/pages/images/banner-4.jpg);">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-sm-12 col-md-6">
                            <h1>Powering the Future of <span>Digital Mining Participation</span></h1>
                            <p class="lead">Winngoo Coin offers a cloud-powered mining platform with tier progression, referral-based growth, and secure access across devices

                            </p>
                            <div class="hero-btns">
                                <a href="#download" class="btn">Start Mining
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6" data-wow-delay="0.5s">
                            <div class="diamond-animation">
                                <div class="main">
                                    <div class="top-coin"><span></span></div>
                                    <div class="lines">
                                        <span class="l-1"></span>
                                        <span class="l-2"></span>
                                        <span class="l-3"></span>
                                        <span class="l-4"></span>
                                        <span class="l-5"></span>
                                        <span class="l-6"></span>
                                        <span class="l-7"></span>
                                        <span class="l-8"></span>
                                        <span class="l-9"></span>
                                        <span class="l-10"></span>
                                        <span class="l-11"></span>
                                        <span class="l-12"></span>
                                        <span class="l-13"></span>
                                        <span class="l-14"></span>
                                        <span class="l-15"></span>
                                    </div>
                                    <div class="inside-bitcoin"></div>
                                </div>
                                <div class="base"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Hero Section End -->

            <!--About Start -->
            <section class="ab-section" id="about">
                <div class="ab-container">
                    <div class="ab-header">
                        <div class="ab-header-l">
                            <div class="ab-kicker">About Winngoo Coin
                            </div>
                            <h2 class="ab-h">
                                Built for the Way<br>
                                <span class="stroke">you</span> <span class="gold">Participate</span>
                            </h2>
                        </div>
                        <div class="ab-header-r">
                            <p>Winngoo Coin is a chip-powered digital mining platform created to simplify how users engage with crypto mining. Through defined tiers, live dashboard insights, and controlled activation, it brings clarity and balance to the mining process.
                            </p>
                            <div class="ab-legend">
                                <div class="ab-legend-dot active"></div>
                                <div class="ab-legend-line"></div>
                                <div class="ab-legend-dot active"></div>
                                <div class="ab-legend-line"></div>
                                <div class="ab-legend-dot active"></div>
                                <div class="ab-legend-line"></div>
                                <div class="ab-legend-dot"></div>
                            </div>
                        </div>
                    </div>
                    <div class="ab-main">
                        <div class="ab-coin-scene">
                            <div class="ab-shadow"></div>
                            <div class="ab-orbit ab-orbit-3"></div>
                            <div class="ab-orbit ab-orbit-2"></div>
                            <div class="ab-orbit ab-orbit-1"></div>
                            <div class="ab-cglow"></div>
                            <div class="ab-coin-wrap">
                                <img src="assets/pages/images/about/about-img.png" alt="">
                            </div>
                            <div class="ab-notif ab-notif-1">
                                <div class="ab-notif-top">
                                    <div class="ab-notif-ico">⚡</div>
                                    <div class="ab-notif-title">Payment Done</div>
                                </div>
                                <div class="ab-notif-body">₹1,240 received via <b>UPI</b></div>
                            </div>
                            <div class="ab-notif ab-notif-2">
                                <div class="ab-notif-top">
                                    <div class="ab-notif-ico">📊</div>
                                    <div class="ab-notif-title">Today's Sales</div>
                                </div>
                                <div class="ab-notif-body"><b>₹48,320</b> — up 24%</div>
                            </div>
                        </div>
                        <div class="ab-content">
                            <div class="ab-editorial">
                                <div class="ab-quote-mark">"</div>
                                <h3>Digital Mining Evolves
                                    <br><em>Your platform should grow with it.
                                    </em>
                                </h3>
                                <div class="ab-rule">
                                    <div class="ab-rule-line"></div>
                                    <div class="ab-rule-diamond"></div>
                                </div>
                                <p>The system is designed around transparency. Mining cycles are clearly defined, activation is intentional, and progress is always visible. Users stay informed and in control at every stage.
                                </p>
                            </div>
                            <div class="ab-feat-list">
                                <div class="ab-feat">
                                    <div class="ab-feat-num">01</div>
                                    <div class="ab-feat-body">
                                        <h4>Transparent System Design
                                        </h4>
                                        <p> Clear mining cycles and defined participation rules without hidden conditions.</p>
                                    </div>
                                    <div class="ab-feat-bar"></div>
                                </div>
                                <div class="ab-feat">
                                    <div class="ab-feat-num">02</div>
                                    <div class="ab-feat-body">
                                        <h4>Controlled Activation Model
                                        </h4>
                                        <p>Manual activation ensures user awareness and active participation.
                                        </p>
                                    </div>
                                    <div class="ab-feat-bar"></div>
                                </div>
                                <div class="ab-feat">
                                    <div class="ab-feat-num">03</div>
                                    <div class="ab-feat-body">
                                        <h4>Secure Account Environment
                                        </h4>
                                        <p> Advanced protection measures safeguard user access and activity.
                                        </p>
                                    </div>
                                    <div class="ab-feat-bar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--About end -->

            <!-- Why Choose Us Start -->
            <section class="wcu-section" id="why-choose-us">
                <canvas class="wcu-canvas" id="wcuCanvas"></canvas>
                <div class="wcu-beam"></div>
                <div class="wcu-orb wcu-orb-1"></div>
                <div class="wcu-orb wcu-orb-2"></div>
                <div class="wcu-container">
                    <div class="wcu-header" id="wcuHeader">
                        <div class="wcu-tag">Why Choose Us</div>
                        <h2>Winngoo Stands Apart in <br><span>Digital Mining
                            </span></h2>
                        <p>The platform emphasizes clarity, consistency, and measurable growth. Users can easily understand their tier position, monitor activity, and progress based on real engagement.
                        </p>
                    </div>
                    <div class="wcu-grid" id="wcuGrid">
                        <div class="wcu-grid-card">
                            <span class="wcu-card-num">01</span>
                            <div class="wcu-card-icon"><img src="assets/pages/images/why-choose/tier-based.png" alt="Instant Exchange"></div>
                            <h5>Tier-Based Progression
                            </h5>
                            <p>Move from Bronze to silver and gold tiers through consistent activity and verified referrals.
                            </p>
                        </div>
                        <div class="wcu-grid-card">
                            <span class="wcu-card-num">02</span>
                            <div class="wcu-card-icon"><img src="assets/pages/images/why-choose/real-time.png" alt="World Coverage"></div>
                            <h5>Real-Time Monitoring
                            </h5>
                            <p>View mining duration, current tier, activation status, and coin growth directly from your dashboard.
                            </p>
                        </div>
                        <div class="wcu-grid-card">
                            <span class="wcu-card-num">03</span>
                            <div class="wcu-card-icon"><img src="assets/pages/images/why-choose/cloud-based.png" alt="Mobile Apps"></div>
                            <h5>Cloud-Based Infrastructure
                            </h5>
                            <p>Mining operates securely through the cloud system, so your phone’s speed, battery, and storage remain unaffected.
                            </p>
                        </div>
                        <div class="wcu-grid-card">
                            <span class="wcu-card-num">04</span>
                            <div class="wcu-card-icon"><img src="assets/pages/images/why-choose/performance-growth.png" alt="Strong Network"></div>
                            <h5>Performance-Linked Growth
                            </h5>
                            <p>As your network grows and referrals are verified, your mining performance improves accordingly.
                            </p>
                        </div>
                        <div class="wcu-grid-card">
                            <span class="wcu-card-num">05</span>
                            <div class="wcu-card-icon"><img src="assets/pages/images/why-choose/secure-access.png" alt="Margin Trading"></div>
                            <h5>Secure Access Controls
                            </h5>
                            <p>Biometric login, PIN security, VPN detection, and active session monitoring help keep your account protected at all times.
                            </p>
                        </div>
                        <div class="wcu-grid-card">
                            <span class="wcu-card-num">06</span>
                            <div class="wcu-card-icon"><img src="assets/pages/images/why-choose/cross-platform.png" alt="24/7 Support"></div>
                            <h5>Cross-Platform Availability</h5>
                            <p>Sign in and manage your account easily across the web, Android, and iOS with synchronized access.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Why Choose Us End -->

            <!-- How It Works Start -->
            <section class="h4-section" id="how-it-works">
                <div class="h4-bg-top"></div>
                <div class="h4-bg-stripe"></div>
                <div class="h4-rings">
                    <div class="h4-ring"></div>
                    <div class="h4-ring"></div>
                    <div class="h4-ring"></div>
                    <div class="h4-ring"></div>
                </div>
                <div class="h4-wrap">
                    <div class="h4-header" id="h4Head">
                        <div class="h4-header-l">
                            <div class="h4-kicker">How It Works</div>
                            <h2>A Clear Path.<br><span class="stroke">Steady</span> <span class="gold-word">Progress.</span></h2>
                        </div>
                        <div class="h4-header-r">
                            <p>Each stage is designed to guide users from registration to tier advancement with full visibility along the way.
                            </p>
                            <div class="h4-legend">
                                <div class="h4-legend-dot active"></div>
                                <div class="h4-legend-line"></div>
                                <div class="h4-legend-dot active"></div>
                                <div class="h4-legend-line"></div>
                                <div class="h4-legend-dot active"></div>
                                <div class="h4-legend-line"></div>
                                <div class="h4-legend-dot active"></div>
                            </div>
                        </div>
                    </div>
                    <div class="h4-cards" id="h4Cards">
                        <div class="h4-card">
                            <div class="h4-card-num">01</div>

                            <div class="h4-card-icon">
                                <img src="assets/pages/images/how-it-works/create-account.png" class="icon-default" alt="Create Account">
                                <img src="assets/pages/images/how-it-works/create-account-b.png" class="icon-hover" alt="Create Account">
                            </div>

                            <h5>Create Your Account</h5>
                            <p>Register using your email and phone number to securely activate your profile.</p>
                            <span class="h4-card-chip">Secure & Quick Setup</span>
                        </div>
                        <div class="h4-card">
                            <div class="h4-card-num">02</div>
                            <div class="h4-card-icon">
                                <img src="assets/pages/images/how-it-works/begin-bronze.png" class="icon-default" alt="Create Account">
                                <img src="assets/pages/images/how-it-works/begin-bronze-b.png" class="icon-hover" alt="Create Account">
                            </div>
                            <h5>Begin with Bronze
                            </h5>
                            <p> Every new user starts with a Bronze mining cycle as the foundation of participation.
                            </p>
                            <span class="h4-card-chip">2-Year Entry Tier
                            </span>
                        </div>
                        <div class="h4-card">
                            <div class="h4-card-num">03</div>
                            <div class="h4-card-icon">
                                <img src="assets/pages/images/how-it-works/activate-monthly.png" class="icon-default" alt="Create Account">
                                <img src="assets/pages/images/how-it-works/activate-monthly-b.png" class="icon-hover" alt="Create Account">
                            </div>
                            <h5>Activate Monthly</h5>
                            <p> Confirm your mining activity once a month to keep your cycle active and uninterrupted.
                            </p>
                            <span class="h4-card-chip">Manual Activation Required
                            </span>
                        </div>
                        <div class="h4-card">
                            <div class="h4-card-num">04</div>
                            <div class="h4-card-icon">
                                <img src="assets/pages/images/how-it-works/track.png" class="icon-default" alt="Create Account">
                                <img src="assets/pages/images/how-it-works/track-b.png" class="icon-hover" alt="Create Account">
                            </div>
                            <h5>Track & Progress
                            </h5>
                            <p> Monitor your activity through the dashboard and move forward based on engagement and verified referrals.
                            </p>
                            <span class="h4-card-chip">Performance-Based Upgrade</span>
                        </div>
                    </div>
                </div>
                <div class="h4-ticker">
                    <div class="h4-ticker-track" id="h4Ticker">
                        <span class="h4-ticker-item"><span class="sep"></span> <span class="hl">Referral</span> Growth </span>
                        <span class="h4-ticker-item"><span class="sep"></span> <span class="hl">Global</span> Participation
                        </span>

                        <span class="h4-ticker-item"><span class="sep"></span> <span class="hl">Monthly</span> Activation
                        </span>
                        <span class="h4-ticker-item"><span class="sep"></span> <span class="hl">Real-Time</span> Tracking
                        </span>
                        <span class="h4-ticker-item"><span class="sep"></span> <span class="hl">Secure</span> Access
                        </span>
                        <span class="h4-ticker-item"><span class="sep"></span> <span class="hl">Tier</span> Progression
                        </span>
                        <span class="h4-ticker-item"><span class="sep"></span> <span class="hl">Digital</span> Infrastructure</span>
                        <span class="h4-ticker-item"><span class="sep"></span> <span class="hl">Referral</span> Growth </span>
                        <span class="h4-ticker-item"><span class="sep"></span> <span class="hl">Global</span> Participation</span>

                        <span class="h4-ticker-item"><span class="sep"></span> <span class="hl">Monthly</span> Activation
                        </span>
                        <span class="h4-ticker-item"><span class="sep"></span> <span class="hl">Real-Time</span> Tracking
                        </span>
                        <span class="h4-ticker-item"><span class="sep"></span> <span class="hl">Secure</span> Access
                        </span>
                        <span class="h4-ticker-item"><span class="sep"></span> <span class="hl">Tier</span> Progression</span>
                        <span class="h4-ticker-item"><span class="sep"></span> <span class="hl">Digital</span> Infrastructure</span>
                    </div>
                </div>
            </section>
            <!-- How It Works End -->

            <!-- Stats / Milestone Section -->
            <div id="stats" class="milestone-section p-tb c-l">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <div class="counter">
                                <div class="counter-icon"><img src="assets/pages/images/counter/cloud-based.png" alt="" /></div>
                                <div class="counter-value" data-count="1594">100%
                                </div>
                                <h4 class="count-text"> Cloud-Based
                                </h4>
                            </div>
                        </div>
                        <div class="col">
                            <div class="counter">
                                <div class="counter-icon"><img src="assets/pages/images/counter/bronze-c.png" alt="" /></div>
                                <div class="counter-value" data-count="649">2-Year
                                </div>
                                <h4 class="count-text"> Bronze Coin
                                </h4>
                            </div>
                        </div>
                        <div class="col">
                            <div class="counter">
                                <div class="counter-icon"><img src="assets/pages/images/counter/silver-c.png" alt="" /></div>
                                <div class="counter-value" data-count="852">1.5-Year
                                </div>
                                <h4 class="count-text">Silver Coin
                                </h4>
                            </div>
                        </div>
                        <div class="col">
                            <div class="counter">
                                <div class="counter-icon"><img src="assets/pages/images/counter/gold-c.png" alt="" /></div>
                                <div class="counter-value" data-count="198">1-Year
                                </div>
                                <h4 class="count-text"> Gold Coin
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Stats / Milestone Section End -->



            <!-- Download App Section Start -->
            <section class="app-section" id="download">
                <div class="app-bg-grid"></div>
                <div class="app-bg-radial"></div>
                <div class="app-beam"></div>
                <div class="app-beam app-beam-2"></div>
                <div class="app-particles" id="appParticles"></div>
                <div style="max-width:1200px; margin:0 auto; padding:0 30px; position:relative; z-index:10;">
                    <div class="app-container">
                        <div class="app-content">
                            <div class="app-kicker">
                                <div class="app-kicker-dot"></div>
                                <span>Mobile Experience
                                </span>
                            </div>
                            <h2 class="app-headline">
                                Control Your<br>
                                Mining from the <span class="gold">Secure</span>
                                Mobile App

                            </h2>
                            <p class="app-desc">The Winngoo Coin mobile app allows you to track progress, review tier status, and manage referrals with ease — all from a secure, streamlined interface
                            </p>
                            <div class="app-store-btns">
                                <a href="javascript:void(0)" class="store-btn">
                                    <div class="store-icon-wrap">
                                        <svg class="store-icon" viewBox="0 0 24 24" fill="#000">
                                            <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.8-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z" />
                                        </svg>
                                    </div>
                                    <div class="store-text">
                                        <span class="store-sub">Download on the</span>
                                        <span class="store-label">App Store</span>
                                    </div>
                                </a>
                                <a href="https://play.google.com/store/apps/details?id=com.winngoocoin" target="_blank" class="store-btn">
                                    <div class="store-icon-wrap">
                                        <svg class="store-icon" viewBox="0 0 24 24" fill="#000">
                                            <path d="M3.18 23.76c.3.17.65.19.97.06l.09-.06 10.62-6.13-2.29-2.3-9.39 8.43zm-1.01-20.5C2.07 3.5 2 3.76 2 4.04v15.92c0 .28.07.54.17.78l.09.18 8.93-8.93v-.21L2.17 3.26zM20.49 10.3l-2.61-1.51-2.56 2.56 2.56 2.57 2.63-1.52c.75-.43.75-1.67-.02-2.1zM4.15.24L14.77 6.37l-2.29 2.3L3.09.24c.32-.13.69-.11.99.08l.07-.08z" />
                                        </svg>
                                    </div>
                                    <div class="store-text">
                                        <span class="store-sub">Get it on</span>
                                        <span class="store-label">Google Play</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="app-visual">
                            <div class="orbit-ring orbit-ring-1"></div>
                            <div class="orbit-ring orbit-ring-2"></div>
                            <div class="orbit-ring orbit-ring-3"></div>
                            <div class="orbit-badge" style="animation: orbitalMove 8s linear infinite;">
                                <svg viewBox="0 0 24 24">
                                    <path d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <div class="orbit-badge" style="animation: orbitalMove2 12s linear infinite;">
                                <svg viewBox="0 0 24 24">
                                    <path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm1 14h-2v-6h2zm0-8h-2V6h2z" />
                                </svg>
                            </div>
                            <div class="phone-wrap">
                                <div class="notif-card">
                                    <div class="notif-card-top">
                                        <div class="notif-ico"><svg viewBox="0 0 24 24">
                                                <path d="M13 10V3L4 14h7v7l9-11h-7z" />
                                            </svg></div>
                                        <div>
                                            <div class="notif-title">Mobile Dashboard
                                            </div>
                                            <div class="notif-time">Just now</div>
                                        </div>
                                    </div>
                                    <div class="notif-body">Track Your <span class="notif-amount">Mining</span> Progress
                                    </div>
                                </div>
                                <div class="rating-card">

                                    <div class="rating-val">Live Monitoring
                                    </div>
                                    <div class="rating-lbl">View Tier Status
                                    </div>
                                </div>
                                <img src="assets/pages/images/mobile/coin-phone.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Download App Section End -->

        </div>
        <!-- Content Section End -->
        <div class="clear"></div>

       @include('landingPage.footer')
    </div>
    <!--Main Wrapper End-->

    <script src="{{ asset('assets/pages/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/pages/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/pages/js/onpagescroll.js') }}"></script>
    <script src="{{ asset('assets/pages/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/pages/js/jquery.countdown.js') }}"></script>
    <script src="{{ asset('assets/pages/js/owl.carousel.js') }}"></script>
    <script src="{{ asset('assets/pages/js/Chart.js') }}"></script>
    <script src="{{ asset('assets/pages/js/chart-function.js') }}"></script>
    <script src="{{ asset('assets/pages/js/script.js') }}"></script>
    <script src="{{ asset('assets/pages/js/particles.js') }}"></script>
    <script src="{{ asset('assets/pages/js/gold-app.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            setTimeout(function() {
                jQuery('.diamond-animation').addClass('done');
            }, 6000);
            setTimeout(function() {
                jQuery('.diamond-animation .main').addClass('active');
            }, 1000);
            setTimeout(function() {
                jQuery('.inside-bitcoin').addClass('active');
            }, 3000);
            setTimeout(function() {
                jQuery('.inside-bitcoin').addClass('spincoin');
            }, 5000);
            setTimeout(function() {
                jQuery('.diamond-animation .lines').addClass('active');
            }, 6000);
            setTimeout(function() {
                jQuery('.diamond-animation .top-coin').addClass('active');
            }, 3000);
            setTimeout(function() {
                jQuery('.diamond-animation .outer-Orbit').addClass('active');
            }, 5000);
        });
    </script>
    <script>
        (function() {
            const canvas = document.getElementById('wcuCanvas');
            const ctx = canvas.getContext('2d');
            let W, H, hexes = [];

            function resize() {
                W = canvas.width = canvas.offsetWidth;
                H = canvas.height = canvas.offsetHeight;
                buildHexes();
            }

            function hexPath(x, y, r) {
                ctx.beginPath();
                for (let i = 0; i < 6; i++) {
                    const a = Math.PI / 180 * (60 * i - 30);
                    i === 0 ? ctx.moveTo(x + r * Math.cos(a), y + r * Math.sin(a)) : ctx.lineTo(x + r * Math.cos(a), y + r * Math.sin(a));
                }
                ctx.closePath();
            }

            function buildHexes() {
                hexes = [];
                const r = 36,
                    rowH = r * 1.73,
                    colW = r * 2 * 0.86;
                let row = 0;
                for (let y = -r; y < H + r * 2; y += rowH, row++) {
                    for (let x = -r; x < W + r * 2; x += colW) {
                        hexes.push({
                            x: x + (row % 2 ? colW / 2 : 0),
                            y,
                            alpha: Math.random() * 0.4 + 0.05,
                            speed: Math.random() * 0.003 + 0.001,
                            phase: Math.random() * Math.PI * 2
                        });
                    }
                }
            }
            let tick = 0;

            function draw() {
                ctx.clearRect(0, 0, W, H);
                tick += 0.008;
                hexes.forEach(h => {
                    const a = h.alpha * (0.5 + 0.5 * Math.sin(tick * h.speed * 300 + h.phase));
                    ctx.strokeStyle = `rgba(251,189,24,${a})`;
                    ctx.lineWidth = 0.6;
                    hexPath(h.x, h.y, 34);
                    ctx.stroke();
                });
                requestAnimationFrame(draw);
            }
            window.addEventListener('resize', resize);
            resize();
            draw();
        })();

        (function() {
            const io = new IntersectionObserver((entries) => {
                entries.forEach(e => {
                    if (e.isIntersecting) {
                        e.target.classList.add('visible');
                        if (e.target.id === 'wcuGrid') e.target.querySelectorAll('.wcu-grid-card').forEach(c => c.classList.add('visible'));
                        if (e.target.id === 'wcuStats') animateCounters();
                        io.unobserve(e.target);
                    }
                });
            }, {
                threshold: 0.15
            });
            ['wcuHeader', 'wcuHero', 'wcuGrid', 'wcuStats'].forEach(id => {
                const el = document.getElementById(id);
                if (el) io.observe(el);
            });
        })();

        function animateCounters() {
            document.querySelectorAll('.wcu-stat-num').forEach(el => {
                const target = parseFloat(el.dataset.target),
                    prefix = el.dataset.prefix || '',
                    suffix = el.dataset.suffix || '';
                const isFloat = target % 1 !== 0,
                    duration = 1800,
                    start = performance.now();

                function step(now) {
                    const p = Math.min((now - start) / duration, 1),
                        ease = 1 - Math.pow(1 - p, 3),
                        val = target * ease;
                    el.textContent = prefix + (isFloat ? val.toFixed(1) : Math.floor(val)) + suffix;
                    if (p < 1) requestAnimationFrame(step);
                }
                requestAnimationFrame(step);
            });
        }
    </script>
    <script>
        (function() {
            const io = new IntersectionObserver((entries) => {
                entries.forEach(e => {
                    if (!e.isIntersecting) return;
                    const el = e.target;
                    el.classList.add('in');
                    if (el.id === 'h4Cards') el.querySelectorAll('.h4-card').forEach(c => c.classList.add('in'));
                    if (el.id === 'h4Timeline') el.querySelectorAll('.h4-tl-item').forEach(i => i.classList.add('in'));
                    io.unobserve(el);
                });
            }, {
                threshold: 0.12
            });
            ['h4Head', 'h4Cards', 'h4Timeline', 'h4Cta'].forEach(id => {
                const el = document.getElementById(id);
                if (el) io.observe(el);
            });
        })();
    </script>
    <script>
        (function() {
            const container = document.getElementById('appParticles');
            const sizes = [3, 4, 5, 6, 3, 4];
            for (let i = 0; i < 30; i++) {
                const p = document.createElement('div');
                p.className = 'app-particle';
                const s = sizes[Math.floor(Math.random() * sizes.length)];
                Object.assign(p.style, {
                    width: s + 'px',
                    height: s + 'px',
                    left: Math.random() * 100 + '%',
                    bottom: Math.random() * 30 + '%',
                    '--dur': (6 + Math.random() * 8) + 's',
                    '--delay': (Math.random() * 8) + 's'
                });
                container.appendChild(p);
            }
        })();

        const style = document.createElement('style');
        style.textContent = `
  @keyframes orbitalMove { 0% { transform: rotate(0deg) translateX(160px) rotate(0deg); } 100% { transform: rotate(360deg) translateX(160px) rotate(-360deg); } }
  @keyframes orbitalMove2 { 0% { transform: rotate(180deg) translateX(220px) rotate(-180deg); } 100% { transform: rotate(540deg) translateX(220px) rotate(-540deg); } }
`;
        document.head.appendChild(style);

        (function() {
            const els = document.querySelectorAll('.app-strip-num');
            const io = new IntersectionObserver(entries => {
                entries.forEach(e => {
                    if (!e.isIntersecting) return;
                    const el = e.target,
                        target = parseFloat(el.dataset.target),
                        suffix = el.dataset.suffix || '';
                    const isFloat = target % 1 !== 0,
                        duration = 1800,
                        start = performance.now();

                    function step(now) {
                        const p = Math.min((now - start) / duration, 1),
                            ease = 1 - Math.pow(1 - p, 3);
                        el.textContent = (isFloat ? (target * ease).toFixed(1) : Math.floor(target * ease)) + suffix;
                        if (p < 1) requestAnimationFrame(step);
                    }
                    requestAnimationFrame(step);
                    io.unobserve(el);
                });
            }, {
                threshold: 0.4
            });
            els.forEach(el => io.observe(el));
        })();
    </script>
    <script>
        const io = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (!e.isIntersecting) return;
                ['.ab-header', '.ab-coin-scene', '.ab-content', '.ab-stats', '.ab-cta-row'].forEach(s => e.target.querySelector(s)?.classList.add('in'));
                e.target.querySelectorAll('.ab-feat').forEach(c => c.classList.add('in'));
                io.unobserve(e.target);
            });
        }, {
            threshold: 0.12
        });
        io.observe(document.querySelector('.ab-section'));
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
                    var $nav = $('nav.onepage');

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
                    var $nav = $('nav.onepage');

                    if ($icon.is(':visible')) {
                        $icon.removeClass('active');
                        $nav.stop(true, true).slideUp(300);
                    }
                });

                // Close menu when clicking outside
                $(document).on('click', function(e) {
                    var $icon = $('.menu-icon');
                    var $nav = $('nav.onepage');

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