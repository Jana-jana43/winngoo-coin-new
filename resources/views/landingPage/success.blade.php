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
    <title>Registration Successful - Winngoo Coin</title>
   <link rel="stylesheet" href="{{ asset('assets/pages/css/fontawesome.min.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ asset('assets/pages/css/bootstrap.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ asset('assets/pages/css/animate.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ asset('assets/pages/css/owl.carousel.min.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ asset('assets/pages/css/coin.css') }}">
<link rel="stylesheet" href="{{ asset('assets/pages/css/style.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ asset('assets/pages/css/responsive.css') }}" type="text/css"/>
    <style>
    /* ===== Success Popup Overlay ===== */
    .success-popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        z-index: 99999;
        display: none;
        justify-content: center;
        align-items: center;
        backdrop-filter: blur(5px);
        -webkit-backdrop-filter: blur(5px);
    }

    .success-popup-overlay.active {
        display: flex;
    }

    /* ===== Popup Container ===== */
    .success-popup {
        background: #fff;
        border-radius: 20px;
        padding: 50px 40px;
        max-width: 450px;
        width: 90%;
        text-align: center;
        position: relative;
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.3);
        animation: popupSlideIn 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards;
        overflow: hidden;
    }

    .success-popup::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, #28a745, #20c997, #17a2b8);
    }

    /* ===== Slide In Animation ===== */
    @keyframes popupSlideIn {
        0% {
            opacity: 0;
            transform: scale(0.5) translateY(-50px);
        }
        100% {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    /* ===== Close Button ===== */
    .success-popup .popup-close {
        position: absolute;
        top: 15px;
        right: 20px;
        background: none;
        border: none;
        font-size: 24px;
        color: #999;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        line-height: 1;
    }

    .success-popup .popup-close:hover {
        color: #333;
        background: #f0f0f0;
        transform: rotate(90deg);
    }

    /* ===== Checkmark Circle ===== */
    .success-checkmark {
        width: 100px;
        height: 100px;
        margin: 0 auto 25px;
        border-radius: 50%;
        background: linear-gradient(135deg, #28a745, #20c997);
        display: flex;
        align-items: center;
        justify-content: center;
        animation: checkBounce 0.6s ease 0.3s both;
        box-shadow: 0 10px 30px rgba(40, 167, 69, 0.3);
    }

    @keyframes checkBounce {
        0% {
            transform: scale(0);
            opacity: 0;
        }
        50% {
            transform: scale(1.2);
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    /* ===== Animated SVG Checkmark ===== */
    .checkmark-svg {
        width: 50px;
        height: 50px;
    }

    .checkmark-svg .checkmark-path {
        stroke: #fff;
        stroke-width: 3;
        fill: none;
        stroke-linecap: round;
        stroke-linejoin: round;
        stroke-dasharray: 50;
        stroke-dashoffset: 50;
        animation: drawCheck 0.5s ease 0.7s forwards;
    }

    @keyframes drawCheck {
        to {
            stroke-dashoffset: 0;
        }
    }

    /* ===== Confetti Particles ===== */
    .confetti-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        overflow: hidden;
    }

    .confetti {
        position: absolute;
        width: 10px;
        height: 10px;
        top: -10px;
        opacity: 0;
    }

    .confetti.active {
        animation: confettiFall 2s ease forwards;
    }

    @keyframes confettiFall {
        0% {
            opacity: 1;
            top: -10px;
            transform: rotate(0deg) scale(1);
        }
        100% {
            opacity: 0;
            top: 100%;
            transform: rotate(720deg) scale(0.5);
        }
    }

    /* ===== Text Styles ===== */
    .success-popup h2 {
        font-family: 'Poppins', sans-serif;
        font-size: 28px;
        font-weight: 700;
        color: #333;
        margin-bottom: 10px;
        animation: fadeInUp 0.5s ease 0.5s both;
    }

    .success-popup .success-subtitle {
        font-family: 'Open Sans', sans-serif;
        font-size: 15px;
        color: #777;
        margin-bottom: 8px;
        line-height: 1.6;
        animation: fadeInUp 0.5s ease 0.65s both;
    }

    .success-popup .success-email {
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        color: #28a745;
        font-weight: 600;
        margin-bottom: 25px;
        animation: fadeInUp 0.5s ease 0.75s both;
    }

    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(15px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ===== Divider ===== */
    .popup-divider {
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, #28a745, #20c997);
        margin: 0 auto 25px;
        border-radius: 2px;
        animation: fadeInUp 0.5s ease 0.85s both;
    }

    /* ===== Info Box ===== */
    .popup-info {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 15px 20px;
        margin-bottom: 25px;
        border-left: 4px solid #28a745;
        animation: fadeInUp 0.5s ease 0.9s both;
    }

    .popup-info p {
        font-family: 'Open Sans', sans-serif;
        font-size: 13px;
        color: #666;
        margin: 0;
        line-height: 1.5;
    }

    .popup-info p i {
        color: #28a745;
        margin-right: 8px;
    }

    /* ===== CTA Button ===== */
    .success-popup .popup-btn {
        display: inline-block;
        padding: 14px 45px;
        background: linear-gradient(135deg, #28a745, #20c997);
        color: #fff;
        font-family: 'Poppins', sans-serif;
        font-size: 15px;
        font-weight: 600;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        letter-spacing: 0.5px;
        animation: fadeInUp 0.5s ease 1s both;
        box-shadow: 0 5px 20px rgba(40, 167, 69, 0.3);
    }

    .success-popup .popup-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(40, 167, 69, 0.4);
        background: linear-gradient(135deg, #20c997, #28a745);
    }

    .success-popup .popup-btn:active {
        transform: translateY(-1px);
    }

    /* ===== Responsive ===== */
    @media (max-width: 480px) {
        .success-popup {
            padding: 40px 25px;
            margin: 15px;
        }

        .success-popup h2 {
            font-size: 22px;
        }

        .success-checkmark {
            width: 80px;
            height: 80px;
        }

        .checkmark-svg {
            width: 40px;
            height: 40px;
        }

        .success-popup .popup-btn {
            padding: 12px 35px;
            font-size: 14px;
        }
    }
</style>
</head>
<body>
    <div class="wrapper" id="top">

       @include('landingPage.header')
      
        <!-- ===== Registration Success Content ===== -->
        <style>
            header {
                padding-top: 15px;
                padding-bottom: 15px;
                background: #000;
                
            }
            .success-section {
                min-height: 80vh;
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 150px 20px;
            }
            .success-box {
                background: #fff;
                border-radius: 20px;
                padding: 50px 40px;
                max-width: 500px;
                width: 100%;
                text-align: center;
                box-shadow: 0 25px 60px rgba(0, 0, 0, 0.3);
                position: relative;
                overflow: hidden;
            }
            .success-box::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 5px;
                background: linear-gradient(90deg, #cf9b42, #eecd82, #fbbd18);
            }
            .success-icon-wrapper {
                position: relative;
                width: 140px;
                height: 140px;
                margin: 0 auto 25px;
            }
            .success-icon {
                width: 100px;
                height: 100px;
                margin: 0 auto;
                border-radius: 50%;
                background: linear-gradient(90deg, #ffce5f, #fbbd18, #ffce5f);
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 10px 30px rgb(167 157 40 / 30%);
                position: relative;
                top: 50%;
                transform: translateY(-50%);
            }
            .success-icon svg {
                width: 50px;
                height: 50px;
            }
            .success-icon svg path {
                stroke: #fff;
                stroke-width: 3;
                fill: none;
                stroke-linecap: round;
                stroke-linejoin: round;
            }

            /* Sparkle styles */
            .sparkle {
                position: absolute;
                width: 10px;
                height: 10px;
                animation: twinkle 1.5s ease-in-out infinite;
            }
            .sparkle::before,
            .sparkle::after {
                content: '';
                position: absolute;
                background: #fbbd18;
                border-radius: 2px;
            }
            .sparkle::before {
                width: 100%;
                height: 3px;
                top: 50%;
                left: 0;
                transform: translateY(-50%);
            }
            .sparkle::after {
                width: 3px;
                height: 100%;
                left: 50%;
                top: 0;
                transform: translateX(-50%);
            }

            .sparkle-1 {
                top: 5px;
                left: 15px;
                animation-delay: 0s;
                transform: scale(0.8);
            }
            .sparkle-2 {
                top: 0px;
                right: 25px;
                animation-delay: 0.5s;
                transform: scale(0.6);
            }
            .sparkle-3 {
                top: 30px;
                right: 5px;
                animation-delay: 0.2s;
                transform: scale(0.9);
            }
            .sparkle-4 {
                bottom: 25px;
                right: 8px;
                animation-delay: 0.8s;
                transform: scale(0.7);
            }
            .sparkle-5 {
                bottom: 5px;
                right: 30px;
                animation-delay: 1.1s;
                transform: scale(0.5);
            }
            .sparkle-6 {
                bottom: 0px;
                left: 25px;
                animation-delay: 0.3s;
                transform: scale(0.8);
            }
            .sparkle-7 {
                bottom: 30px;
                left: 3px;
                animation-delay: 0.7s;
                transform: scale(0.6);
            }
            .sparkle-8 {
                top: 25px;
                left: 3px;
                animation-delay: 1s;
                transform: scale(0.5);
            }

            @keyframes twinkle {
                0%, 100% {
                    opacity: 0;
                    transform: scale(0.3) rotate(0deg);
                }
                50% {
                    opacity: 1;
                    transform: scale(1) rotate(45deg);
                }
            }

            .sparkle-1 { animation: twinkle 1.5s ease-in-out 0s infinite; }
            .sparkle-2 { animation: twinkle 1.8s ease-in-out 0.5s infinite; }
            .sparkle-3 { animation: twinkle 1.4s ease-in-out 0.2s infinite; }
            .sparkle-4 { animation: twinkle 1.7s ease-in-out 0.8s infinite; }
            .sparkle-5 { animation: twinkle 1.6s ease-in-out 1.1s infinite; }
            .sparkle-6 { animation: twinkle 1.5s ease-in-out 0.3s infinite; }
            .sparkle-7 { animation: twinkle 1.9s ease-in-out 0.7s infinite; }
            .sparkle-8 { animation: twinkle 1.3s ease-in-out 1s infinite; }

            .success-box h2 {
                font-family: 'Poppins', sans-serif;
                font-size: 26px;
                font-weight: 700;
                color: #333;
                margin-bottom: 12px;
            }
            .success-box p {
                font-family: 'Open Sans', sans-serif;
                font-size: 15px;
                color: #777;
                line-height: 1.7;
                margin-bottom: 25px;
            }
            .success-divider {
                width: 60px;
                height: 3px;
                background: linear-gradient(90deg, #cf9b42, #eecd82, #fbbd18);
                margin: 0 auto 25px;
                border-radius: 2px;
            }
            .success-info {
                background: #f8f9fa;
                border-radius: 12px;
                padding: 15px 20px;
                margin-bottom: 30px;
                border-left: 4px solid #fbbd18;
                text-align: left;
            }
            .success-info p {
                font-size: 13px;
                color: #666;
                margin: 0;
                line-height: 1.6;
            }
            .success-info p i {
                color: #fbbd18;
                margin-right: 8px;
            }
            .success-box .success-btn {
                display: inline-block;
                padding: 14px 45px;
                background: linear-gradient(135deg, #28a745, #20c997);
                color: #fff;
                font-family: 'Poppins', sans-serif;
                font-size: 15px;
                font-weight: 600;
                border: none;
                border-radius: 50px;
                text-decoration: none;
                box-shadow: 0 5px 20px rgba(40, 167, 69, 0.3);
                transition: all 0.3s ease;
            }
            .success-box .success-btn:hover {
                transform: translateY(-3px);
                box-shadow: 0 8px 30px rgba(40, 167, 69, 0.4);
                color: #fff;
                text-decoration: none;
            }
            @media (max-width: 480px) {
                .success-section { padding: 60px 15px; }
                .success-box { padding: 40px 25px; }
                .success-box h2 { font-size: 22px; }
                .success-icon { width: 80px; height: 80px; }
                .success-icon svg { width: 40px; height: 40px; }
                .success-box .success-btn { padding: 12px 35px; font-size: 14px; }
            }
        </style>
        
        <section class="success-section">
            <div class="success-box">
        
                <div class="success-icon-wrapper">
                    <span class="sparkle sparkle-1"></span>
                    <span class="sparkle sparkle-2"></span>
                    <span class="sparkle sparkle-3"></span>
                    <span class="sparkle sparkle-4"></span>
                    <span class="sparkle sparkle-5"></span>
                    <span class="sparkle sparkle-6"></span>
                    <span class="sparkle sparkle-7"></span>
                    <span class="sparkle sparkle-8"></span>
                    <div class="success-icon">
                        <img src="{{ asset('assets/images/w-coin-success.png') }}" alt="">
                    </div>
                </div>
        
                <h2>Registration Successful!</h2>
        
                <p>Your account has been created successfully.<br>Welcome to <strong>Winngoo Coin!</strong></p>
        
                <div class="success-divider"></div>
        
            </div>
        </section>
        <!-- ===== End Registration Success Content ===== -->
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


// <script>
//     const status = "{{ $status }}";

//     const appUrl = `winngoocoin://loginscreen?status=${status}`;
//     const webUrl = `https://winngoocoin.wimbgo.com/loginscreen?status=${status}`;

//     let appOpened = false;

//     document.addEventListener("visibilitychange", function () {
//         if (document.hidden) {
//             appOpened = true;
//         }
//     });

//     // Try to open mobile app
//     window.location.href = appUrl;

//     // Fallback to web
//     // setTimeout(function () {
//     //     if (!appOpened) {
//     //         window.location.href = webUrl;
//     //     }
//     // }, 2000);

//     // Manual fallback
//     document.getElementById("fallbackLink").href = webUrl;
// </script>










<script>
    const status = "{{ $status }}";
    const appUrl = `winngoocoin://loginscreen?status=${status}`;

    let appOpened = false;

    // Detect app open
    document.addEventListener("visibilitychange", function () {
        if (document.hidden) {
            appOpened = true;
        }
    });

    // Try to open app AFTER page loads
    setTimeout(function () {
        window.location.href = appUrl;
    }, 500);

    // If app NOT opened → stay on page and redirect to HOME
    setTimeout(function () {
        if (!appOpened) {
            window.location.href = "{{ route('home') }}";
        }
    }, 2000);
</script>






</body>
</html>


