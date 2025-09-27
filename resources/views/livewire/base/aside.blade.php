<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/dashboard" wire:navigate class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('img/cert_lspu.png') }}" class="mx-auto" alt="" srcset="" height="50">
            </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ str_contains(url()->current(), 'dashboard') ? 'active' : '' }}">
            <a href="/dashboard"  class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Core</span>
        </li>


        @if(in_array(Auth::user()->role, [ROLE_ADMIN, ROLE_TEACHER]))
        <li class="menu-item {{ str_contains(url()->current(), 'manage') ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Management</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('manage_learning_course') }}" class="menu-link">
                        <div data-i18n="Account">Courses</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="{{ route('manage_activity') }}" class="menu-link">
                        <div data-i18n="Account">Activity</div>
                    </a>
                </li>

            </ul>
        </li>
        @endif

        @if(in_array(Auth::user()->role, [ROLE_ADMIN]))
        <li class="menu-item {{ str_contains(url()->current(), 'system-administration') ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">System Administration</div>
            </a>
            <ul class="menu-sub">

                <li class="menu-item">
                    <a href="{{ route('sections') }}" class="menu-link">
                        <div data-i18n="Account">Param Sections</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="{{ route('organizations') }}" class="menu-link">
                        <div data-i18n="Account">Organizations</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="{{ route('users') }}" class="menu-link">
                        <div data-i18n="Account">Users</div>
                    </a>
                </li>

            </ul>
        </li>
        @endif

        @if(in_array(Auth::user()->role, [ROLE_STUDENT]))
        <li class="menu-item {{ str_contains(url()->current(), 'courses') ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Explore</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('user_courses') }}" class="menu-link">
                        <div data-i18n="Account">Courses</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="{{ route('user_activity') }}" class="menu-link">
                        <div data-i18n="Account">Activities</div>
                    </a>
                </li>

            </ul>
        </li>
        @endif


        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pages</span>
        </li>

        <li class="menu-item {{ str_contains(url()->current(), 'account') ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Account Settings</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('account_setting_page') }}" class="menu-link">
                        <div data-i18n="Account">Account</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('notification_page') }}" class="menu-link">
                        <div data-i18n="Notifications">Notifications</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="{{ route('chats') }}" class="menu-link">
                        <div data-i18n="Notifications">Chats</div>
                    </a>
                </li>

            </ul>
        </li>






    </ul>
</aside>