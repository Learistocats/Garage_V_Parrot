<?php
require_once('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['sender']) && isset($_POST['review']) && isset($_POST['rating'])) {
                $sender = htmlspecialchars($_POST['sender']);
                $review = htmlspecialchars($_POST['review']);
                $rating = $_POST['rating'];
                $sql = "INSERT INTO unapproved_reviews (sender, review, rating) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('ssi', $sender, $review, $rating);
                if (!($stmt->execute())) {
                    echo "Error inserting row: " . $stmt->error;
                }
                $stmt->close();
                $conn->close();
                echo "The review was sent";
                header("Location: ../index.php");
            }
        }
?>