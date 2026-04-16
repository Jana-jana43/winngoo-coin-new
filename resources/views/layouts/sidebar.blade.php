 <div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="{{route('dashboard')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/Coin.png') }}" alt="" height="50">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/Coin.png') }}" alt="" height="50">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>    
            
            <div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{route('dashboard')}}">
                                <i class="ri-apps-2-line"></i> <span data-key="t-dashboards">Dashboard</span>
                            </a>
                        </li>
                         @if(auth('admin')->check() && auth('admin')->user()->hasPermission('user_management', 'view'))
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('admin.members') ? 'active' : '' }}" href="{{ route('admin.members') }}">
                                <i class="ri-group-line"></i> <span data-key="t-user-management">Members</span>
                            </a>
                        </li>
                        @endif
                        
                        @if(auth('admin')->check() && auth('admin')->user()->hasPermission('team_management', 'view'))
                       <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('admin.staffmanagement') ? 'active' : '' }}" href="{{route('admin.staffmanagement')}}">
                                <i class="ri-team-line"></i> <span data-key="t-team-management">Staff Management</span>
                            </a>
                        </li>
                        @endif
                        
                         @if(auth('admin')->check() && auth('admin')->user()->hasPermission('role_management', 'view'))
                         <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('admin.rolemanagement') ? 'active' : '' }}" href="{{route('admin.rolemanagement')}}">
                                <i class="ri-user-follow-line"></i> <span data-key="t-role-management">Role Management</span>
                            </a>
                        </li>
                        @endif
                        
                        @if(auth('admin')->check() && auth('admin')->user()->hasPermission('coin_management', 'view'))
                       <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('admin.coinmanagement') ? 'active' : '' }}" href="{{route('admin.coinmanagement')}}">
                                <i class="ri-coins-line"></i> <span data-key="t-coin-management">Coin Management</span>
                            </a>
                        </li>
                        @endif
                        
                <!--         @if(auth('admin')->check() && auth('admin')->user()->hasPermission('notification', 'view'))-->
                <!--        <li class="nav-item">-->
                <!--           <a class="nav-link menu-link" href="{{ route('admin.notifications') }}" >-->
                <!--         <i class="ri-notification-2-line"></i> <span data-key="t-notifications">Notifications</span>-->
                <!--     </a>-->
                <!--        </li>-->
                <!--        @endif-->
                        
                <!--         @if(auth('admin')->check() && auth('admin')->user()->hasPermission('content_management', 'view'))-->

                <!--<li class="nav-item">-->
                <!--     <a class="nav-link menu-link" href="#managecontent" data-bs-toggle="collapse" role="button"-->
                <!--         aria-expanded="false" aria-controls="managecontent">-->
                <!--         <i class="ri-file-list-line"></i> <span data-key="t-content-management">Content-->
                <!--             Management</span>-->
                <!--     </a>-->
                <!--     <div class="collapse menu-dropdown" id="managecontent">-->
                <!--         <ul class="nav nav-sm flex-column">-->
                <!--              @if(auth('admin')->check() && auth('admin')->user()->hasPermission('content_management', 'create'))-->
                <!--             <li class="nav-item">-->
                <!--                 <a href="{{ route('admin.manage.about') }}"-->
                <!--                     class="nav-link {{ request()->routeIs('admin.manage.about') ? 'active' : '' }}"-->
                <!--                     data-key="t-about">-->
                <!--                     About-->
                <!--                 </a>-->
                <!--             </li>-->
                <!--             @endif-->
                             
                <!--              @if(auth('admin')->check() && auth('admin')->user()->hasPermission('content_management', 'create'))-->
                <!--             <li class="nav-item">-->
                <!--                 <a href="{{ route('admin.faq') }}"-->
                <!--                     class="nav-link {{ request()->routeIs('admin.faq') ? 'active' : '' }}">-->
                <!--                     FAQ-->
                <!--                 </a>-->
                <!--             </li>-->
                <!--             @endif-->
                             
                <!--                   @if(auth('admin')->check() && auth('admin')->user()->hasPermission('content_management', 'create'))-->
                <!--             <li class="nav-item">-->
                <!--                 <a href="{{ route('admin.manage.privacy.policy') }}"-->
                <!--                     class="nav-link {{ request()->routeIs('admin.manage.privacy.policy') ? 'active' : '' }}"-->
                <!--                     data-key="t-privacy">-->
                <!--                     Privacy Policy-->
                <!--                 </a>-->
                <!--             </li>-->
                             
                <!--             @endif-->
                <!--                   @if(auth('admin')->check() && auth('admin')->user()->hasPermission('content_management', 'create'))-->
                <!--             <li class="nav-item">-->
                <!--                 <a href="{{ route('admin.manage.terms.and.conditions') }}"-->
                <!--                     class="nav-link {{ request()->routeIs('admin.manage.terms.and.conditions') ? 'active' : '' }}"-->
                <!--                     data-key="t-terms">-->
                <!--                     Terms & Conditions-->
                <!--                 </a>-->
                <!--             </li>-->
                <!--             @endif-->
                <!--                   @if(auth('admin')->check() && auth('admin')->user()->hasPermission('content_management', 'create'))-->
                <!--             <li class="nav-item">-->
                <!--                 <a href="{{ route('admin.manage.news') }}"-->
                <!--                     class="nav-link {{ request()->routeIs('admin.manage.news') ? 'active ' : '' }}"-->
                <!--                     data-key="t-news">-->
                <!--                     News-->
                <!--                 </a>-->
                <!--             </li>-->
                <!--             @endif-->
                <!--         </ul>-->
                <!--     </div>-->
                <!-- </li>-->
                <!-- @endif-->
                 
                  @if(auth('admin')->check() && auth('admin')->user()->hasPermission('settings', 'view'))

                        <li class="nav-item">
                            <!--<a class="nav-link menu-link" href="#managesettings" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="managesettings">-->
                                
                                
                                <a class="nav-link menu-link {{ request()->routeIs(
    'admin.profile',
    'admin.change.password.form',
    'admin.platform.settings',
    'admin.email.configuration',
    'admin.language',
    'admin.notification.settings'
) ? '' : 'collapsed' }}"
href="#managesettings"
data-bs-toggle="collapse"
role="button"
aria-expanded="{{ request()->routeIs(
    'admin.profile',
    'admin.change.password.form',
    'admin.platform.settings',
    'admin.email.configuration',
    'admin.language',
    'admin.notification.settings'
) ? 'true' : 'false' }}">
                                
                                
                                
                                
                                <i class="ri-settings-3-line"></i> <span data-key="t-settings">Settings</span>
                            </a>
                            <!--<div class="collapse menu-dropdown" id="managesettings">-->
                            
                            <div class="collapse menu-dropdown {{ request()->routeIs(
    'admin.profile',
    'admin.change.password.form',
    'admin.platform.settings',
    'admin.email.configuration',
    'admin.language',
    'admin.notification.settings'
) ? 'show' : '' }}" id="managesettings">
                                <ul class="nav nav-sm flex-column">
                                   
                                    <li class="nav-item">
                                        <a href="{{route('admin.profile') }}" class="nav-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}" data-key="t-admin-profile">
                                            Profile
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.change.password.form') }}" class="nav-link {{ request()->routeIs('admin.change.password.form') ? 'active' : '' }}" data-key="t-change-password">
                                     Change Password
                                 </a>
                                    </li>
                                    @if(auth('admin')->check() && auth('admin')->user()->hasPermission('settings', 'create'))
                                    <li class="nav-item">
                                        <a href="{{ route('admin.platform.settings') }}" class="nav-link {{ request()->routeIs('admin.platform.settings') ? 'active' : '' }}" data-key="t-platform">
                                            Platform Settings
                                        </a>
                                    </li>
                                    @endif
                                    
                                    @if(auth('admin')->check() && auth('admin')->user()->hasPermission('settings', 'create'))
                                    <li class="nav-item">
                                        <a href="{{ route('admin.email.configuration') }}" class="nav-link {{ request()->routeIs('admin.email.configuration') ? 'active' : '' }}" data-key="t-email">
                                            Email Configuration
                                        </a>
                                    </li>
                                    @endif
                                    @if(auth('admin')->check() && auth('admin')->user()->hasPermission('settings', 'create'))
                                    <li class="nav-item">
                                        <a href="{{ route('admin.language') }}" class="nav-link {{ request()->routeIs('admin.language') ? 'active' : '' }}" data-key="t-language">
                                            Language
                                        </a>
                                    </li>
                                    @endif
                                    <!--@if(auth('admin')->check() && auth('admin')->user()->hasPermission('settings', 'create'))-->
                                    <!--<li class="nav-item">-->
                                    <!--    <a href="sms-configuration.html" class="nav-link" data-key="t-sms">-->
                                    <!--        SMS-->
                                    <!--    </a>-->
                                    <!--</li>-->
                                    <!--@endif-->
                                    @if(auth('admin')->check() && auth('admin')->user()->hasPermission('settings', 'create'))
                                    <li class="nav-item">
                                        <a href="{{ route('admin.notification.settings') }}" class="nav-link {{ request()->routeIs('admin.notification.settings') ? 'active' : '' }}" data-key="t-notification-preferences">
                                            Notification Preferences
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </li>
                        
                        @endif
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>

            <div class="sidebar-background"></div>
        </div>