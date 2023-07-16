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
    $current_page = "Occasion";
    $assets_path = "../assets/";
    include("../assets/header.php");
    ?>
    <main>
        <div id="login-form-container">
            <div id="login-form">
                <h2>Login</h2>
                <span id="close-btn">&times;</span>
                <form>
                    <label for="username">Nom d'utilisateur:</label>
                    <input type="text" id="username" name="username" required>
                    <label for="password">Mot de passe:</label>
                    <input type="password" id="password" name="password" required>
                    <button type="submit">Se connecter</button>
                </form>
            </div>
        </div>
    </main>
    <?php
    include("../assets/footer.php");
    ?>
    <script src="../js/main.js"></script>
</body>

</html>