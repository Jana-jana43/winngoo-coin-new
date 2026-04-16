 <!-- Footer Start -->
        <footer class="diamond-footer">
            <div class="footer-widget-area">
                <div class="container">
                    <div class="row" style="justify-content: space-between;">
                        <div class="col-lg-4 col-md-12 widget-area">
                            <div class="widget widget-html">
                                <div class="footer-logo">
                                    <a href="index.html"><img src="{{ asset('assets/pages/images/w-coin-logo.png') }}" alt="Cp Diamond"></a>
                                </div>
                                <p class="text-white" style="color:#fff; font-size:18px; text-align:justify;">A tier-based digital mining platform focused on secure access, transparent tracking, and steady participation. Built for individuals and businesses seeking clarity and control in their mining journey.</p>
                            </div>
                            <div class="socials">
                                <ul>
                                    <li><a href="https://www.facebook.com/profile.php?id=61582531457040" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="https://www.instagram.com/winngoocoin" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                    <li><a href="https://www.youtube.com/@winngoocoin" target="_blank" ><i class="fab fa-youtube"></i></a></li>
                                    <li><a href="https://www.linkedin.com/company/winngoocoin/" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12 widget-area">
                            <div class="widget widget-html">
                                <div class="sec-title"><h4 class="widget-title">Quick Links</h4></div>
                                <ul class="footer-box-2">
                                    <li><a href="{{route('home')}}">Home</a></li>
                                     <li><a href="{{route('aboutus')}}">About Us</a></li>
                                    <li><a href="{{route('faq')}}">FAQ</a></li>
                                     <li><a href="{{route('contactus')}}">Contact Us</a></li>
                                    <li><a href="{{route('termsAndConditions')}}">Terms & Conditions</a></li>
                                    <li><a href="{{route('privacyPolicy')}}">Privacy Policy</a></li>
                                   
                                   
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 widget-area">
                            <div class="widget widget-html">
                                <div class="sec-title"><h4 class="widget-title">Contact Us</h4></div>
                                <div class="contact-info">
                                    <ul>
                                        <li class="phone-no"><a href="tel:02033765250">020 3376 5250</a></li>
                                        <li class="email"><a href="mailto:support@winngoocoin.com">support@winngoocoin.com</a></li>
                                        <li style="position:relative; padding-left:35px;">
                                            <i class="fas fa-map-marker-alt" style="position:absolute; left:0; top:2px; color:#fbbd18; font-size:20px;"></i>
                                            <span style="color:#ffffff;">Unit 5, Martinbridge Trading Estate, 240-242 Lincoln Road, Enfield, EN1 1SP, United Kingdom.</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright-area text-center">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="copy-text text-center">Copyright &copy; 2026 <a href="https://www.vishakarex.in/" target="_blank">Vishakarex.</a> All Rights Reserved.</div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer End -->



<script src='https://winngoolivechat.com/script/jvwySydU0o' wsPort='6001' defer></script>

<script>
function injectChatStyles() {
    const widget = document.querySelector('.mainLiveChatDiv');
    if (!widget || !widget.shadowRoot) return;

    const shadow = widget.shadowRoot;

    // Prevent duplicate injection
    if (shadow.querySelector('#customChatStyle')) return;

    const style = document.createElement('style');
    style.id = "customChatStyle";
    style.textContent = `
        /* Hide "Livechat Users" text */
        .chat-icon-text {
            display: none !important;
        }

        #chat-popup.chat-popup-active {
          bottom: 55px;
    
        }
        
        @media screen and (min-width: 1200px) and (max-width: 1200px) and (orientation: landscape) {

                    #chat-popup.chat-popup-active {
                      bottom: 55px;
                
                    }
          
          } 
        
        @media only screen 
            and (min-device-width: 1024px) 
            and (max-device-width: 1024px) 
            and (orientation: portrait) {
            
                #chat-popup.chat-popup-active {
          bottom: 55px;
    
        }
            
            }
            
          
            
        
        /* Mobile Fullscreen */
        @media (max-width: 575px) {
          
        #chat-popup.chat-popup-active {
          bottom: 55px;
    
        }
          
        }
        
        /* Mobile Fullscreen */
        @media (max-width: 768px) {
            .chat-container {
                width: 100% !important;
                height: 100vh !important;
                right: 0 !important;
                bottom: 0 !important;
                border-radius: 0 !important;
            }

            .chat-header {
                font-size: 14px !important;
            }
        }
    `;

    shadow.appendChild(style);
}

// Wait until widget loads
const observer = new MutationObserver(() => {
    const widget = document.querySelector('.mainLiveChatDiv');
    if (widget && widget.shadowRoot) {
        injectChatStyles();
        observer.disconnect();
    }
});

observer.observe(document.body, { childList: true, subtree: true });
</script>
@stack('scripts')