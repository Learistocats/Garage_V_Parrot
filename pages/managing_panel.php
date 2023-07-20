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
            $fetchUsersSql = "SELECT * FROM users WHERE clearance_level = 1";
            $fetchOccasionsSql = "SELECT occasions.id, occasions.title, occasions.price, occasions.description, occasion_images.image_name
            FROM occasions
            LEFT JOIN occasion_images ON occasions.id = occasion_images.occasion_id
            GROUP BY occasions.id";
            $fetchUnapprovedReviews = "SELECT * from unapproved_reviews";
            $unapprovedReviewsResult = mysqli_query($conn, $fetchUnapprovedReviews);
            $occasionsResult = mysqli_query($conn, $fetchOccasionsSql);
            $servicesResult = mysqli_query($conn, $fetchServicesSql);
            $usersResult = mysqli_query($conn, $fetchUsersSql);

            echo '
            <div class="side-nav">
                <a class="nav-btn" href="../index.php">Garage V.Parrot</a>
                <button class="nav-btn" onclick="showContent(\'services\')">Services</button>
                <button class="nav-btn" onclick="showContent(\'occasions\')">Occasions</button>
                <button class="nav-btn" onclick="showContent(\'reviews\')">Témoignages</button>
                <button class="nav-btn" onclick="showContent(\'compte-employe\')">Compte Employé</button>
                <button class="nav-btn" onclick="showScheduleForm()">Horaires</button>
            </div>';

            echo '<div class="popup-form" id="scheduleForm">
                            <span class="close" onclick="closeScheduleForm()">&times;</span>
                            <h2>Modifier les horaires</h2>
                            <form id="updateScheduleForm" name="updateScheduleForm" method="post">
                                <label for="line1">Ligne 1:</label>
                                <input type="text" id="line1" name="line1">
        
                                <label for="line2">Ligne 2:</label>
                                <input type="text" id="line2" name="line2">
        
                                <label for="line3">Ligne 3:</label>
                                <input type="text" id="line3" name="line3">
        
                                <button type="submit" name="submit" onclick="updateSchedule()">Changer les horaires</button>
                            </form>
                        </div>';

            echo '<div class="content" id="services">
                <h2>Services</h2>';

            if (!$servicesResult) {
                die('Error fetching data: ' . mysqli_error($conn));
            } else {
                while ($row = mysqli_fetch_assoc($servicesResult)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];


                    echo '<div class="row-element" id="service-row-' . $id . '">
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
                    $image_names[$id] = $image_name;

                    echo   '<div class="row-element" id="occasion-row-' . $id . '">
                                <div class="column">' . $title . '</div>
                                <div class="column">' . $description . '</div>
                                <div class="column">' . $price . '</div>
                                <div class="column"><a class="thumbnail" href="#thumb">' . $image_name . '<span><img src="../uploads/'
                        . $image_name . '"></span></a> </div>
                                <button class="delete-button" onclick="deleteOccasionRow(' . $id . ')">Supprimer</button>
                            </div>';
                }
                echo '<div class="popup popup-form" id="formPopup">
                <span class="close" onclick="closeOccasionForm()">&times;</span>
                <form id="addOccasionForm" enctype="multipart/form-data" method="post">
                    <input type="hidden" id="actionO" name="actionO" value="add_occasion">

                    <label for="titleO">Titre:</label>
                    <input type="text" id="titleO" name="titleO" required>
        
                    <label for="descriptionO">Description:</label>
                    <textarea id="descriptionO" name="descriptionO" required></textarea>
        
                    <label for="priceO">Prix:</label>
                    <input type="number" id="priceO" name="priceO" required>
        
                    <label for="mileageO">Kilometrage:</label>
                    <input type="number" id="mileageO" name="mileageO" required>
                    <div>
                        <label>Mis en avant?</label>
                    <div>
                        <input type="checkbox" id="yes" name="featured" value="yes" />
                        <label for="yes">Oui</label>
                    </div>
                    <div>
                        <input type="checkbox" id="no" name="featured" value="no" />
                        <label for="no">Non</label>
                    </div>
                    </div>
                    <label for="imageO">Images:</label>
                    <input type="file" id="imageO" name="imageO[]" required multiple>
                    <button type="submit" onclick="submitOccasionsForm()">Ajouter l\'occasion</button>
                </form>
            </div>';
                echo '  <div class="add-row"><button class="add-button" onclick="openOccasionsForm()">Ajouter</button></div>';
                echo '</div>';
            }

            echo '<div class="content" id="reviews">
        <h2>Témoignages</h2>';
            if (!$fetchUnapprovedReviews) {
                die('Error fetching data: ' . mysqli_error($conn));
            } else {
                while ($row = mysqli_fetch_assoc($unapprovedReviewsResult)) {
                    $id = $row['id'];
                    $sender = $row['sender'];
                    $review = $row['review'];
                    $rating = $row['rating'];

                    echo   '<div class="row-element" id="review-row-' . $id . '">
                            <div class="column">' . $sender . '</div>
                            <div class="column">' . $review . '</div>
                            <div class="column">' . $rating . '</div>
                            <button class="add-button" onclick="acceptReview(' . $id . ')">Accepter</button>
                            <button class="delete-button" onclick="denyReview(' . $id . ')">Rejeter</button>
                        </div>';
                }
            }
            echo '</div>
    
    <div class="content" id="compte-employe">
        <h2>Compte Employé</h2>';
            if (!$usersResult) {
                die('Error fetching data: ' . mysqli_error($conn));
            } else {
                while ($row = mysqli_fetch_assoc($usersResult)) {
                    $id = $row['id'];
                    $username = $row['username'];
                    echo   '<div class="row-element" id="user-row-' . $id . '">
                    <div class="column">' . $username . '</div>
                    <button class="delete-button" onclick="denyReview(' . $id . ')">Révoquer</button>
                </div>';
                }
                echo '  <div class="add-row"><button class="add-button" onclick="openUserForm()">Ajouter</button></div>';
                echo '</div>';
                echo '</div>';
            }
            echo '<div class="popup-form" id="userForm">
            <span class="close" onclick="closeUserForm()">&times;</span>
            <h2>Ajouter un compte</h2>
            <form id="addUserForm" method="post">
                <input type="hidden" name="action" value="add">
                <label for="email">Adresse mail:</label>
                <input type="email" id="email" name="email" required autocomplete="email">
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password" required autocomplete="new-password">
                <button type="submit" onclick="addUser()">Ajouter le compte</button>
            </form>
            </div>';
        } elseif (isset($_SESSION['role']) && ($_SESSION['role'] == 1)) {
            $fetchOccasionsSql = "SELECT occasions.id, occasions.title, occasions.price, occasions.description, occasion_images.image_name
            FROM occasions
            LEFT JOIN occasion_images ON occasions.id = occasion_images.occasion_id
            GROUP BY occasions.id";
            $fetchUnapprovedReviews = "SELECT * from unapproved_reviews";
            $unapprovedReviewsResult = mysqli_query($conn, $fetchUnapprovedReviews);
            $occasionsResult = mysqli_query($conn, $fetchOccasionsSql);
            echo '
            <div class="side-nav">
                <a class="nav-btn" href="../index.php">Garage V.Parrot</a>
                <button class="nav-btn" onclick="showContent(\'occasions\')">Occasions</button>
                <button class="nav-btn" onclick="showContent(\'reviews\')">Témoignages</button>
            </div>

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
                    $image_names[$id] = $image_name;

                    echo   '<div class="row-element" id="occasion-row-' . $id . '">
                                <div class="column">' . $title . '</div>
                                <div class="column">' . $description . '</div>
                                <div class="column">' . $price . '</div>
                                <div class="column"><a class="thumbnail" href="#thumb">' . $image_name . '<span><img src="../uploads/'
                        . $image_name . '"></span></a> </div>
                                <button class="delete-button" onclick="deleteOccasionRow(' . $id . ')">Supprimer</button>
                            </div>';
                }
                echo '<div class="popup popup-form" id="formPopup">
                <span class="close" onclick="closeOccasionForm()">&times;</span>
                <form id="addOccasionForm" enctype="multipart/form-data" method="post">
                    <input type="hidden" id="actionO" name="actionO" value="add_occasion">

                    <label for="titleO">Titre:</label>
                    <input type="text" id="titleO" name="titleO" required>
        
                    <label for="descriptionO">Description:</label>
                    <textarea id="descriptionO" name="descriptionO" required></textarea>
        
                    <label for="priceO">Prix:</label>
                    <input type="number" id="priceO" name="priceO" required>
        
                    <label for="mileageO">Kilometrage:</label>
                    <input type="number" id="mileageO" name="mileageO" required>
                    <div>
                        <label>Mis en avant?</label>
                    <div>
                        <input type="checkbox" id="yes" name="featured" value="yes" />
                        <label for="yes">Oui</label>
                    </div>
                    <div>
                        <input type="checkbox" id="no" name="featured" value="no" />
                        <label for="no">Non</label>
                    </div>
                    </div>
                    <label for="imageO">Images:</label>
                    <input type="file" id="imageO" name="imageO[]" required multiple>
                    <button type="submit" onclick="submitOccasionsForm()">Ajouter l\'occasion</button>
                </form>
            </div>';
                echo '  <div class="add-row"><button class="add-button" onclick="openOccasionsForm()">Ajouter</button></div>';
                echo '</div>';
            }

            echo '<div class="content" id="reviews">
        <h2>Témoignages</h2>';
            if (!$fetchUnapprovedReviews) {
                die('Error fetching data: ' . mysqli_error($conn));
            } else {
                while ($row = mysqli_fetch_assoc($unapprovedReviewsResult)) {
                    $id = $row['id'];
                    $sender = $row['sender'];
                    $review = $row['review'];
                    $rating = $row['rating'];

                    echo   '<div class="row-element" id="review-row-' . $id . '">
                            <div class="column">' . $sender . '</div>
                            <div class="column">' . $review . '</div>
                            <div class="column">' . $rating . '</div>
                            <button class="add-button" onclick="acceptReview(' . $id . ')">Accepter</button>
                            <button class="delete-button" onclick="denyReview(' . $id . ')">Rejeter</button>
                        </div>';
                }
            }
            echo '</div>';
        } else {
            header("Location: ../index.php");
            exit();
        }
        ?>

    </main>
    <script src="../js/admin.js"></script>
</body>

</html>