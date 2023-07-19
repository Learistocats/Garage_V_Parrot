<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garage V.Parrot</title>
    <link rel="stylesheet" href="styles/normalize.css">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/custom-elements.css">
</head>

<body>
    <?php
    session_start();
    require_once 'scripts/db_connection.php';
    $fetchServicesSql = "SELECT * FROM services";
    $servicesResult = mysqli_query($conn, $fetchServicesSql);
    $current_page = "Home";
    $root_path = "./";
    include("assets/header.php");
    ?>
    <main>
        <?php
        include("scripts/login.php");
        ?>
        <div class="card">
            <div class="card-content">
                <h2 class="card-title">Garage V.Parrot</h2>
                <p class="card-description">Vente et rachat de véhicule d'occasion et gamme complète de services
                    d'entretien et de réparation pour votre véhicule depuis 1985</p>
                <button class="contact-button">Nous contacter</button>
            </div>
        </div>
        <div class="section">
            <h2 class="section-titles">Services</h2>
            <div class="card-list">
                <?php
                if (!$servicesResult) {
                    die('Error fetching data: ' . mysqli_error($conn));
                } else {
                    while ($row = mysqli_fetch_assoc($servicesResult)) {
                        $title = $row['title'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        echo '<a href="#" class="feature-card">';
                        echo '  <div class="feature-card-image">';
                        echo '      <img src="' . $root_path . 'uploads/' . $image_name . '" alt="Card Image">';
                        echo '  </div>';
                        echo '  <div class="feature-card-content">';
                        echo '      <h2 class="feature-card-title">' . $title . '</h2>';
                        echo '      <p class="feature-card-description">' . $description . '</p>';
                        echo '      <button class="feature-card-button">Nous contacter</button>';
                        echo '  </div>';
                        echo '</a>';
                    }
                }
                mysqli_close($conn);
                ?>
            </div>
            <h2 class="section-titles">Occasions</h2>
            <div class="section">
                <div class="card-list">
                    <a href="#" class="feature-card">
                        <div class="feature-card-image">
                            <img src="your-image-url.jpg" alt="Card Image">
                        </div>
                        <div class="feature-card-content">
                            <h2 class="feature-card-title">Title</h2>
                            <p class="feature-card-description">Description goes here.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </main>
    <?php
    include("assets/footer.php");
    ?>
    <script src="js/main.js"></script>
</body>

</html>