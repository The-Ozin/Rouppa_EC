<?php 
session_start();

// Verifica se o usuário está fazendo logout
if(isset($_GET['logout'])) {
    // Remove todas as variáveis de sessão
    session_unset();
    // Destroi a sessão
    session_destroy();
    // Redireciona para a página de login
    header("Location: ./user/user_login.php");
    exit;
}
?>

<nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgba(90, 29, 0); position: sticky; top: 0; z-index: 1000;">
    <!-- Container wrapper -->
    <div class="container-fluid">
        <!-- Navbar title -->
        <a class="navbar-brand mt-2 mt-lg-0" href="http://localhost/Rouppa/welcome.php" style="font-family: 'Noto Serif Display', serif; font-weight: bold; font-style: italic; color: white;">
            Rouppa
        </a>

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

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left links -->
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
                            <a class="dropdown-item" href="#">Alguma notícia</a>
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
                        <?php if(isset($_SESSION['user_name'])): ?>
                            <span class="ms-2" style="color: white;"><?php echo $_SESSION['user_name']; ?></span>
                        <?php endif; ?>
                    </a>
                    <ul
                        class="dropdown-menu dropdown-menu-end"
                        aria-labelledby="navbarDropdownMenuAvatar"
                    >
                        <?php if(isset($_SESSION['user_name'])): ?>
                            <li><a class="dropdown-item" href="?logout">Logout</a></li>
                        <?php else: ?>
                            <li><a class="dropdown-item" href="./user/user_login.php">Login/Cadastro</a></li>
                        <?php endif; ?>
                    </ul>
                </div>

            </div>
        </div>
        <!-- Collapsible wrapper -->
    </div>
    <!-- Container wrapper -->
</nav>
<!-- Navbar -->
