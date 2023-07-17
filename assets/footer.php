<footer>
    <div class="footer-container">
        <div class="contact-info">
            <h3>Contact Us</h3>
            <p>Address: 123 Garage Street, City, Country</p>
            <p>Phone: +1 123-456-7890</p>
            <p>Email: info@example.com</p>
        </div>
        <div class="opening-hours">
            <h3>Opening Hours</h3>
            <p>Monday - Friday: 9:00 AM - 6:00 PM</p>
            <p>Saturday: 9:00 AM - 3:00 PM</p>
            <p>Sunday: Closed</p>
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