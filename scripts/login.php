<?php
$current_page = $_SERVER['PHP_SELF'];
        echo '<div id="login-form-container">';
        echo '<div id="login-form">';
        echo '<h2>Login</h2>';
        echo '<span id="close-btn">&times;</span>';
        echo '<form action="' . $current_page . '" method="post">';
        echo '<label for="username">Nom d\'utilisateur:</label>';
        echo '<input type="text" id="username" name="username" required>';
        echo '<label for="password">Mot de passe:</label>';
        echo '<input type="password" id="password" name="password" required>';
        echo '<button type="submit" name="login" value="Login">Se connecter</button>';
        echo '</form>';
        echo '</div>';
        echo '</div>';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $usernameInput = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $passwordInput = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
            
            $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE username = ?");
            mysqli_stmt_bind_param($stmt, 's', $usernameInput);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $user_id, $username, $hashed_password, $clearance_level);
            if (mysqli_stmt_fetch($stmt)) {
                if (password_verify($passwordInput, $hashed_password)) {
                    echo 'Login Successful';
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['username'] = $username;
                    $_SESSION['role'] = $clearance_level;
                }
                
            } 
            else {
            echo "Username not found.";
            }
            mysqli_stmt_close($stmt);
            header("Refresh:0");
        }
?>