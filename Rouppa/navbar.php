<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgba(90, 29, 0); position: sticky; top: 0; z-index: 1000;">
    <!-- Container wrapper -->
    <div class="container-fluid">
        <!-- Toggle button -->
        <button
            data-mdb-collapse-init
            class="navbar-toggler"
            type="button"
            data-mdb-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <i class="fas fa-bars"></i>
        </button>

        <!-- Left elements -->
        <div class="d-flex align-items-center">
            <!-- Navbar title -->
            <a class="navbar-brand mt-2 mt-lg-0" href="{{ url('/') }}" style="font-family: 'Noto Serif Display', serif; font-weight: bold; font-style: italic; color: white;">
                Rouppa
            </a>

            <!-- Search form -->
            <form class="input-group w-auto my-auto d-none d-sm-flex">
                <input
                autocomplete="off"
                type="search"
                class="form-control rounded"
                placeholder="Search"
                style="min-width: 125px;"
                />
                <span class="input-group-text border-0 d-none d-lg-flex"
                ><i class="fas fa-search" style="color: white;"></i
                ></span>
            </form>
        </div>
        <!-- Left elements -->

        <!-- Center elements -->
        <div class="d-flex justify-content-center align-items-center" style="position: absolute; left: 50%; transform: translateX(-50%);">
            <!-- Links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: white;">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: white;">Team</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: white;">Projects</a>
                </li>
            </ul>
        </div>
        <!-- Center elements -->

        <!-- Right elements -->
        <div class="d-flex align-items-center">
            <!-- Icon -->
            <a class="text-reset me-3" href="#">
                <i class="fas fa-shopping-cart" style="color: white;"></i>
            </a>

            <!-- Notifications -->
            <div class="dropdown">
                <a
                    data-mdb-dropdown-init
                    class="text-reset me-3 dropdown-toggle hidden-arrow"
                    href="#"
                    id="navbarDropdownMenuLink"
                    role="button"
                    aria-expanded="false"
                >
                    <i class="fas fa-bell" style="color: white;"></i>
                    <span class="badge rounded-pill badge-notification bg-danger">1</span>
                </a>
                <ul
                    class="dropdown-menu dropdown-menu-end"
                    aria-labelledby="navbarDropdownMenuLink"
                >
                    <li>
                        <a class="dropdown-item" href="#">Some news</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">Another news</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </li>
                </ul>
            </div>
            <!-- Avatar -->
            <div class="dropdown">
                <a
                    data-mdb-dropdown-init
                    class="dropdown-toggle d-flex align-items-center hidden-arrow"
                    href="#"
                    id="navbarDropdownMenuAvatar"
                    role="button"
                    aria-expanded="false"
                >
                    <i class="fas fa-user" style="color: white;"></i>
                </a>
                <ul
                    class="dropdown-menu dropdown-menu-end"
                    aria-labelledby="navbarDropdownMenuAvatar"
                >
                    <li>
                        <a class="dropdown-item" href="{{ url('/user-register') }}">My profile</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ url('/profile-settings') }}">Settings</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Right elements -->
    </div>
    <!-- Container wrapper -->
</nav>
<!-- Navbar -->