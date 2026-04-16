 <!-- Header -->
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 logo">
                        <a href="{{route('home')}}" title="Cp diamond">
                            <img class="light w-logo" src="{{ asset('assets/pages/images/w-coin-logo.png') }}" alt="Cp diamond">
                            <img class="dark w2-logo" src="{{ asset('assets/pages/images/w-coin-logo.png') }}" alt="Cp diamond">
                        </a>
                    </div>
                    <div class="col-sm-8 main-menu">
                        <div class="menu-icon">
                            <span class="top"></span>
                            <span class="middle"></span>
                            <span class="bottom"></span>
                        </div>
                        <nav class="onepage">
                            <ul>
                                <li ><a href="{{route('home')}}">Home</a></li>
                                <li><a href="{{route('aboutus')}}">About Us</a></li>
                                <!--<li><a href="{{route('home')}}#why-choose-us">Why Choose Us</a></li>-->
                                <!--<li><a href="{{route('home')}}#how-it-works">How it Works</a></li>-->
                                <li><a href="{{route('faq')}}">FAQ</a></li>
                                <li><a href="{{route('contactus')}}">Contact Us</a></li>
                                <li class="nav-btn"><a href="{{route('home')}}#download">Download App</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const currentPath = window.location.pathname;
                const navLinks = document.querySelectorAll("nav ul li a");
        
                navLinks.forEach(link => {
                    const linkPath = new URL(link.href).pathname;
        
                    if (currentPath === linkPath) {
                        link.parentElement.classList.add("active");
                    }
                });
            });
        </script>
        <!-- Header End -->