<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Managing Panel</title>
    <link rel="stylesheet" href="../styles/normalize.css">
    <link rel="stylesheet" href="../styles/admin.css">
</head>

<?php
session_start();
$root_path = "../";
require_once($root_path . 'scripts/db_connection.php');
$current_page = "Admin";
?>

<body>
    <main>
        <?php
        if (isset($_SESSION['role']) && ($_SESSION['role'] == 2)) {

            $fetchServicesSql = "SELECT * FROM services";
            $fetchUsersSql = "SELECT * FROM users";
            $fetchOccasionsSql = "SELECT occasions.id, occasions.title, occasions.price, occasions.description, occasion_images.image_name
            FROM occasions
            LEFT JOIN occasion_images ON occasions.id = occasion_images.occasion_id
            GROUP BY occasions.id";
            $servicesResult = mysqli_query($conn, $fetchServicesSql);
            $usersResult = mysqli_query($conn, $fetchUsersSql);
            $occasionsResult = mysqli_query($conn, $fetchOccasionsSql);

            echo '
            <div class="side-nav">
                <button class="nav-btn" onclick="showContent(\'services\')">Services</button>
                <button class="nav-btn" onclick="showContent(\'occasions\')">Occasions</button>
                <button class="nav-btn" onclick="showContent(\'reviews\')">Témoignages</button>
                <button class="nav-btn" onclick="showContent(\'compte-employe\')">Compte Employé</button>
            </div>
    
            <div class="content" id="services">
                <h2>Services</h2>';
            if (!$servicesResult) {
                die('Error fetching data: ' . mysqli_error($conn));
            } else {
                while ($row = mysqli_fetch_assoc($servicesResult)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];


                    echo '<div class="row-element" id="row-' . $id . '">
                            <div class="column">' . $title . '</div>
                            <div class="column">' . $description . '</div>
                            <div class="column"><a class="thumbnail" href="#thumb">' . $image_name . '<span><img src="../uploads/'
                            . $image_name . '"></span></a> </div>
                            <button class="delete-button" onclick="deleteRow(' . $id . ')">Supprimer</button>
                        </div>';
                }
                echo '<div class="add-row"><button class="add-button" onclick="openForm()">Ajouter</button></div>';

                echo '  <div class="popup-form" id="myForm">
                            <span class="close" onclick="closeForm()">&times;</span>
                            <h2>Ajouter un service</h2>
                            <form id="addServiceForm" name="addServiceForm" enctype="multipart/form-data">
                                <input type="hidden" name="action" value="add_service">
                                <label for="title">Titre:</label>
                                <input type="text" id="title" name="title" required>
        
                                <label for="description">Description:</label>
                                <textarea id="description" name="description" required></textarea>
        
                                <label for="image">Image:</label>
                                <input type="file" id="image" name="image" required>
        
                                <button type="submit" name="submit" onclick="addService()">Ajouter le Service</button>
                            </form>
                        </div>';
            }
            echo '</div>
    
    <div class="content" id="occasions">
        <h2>Occasions</h2>';
            if (!$occasionsResult) {
                die('Error fetching data: ' . mysqli_error($conn));
            } else {
                while ($row = mysqli_fetch_assoc($occasionsResult)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];

                    if (!empty($image_name)) {
                        $image_names[$id] = $image_name;
                        $data[] = array('id' => $id, 'title' => $title, 'price' => $price, 'description' => $description);
                    }
                }
                if(isset($data)){
                foreach ($data as $row) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['price'];
                echo   '<div class="row-element" id="row-' . $id . '">
                            <div class="column">' . $title . '</div>
                            <div class="column">' . $description . '</div>
                            <div class="column">' . $price . '</div>
                            <div class="column"><a class="thumbnail" href="#thumb">' . $image_name . '<span><img src="../uploads/'
                            . $image_name . '"></span></a> </div>
                            <button class="delete-button" onclick="deleteOccasionRow(' . $id . ')">Supprimer</button>
                        </div>';
                }}
                echo '<div class="popup popup-form" id="formPopup">
                <form id="myForm">
                    <label for="title">Titre:</label>
                    <input type="text" id="title" name="title" required>
        
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" required></textarea>
        
                    <label for="price">Prix:</label>
                    <input type="number" id="price" name="price" required>
        
                    <label for="mileage">Kilometrage:</label>
                    <input type="number" id="mileage" name="mileage" required>
        
                    <!-- Single drag and drop area -->
                    <div class="drop-area" id="dropArea" ondrop="handleDrop(event)" ondragover="allowDrop(event)">
                        Déposer les images ici (jusqu\'a 5 images)
                    </div>
        
                    <button type="submit" onclick="submitOccasionsForm()">Ajouter l\'occasion</button>
                </form>
            </div>';
                echo '  <div class="add-row"><button class="add-button" onclick="openOccasionsForm()">Ajouter</button></div>';
                echo '</div>

    <div class="content" id="reviews">
        <h2>Témoignages</h2>
        <p>This is the Témoignages content.</p>
    </div>
    
    <div class="content" id="compte-employe">
        <h2>Compte Employé</h2>
        <p>This is the Compte Employé content.</p>
    </div>
    ';}
        } else {
            header("Location: ../index.php");
            exit();
        }
        ?>

    </main>
    <script src="../js/admin.js"></script>
</body>

</html>