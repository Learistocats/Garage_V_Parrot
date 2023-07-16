<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Garage V.Parrot</title>
  <link rel="stylesheet" href="styles/normalize.css">
  <link rel="stylesheet" href="styles/style.css">
  <link rel="stylesheet" href="styles/custom-elements.css">
</head>

<body>
  <?php
  $current_page = "Home";
  $assets_path = "assets/";
    include("assets/header.php");
  ?>
  <main>
    <div id="login-form-container">
      <div id="login-form">
        <h2>Login</h2>
        <span id="close-btn">&times;</span>
        <form action="index.php" method="post">
          <label for="username">Nom d'utilisateur:</label>
          <input type="text" id="username" name="username" required>
          <label for="password">Mot de passe:</label>
          <input type="password" id="password" name="password" required>
          <button type="submit" name="login" value="Login">Se connecter</button>
        </form>
      </div>
    </div>
    <div class="card">
      <div class="card-content">
        <h2 class="card-title">Garage V.Parrot</h2>
        <p class="card-description">Vente et rachat de véhicule d'occasion et gamme complète de services
          d'entretien et de réparation pour votre véhicule depuis 1985</p>
        <button class="contact-button">Nous contacter</button>
      </div>
    </div>
    <div class="section">
      <h2 class="section-titles">Services</h2>
      <div class="card-list">
        <a href="#" class="feature-card">
          <div class="feature-card-image">
            <img src="assets/controle_technique.jpg" alt="Card Image">
          </div>
          <div class="feature-card-content">
            <h2 class="feature-card-title">Controle Technique</h2>
            <p class="feature-card-description">Renouveler le controle technique de votre véhicule chez nous à partir de
              65€</p>
            <button class="feature-card-button">Nous contacter</button>
          </div>
        </a>
        <a href="#" class="feature-card">
          <div class="feature-card-image">
            <img src="assets/revision.jpg" alt="Card Image">
          </div>
          <div class="feature-card-content">
            <h2 class="feature-card-title">Révision</h2>
            <p class="feature-card-description">Nos experts peuvent diagnostiquer et régler les dysfonctionnement de
              votre véhicule au meilleur prix!</p>
            <button class="feature-card-button">Nous contacter</button>
          </div>
        </a>
        <a href="#" class="feature-card">
          <div class="feature-card-image">
            <img src="assets/vidange.jpg" alt="Card Image">
          </div>
          <div class="feature-card-content">
            <h2 class="feature-card-title">Vidange</h2>
            <p class="feature-card-description">Votre véhicule à besoin d'un changement d'huile? Nous pouvons faire ça
              pour vous, si vous êtes déjà client chez nous, le filtre est offert</p>
            <button class="feature-card-button">Nous contacter</button>
          </div>
        </a>
      </div>
      <h2 class="section-titles">Occasions</h2>
      <div class="section">
        <div class="card-list">
          <a href="#" class="feature-card">
            <div class="feature-card-image">
              <img src="your-image-url.jpg" alt="Card Image">
            </div>
            <div class="feature-card-content">
              <h2 class="feature-card-title">Title</h2>
              <p class="feature-card-description">Description goes here.</p>
            </div>
          </a>
        </div>
      </div>
    </div>
  </main>
  <?php
    include("assets/footer.php");
  ?>
  <script src="js/main.js"></script>
</body>

</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
  
  echo"Hello {$username}";
  echo $password;
}
?>

