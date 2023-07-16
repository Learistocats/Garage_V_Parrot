<header>
    <?php
        echo '<img src="' . $assets_path . 'logo.png" class="top-logo" />'
    ?>
    <nav>
        <ul class="breadcrumb">
            <?php
            switch ($current_page) 
            {
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
    <div class="account-button">
        <a href="#" id="login-btn">
            <?php
            echo '<img src="'. $assets_path . 'person-fill.svg" alt="Account Logo">';
            ?>
            <span>Se Connecter</span>
        </a>
    </div>
    <nav class="mobile-nav">
    <?php
    if ($current_page == "Home") 
    {
        echo '<a href="#" id="login-btn-mobile">Se Connecter</a>';
        echo '<a href="index.php">Accueil</a>';
        echo '<a href="pages/occasion.php">Occasions</a>';
        echo '<a href="pages/reviews.php">Avis</a>';
        echo '<a href="pages/contact.php">Contact</a>';
    }
    else 
    {
        echo '<a href="#" id="login-btn-mobile">Se Connecter</a>';
        echo '<a href="../index.php">Accueil</a>';
        echo '<a href="occasion.php">Occasions</a>';
        echo '<a href="reviews.php">Avis</a>';
        echo '<a href="contact.php">Contact</a>';
    }
    ?>
    </nav>
</header>