<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{ asset('template-dashboard') }}/assets/img/profile2.jpg" alt="{{ asset('template-dashboard') }}." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            Gilga Syahid
                            <span class="user-level">Administrator Jaringan</span>
                        </span>
                    </a>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'text-primary' : 'collapsed' }}" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>
                <li class="nav-item {{ request()->routeIs('pppoe.monitoring') ? 'active' : '' }}">
                    <a href="{{ route('pppoe.monitoring') }}" class="{{ request()->routeIs('pppoe.monitoring') ? 'text-primary' : 'collapsed' }}" aria-expanded="false">
                        <i class="fa fa-podcast" aria-hidden="true"></i>
                        <p>Monitoring PPPoE</p>
                    </a>
                </li>
                <li class="nav-item mb-0">
                    <a data-toggle="collapse" href="#sidebarLayouts"
                        class="{{ request()->routeIs('pppoe.client') || request()->routeIs('pppoe.profil') ? 'text-primary' : '' }}">
                        <i class="fas fa-pen-square"></i>
                        <p>Manajemen PPPoE</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('pppoe.client') || request()->routeIs('pppoe.profil') ? 'show' : '' }}" id="sidebarLayouts" style="margin-bottom: 0; padding-bottom: 0;">
                        <ul class="nav nav-collapse mb-0 pb-0">
                            <li class="{{ request()->routeIs('pppoe.client') ? 'active' : '' }}">
                                <a href="{{ route('pppoe.client') }}" class="{{ request()->routeIs('pppoe.client') ? 'text-primary' : '' }}">
                                    <span class="sub-item">Manajemen Client dan Profil PPPoE</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ request()->routeIs('pppoe.log') ? 'active' : '' }}" style="margin-top: 0">
                    <a href="{{ route('pppoe.log') }}" class="{{ request()->routeIs('pppoe.log') ? 'text-primary' : '' }}" aria-expanded="false">
                        <i class="fa fa-history" aria-hidden="true"></i>
                        <p>Log History</p>
                    </a>
                </li>
                {{-- <li class="nav-item {{ request()->routeIs('terminal.index') ? 'active' : '' }}">
                    <a href="{{ route('terminal.index') }}" class="nav-link {{ request()->routeIs('terminal.index') ? 'text-primary' : 'collapsed' }}" aria-expanded="false">
                        <i class="fa fa-podcast" aria-hidden="true"></i>
                        <p>Terminal</p>
                    </a>
                </li> --}}
            </ul>
        </div>
    </div>
</div>
