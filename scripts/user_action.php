<?php
require_once('db_connection.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        if ($action == 'add') {
            if (isset($_POST['email']) && isset($_POST['password'])) {
                $username = $_POST['email'];
                $password = $_POST['password'];
                $clearance_level = 1;
                if ($action == "add") {
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $sqlAddUser = "INSERT INTO users (username, password, clearance_level) VALUES (?, ?, ?)";
                    $stmt = $conn->prepare($sqlAddUser);
                            $stmt->bind_param('ssi', $username, $hashed_password, $clearance_level);
                            if (!($stmt->execute())) {
                                echo "Error inserting row: " . $stmt->error;
                            }
                            else {
                                echo 'User added succesfully';
                            }
                            $stmt->close();
                            $conn->close();
                }
            }
        }
    }
}
?>
