<?php
include_once('db_connection.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['line1'])) {
                $line1 = "";
            }
            else {
                $line1 = $_POST['line1'];
            }
            if (!isset($_POST['line2'])) {
                $line2 = $_POST['line2'];
            }else{
                $line2 = $_POST['line2'];
            }
            if (!isset($_POST['line3'])) {
                $line3 = $_POST['line3'];
            }else{
                $line3 = $_POST['line3'];
            }
                    $sqlDeleteSchedule = "DELETE FROM schedule";
                    $sqlUpdateSchedule = "INSERT INTO schedule (line1, line2, line3) VALUES (?, ?, ?)";
                    $stmt = $conn->prepare($sqlDeleteSchedule);

                            if (!($stmt->execute())) {
                                echo "Error deleting: " . $stmt->error;
                            }
                            else {
                                echo 'Table cleared successfully';
                            }
                            $stmt->close();
                    $stmt = $conn->prepare($sqlUpdateSchedule); 
                    $stmt->bind_param('sss', $line1, $line2, $line3);
                            if (!($stmt->execute())) {
                                echo "Error deleting: " . $stmt->error;
                            }
                            else {
                                echo 'Table cleared successfully';
                            }
                            $stmt->close();
                            $conn->close();
}
?>