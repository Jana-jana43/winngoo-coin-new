<!DOCTYPE html>
<html lang="en" xml:lang="en">    
<head>       
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('assets/pages/images/bookmark.png') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ asset('assets/pages/images/coin-favi.png') }}" type="image/x-icon" /> 
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800" rel="stylesheet">
    <title>Privacy Policy – Winngoo Coin</title>
    <link rel="stylesheet" href="{{ asset('assets/pages/css/fontawesome.min.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/pages/css/bootstrap.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/pages/css/animate.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/pages/css/owl.carousel.min.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/pages/css/coin.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/pages/css/style.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/pages/css/responsive.css') }}" type="text/css"/>

    <style>
/* ===================================
   INNER BANNER
=================================== */
.inner-banner {
    position: relative;
    padding-top: 160px !important;
    padding-bottom: 40px !important;
    text-align: center;
    min-height: 450px;
    display: flex;
    align-items: center;
    background-attachment: scroll !important;
    background-size: cover !important;
    background-position: center center !important;
}

.inner-banner:before {
    position: absolute;
    background: rgba(0, 0, 0, 0.75);
    content: "";
    left: 0; top: 0;
    height: 100%; width: 100%;
}

.inner-banner .container {
    position: relative;
    z-index: 1;
    width: 100%;
}

.hero-main:before {
    position: absolute;
    background: rgba(0, 0, 0, 0.3);
    content: "";
    left: 0; top: 0;
    height: 100%; width: 100%;
}

