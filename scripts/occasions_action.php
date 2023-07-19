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
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        if ($action == 'add_service') {
            if (isset($_POST['title']) && isset($_POST['description'])) {
                $title = $_POST['title'];
                $description = $_POST['description'];
                if (isset($_FILES["image"])) {
                    $target_dir = "../uploads/";
                    $target_file = $target_dir . basename($_FILES["image"]["name"]);
                    $image_name = basename($_FILES["image"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $check = getimagesize($_FILES["image"]["tmp_name"]);
                    if ($check !== false) {
                        $uploadOk = 1;
                    } else {
                        echo "Ce fichier n'est pas une image.";
                        $uploadOk = 0;
                    }
                    if (file_exists($target_file)) {
                        echo "Un fichier avec ce nom existe déjà.";
                        $uploadOk = 0;
                    }
                    if ($_FILES["image"]["size"] > 1000000) {
                        echo "Désolée, l'image est trop lourde.";
                        $uploadOk = 0;
                    }
                    if (
                        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                        && $imageFileType != "gif"
                    ) {
                        echo "Désolée, seulements les extensions JPG, JPEG, PNG & GIF files sont autorisés.";
                        $uploadOk = 0;
                    }
                    if ($uploadOk == 0) {
                        echo "Sorry, your file was not uploaded.";
                    } else {
                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                            $sql = "INSERT INTO services (title, description, image_name) VALUES (?, ?, ?)";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param('sss', $title, $description, $image_name);
                            if (!($stmt->execute())) {
                                echo "Error inserting row: " . $stmt->error;
                            }
                            $stmt->close();
                            $conn->close();
                            echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }
                }
            }
        }
    }
}
?>