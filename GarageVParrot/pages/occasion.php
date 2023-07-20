<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garage V.Parrot</title>
    <link rel="stylesheet" href="../styles/normalize.css">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/custom-elements.css">
</head>

<body>
    <?php
    session_start();
    require_once '../scripts/db_connection.php';
    $fetchVehiclesSql = "SELECT * FROM occasions"; // Adaptez cette requête à vos besoins
    $vehiclesResult = mysqli_query($conn, $fetchVehiclesSql);

    if (!$vehiclesResult) {
        die('Error fetching data: ' . mysqli_error($conn));
    }

    require_once("../scripts/db_connection.php");
    $current_page = "Occasion";
    $root_path = "../";
    include("../assets/header.php");
    ?>
    <main>
        <?php
        include("../scripts/login.php");
        ?>
        <div class="section">
            <h2 class="section-titles">Véhicules d'occasion</h2>
            <div class="filter-bar">
                <input type="text" id="name" placeholder="Rechercher">
                <input type="number" id="min_price" placeholder="Prix minimum" min="0">
                <input type="number" id="max_price" placeholder="Prix maximum" min="0">
                <input type="number" id="min_mileage" placeholder="Kilométrage minimum" min="0">
                <input type="number" id="max_mileage" placeholder="Kilométrage maximum" min="0">
                <label for="sort">Trier par:</label>
                <select id="sort">
                    <option value="none">Aucun</option>
                    <option value="asc-price">Prix croissant</option>
                    <option value="desc-price">Prix décroissant</option>
                    <option value="asc-mileage">Kilometrage croissant</option>
                </select>
            </div>
            <div class="card-list">
                <?php
                while ($row = mysqli_fetch_assoc($vehiclesResult)) {
                    $title = $row['title'];
                    $description = $row['description'];
                    $mileage = $row['mileage'];
                    $price = $row['price'];
                    $occasion_id = $row['id'];

                    // Récupérer toutes les images liées à cette occasion
                    $fetchImagesSql = "SELECT * FROM occasion_images WHERE occasion_id = $occasion_id LIMIT 1";
                    $imagesResult = mysqli_query($conn, $fetchImagesSql);

                    if (!$imagesResult) {
                        die('Error fetching images: ' . mysqli_error($conn));
                    }

                    $imageRow = mysqli_fetch_assoc($imagesResult);
                    $image_name = $imageRow ? $imageRow['image_name'] : ''; // Si aucune image n'est trouvée, $image_name sera une chaîne vide

                    echo '<a href="article.php?id=' . $occasion_id . '" class="feature-card">';

                    if ($image_name) {
                        echo '<div class="feature-card-image">';
                        echo '<img src="' . $root_path . 'uploads/' . $image_name . '" alt="Card Image">';
                        echo '</div>';
                    }

                    echo '<div class="feature-card-content">';
                    echo '<h2 class="feature-card-title">' . $title . '</h2>';
                    echo '<p class="feature-card-description">' . $description . '</p>';
                    echo '<p class="feature-card-price"  style="display: inline">' . $price . '</p><span>€</span><br>';
                    echo '<p class="feature-card-mileage" style="display: inline">' . $mileage . '</p><span>KM</span>';
                    echo '<button class="feature-card-button">Détails</button>';
                    echo '</div>';
                    echo '</a>';
                }
                ?>
            </div>
        </div>
    </main>
    <?php
    include("../assets/footer.php");
    ?>
    <script src="../js/main.js"></script>
    <script src="../js/occasions_filter.js"></script>
</body>

</html>