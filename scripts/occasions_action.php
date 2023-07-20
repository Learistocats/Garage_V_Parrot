<?php
require_once('db_connection.php');
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        if ($action == "delete") {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "DELETE FROM occasions WHERE id = $id";
                if ($conn->query($sql) === TRUE) {
                    echo "Row deleted successfully";
                } else {
                    echo "Error deleting row: " . $conn->error;
                }
                $conn->close();
            }
        }
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['actionO'])) {
        $action = $_POST['actionO'];
        if ($action == 'add_occasion') {
            if (isset($_POST['titleO']) && isset($_POST['descriptionO'])) {
                if (isset($_POST['featured']) && ($_POST['featured'] == 'yes')) {
                    $featured = 1;
                }
                else {
                    $featured = 0;
                }
                $title = $_POST['titleO'];
                $description = $_POST['descriptionO'];
                $price = $_POST['priceO'];
                $mileage = $_POST['mileageO'];
                if ($conn->connect_error) {
                    die('Connection failed: ' . $conn->connect_error);
                }
                $occasion_sql = "INSERT INTO occasions (title, description, price, mileage, featured) VALUES (?, ?, ?, ?, ?)";
                $occasion_stmt = $conn->prepare($occasion_sql);
                $occasion_stmt->bind_param('ssdii', $title, $description, $price, $mileage, $featured);

                if ($occasion_stmt->execute()) {
                    $occasion_id = $conn->insert_id;
                    $occasion_stmt->close();
                    if (!empty($_FILES['imageO'])) {
                        $upload_dir = '../uploads/';
                        $uploaded_images = array();
                        foreach ($_FILES['imageO']['tmp_name'] as $key => $tmp_name) {
                            $file_name = $_FILES['imageO']['name'][$key];
                            $file_tmp = $_FILES['imageO']['tmp_name'][$key];
                            $file_path = $upload_dir . $file_name;
                            if (move_uploaded_file($file_tmp, $file_path)) {
                                $uploaded_images[] = $file_name;
                            } else {
                                echo "Error uploading file: " . $_FILES['imageO']['error'][$key];
                            }
                        }
                        $image_sql = "INSERT INTO occasion_images (occasion_id, image_name) VALUES (?, ?)";
                        $image_stmt = $conn->prepare($image_sql);
                        $image_stmt->bind_param('is', $occasion_id, $file_name);
                        foreach ($uploaded_images as $file_name) {
                            $image_stmt->execute();
                        }
                        $image_stmt->close();
                    }
                    echo "Occasion and images added successfully.";
                } else {
                    echo "Error inserting occasion: " . $occasion_stmt->error;
                }
                $conn->close();
            }
        }
    }
}
