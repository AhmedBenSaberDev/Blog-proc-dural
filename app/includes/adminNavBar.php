<!-- Including functions  -->
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/utilities/functions.php');

if(!checkIfAdmin()){
    header('Location:'. BASE_URL . "/index.php");
}
?>

<header>
    <nav class="main-nav">

        <div class="logo">
            <!-- <img src="" alt="logo"> -->
            <a href= <?= BASE_URL ."/index.php"?> >MYBLOG</a>
        </div>

        <ul class="mobile-nav-ul hidden">
            <li> <a class="nav-ancers" href=<?= BASE_URL . "/index.php" ?>>Home</a></li>
            <?php if (userConnectionCheck()) : ?>
                <li>
                    <?php if (checkIfAdmin()) : ?> <?= "<a class='nav-ancers' href=" . BASE_URL . "/app/admin/posts/index.php" . ">Dashboard</a>" ?>
                       
                    <?php endif; ?>
                    <li> <a class="nav-ancers"  href=<?= BASE_URL . "/app/utilities/sessionDestroy.php" ?>>Log Out</a></li>

                </li>
            <?php else : ?>
                <li> <a class="nav-ancers" href=<?= BASE_URL . "/register.php" ?>>Register</a></li>
                <li> <a class="nav-ancers" href=<?= BASE_URL . "/login.php" ?>>Login</a></li>
            <?php endif; ?>
        </ul>

        <ul class="nav hamburger">
            <div class="menu-wrapper">
                <div class="hamburger-menu">

                </div>
            </div>
        </ul>

    </nav>  

</header>