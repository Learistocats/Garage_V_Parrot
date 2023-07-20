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
    $current_page = "Occasion";

    $occasion_id = isset($_GET['id']) ? $_GET['id'] : die('No occasion ID provided');

    $fetchVehicleSql = "SELECT * FROM occasions WHERE id = $occasion_id"; // Adapt this query as per your needs
    $vehicleResult = mysqli_query($conn, $fetchVehicleSql);

    if (!$vehicleResult) {
        die('Error fetching data: ' . mysqli_error($conn));
    }

    $occasion = mysqli_fetch_assoc($vehicleResult);

    if (!$occasion) {
        die('No such occasion found');
    }

    $fetchImagesSql = "SELECT * FROM occasion_images WHERE occasion_id = $occasion_id";
    $imagesResult = mysqli_query($conn, $fetchImagesSql);

    if (!$imagesResult) {
        die('Error fetching images: ' . mysqli_error($conn));
    }

    $images = [];
    while ($imageRow = mysqli_fetch_assoc($imagesResult)) {
        $images[] = $imageRow['image_name'];
    }

    $root_path = "../";
    include("../assets/header.php");
    ?>
    <main>
        <?php
        include("../scripts/login.php");
        ?>
        <div class="section">
            <h2 class="section-titles"><?php echo $occasion['title']; ?></h2>
            <div class=article-section>
                <div class="gallery">
                    <div class="slider"><?php
                                        foreach ($images as $image_name) {
                                            echo '<img src="' . $root_path . 'uploads/' . $image_name . '" alt="Image of the occasion">';
                                        }
                                        ?>
                    </div>
                    <div class="controls">
                        <button id="prevBtn" class="arrow-button left-arrow">&#10094;</button>
                        <button id="nextBtn" class="arrow-button right-arrow">&#10095;</button>
                    </div>
                </div>
                <div style="margin-top: 10px">
                    <p>Prix : <?php echo $occasion['price']; ?>€</p>
                    <p>Kilométrage : <?php echo $occasion['mileage']; ?> KM</p>
                    <p><?php echo $occasion['description']; ?></p>
                    <?php echo '<a href="' . $root_path . 'pages/contact.php?subject=' . $occasion['title'] . ' Article N°' . $occasion_id . '"><button class="article-card-button">Nous contacter</button></a>'; ?>
                </div>
            </div>
        </div>
    </main>
    <?php
    include("../assets/footer.php");
    ?>
    <script src="../js/main.js"></script>
</body>

</html>