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
    <title>FAQ – Winngoo Coin</title>
   <link rel="stylesheet" href="{{ asset('assets/pages/css/fontawesome.min.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ asset('assets/pages/css/bootstrap.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ asset('assets/pages/css/animate.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ asset('assets/pages/css/owl.carousel.min.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ asset('assets/pages/css/coin.css') }}">
<link rel="stylesheet" href="{{ asset('assets/pages/css/style.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ asset('assets/pages/css/responsive.css') }}" type="text/css"/>
    
    <style>
/* ===================================
   INNER BANNER  (matches terms/privacy)
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
    margin: 0 0 0 0;
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
    margin-bottom: 14px;
}
.banner-content h1 span {
    color: #fbbd18;
    font-weight: 300;
}

/* ===================================
   RESPONSIVE  (matches terms/privacy)
=================================== */
@media (max-width: 767px) {
    .inner-banner {
        padding-top: 110px !important;
        padding-bottom: 30px !important;
        min-height: 280px !important;
        align-items: center !important;
        background-position: 68% !important;
    }
    .banner-content h1 { font-size: 28px; }
    .breadcrumb-custom li { font-size: 12px; }
}
@media (max-width: 480px) {
    .inner-banner { padding-top: 95px !important; }
    .banner-content h1 { font-size: 24px; }
    .breadcrumb-custom li { font-size: 11px; }
}
    </style>
</head>
<body>
    <div class="wrapper" id="top">

       @include('landingPage.header')

        <div class="midd-container">

            <!-- Inner Banner — same structure as terms.html & privacy.html -->
            <div class="hero-main inner-banner white-sec"
                 style="background: url('{{ asset('assets/pages/images/banner/faq-banner.jpeg') }}') no-repeat center center / cover;">
                <div class="container">

                    <!-- 1. Title FIRST -->
                    <div class="row justify-content-center text-center">
                        <div class="col-sm-12 col-md-8">
                            <div class="banner-content">
                                <h1>FAQ</h1>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Breadcrumb BELOW title -->
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb-custom">
                                    <li><a href="{{url('/')}}">Home</a></li>
                                    <li class="separator">/</li>
                                    <li class="active">FAQ</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Banner End -->

            <!-- FAQ Section Start -->
            <div class="faq-section p-tb white-bg diamond-layout" id="faq">
                <div class="container">
                    <div class="h4-header-l text-center mb-5" style="font-size: 16px;">
                        <h2>Frequently Asked <span class="gold-word">Questions</span></h2>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="accordion md-accordion style-2" id="accordionEx" role="tablist" aria-multiselectable="true">

                                <div class="card">
                                    <div class="card-header" role="tab" id="headingOne1">
                                        <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne1" aria-expanded="true" aria-controls="collapseOne1">
                                            <h5 class="mb-0">How do I get started with Winngoo Coin? <i class="fas fa-caret-down rotate-icon"></i></h5>
                                        </a>
                                    </div>
                                    <div id="collapseOne1" class="collapse show" role="tabpanel" aria-labelledby="headingOne1" data-parent="#accordionEx">
                                        <div class="card-body">Create an account using your email and phone number, complete verification, and begin with the Bronze tier. Once registered, you can activate your mining cycle from the dashboard.</div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" role="tab" id="headingTwo2">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseTwo2" aria-expanded="false" aria-controls="collapseTwo2">
                                            <h5 class="mb-0">Do I need to pay to use the platform? <i class="fas fa-caret-down rotate-icon"></i></h5>
                                        </a>
                                    </div>
                                    <div id="collapseTwo2" class="collapse" role="tabpanel" aria-labelledby="headingTwo2" data-parent="#accordionEx">
                                        <div class="card-body">No upfront payment is required to register or begin mining. You simply need to log in periodically to keep your mining cycle active.</div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" role="tab" id="headingThree3">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseThree3" aria-expanded="false" aria-controls="collapseThree3">
                                            <h5 class="mb-0">Does mining affect my phone's performance? <i class="fas fa-caret-down rotate-icon"></i></h5>
                                        </a>
                                    </div>
                                    <div id="collapseThree3" class="collapse" role="tabpanel" aria-labelledby="headingThree3" data-parent="#accordionEx">
                                        <div class="card-body">Mining runs through cloud infrastructure and does not rely on your device's processing power.</div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" role="tab" id="headingFour4">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseFour4" aria-expanded="false" aria-controls="collapseFour4">
                                            <h5 class="mb-0">How do tier upgrades work? <i class="fas fa-caret-down rotate-icon"></i></h5>
                                        </a>
                                    </div>
                                    <div id="collapseFour4" class="collapse" role="tabpanel" aria-labelledby="headingFour4" data-parent="#accordionEx">
                                        <div class="card-body">All users begin with the Bronze tier. Movement to higher tiers is based on overall activity and verified referrals within the platform. Bronze runs for 2 years, Silver for 1.5 years, and Gold for 1 year, each with its own defined mining cycle.</div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" role="tab" id="headingFive5">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseFive5" aria-expanded="false" aria-controls="collapseFive5">
                                            <h5 class="mb-0">How can I improve my mining performance? <i class="fas fa-caret-down rotate-icon"></i></h5>
                                        </a>
                                    </div>
                                    <div id="collapseFive5" class="collapse" role="tabpanel" aria-labelledby="headingFive5" data-parent="#accordionEx">
                                        <div class="card-body">Consistent participation and verified referrals contribute to improved mining performance. The more active and engaged you are, the stronger your progression.</div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" role="tab" id="headingSix6">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseSix6" aria-expanded="false" aria-controls="collapseSix6">
                                            <h5 class="mb-0">When can I withdraw my coins? <i class="fas fa-caret-down rotate-icon"></i></h5>
                                        </a>
                                    </div>
                                    <div id="collapseSix6" class="collapse" role="tabpanel" aria-labelledby="headingSix6" data-parent="#accordionEx">
                                        <div class="card-body">Withdrawals will be available after completing identity verification (KYC) once the withdrawal phase is activated. Until then, rewards can be tracked within the app.</div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" role="tab" id="headingSeven7">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseSeven7" aria-expanded="false" aria-controls="collapseSeven7">
                                            <h5 class="mb-0">Is my personal information secure? <i class="fas fa-caret-down rotate-icon"></i></h5>
                                        </a>
                                    </div>
                                    <div id="collapseSeven7" class="collapse" role="tabpanel" aria-labelledby="headingSeven7" data-parent="#accordionEx">
                                        <div class="card-body">Yes. Winngoo uses biometric access options, PIN protection, VPN detection, and session monitoring to help safeguard user accounts and personal data.</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FAQ Section End -->

        </div>
        <div class="clear"></div>

       @include('landingPage.footer')
    </div>

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
        jQuery(document).ready(function(){
            setTimeout(function(){ jQuery('.diamond-animation').addClass('done'); }, 6000);
            setTimeout(function(){ jQuery('.diamond-animation .main').addClass('active'); }, 1000);
            setTimeout(function(){ jQuery('.inside-bitcoin').addClass('active'); }, 3000);
            setTimeout(function(){ jQuery('.inside-bitcoin').addClass('spincoin'); }, 5000);
            setTimeout(function(){ jQuery('.diamond-animation .lines').addClass('active'); }, 6000);
            setTimeout(function(){ jQuery('.diamond-animation .top-coin').addClass('active'); }, 3000);
            setTimeout(function(){ jQuery('.diamond-animation .outer-Orbit').addClass('active'); }, 5000);
        });
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