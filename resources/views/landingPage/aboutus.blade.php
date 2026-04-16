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
    <title>About – Winngoo Coin</title>
   <link rel="stylesheet" href="{{ asset('assets/pages/css/fontawesome.min.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ asset('assets/pages/css/bootstrap.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ asset('assets/pages/css/animate.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ asset('assets/pages/css/owl.carousel.min.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ asset('assets/pages/css/coin.css') }}">
<link rel="stylesheet" href="{{ asset('assets/pages/css/style.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ asset('assets/pages/css/responsive.css') }}" type="text/css"/>
    <style>

/* ── INNER BANNER ── */
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
    background: rgba(0,0,0,0.75);
    content: "";
    left: 0; top: 0;
    height: 100%; width: 100%;
}
.inner-banner .container { position: relative; z-index: 1; width: 100%; }
.hero-main:before {
    position: absolute;
    background: rgba(0,0,0,0.3);
    content: "";
    left: 0; top: 0;
    height: 100%; width: 100%;
}
.breadcrumb-custom {
    list-style: none; padding: 0; margin: 0;
    display: flex; flex-wrap: wrap; align-items: center; justify-content: center; gap: 4px;
}
.breadcrumb-custom li { font-size: 16px; font-family: 'Poppins', sans-serif; text-transform: uppercase; letter-spacing: 1px; }
.breadcrumb-custom li a { color: #fbbd18; text-decoration: none; font-weight: 600; transition: all 300ms; }
.breadcrumb-custom li a:hover { color: #f0931e; }
.breadcrumb-custom li.separator { margin: 0 6px; color: rgba(255,255,255,0.4); }
.breadcrumb-custom li.active { color: #ffffff; font-weight: 400; }
.banner-content h1 { font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 48px; color: #ffffff; margin-bottom: 14px; }
.banner-content h1 span { color: #fbbd18; font-weight: 300; }

/* ── OVERLINE ── */
.overline {
    font-size: 10px; font-weight: 700; letter-spacing: 0.3em;
    text-transform: uppercase; color: #fbbd18; margin-bottom: 14px;
    display: flex; align-items: center; gap: 8px;
}
.overline::before { content: ''; width: 28px; height: 2px; background: #fbbd18; border-radius: 2px; }
.overline-center { justify-content: center; }
.overline-center::before, .overline-center::after { content: ''; width: 24px; height: 2px; background: #fbbd18; border-radius: 2px; }

/* ── INTRO SPLIT ── */
.ab-intro { display: grid; grid-template-columns: 55% 45%; min-height: 480px; }
.ab-intro-l { background: #fff; padding: 80px 70px; display: flex; flex-direction: column; justify-content: center; border-right: 1px solid #f0ebe0; }
.ab-intro-l h2 { font-size: 42px; font-weight: 800; color: #111; line-height: 1.12; margin-bottom: 20px; }
.ab-intro-l h2 .stroke { -webkit-text-stroke: 1.5px #111; color: transparent; }
.ab-intro-l h2 .gold { color: #fbbd18; }
.ab-intro-l .body-text { font-size: 16px; color: #666; line-height: 1.85; max-width: 480px; margin-bottom: 28px; text-align: justify;}
.ab-tagrow { display: flex; flex-wrap: wrap; gap: 8px; }
.ab-tag { font-size: 11px; font-weight: 600; padding: 6px 16px; border-radius: 100px; border: 1px solid #e8e0cc; color: #555; letter-spacing: 0.04em; transition: all 0.2s; }
.ab-tag:hover { border-color: #fbbd18; color: #fbbd18; }
.ab-intro-r { background: #fdf8ee; display: flex; align-items: stretch; flex-direction: column; }
.ab-intro-r .top-half {
    flex: 1; display: flex; align-items: center; justify-content: center;
    position: relative; overflow: hidden; border-bottom: 1px solid #ede8d8; min-height: 300px;
}
.ab-intro-r .top-half::before {
    content: ''; position: absolute; inset: 0;
    background: radial-gradient(circle at 50% 50%, rgba(251,189,24,0.12), transparent 65%);
}
.ab-coin { width: 200px; height: 200px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 38px; font-weight: 800; color: #3a2a00; box-shadow: 0 0 50px rgba(251,189,24,0.35); animation: abfloat 4s ease-in-out infinite; position: relative; z-index: 2; }
.ab-coin img { width: 100%; height: 100%; object-fit: contain; border-radius: 50%; }
@keyframes abfloat { 0%,100%{transform:translateY(0);} 50%{transform:translateY(-10px);} }
.ab-ring { position: absolute; border-radius: 50%; border: 1px solid rgba(251,189,24,0.2); animation: abrspin 20s linear infinite; }
.ab-ring:nth-child(1) { width: 220px; height: 220px; }
.ab-ring:nth-child(2) { width: 300px; height: 300px; animation-direction: reverse; animation-duration: 30s; }
@keyframes abrspin { to { transform: rotate(360deg); } }
.ab-ring::after { content: ''; position: absolute; top: -4px; left: 50%; width: 8px; height: 8px; border-radius: 50%; background: #fbbd18; transform: translateX(-50%); box-shadow: 0 0 8px #fbbd18; }
.ab-intro-r .bottom-half { display: grid; grid-template-columns: 1fr 1fr; }
.ab-stat { padding: 24px 26px; border-right: 1px solid #ede8d8; }
.ab-stat:last-child { border-right: none; }
.ab-stat .num { font-size: 30px; font-weight: 800; color: #111; line-height: 1; }
.ab-stat .num span { color: #000; }
.ab-stat .lbl { font-size: 11px; color: #000; margin-top: 4px; letter-spacing: 0.04em; }

/* ── MARQUEE ── */
.ab-strip { background: #fbbd18; overflow: hidden; padding: 14px 0; border-top: 1px solid rgba(0,0,0,0.06); border-bottom: 1px solid rgba(0,0,0,0.06); }
.ab-strip-track { display: flex; animation: abmarquee 22s linear infinite; white-space: nowrap; }
@keyframes abmarquee { from{transform:translateX(0);} to{transform:translateX(-50%);} }
.ab-strip-item { display: inline-flex; align-items: center; gap: 10px; padding: 0 28px; font-size: 16px; font-weight: 700; color: #3a2a00; letter-spacing: 0.1em; text-transform: uppercase; }
.ab-strip-item .dot { width: 5px; height: 5px; border-radius: 50%; background: #3a2a00; opacity: 0.4; }

/* ── PILLARS ── */
.ab-pillars { background: #fff; padding: 80px 60px; }
.ab-pillars-head { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 44px; }
.ab-pillars-head-l h3 { font-size: 32px; font-weight: 800; color: #111; line-height: 1.2; display:flex; gap:10px;}
.ab-pillars-head-l h3 span { color: #fbbd18; }
.ab-pillars-head-r p { font-size: 16px; color: #888; max-width: 500px; line-height: 1.7; text-align: right; }
.ab-pillars-grid { display: grid; grid-template-columns: repeat(3,1fr); border: 1px solid #ede8d8; border-radius: 14px; overflow: hidden; }
.ab-pillar { padding: 36px 32px; border-right: 1px solid #ede8d8; position: relative; transition: background 0.3s; }
.ab-pillar:last-child { border-right: none; }
.ab-pillar:hover { background: #fdf8ee; }
.ab-pillar-top { display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; }
.ab-pillar-icon { width: 60px; height: 60px; border-radius: 10px; background: #fdf8ee; border: 1px solid rgba(251,189,24,0.2); display: flex; align-items: center; justify-content: center; }
.ab-pillar-icon svg { width: 20px; height: 20px; fill: #fbbd18; }
.ab-pillar-n { font-size: 36px; font-weight: 800; color: rgba(251,189,24,0.1); line-height: 1; }
.ab-pillar h5 { font-size: 15px; font-weight: 700; color: #111; margin-bottom: 8px; }
.ab-pillar p { font-size: 16px; color: #888; line-height: 1.75; }
.ab-pillar-line { position: absolute; bottom: 0; left: 0; width: 0; height: 2px; background: #fbbd18; transition: width 0.45s ease; }
.ab-pillar:hover .ab-pillar-line { width: 100%; }

/* ── JOURNEY ── */
.ab-journey { background: #faf7f0; padding: 80px 60px; }
.ab-journey-head { text-align: center; margin-bottom: 60px; }
.ab-journey-head h3 { font-size: 32px; font-weight: 800; color: #111; }
.ab-journey-head h3 span { color: #fbbd18; }
.ab-steps { display: grid; grid-template-columns: repeat(4,1fr); position: relative; }
.ab-steps::before { content: ''; position: absolute; top: 32px; left: 12.5%; right: 12.5%; height: 1px; background: linear-gradient(90deg, #fbbd18 0%, rgba(251,189,24,0.3) 100%); z-index: 0; }
.ab-step { padding: 0 20px; text-align: center; position: relative; z-index: 1; }
.ab-step-node { width: 18px; height: 18px; border-radius: 50%; background: #fff; border: 2px solid #fbbd18; margin: 0 auto 20px; position: relative; box-shadow: 0 0 0 6px rgba(251,189,24,0.12); }
.ab-step-node.active { background: #fbbd18; }
.ab-step-node::before { content: ''; position: absolute; inset: -6px; border-radius: 50%; border: 1px solid rgba(251,189,24,0.25); }
.ab-step-year { font-size: 10px; font-weight: 700; letter-spacing: 0.15em; text-transform: uppercase; color: #fbbd18; margin-bottom: 6px; }
.ab-step h5 { font-size: 16px; font-weight: 700; color: #111; margin-bottom: 8px; padding-top: 15px; }
.ab-step p { font-size: 16px; color: #888; line-height: 1.7; }

/* ── WHY CHOOSE US SECTION ── */
.wcu-sec { padding: 90px 0; overflow: hidden; }
.wcu-wrap { margin: 0 auto; padding: 0 60px; }
.wcu-head { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: end; margin-bottom: 56px; }
.wcu-head-l .tag { font-size: 10px; font-weight: 700; letter-spacing: 0.28em; text-transform: uppercase; color: #fbbd18; display: flex; align-items: center; gap: 8px; margin-bottom: 12px; }
.wcu-head-l .tag::before { content: ''; width: 24px; height: 2px; background: #fbbd18; border-radius: 2px; }
.wcu-head-l h2 { font-size: 40px; font-weight: 800; color: #111; line-height: 1.1; }
.wcu-head-l h2 span { color: #fbbd18; }
.wcu-head-r p { font-size: 16px; color: #888; line-height: 1.8; }

/* big card */
.wcu-big-card { display: grid; grid-template-columns: 1fr 1fr; border-radius: 16px; overflow: hidden; margin-bottom: 16px; min-height: 300px; }
.wcu-bc-left { background: #111; padding: 52px 50px; display: flex; flex-direction: column; justify-content: space-between; position: relative; overflow: hidden; }
.wcu-bc-left::after { content: ''; position: absolute; bottom: -80px; right: -80px; width: 240px; height: 240px; border-radius: 50%; border: 1px solid rgba(251,189,24,0.08); }
.wcu-bc-left h3 { font-size: 26px; font-weight: 800; color: #fff; line-height: 1.2; position: relative; z-index: 1; }
.wcu-bc-left h3 span { color: #fbbd18; }
.wcu-bc-left p { font-size: 16px; color: #a89f88; line-height: 1.75; max-width: 340px; position: relative; z-index: 1; text-align: justify;}
.wcu-bc-left .pill { display: inline-flex; align-items: center; gap: 6px; background: rgba(251,189,24,0.12); border: 1px solid rgba(251,189,24,0.25); border-radius: 20px; padding: 5px 14px; font-size: 10px; font-weight: 700; color: #fbbd18; letter-spacing: 0.1em; text-transform: uppercase; position: relative; z-index: 1; width: fit-content; }
.wcu-bc-right { background: #fff; padding: 52px 50px; display: flex; flex-direction: column; gap: 20px; justify-content: center; border: 1px solid #ede8d8; border-left: none; }
.wcu-bc-feat { display: flex; align-items: flex-start; gap: 14px; padding-bottom: 20px; border-bottom: 1px solid #f0ebe0; }
.wcu-bc-feat:last-child { border-bottom: none; padding-bottom: 0; }
.wcu-bc-dot { width: 8px; height: 8px; border-radius: 50%; background: #fbbd18; margin-top: 5px; flex-shrink: 0; box-shadow: 0 0 8px rgba(251,189,24,0.5); }
.wcu-bc-feat h5 { font-size: 16px; font-weight: 700; color: #111; margin-bottom: 3px; }
.wcu-bc-feat p { font-size: 16px; color: #888; line-height: 1.65; }




/* reveal */
.rv { opacity: 0; transform: translateY(22px); transition: opacity 0.65s, transform 0.65s; }
.rv.in { opacity: 1; transform: translateY(0); }
.d1 { transition-delay: 0.1s; }
.d2 { transition-delay: 0.2s; }
.d3 { transition-delay: 0.3s; }
.d4 { transition-delay: 0.4s; }


/* ═══ RESPONSIVE ═══ */
    
@media (max-width: 991px) {
    .ab-intro { grid-template-columns: 1fr; }
    .ab-intro-r .top-half { min-height: 260px; }
    .ab-pillars-grid { grid-template-columns: 1fr 1fr; }
    .ab-steps { grid-template-columns: 1fr 1fr; gap: 30px; }
    .ab-steps::before { display: none; }
    .ab-pillars-head { flex-direction: column; gap: 12px; }
    .ab-pillars-head-r p { text-align: left; }
    .wcu-head { grid-template-columns: 1fr; }
    .wcu-big-card { grid-template-columns: 1fr; }
    .wcu-bc-right { border-left: 1px solid #ede8d8; border-top: none; }
    .wcu-small-row { grid-template-columns: 1fr 1fr; }
    .wcu-bot-strip { flex-direction: column; gap: 24px; align-items: flex-start; }
    .wcu-bot-stats { flex-wrap: wrap; gap: 20px; }
    .wcu-bs-item { padding: 0 20px; }
    .wcu-bs-item:first-child { padding-left: 0; }
    .wcu-wrap { padding: 0 30px; }
}
@media (max-width: 768px) {
    .ab-pillar p, .ab-step p{
        text-align: justify;
    }
    .inner-banner { padding-top: 110px !important; padding-bottom: 30px !important; min-height: 280px !important; }
    .banner-content h1 { font-size: 28px; }
    .ab-intro-l { padding: 44px 24px; }
    .ab-intro-l h2 { font-size: 28px; }
    .ab-pillars { padding: 50px 24px; }
    .ab-pillars-grid { grid-template-columns: 1fr; }
    .ab-pillar { border-right: none; border-bottom: 1px solid #ede8d8; }
    .ab-pillar:last-child { border-bottom: none; }
    .ab-journey { padding: 50px 24px; }
    .ab-steps { grid-template-columns: 1fr; }
    .wcu-wrap { padding: 0 20px; }
    .wcu-head-l h2 { font-size: 28px; }
    .wcu-big-card { grid-template-columns: 1fr; }
    .wcu-bc-left { padding: 36px 28px; }
    .wcu-bc-right { padding: 36px 28px; border-left: 1px solid #ede8d8; border-top: none; }
    .wcu-small-row { grid-template-columns: 1fr; }
    .wcu-bot-strip { padding: 28px 24px; border-radius: 10px; }
    .wcu-bot-stats { flex-direction: column; gap: 16px; }
    .wcu-bs-item { padding: 0; border-right: none; border-bottom: 1px solid rgba(26,18,0,0.1); padding-bottom: 12px; }
    .wcu-bs-item:last-child { border-bottom: none; padding-bottom: 0; }
    .wcu-bot-cta { width: 100%; }
    .wcu-bot-cta a { width: 100%; text-align: center; }
}
@media (max-width: 480px) {
    .inner-banner { padding-top: 95px !important; }
    .banner-content h1 { font-size: 24px; }
}
.ab-pillar-icon img {
    width: 40px;
    height: 40px;
    object-fit: contain;
    filter: brightness(0) saturate(100%) invert(72%) sepia(67%) saturate(500%) hue-rotate(1deg) brightness(101%) contrast(97%);
}
    </style>
</head>
<body>
    <div class="wrapper" id="top">

      @include('landingPage.header')
        <div class="midd-container">

            <!-- Banner -->
            <div class="hero-main inner-banner white-sec"
                 style="background: url('{{ asset('assets/pages/images/banner/about-banner2.jpeg') }}') no-repeat center center / cover;">
                <div class="container">
                    <div class="row justify-content-center text-center">
                        <div class="col-sm-12 col-md-8">
                            <div class="banner-content">
                                <h1>About <span>Winngoo Coin</span></h1>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb-custom">
                                    <li><a href="{{url('/')}}">Home</a></li>
                                    <li class="separator">/</li>
                                    <li class="active">About</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Intro Split -->
            <div class="ab-intro">
                <div class="ab-intro-l rv">
                    <div class="overline">Who We Are</div>
                    <h2>The Smarter Way to<br><span class="stroke">Mine</span> <span class="gold">Digital Assets</span></h2>
                    <p class="body-text">Winngoo Coin is a chip-powered digital mining platform created to simplify how users engage with crypto mining. Through defined tiers, live dashboard insights, and controlled activation, it brings clarity and balance to the mining process — giving every participant the visibility and control they deserve at every stage of their journey.
</p>
                    <div class="ab-tagrow">
                        <span class="ab-tag">Cloud-Based Mining</span>
                        <span class="ab-tag">Tier Progression</span>
                        <span class="ab-tag">Secure Access</span>
                        <span class="ab-tag">Referral Growth</span>
                        <span class="ab-tag">KYC Withdrawals</span>
                    </div>
                </div>
                <div class="ab-intro-r rv">
                    <div class="top-half">
                        <div class="ab-ring"></div>
                        <div class="ab-ring"></div>
                        <div class="ab-coin"><img src="{{ asset('assets/pages/images/about/about-img.png') }}" alt=""></div>
                    </div>
                    <div class="bottom-half">
                        <div class="ab-stat">
                            <div class="num"><span>100</span>%</div>
                            <div class="lbl">Cloud-Based</div>
                        </div>
                        <div class="ab-stat">
                            <div class="num"><span>3</span> Tiers</div>
                            <div class="lbl">Bronze · Silver · Gold</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Marquee -->
            <div class="ab-strip">
                <div class="ab-strip-track">
                    <span class="ab-strip-item">Cloud Mining<span class="dot"></span></span>
                    <span class="ab-strip-item">Tier Progression<span class="dot"></span></span>
                    <span class="ab-strip-item">Secure Access<span class="dot"></span></span>
                    <span class="ab-strip-item">Referral Growth<span class="dot"></span></span>
                    <span class="ab-strip-item">Transparent System<span class="dot"></span></span>
                    <span class="ab-strip-item">Monthly Activation<span class="dot"></span></span>
                    <span class="ab-strip-item">Real-Time Tracking<span class="dot"></span></span>
                    <span class="ab-strip-item">KYC Withdrawals<span class="dot"></span></span>
                    <span class="ab-strip-item">Cloud Mining<span class="dot"></span></span>
                    <span class="ab-strip-item">Tier Progression<span class="dot"></span></span>
                    <span class="ab-strip-item">Secure Access<span class="dot"></span></span>
                    <span class="ab-strip-item">Referral Growth<span class="dot"></span></span>
                    <span class="ab-strip-item">Transparent System<span class="dot"></span></span>
                    <span class="ab-strip-item">Monthly Activation<span class="dot"></span></span>
                    <span class="ab-strip-item">Real-Time Tracking<span class="dot"></span></span>
                    <span class="ab-strip-item">KYC Withdrawals<span class="dot"></span></span>
                </div>
            </div>

            <!-- Core Pillars -->
            <div class="ab-pillars">
    <div class="ab-pillars-head rv">
        <div class="ab-pillars-head-l">
            <div class="overline">What Drives Us</div>
            <h3>Core <span>Pillars</span></h3>
        </div>
        <div class="ab-pillars-head-r">
            <p>Every feature and decision at Winngoo is built on these foundational principles that shape the entire platform experience.</p>
        </div>
    </div>
    <div class="ab-pillars-grid rv">
        <div class="ab-pillar">
            <div class="ab-pillar-top">
                <div class="ab-pillar-icon">
                    <img src="{{ asset('assets/pages/images/why-choose/secure-access.png') }}" alt="Secure Infrastructure">
                </div>
                <div class="ab-pillar-n">01</div>
            </div>
            <h5>Secure Infrastructure </h5>
            <p>Every account is protected through biometric login PIN security VPN detection and active session monitoring at all times
</p>
            <div class="ab-pillar-line"></div>
        </div>
        <div class="ab-pillar">
            <div class="ab-pillar-top">
                <div class="ab-pillar-icon">
                    <img src="{{ asset('assets/pages/images/why-choose/real-time.png') }}" alt="Transparent Design">
                </div>
                <div class="ab-pillar-n">02</div>
            </div>
            <h5>Transparent Design</h5>
            <p> Every mining cycle is clearly structured with no hidden conditions so you always know exactly where you stand
</p>
            <div class="ab-pillar-line"></div>
        </div>
        <div class="ab-pillar">
            <div class="ab-pillar-top">
                <div class="ab-pillar-icon">
                    <img src="{{ asset('assets/pages/images/why-choose/performance-growth.png') }}" alt="Performance Growth">
                </div>
                <div class="ab-pillar-n">03</div>
            </div>
            <h5>Performance Growth</h5>
            <p>Consistent participation and verified referrals directly strengthen your mining output and accelerate your progression forward
</p>
            <div class="ab-pillar-line"></div>
        </div>
    </div>
</div>

            <!-- Journey -->
            <div class="ab-journey">
                <div class="ab-journey-head rv">
                    <div class="overline overline-center">Our Evolution
</div>
                    <h3>A Defined Path <span>Ahead</span></h3>
                </div>
                <div class="ab-steps rv">
                    <div class="ab-step d1">
                        <div class="ab-step-node active"></div>
                       
                        <h5>Platform Conceived </h5>
                        <p>Winngoo Coin was built from the ground up to bring genuine clarity and structure to crypto mining participation
</p>
                    </div>
                    <div class="ab-step d2">
                        <div class="ab-step-node active"></div>
                      
                        <h5>Infrastructure Built 
</h5>
                        <p>Cloud architecture was deployed, tier logic was engineered and all security layers were fully integrated and tested
</p>
                    </div>
                    <div class="ab-step d3">
                        <div class="ab-step-node active"></div>
                        
                        <h5>Platform Launch</h5>
                        <p>Winngoo Coin went live with Bronze Silver and Gold tier mining cycles available to users across the globe
</p>
                    </div>
                    <div class="ab-step d4">
                        <div class="ab-step-node"></div>
                    
                        <h5>KYC & Withdrawals</h5>
                        <p>Identity verification was activated, allowing verified users to complete KYC and prepare for the withdrawal phase
</p>
                    </div>
                </div>
            </div>

            <!-- Why Choose Us Section -->
            <div class="wcu-sec">
                <div class="wcu-wrap">

                    <div class="wcu-head rv">
                        <div class="wcu-head-l">
                            <div class="tag">Why Choose Us</div>
                            <h2>Excellence in<br>Digital <span>Mining Solutions</span></h2>
                        </div>
                        <div class="wcu-head-r">
                            <p>Winngoo Coin is built on a foundation of clarity consistency and measurable progress — where every user understands their position tracks their activity and advances through real meaningful engagement
</p>
                        </div>
                    </div>

                    <div class="wcu-big-card rv d1">
                        <div class="wcu-bc-left">
                            <div>
                                <h3>Tier-Based<br><span>Progression</span></h3>
                            </div>
                            <p>Advance from Bronze through Silver and Gold by staying active and growing your verified referral network. Each tier carries a clearly defined mining cycle with full transparency from the moment you begin
</p>
                            <div class="pill">Bronze · Silver · Gold</div>
                        </div>
                        <div class="wcu-bc-right">
                            <div class="wcu-bc-feat">
                                <div class="wcu-bc-dot"></div>
                                <div><h5>2-Year Bronze Cycle</h5><p>Your entry point — a steady two-year cycle built for every new participant</p></div>
                            </div>
                            <div class="wcu-bc-feat">
                                <div class="wcu-bc-dot"></div>
                                <div><h5>1.5-Year Silver Cycle</h5><p>Unlocked through consistent activity and verified referrals within the platform</p></div>
                            </div>
                            <div class="wcu-bc-feat">
                                <div class="wcu-bc-dot"></div>
                                <div><h5>1-Year Gold Cycle</h5><p>The highest tier reserved for the most active and engaged users on Winngoo</p></div>
                            </div>
                        </div>
                    </div>

                   
                </div>
            </div>

        </div>
        <div class="clear"></div>

       @include('landingPage.footer')

    </div>

    <script src="{{ asset('assets/pages/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/pages/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/pages/js/onpagescroll.js') }}"></script>
    <script src="{{ asset('assets/pages/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/pages/js/owl.carousel.js') }}"></script>
    <script src="{{ asset('assets/pages/js/script.js') }}"></script>
    <script>
        const o = new IntersectionObserver(e => {
            e.forEach(x => { if (x.isIntersecting) { x.target.classList.add('in'); o.unobserve(x.target); } });
        }, { threshold: 0.1 });
        document.querySelectorAll('.rv').forEach(el => o.observe(el));
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