<div class="navbar-custom">
    <div class="topbar container-fluid">
        <div class="d-flex align-items-center gap-lg-2 gap-1">
            <!-- Topbar Brand Logo -->
            <div class="logo-topbar">
                <!-- Logo light -->
                <a href="{{ route('admin.dashboard') }}" class="logo-light">
                    <span class="logo-lg">
                        <img src="{{ asset('backend/images/logo.png') }}" alt="logo">
                    </span>
                    <span class="logo-sm">
                        <img src="{{ asset('backend/images/logo-sm.png') }}" alt="small logo">
                    </span>
                </a>

                <!-- Logo Dark -->
                <a href="{{ route('admin.dashboard') }}" class="logo-dark">
                    <span class="logo-lg">
                        <img src="{{ asset('backend/images/logo-dark.png') }}" alt="dark logo">
                    </span>
                    <span class="logo-sm">
                        <img src="{{ asset('backend/images/logo-sm.png') }}" alt="small logo">
                    </span>
                </a>
            </div>

            <!-- Sidebar Menu Toggle Button -->
            <button class="button-toggle-menu">
                <i class="ri-menu-2-fill"></i>
            </button>

            <!-- Horizontal Menu Toggle Button -->
            <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <div class="lines">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>

            <!-- Topbar Search Form -->
            <div class="app-search dropdown d-none d-lg-block">
                <form>
                    <div class="input-group">
                        <input type="search" class="form-control dropdown-toggle" placeholder="Search..."
                            id="top-search">
                        <span class="ri-search-line search-icon"></span>
                    </div>
                </form>
            </div>
        </div>

        <ul class="topbar-menu d-flex align-items-center gap-3">
            <li class="d-none d-md-inline-block me-md-2">
                <div id="cartMenu">
                    <a href="JavaScript:void(0)" class="btn btn-primary position-relative pr-cart">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            0
                        </span>View Cart
                    </a>
                </div>
            </li>
            @auth
                <li class="dropdown me-md-2">
                    <a class="nav-link dropdown-toggle arrow-none nav-user px-2" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="account-user-avatar">
                            <img src="{{ profileImg() }}" alt="user-image" width="32" class="rounded-circle">
                        </span>
                        <span class="d-lg-flex flex-column gap-1 d-none">
                            <h5 class="my-0">{{ user()->name }}</h5>
                            {{-- <h6 class="my-0 fw-normal">Founder</h6> --}}
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                        <a href="{{ route('my_profile.index') }}" class="dropdown-item">
                            <i class="ri-account-circle-fill align-middle me-1"></i>
                            <span>My Account</span>
                        </a>
                        <a href="{{ route('my_order.index') }}" class="dropdown-item">
                            <i class="fa-solid fa-cart-shopping align-middle me-1"></i>
                            <span>My Order</span>
                        </a>
                        <a href="{{ route('sign_out') }}" class="dropdown-item">
                            <i class="ri-lock-password-fill align-middle me-1"></i>
                            <span>Sing Out</span>
                        </a>
                    </div>
                </li>
            @endauth
            <li class="d-none d-md-inline-block me-md-2">
                {{-- @auth
                    <a class="nav-link" href="{{ route('sign_out') }}">Sing Out</a>
                @endauth --}}
                @guest
                    <a class="nav-link" href="{{ route('sign_in') }}">Sing In</a>
                @endguest
            </li>
            <li class="d-none d-md-inline-block me-md-2">
                <a class="nav-link" href="" data-toggle="fullscreen">
                    <i class="ri-fullscreen-line fs-22"></i>
                </a>
            </li>
        </ul>
    </div>
</div>
