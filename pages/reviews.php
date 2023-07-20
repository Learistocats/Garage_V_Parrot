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
    require_once("../scripts/db_connection.php");
    $current_page = "Reviews";
    $root_path = "../";
    include("../assets/header.php");
    ?>
    <main>
        <?php
        include("../scripts/login.php");
        ?>
        <div class="section">
            <h2 class="section-title">Donner nous votre avis!</h2>
            <div class="cards-list">
                <form class="review-form" action="../scripts/send_reviews.php" method="post">
                    <div class="rating">
                        <label for="stars">Note:</label>
                        <div class="stars" id="stars">
                            <input type="radio" id="star5" name="rating" value="5">
                            <label for="star5" title="5 stars"></label>
                            <input type="radio" id="star4" name="rating" value="4">
                            <label for="star4" title="4 stars"></label>
                            <input type="radio" id="star3" name="rating" value="3">
                            <label for="star3" title="3 stars"></label>
                            <input type="radio" id="star2" name="rating" value="2">
                            <label for="star2" title="2 stars"></label>
                            <input type="radio" id="star1" name="rating" value="1">
                            <label for="star1" title="1 star"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sender">Votre nom:</label>
                        <input type="text" id="sender" name="sender" required>
                    </div>
                    <div class="form-group">
                        <label for="review">Avis:</label>
                        <textarea id="review" name="review" rows="4" required></textarea>
                    </div>
                    <button type="submit">Envoyer</button>
                </form>
            </div>
            <div class="comment-section">
            <?php 
            $fetchReviews = "SELECT * FROM reviews";
            $result = mysqli_query($conn, $fetchReviews);
            if(!$result){
                die('Error fetching data: ' . mysqli_error($conn));
            } else {

                while ($row = mysqli_fetch_assoc($result)) {
                $sender = $row['sender'];
                $review = $row['review'];
                $rating = $row['rating'];
                echo '<div class="comment">
                <div class="comment-header">
                    <span class="username">' . $sender . '</span>
                    <span class="note">' . $rating . '/5</span>
                </div>
                <div class="comment-text">' . $review . '</div>
            </div>';
                }
            }
            ?>

            </div>
        </div>

    </main>
    <?php
    include("../assets/footer.php");
    ?>
    <script src="../js/main.js"></script>
</body>

</html>