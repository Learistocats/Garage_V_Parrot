<footer>
    <div class="footer-container">
        <div class="contact-info">
            <h3>Nous contacter</h3>
            <p>Adresse: 123 Rue des Garages, Montpellier, France</p>
            <p>Téléphone: +1 123-456-7890</p>
            <p>Email: garagevictorparrot@gmail.com</p>
        </div>
        <div class="opening-hours">
            <?php
            require_once($root_path . 'scripts/db_connection.php');
            $sqlSchedule = "SELECT * FROM schedule LIMIT 1";
            $sqlScheduleResults = mysqli_query($conn, $sqlSchedule);
            while ($row = mysqli_fetch_assoc($sqlScheduleResults)) {
                echo '<h3>Horaires</h3>
                <p>' . $row['line1'] . '</p>
                <p>' . $row['line2'] . '</p>
                <p>' . $row['line3'] . '</p>';
            }
            ?>
        </div>
    </div>
    <div class="copyright">
        <p>&copy; 2023 Garage V Parrot. All rights reserved.</p>
    </div>
    <?php
        if (isset($_SESSION['role'])) {
            echo '<div class="disconnect">';
            echo '<a href="' . $root_path . 'scripts/logout.php" class="disconnect">Se deconnecter</a>';
            echo '</div>';
        }
    ?>
</footer>