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
        <div class="section">
            <h2 class="section-title">Contactez-nous</h2>
            <div class=contact-form>
                <form action="../scripts/contact_form.php" method="post">
                    <div class="form-group">
                        <label for="email">Adresse Email :</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Numéro de Téléphone :</label>
                        <input type="tel" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Sujet :</label>
                        <input type="text" id="subject" name="subject" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message :</label>
                        <textarea id="message" name="message" rows="6" required></textarea>
                    </div>
                    <button type="submit">Envoyer</button>
                </form>
            </div>
        </div>
    </main>
    <?php
    include("../assets/footer.php");
    ?>
    <script src="../js/main.js"></script>
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const subject = urlParams.get('subject');
        const subjectField = document.getElementById('subject');
        subjectField.value = subject;
    </script>
</body>

</html>