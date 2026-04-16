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
    <title>Terms & Conditions – Winngoo Coin</title>
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
   TERMS BODY SECTION
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

/* Section block */
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
    position: relative;
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

/* Last updated badge */
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
                 style="background: url('{{ asset('assets/pages/images/banner/terms-banner.jpg') }}') no-repeat center center / cover;">
                <div class="container">
                    <!-- Title -->
                    <div class="row justify-content-center text-center">
                        <div class="col-sm-12 col-md-8">
                            <div class="banner-content">
                                <h1>Terms &amp; <span>Conditions</span></h1>
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
                                    <li class="active">Terms &amp; Conditions</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Banner End -->

            <!-- Terms Content -->
            <section class="terms-page-section">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-md-10 offset-md-1">

                          <div class="tc-doc-header">
                 
                    <div class="tc-doc-meta">
                        <div class="tc-doc-meta-item">
                            <span class="tc-meta-label">Date of Effectiveness</span>
                            <span class="tc-meta-val">07-04-2026</span>
                        </div>
                        <div class="tc-doc-meta-item">
                            <span class="tc-meta-label">Last Update</span>
                            <span class="tc-meta-val">07-04-2026</span>
                        </div>
                        <div class="tc-doc-meta-item">
                            <span class="tc-meta-label">Authority</span>
                            <span class="tc-meta-val">07-04-2026</span>
                        </div>
                    </div>
                </div>


                            <div class="terms-block">
                                <h3><span class="tc-num">01</span> Overview</h3>
                                <p>Your use of the Winngoo Coin platform (the "Platform") is governed by these Terms and Conditions ("Terms"). You agree to abide by these Terms, our Privacy Policy, and any applicable UK laws by creating an account or using our services.</p>
                                
                            </div>

                            <div class="terms-block">
                                <h3><span class="tc-num">02</span> Terminologies</h3>
                              
                                <ul>
                                    <li>Any person or organization that uses the Platform is referred to as a "User."</li>
                                    <li>Winngoo Coin is referred to by "We," "Us," and "Company."</li>
                                    <li>The Bronze, Silver, and gold coins that are mineable on the Platform are referred to as "Digital Assets."</li>
                                    <li>All mining, referral, and wallet-based features are referred to as "services."</li>
                                </ul>
                               
                            </div>

                            <div class="terms-block">
                                <h3><span class="tc-num">03</span> Eligibility</h3>
                                <p>To register, a user must be at least eighteen years old. To verify their identity, they must supply accurate and comprehensive information.

</p>
                              
                            </div>

                            <div class="terms-block">
                                <h3><span class="tc-num">04</span> Account Registration and KYC:</h3>
                               
                                <ul>
                                    <li>User must register and account and complete KYC verification </li>
                                    <li>Failure to provide accurate documentation may lead to account suspension.</li>
                                    <li>We comply with the money laundering regulations 2017 and proceeds og crime act 2002.</li>
                                </ul>
                                <p>We promise to protect your login information. We also promise not to use another user's account or share your access credentials.</p>
                            </div>

                            <div class="terms-block">
                                <h3><span class="tc-num">05</span> Services</h3>
                                <p>Users are able to mine various coin tiers.</p>
                                <ul>
                                    <li>Through referrals, users can earn rewards or upgrade their coins.</li>
                                    <li>Through referrals, users can earn rewards or upgrade their coins.</li>
                                   
                                </ul>
                            </div>

                            <div class="terms-block">
                                <h3><span class="tc-num">06</span> Fees and Payments</h3>
                                <p>Every purchase is final. For assets that have been mined or transacted, refunds will not be given.HMRC requirements must be followed when paying any applicable taxes.</p>
                              
                            </div>

                            <div class="terms-block">
                                <h3><span class="tc-num">07</span> Permitted Use</h3>
                                <p>You are not allowed to:</p>
                                <ul>
                                    <li>Engage in fraudulent or unlawful activity on the platform.</li>
                                    <li>Try to gain access to the systems or data of other users.</li>
                                      <li>Send spam or malicious code.</li>
                                   
                                </ul>
                            </div>

                            <div class="terms-block">
                                <h3><span class="tc-num">08</span> Property Rights</h3>
                                <p>The Copyright, Designs and Patents Act of 1988 protects all of the content on the platform, which is either owned by Winngoo Coin or licensed to us.</p>
                               
                            </div>

                            <div class="terms-block">
                                <h3><span class="tc-num">09</span> Discontinuation</h3>
                                <p>If you violate these terms or use the platform in an illegal manner, we reserve the right to suspend or terminate your account without prior notice. </p>
                            </div>

                            <div class="terms-block">
                                <h3><span class="tc-num">10</span> Disclaimers</h3>
                                <p>We do not guarantee the performance or profitability of digital mining, and the platform is offered "as is" with no guarantees of any kind. </p>
                               
                            </div>

                            <div class="terms-block">
                                <h3><span class="tc-num">11</span> Liability Limitation</h3>
                               <ul>
                                    <li>We are not liable for any loss of data, business, or revenue.</li>
                                    <li>An interruption, error, or delay in platform access. </li>
                                      
                                   
                                </ul>
                            </div>

                            <div class="terms-block">
                                <h3><span class="tc-num">12</span> The Law That Oversees</h3>
                                <p>The laws of England and Wales apply to these terms. Only English courts will hear disputes.</p>
                            </div>

                            <div class="terms-block">
                                <h3><span class="tc-num">13</span> Mining and Staking</h3>
                                <p>You consent to a short-term lock-in under either flexible or fixed contracts when you stake tokens.Rewards are contingent on terms, APY, and staking amounts and are not assured.</p>
                               
                            </div>
                             <div class="terms-block">
                                <h3><span class="tc-num">14</span> Withdrawals</h3>
                                <p>Users can ask for withdrawals to bank accounts or verified wallets; processing times and costs may differ; withdrawal history is recorded.</p>
                               
                            </div>

                            <div class="terms-block">
                                <h3><span class="tc-num">15</span> Reward and Referral Programs</h3>
                                <p>We can suspend referral rewards for misuse or noncompliance, and referral codes and commissions are subject to KYC and anti-fraud checks. </p>
                               
                            </div>

                            <div class="terms-block">
                                <h3><span class="tc-num">16</span> Contact us</h3>
                                <p>For any inquiries about the law or policy, get in touch with support@winngoocoin.com.  </p>
                               
                            </div>

                            <div class="terms-block">
                                <h3>Data Security and 2FA:</h3>
                                 <ul>
                                    <li>Users are encouraged to enable Two-Factor Authentication (2FA).</li>
                                    <li>All activity logs are maintained for audit and compliance purposes.</li>
                                      
                                   
                                </ul>
                               
                            </div>

                            <div class="terms-block">
                                <h3>Suspension and Termination</h3>
                                 <p>We reserve the right to:</p>
                               <ul>
                                    <li>Suspend or terminate accounts for violation of these Terms;</li>
                                    <li>Freeze assets in accordance with FCA guidance or law enforcement requests.</li>
                                      
                                   
                                </ul>
                               
                            </div>

                            <div class="terms-block">
                                <h3>Limitation of Liability</h3>
                                 <p>Winngoo Coin is not liable for:</p>
                                <ul>
                                    <li>User losses due to private key mismanagement;</li>
                                    <li>Loss of staking rewards or failed transactions due to third-party systems.</li>
                                      
                                   
                                </ul>
                               
                            </div>

                            <div class="terms-block">
                                <h3>Amendments:</h3>
                                <p>We may revise these Terms from time to time. Continued use after changes constitutes acceptance.

</p>
                               
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