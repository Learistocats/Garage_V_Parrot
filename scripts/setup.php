<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Installation du site web</h1>
    <form action="index.php" method="post">
        <label for="username">Nom d'utilisateur compte admin:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Mot de passe compte admin</label>
        <input type="password" id="password" name="password" required>
        <button type="submit" name="login" value="Login">Valider</button>
    </form>
</body>
</html>
<?php
require_once './private/config.php';
$host = DB_HOST;
$username = DB_USER; 
$password = DB_PASS; 
$conn = mysqli_connect($host, $username, $password);

if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $adminUsername = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $adminPassword = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    $databaseName = DB_NAME;

    // Create the database
    $sql = "CREATE DATABASE IF NOT EXISTS $databaseName";

    if (mysqli_query($conn, $sql)) {
        echo "Database '$databaseName' created successfully.";
    } else {
        echo "Error creating database: " . mysqli_error($conn);
        exit;
    }

    mysqli_select_db($conn, $databaseName);

    //Creating the users table

    $sqlCreateTable = "CREATE TABLE IF NOT EXISTS users (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(25) NOT NULL,
        password VARCHAR(255) NOT NULL,
        clearance_level INT NOT NULL
    )";

    if (mysqli_query($conn, $sqlCreateTable)) {
        echo "Table 'users' created successfully.";
    } else {
        echo "Error creating table: " . mysqli_error($conn);
        exit;
    }

    $adminPasswordHash = password_hash($adminPassword, PASSWORD_DEFAULT);
    $adminClearanceLevel = 2;
    $sqlInsertAdmin = "INSERT INTO users (username, password, clearance_level) 
    VALUES ('$adminUsername', '$adminPasswordHash', $adminClearanceLevel)";

if (mysqli_query($conn, $sqlInsertAdmin)) {
    echo "Base admin user inserted successfully.<br>";
} else {
    echo "Error inserting admin user: " . mysqli_error($conn);
    exit;
}
$sqlCreateServicesTable = "CREATE TABLE IF NOT EXISTS services (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(30) NOT NULL,
    description TEXT NOT NULL,
    image_name VARCHAR(255) NOT NULL
)";

if (mysqli_query($conn, $sqlCreateServicesTable)) {
    echo "Table 'services' created successfully.<br>";
} else {
    echo "Error creating 'services' table: " . mysqli_error($conn);
    exit;
}

$sqlAddServices = "INSERT INTO services (title, description, image_name)
              VALUES
              ('Controle Technique', 'Renouveler le controle technique de votre véhicule chez nous à partir de
              65€', 'controle_technique.jpg'),
              ('Révision', 'Nos experts peuvent diagnostiquer et régler les dysfonctionnement de
              votre véhicule au meilleur prix!', 'revision.jpg'),
              ('Vidange', 'Votre véhicule à besoin d\'un changement d\'huile? Nous pouvons faire ça
              pour vous, si vous êtes déjà client chez nous, le filtre est offert', 'vidange.jpg')";

if (mysqli_query($conn, $sqlAddServices)) {
    echo "3 rows added to 'services' table.<br>";
} else {
    echo "Error adding rows to 'services' table: " . mysqli_error($conn);
    exit;
}

$sqlCreateOccasionsTable = "CREATE TABLE IF NOT EXISTS occasions (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(30) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    image_name VARCHAR(255) NOT NULL,
    featured TINYINT(1) DEFAULT 0
)";

if (mysqli_query($conn, $sqlCreateOccasionsTable)) {
    echo "Table 'occasions' created successfully.<br>";
} else {
    echo "Error creating 'occasions' table: " . mysqli_error($conn);
    exit;
}

rename("index.php", "setup.php");
rename("home.php", "index.php");
header("Refresh:0");


    mysqli_close($conn);
}
