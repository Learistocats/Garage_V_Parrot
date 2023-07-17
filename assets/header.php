<header>
    <?php
    echo '<img src="' . $root_path . 'assets/logo.png" class="top-logo" />'
    ?>
    <nav>
        <ul class="breadcrumb">
            <?php
            switch ($current_page) {
                case "Home":
                    echo '  <li class="current-page"><a href="index.php">Accueil</a></li>';
                    echo '  <li><a href="pages/occasion.php" class="hover-underline-animation">Occasions</a></li>';
                    echo '  <li><a href="pages/reviews.php" class="hover-underline-animation">Avis</a></li>';
                    echo '  <li><a href="pages/contact.php" class="hover-underline-animation">Contact</a></li>';
                    break;
                case "Contact":
                    echo '  <li><a href="../index.php" class="hover-underline-animation">Accueil</a></li>';
                    echo '  <li><a href="occasion.php" class="hover-underline-animation">Occasions</a></li>';
                    echo '  <li><a href="reviews.php" class="hover-underline-animation">Avis</a></li>';
                    echo '  <li  class="current-page"><a href="contact.php">Contact</a></li>';
                    break;
                case "Occasion":
                    echo '  <li><a href="../index.php" class="hover-underline-animation">Accueil</a></li>';
                    echo '  <li class="current-page"><a href="occasion.php">Occasions</a></li>';
                    echo '  <li><a href="reviews.php" class="hover-underline-animation">Avis</a></li>';
                    echo '  <li><a href="contact.php" class="hover-underline-animation">Contact</a></li>';
                    break;
                case "Reviews":
                    echo '  <li><a href="../index.php" class="hover-underline-animation">Accueil</a></li>';
                    echo '  <li><a href="occasion.php" class="hover-underline-animation">Occasions</a></li>';
                    echo '  <li  class="current-page"><a href="reviews.php">Avis</a></li>';
                    echo '  <li><a href="contact.php" class="hover-underline-animation">Contact</a></li>';
                    break;
            }
            ?>
        </ul>
    </nav>
    <button class="hamburger">
        <div class="bar"></div>
    </button>
    <?php
    if (isset($_SESSION['role']) && ($_SESSION['role'] > 0)) {
        echo    '<div class="account-button">';
        echo    '<a href="#">';
        echo '<img src="' . $root_path . 'assets/person-fill.svg" alt="Account Logo">';
        echo    '<span>Panneau de controle</span>';
        echo    '</a>';
        echo    '</div>';
    }

    else {
        echo    '<div class="account-button">';
        echo    '<a href="#" id="login-btn">';
        echo '<img src="' . $root_path . 'assets/person-fill.svg" alt="Account Logo">';
        echo    '<span>Se connecter</span>';
        echo    '</a>';
        echo    '</div>';
    }
    ?>
    <nav class="mobile-nav">
        <?php
        if (isset($_SESSION['role']) && ($_SESSION['role'] > 0)) {
            echo '<a href="#" id="login-btn-mobile">Panneau de Contrôle</a>';
            echo '<a href="index.php">Accueil</a>';
            echo '<a href="pages/occasion.php">Occasions</a>';
            echo '<a href="pages/reviews.php">Avis</a>';
            echo '<a href="pages/contact.php">Contact</a>';
        } else {
            if ($current_page == "Home") {
                echo '<a href="#" id="login-btn-mobile">Se Connecter</a>';
                echo '<a href="index.php">Accueil</a>';
                echo '<a href="pages/occasion.php">Occasions</a>';
                echo '<a href="pages/reviews.php">Avis</a>';
                echo '<a href="pages/contact.php">Contact</a>';
            } else {
                echo '<a href="#" id="login-btn-mobile">Se Connecter</a>';
                echo '<a href="../index.php">Accueil</a>';
                echo '<a href="occasion.php">Occasions</a>';
                echo '<a href="reviews.php">Avis</a>';
                echo '<a href="contact.php">Contact</a>';
            }
        }
        ?>
    </nav>
</header>