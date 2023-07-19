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
    $current_page = "Contact";
    $root_path = "../";
    include("../assets/header.php");
    ?>
    <main>
    <?php
        include("../scripts/login.php");
    ?>
    </main>
    <?php
    include("../assets/footer.php");
    ?>
    <script src="../js/main.js"></script>
</body>

</html>