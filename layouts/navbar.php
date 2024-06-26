<?php
session_start();
?>

<nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgba(90, 29, 0); position: sticky; top: 0; z-index: 1000;">
    <div class="container-fluid">

        <a class="navbar-brand mt-2 mt-lg-0" href="http://localhost/Rouppa_EC/welcome.php" style="font-family: 'Noto Serif Display', serif; font-weight: bold; font-style: italic; color: white;">
            Rouppa
        </a>


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


        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/Rouppa_EC/shop/shop.php" style="color: white;">Loja</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/Rouppa_EC/user/brecho.php" style="color: white;">Brechó</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: white;">Contato</a>
                </li>
            </ul>


            <div class="d-flex align-items-center">

                <a class="text-reset me-3" href="http://localhost/Rouppa_EC/product/cart.php">
                    <i class="fas fa-shopping-cart" style="color: white;"></i>
                </a>

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
                <div class="dropdown">
                    <?php if (isset($_SESSION['user_name'])): ?>

                        <a
                            data-mdb-dropdown-init
                            class="dropdown-toggle d-flex align-items-center hidden-arrow"
                            href="#"
                            id="navbarDropdownMenuAvatar"
                            role="button"
                            aria-expanded="false"
                        >
                            <?php if (!empty($_SESSION['foto'])): ?>
                                <?php $avatarPath = 'http://localhost/Rouppa_EC/pfp/' . basename($_SESSION['foto']); ?>
                                <img src="<?php echo $avatarPath; ?>" class="rounded-circle" height="30" width="30" alt="Avatar" loading="lazy" />
                            <?php else: ?>
                                <i class="fas fa-user" style="color: white;"></i>
                            <?php endif; ?>
                            <span class="ms-2" style="color: white;">Olá, <?php echo $_SESSION['user_name']; ?>!</span>
                        </a>
                    <?php elseif (isset($_SESSION['nome_loja'])): ?>

                        <a
                            data-mdb-dropdown-init
                            class="dropdown-toggle d-flex align-items-center hidden-arrow"
                            href="#"
                            id="navbarDropdownMenuAvatar"
                            role="button"
                            aria-expanded="false"
                        >
                            <?php if (!empty($_SESSION['foto_loja'])): ?>
                                <?php $avatarPath = 'http://localhost/Rouppa_EC/pfp/' . basename($_SESSION['foto_loja']); ?>
                                <img src="<?php echo $avatarPath; ?>" class="rounded-circle" height="35" width="35" alt="Avatar" loading="lazy" />
                            <?php else: ?>
                                <i class="fas fa-store" style="color: white;"></i>
                            <?php endif; ?>
                            <span class="ms-2" style="color: white;">Olá, <?php echo $_SESSION['nome_loja']; ?>!</span>
                            
                        </a>
                    <?php elseif (isset($_SESSION['adm_name'])): ?>
                        <a
                                data-mdb-dropdown-init
                                class="dropdown-toggle d-flex align-items-center hidden-arrow"
                                href="#"
                                id="navbarDropdownMenuAvatar"
                                role="button"
                                aria-expanded="false"
                        >
                                <i class="fas fa-user" style="color: white;"></i>
                                <span class="ms-2" style="color: white;">Olá, <?php echo $_SESSION['adm_name']; ?>!</span>
                        </a>
                        <?php else: ?>
                            <a
                                data-mdb-dropdown-init
                                class="dropdown-toggle d-flex align-items-center hidden-arrow"
                                href="#"
                                id="navbarDropdownMenuAvatar"
                                role="button"
                                aria-expanded="false"
                            >
                                <i class="fas fa-user" style="color: white;"></i>
                                <span class="ms-2" style="color: white;">Bem-vindo, visitante!</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                                <li><a class="dropdown-item" href="http://localhost/Rouppa_EC/user/user_login.php">Login</a></li>
                                <li><a class="dropdown-item" href="http://localhost/Rouppa_EC/user/user_register.php">Cadastro</a></li>
                            </ul>
                        <?php endif; ?>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                        <?php if (!empty($_SESSION)): ?>
                            <?php if (isset($_SESSION['adm_name'])): ?>
                                <li><a class="dropdown-item" href="http://localhost/Rouppa_EC/adm/adm.php">Gerenciar Usuários e Lojas</a></li>
                                <li><a class="dropdown-item" href="http://localhost/Rouppa_EC/adm/produtos_adm.php">Gerenciar Produtos</a></li>
                                <li><a class="dropdown-item" href="http://localhost/Rouppa_EC/logout.php">Logout</a></li>

                            <?php elseif (isset($_SESSION['user_name'])): ?>
                                <li><a class="dropdown-item" href="http://localhost/Rouppa_EC/user/user_managment.php">Gerenciar Perfil</a></li>
                                <li><a class="dropdown-item" href="http://localhost/Rouppa_EC/user/user_product_managment.php">Gerenciar Produtos</a></li>
                                <li><a class="dropdown-item" href="http://localhost/Rouppa_EC/product/product_register.php">Cadastar Produto</a></li>
                                <li><a class="dropdown-item" href="http://localhost/Rouppa_EC/logout.php">Logout</a></li>
                            <?php elseif (isset($_SESSION['nome_loja'])): ?>

                                <li><a class="dropdown-item" href="http://localhost/Rouppa_EC/shop/shop_product_managment.php">Gerenciar Produtos</a></li>
                                <li><a class="dropdown-item" href="http://localhost/Rouppa_EC/product/product_register.php">Cadastar Produto</a></li>
                                <li><a class="dropdown-item" href="http://localhost/Rouppa_EC/logout.php">Logout</a></li>
                            <?php endif; ?>
                        <?php else: ?>
                            <li><a class="dropdown-item" href="http://localhost/Rouppa_EC/user/user_login.php">Login</a></li>
                            <li><a class="dropdown-item" href="http://localhost/Rouppa_EC/user/user_register.php">Cadastro</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
