<nav
    class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center">
                <i class="bx bx-search fs-4 lh-0"></i>
                <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..." />
            </div>
        </div>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">

            <style>
                .nav-item.dropdown-notifications .dropdown-menu {
                    width: 400px;
                }
            </style>
            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-2">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                    <span class="position-relative">
                        <i class="bx bx-bell fs-4"></i>
                        <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                            <span class="visually-hidden">New alerts</span>
                        </span>
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end p-0 shadow">
                    <!-- Header -->
                    <li class="dropdown-menu-header border-bottom">
                        <div class="dropdown-header d-flex justify-content-between align-items-center p-3">
                            <h6 class="mb-0">Notifications</h6>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-primary"></span>
                                <a href="javascript:void(0)" class="text-muted" data-bs-toggle="tooltip" title="Mark all as read">
                                    <i class="bx bx-envelope-open"></i>
                                </a>
                            </div>
                        </div>
                    </li>

                    <!-- Notification List -->
                    <li class="dropdown-notifications-list overflow-auto" style="max-height: 300px;">
                        <ul class="list-group list-group-flush">
                            @forelse($notifications as $item)
                            <li class="list-group-item list-group-item-action" wire:click="update_status({{ $item->id}})">
                                <a href="{{ $item->link }}" class="d-flex align-items-start">
                                    <i class="{{ $item->icon }} dodgerblue me-3"></i>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1 fw-semibold text-success">{{ $item->title }}</h6>
                                        <p class="mb-1 small text-dark">{{ $item->message }}</p>
                                        <small class="text-muted">{{ $item->created_at->diffForHumans() }}</small>
                                    </div>
                                </a>
                            </li>
                            @empty
                            <li class="list-group-item list-group-item-action">
                                <a href="#" class="d-flex align-items-start">
                                    No Notifications
                                </a>
                            </li>
                            @endforelse


                            <!-- Add more items here -->
                        </ul>
                    </li>

                    <!-- Footer -->
                    <li class="border-top">
                        <div class="p-3 text-center">
                            <a class="btn btn-sm btn-primary w-100" href="javascript:void(0);">View all notifications</a>
                        </div>
                    </li>
                </ul>
            </li>

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow text-uppercase fw-bold text-primary" href="javascript:void(0);" data-bs-toggle="dropdown">
                    {{ decrypt(Auth::user()->first_name) }} {{ decrypt(Auth::user()->last_name) }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="{{ Auth::user()->profile ? asset(Auth::user()->profile) : asset('img/user.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">{{ decrypt(Auth::user()->first_name) }} {{ decrypt(Auth::user()->last_name) }}</span>
                                    <small class="text-muted">{{ Auth::user()->role_code }}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">My Profile</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bx bx-cog me-2"></i>
                            <span class="align-middle">Settings</span>
                        </a>
                    </li>

                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#" wire:click="$dispatchTo('base.aside','on-logout')">
                            <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle">Log Out</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>