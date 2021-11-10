<!-- Including functions  -->
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/utilities/functions.php');

?>

<header class="main-header">

    <nav class="main-nav">

        <div class="logo">
            <!-- <img src="" alt="logo"> -->
            <a href=<?= BASE_URL . "/index.php" ?>>MYBLOG</a>
        </div>

        <div class="mobile-nav-wrapper hidden">
            <ul class="mobile-nav-ul">
                <li> <a class="nav-ancers" href=<?= BASE_URL . "/index.php" ?>>Home</a></li>
                <?php if (userConnectionCheck()) : ?>
                  
                    <?php if (checkIfAdmin()) : ?> <?= "<li><a class='nav-ancers' href=" . BASE_URL . "/app/admin/posts/index.php" . ">Dashboard</a></li>" ?> 

                    <li><a class="nav-ancers" href=<?= BASE_URL . "/app/admin/posts/index.php" ?>> Manage posts</a></li>
                    <li><a class="nav-ancers" href=<?= BASE_URL . "/app/admin/users/index.php" ?>>Manage users</a></li>
                    <li> <a class="nav-ancers" href=<?= BASE_URL . "/app/admin/topics/index.php" ?>>Manage topics</a> </li>
                    
                    <?php endif; ?>
                    <li> <a class="nav-ancers" href=<?= BASE_URL . "/app/utilities/sessionDestroy.php" ?>>Log Out</a></li>
                <?php else : ?>
                    <li> <a class="nav-ancers" href=<?= BASE_URL . "/register.php" ?>>Register</a></li>
                    <li> <a class="nav-ancers" href=<?= BASE_URL . "/login.php" ?>>Login</a></li>
                <?php endif; ?>
               
            </ul>
        </div>

            <ul class="nav hamburger">
                <div class="menu-wrapper">
                    <div class="hamburger-menu hidden">

                    </div>
                </div>
            </ul>

            <ul class="nav desktop-nav">

                <li> <a class="nav-ancers" href=<?= BASE_URL . "/index.php" ?>>Home</a></li>
                <?php if (userConnectionCheck()) : ?>
                    <li class="account-nav">

                        <div class="user-logo">
                            <i class="fas fa-user"></i> <a class="username-nav" href="#"><?= displayUserName() ?> </a>
                            <i class="fas fa-sort-down"></i>
                        </div>

                        <div class="drop-down">

                            <?php if (checkIfAdmin()) : ?> <?= "<a href=" . BASE_URL . "/app/admin/posts/index.php" . ">Dashboard</a>" ?>
                                <a href=<?= BASE_URL . "/app/admin/posts/index.php" ?>> Manage posts</a>
                                <a href=<?= BASE_URL . "/app/admin/users/index.php" ?>>Manage users</a>
                                <a href=<?= BASE_URL . "/app/admin/topics/index.php" ?>>Manage topics</a>
                            <?php endif; ?>
                            <a class="logout-nav" href=<?= BASE_URL . "/app/utilities/sessionDestroy.php" ?>>Log Out</a>

                        </div>
                    </li>
                <?php else : ?>
                    <li> <a class="nav-ancers" href=<?= BASE_URL . "/register.php" ?>>Register</a></li>
                    <li> <a class="nav-ancers" href=<?= BASE_URL . "/login.php" ?>>Login</a></li>
                <?php endif; ?>
            </ul>
    </nav>

    <div class="banner">
        <div class="banner-overlay"></div>
    </div>

</header>