/* Breadcrumb */
.breadcrumb-custom {
    list-style: none;
    padding: 0;
    margin: 0 0 20px 0;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    gap: 4px;
}
.breadcrumb-custom li {
    font-size: 14px;
    font-family: 'Poppins', sans-serif;
    text-transform: uppercase;
    letter-spacing: 1px;
}
.breadcrumb-custom li a {
    color: #fbbd18;
    text-decoration: none;
    font-weight: 600;
    transition: all 300ms;
}
.breadcrumb-custom li a:hover { color: #f0931e; }
.breadcrumb-custom li.separator {
    margin: 0 6px;
    color: rgba(255,255,255,0.4);
}
.breadcrumb-custom li.active {
    color: #ffffff;
    font-weight: 400;
}

/* Banner title */
.banner-content h1 {
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    font-size: 48px;
    color: #ffffff;
    margin-bottom: 12px;
}
.banner-content h1 span {
    color: #fbbd18;
    font-weight: 300;
}

/* ===================================
   PRIVACY BODY SECTION
=================================== */
.terms-page-section {
    background: #ffffff;
    padding: 70px 0 80px;
}

.terms-intro {
    margin-bottom: 45px;
    padding-bottom: 30px;
    border-bottom: 2px solid #fbbd18;
}

.terms-intro p {
    font-family: 'Open Sans', sans-serif;
    color: #616161;
    font-size: 15px;
    line-height: 28px;
    margin: 0;
}

.terms-intro p strong {
    color: #1d1d1d;
}

.terms-block {
    margin-bottom: 40px;
    padding-bottom: 35px;
    border-bottom: 1px solid #ebebeb;
}
.terms-block:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.terms-block h3 {
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    font-size: 20px;
    color: #1d1d1d;
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.terms-block h3 .tc-num {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 32px;
    height: 32px;
    background: #fbbd18;
    color: #1d1d1d;
    font-size: 13px;
    font-weight: 700;
    border-radius: 4px;
    flex-shrink: 0;
}

.terms-block p {
    font-family: 'Open Sans', sans-serif;
    color: #616161;
    font-size: 15px;
    line-height: 28px;
    text-align: justify;
    margin-bottom: 12px;
}
.terms-block p:last-child { margin-bottom: 0; }

.terms-block ul {
    padding-left: 20px;
    margin-bottom: 12px;
}
.terms-block ul li {
    font-family: 'Open Sans', sans-serif;
    color: #616161;
    font-size: 15px;
    line-height: 28px;
    margin-bottom: 6px;
}
.terms-block ul li::marker {
    color: #fbbd18;
}

.terms-block a {
    color: #fbbd18;
    font-weight: 600;
    text-decoration: underline;
    transition: color 300ms;
}
.terms-block a:hover { color: #f0931e; }

.tc-last-updated {
    display: inline-block;
    background: rgba(251,189,24,0.1);
    border: 1px solid rgba(251,189,24,0.35);
    border-radius: 4px;
    padding: 8px 18px;
    font-family: 'Poppins', sans-serif;
    font-size: 13px;
    color: #fbbd18;
    font-weight: 600;
    margin-bottom: 30px;
}
.tc-last-updated i { margin-right: 6px; }

/* ===================================
   RESPONSIVE
=================================== */
@media (max-width: 767px) {
    .inner-banner {
        padding-top: 110px !important;
        padding-bottom: 30px !important;
        min-height: 280px !important;
        align-items: center !important;
    }
    .banner-content h1 { font-size: 28px; }
    .terms-page-section { padding: 45px 0 55px; }
    .terms-block h3 { font-size: 17px; }
    .terms-block p,
    .terms-block ul li { font-size: 14px; line-height: 26px; }
}
@media (max-width: 480px) {
    .inner-banner { padding-top: 95px !important; }
    .banner-content h1 { font-size: 24px; }
}
/* ── DOCUMENT HEADER BLOCK ── */
.tc-doc-header {
    margin-bottom: 45px;
    padding: 30px 32px;
    background: #fafaf7;
    border: 1px solid #ebebeb;
    border-left: 4px solid #fbbd18;
    border-radius: 0 8px 8px 0;
}

.tc-doc-title {
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    font-size: 22px;
    color: #1d1d1d;
    margin-bottom: 20px;
    line-height: 1.4;
}
.tc-doc-title span { color: #fbbd18; }

.tc-doc-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 20px 40px;
}

.tc-doc-meta-item {
    display: flex;
    flex-direction: column;
    gap: 3px;
}

.tc-meta-label {
    font-family: 'Poppins', sans-serif;
    font-size: 11px;
    font-weight: 700;
    color: #aaa;
    text-transform: uppercase;
    letter-spacing: 0.8px;
}

.tc-meta-val {
    font-family: 'Open Sans', sans-serif;
    font-size: 14px;
    color: #1d1d1d;
    font-weight: 600;
}

@media (max-width: 767px) {
    .tc-doc-header { padding: 20px 18px; }
    .tc-doc-title { font-size: 17px; }
    .tc-doc-meta { gap: 14px 24px; }
}
    </style>
</head>
<body>
    <div class="wrapper" id="top">

        @include('landingPage.header')

        <div class="midd-container">

            <!-- Inner Banner -->
            <div class="hero-main inner-banner white-sec"
                 style="background: url('{{ asset('assets/pages/images/banner/privacy-banner.jpeg') }}') no-repeat center center / cover;">
                <div class="container">
                    <!-- Title -->
                    <div class="row justify-content-center text-center">
                        <div class="col-sm-12 col-md-8">
                            <div class="banner-content">
                                <h1>Privacy <span>Policy</span></h1>
                            </div>
                        </div>
                    </div>
                    <!-- Breadcrumb below title -->
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb-custom">
                                    <li><a href="{{url('/')}}">Home</a></li>
                                    <li class="separator">/</li>
                                    <li class="active">Privacy Policy</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Banner End -->

            <!-- Privacy Content -->
            <section class="terms-page-section">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-md-10 offset-md-1">

                             <div class="tc-doc-header">
                  
                    <div class="tc-doc-meta">
                        <div class="tc-doc-meta-item">
                            <span class="tc-meta-label">Effective Date</span>
                            <span class="tc-meta-val">07-04-2026</span>
                        </div>
                        <div class="tc-doc-meta-item">
                            <span class="tc-meta-label">Last Updated</span>
                            <span class="tc-meta-val">07-04-2026</span>
                        </div>
                        
                    </div>
                </div>

                           
                            <div class="terms-block">
                                <h3><span class="tc-num">01</span> About us</h3>
                                <p>
We, Winngoo, a UK-based crypto platform provider. This policy is compliant with UK GDPR and the Data Protection Act 2018.
</p>
                                
                            </div>

                            <div class="terms-block">
                                <h3><span class="tc-num">02</span> Data We Collect</h3>
                               
                                <ul>
                                    <li>Personal Information: Full name, date of birth, postal code, email, phone number, photo ID (KYC).</li>
                                    <li>Technical Data: IP address, geolocation, device ID, VPN status.</li>
                                    <li>Usage Data: Login attempts, session activity, mining progress.</li>
                                    
                                </ul>
                            </div>

                            <div class="terms-block">
                                <h3><span class="tc-num">03</span> How We Use Your Data</h3>
                                <p>We process your data to:</p>
                                <ul>
                                    <li>Verify identity (KYC compliance under Money Laundering Regulations 2017)</li>
                                    <li>Manage mining operations</li>
                                    <li>Send notifications (via consent or legitimate interest)</li>
                                    <li>Enforce platform rules</li>
                                      <li>Prevent fraud and meet legal obligations</li>
                                </ul>
                            </div>

                            <div class="terms-block">
                                <h3><span class="tc-num">04</span> Legal Basis for Processing</h3>
                                <p>We process your personal data under the following legal bases:</p>
                                <ul>
                                    <li>Contractual obligation (platform use)</li>
                                    <li>Legal obligation (AML, KYC)</li>
                                    <li>Legitimate interest (platform security, user verification)</li>
                                       <li>Consent (optional marketing)</li>
                                </ul>
                               
                            </div>

                            <div class="terms-block">
                                <h3><span class="tc-num">05</span> Data Retention</h3>
                                <p>We retain personal data for as long as your account is active and as required by law (e.g. 5 years for KYC-related data).
</p>
                               
                            </div>

                            <div class="terms-block">
                                <h3><span class="tc-num">06</span> Data Sharing</h3>
                                <p>We may share data with:</p>
                                 <ul>
                                    <li>Third-party KYC/AML service providers</li>
                                    <li>Regulatory authorities (as required by law)</li>
                                    <li>Internal teams for technical operations</li>
                                      
                                </ul>
                               
                                <p>We do not sell personal data to third parties.</p>
                            </div>

                            <div class="terms-block">
                                <h3><span class="tc-num">07</span> Data Transfers</h3>
                                <p>Data may be stored in the UK or securely transferred under UK-approved Standard Contractual Clauses (SCCs) if stored internationally.</p>
                               
                            </div>

                            <div class="terms-block">
                                <h3><span class="tc-num">08</span> Legal Rights</h3>
                                <p>Under the UK GDPR, you have the right to:</p>
                                <ul>
                                    <li>Access your data</li>
                                    <li>Correct inaccuracies</li>
                                    <li>Request erasure (right to be forgotten)</li>
                                    <li>Object to processing</li>
                                    <li>Withdraw consent</li>
                                    <li>Lodge a complaint with the ICO (Information Commissioner’s Office).</li>
                                </ul>
                               
                            </div>

                            <div class="terms-block">
                                <h3><span class="tc-num">09</span> Lawful Basis for Processing</h3>
                                <p>We process your data under:</p>
                                 <ul>
                                    <li>Consent (e.g., for marketing, optional features)</li>
                                    <li>Contract (for providing platform access)</li>
                                    <li>Legal Obligation (KYC, AML)</li>
                                    <li>Legitimate Interest (fraud prevention, analytics)</li>
                                   
                                </ul>
                            </div>

                            <div class="terms-block">
                                <h3><span class="tc-num">10</span> Security Measures</h3>
                                  <ul>
                                    <li>End-to-end encryption of sensitive data</li>
                                    <li>Enforced 2FA and brute-force prevention</li>
                                    <li>Real-time audit logs and alerts</li>
                                    
                                   
                                </ul>
                            </div>

                            <div class="terms-block">
                                <h3><span class="tc-num">11</span> International Data Transfers</h3>
                                <p>We do not transfer your personal data outside the UK/EEA unless adequate safeguards are in place (e.g., Standard Contractual Clauses).</p>
                            </div>

                            <div class="terms-block">
                                <h3><span class="tc-num">12</span> Cookies and Tracking</h3>
                                <p>We use essential cookies and analytics tools. Consent is obtained where required under the Privacy and Electronic Communications Regulations (PECR).</p>
                              
                            </div>

                              <div class="terms-block">
                                <h3><span class="tc-num">13</span> Changes to This Policy</h3>
                                <p>Any changes will be communicated via the platform. Continued use indicates acceptance.</p>
                              
                            </div>


                              <div class="terms-block">
                                <h3> Contact Us:</h3>
                                <p> <strong>Email:</strong> support@winngoocoin.com</p>
                                <p> <strong> Address:</strong>  Unit 5, Martinbridge Trading Estate, 240-242 Lincoln Road, Enfield, EN1 1SP, United Kingdom.</p>
                                <!--<p> <strong>ICO Registration Number:</strong>  [If applicable]</p>-->
                              
                            </div>

                        </div>
                    </div>
                </div>
            </section>

        </div>
        <div class="clear"></div>

       @include('landingPage.footer')
    </div>

       <script src="{{ asset('assets/pages/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/pages/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/pages/js/onpagescroll.js') }}"></script>
    <script src="{{ asset('assets/pages/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/pages/js/script.js') }}"></script>

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