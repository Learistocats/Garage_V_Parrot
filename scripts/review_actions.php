<?php
require_once('db_connection.php');
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        $id = $_GET['id'];
        switch ($action) {
            case 'accept':
                $getRow = "SELECT * FROM unapproved_reviews WHERE id = $id";
                $result = mysqli_query($conn, $getRow);
                if ($result->num_rows == 1) {
                    $row_data = $result->fetch_assoc();
                    unset($row_data['id']);
                    $sql_insert = "INSERT INTO reviews (sender, review, rating) VALUES (?, ?, ?)";
                    $stmt = $conn->prepare($sql_insert);
                    $stmt->bind_param('ssi', $row_data['sender'], $row_data['review'], $row_data['rating']);
                    $stmt->execute();
                    if ($stmt->affected_rows == 1) {
                        $sql_delete = "DELETE FROM unapproved_reviews WHERE id = $id";
                        $conn->query($sql_delete);
                        echo "Row moved successfully.";
                    } else {
                        echo "Failed to move the row.";
                    }
                    } else {
                    echo "Row not found in the source table.";
                    }
                    break;
                case 'deny':
                    $sql_delete = "DELETE FROM unapproved_reviews WHERE id = $id";
                    if (mysqli_query($conn, $sql_delete)) {
                        echo "Row removed succeesfully";
                    }
                    else {
                        echo "Failed to remove the row";
                    }
                    break;

        }
    }
}
