<?php
session_start();
include("db.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kickball League</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <header>
        <img src="logo.png" alt="Logo" id="logo" />
        <section>
            <h2 id="web-app-name">Kickball League</h2>
            <ul id = "hl">
                <li><a href="about.html">About Us</a></li>
                <?php
                if (isset($_SESSION['username'])) {
                    echo '<li>Welcome, ' . $_SESSION['username'] . '</li>';
                    echo '<li><a href="logout.php">Logout</a></li>';
                } else {
                    echo '<li><a href="index.php">Login</a></li>';
                }
                ?>
            </ul>
        </section>
    </header>

    <div>
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="create-team.php">Create New Team</a></li>
                <li><a href="edit-team.php">Edit Team Page</a></li>
            </ul>
        </nav>

        <main>
            <?php
             if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $confirmPassword = $_POST['confirm-password'];
            
                $sqlCheckEmail = "SELECT * FROM users WHERE email = ?";
                $statementCheckEmail = $pdo->prepare($sqlCheckEmail);
                $statementCheckEmail->execute([$email]);
            
                $sqlCheckUsername = "SELECT * FROM users WHERE username = ?";
                $statementCheckUsername = $pdo->prepare($sqlCheckUsername);
                $statementCheckUsername->execute([$username]);
            
                if ($statementCheckEmail->rowCount() > 0) {
                    echo '<p class = "error">The email already exists. Please use a another email.</p>';
                } elseif ($statementCheckUsername->rowCount() > 0) {
                    echo '<p class = "error">The username already exists. Please choose a another username.</p>';
                } elseif ($password !== $confirmPassword) {
                    echo '<p class = "error">The password do not match. Please try again.</p>';
                } else {
                    $sqlInsert = "INSERT INTO users (username, email, passwor) VALUES (?, ?, ?)";
                    $statementInsert = $pdo->prepare($sqlInsert);
                    $statementInsert->bindValue(1, $username);
                    $statementInsert->bindValue(2, $email);
                    $statementInsert->bindValue(3, $password);
                    $statementInsert->execute();
            
                    echo "Registration successful.";
            
                    header('Location: index.php');
                    exit();
                }
            }
            if (isset($_SESSION['username'])) {
                echo '<h1>Welcome, ' . $_SESSION['username'] . '</h1>';
                echo '<p class = "error" >You are already logged in.</p>';
            } else {
                echo '
                <div class = "welform">
                <form id="registration-form" action="" method="POST">
                <fieldset>
                <legend><strong>User Registration</strong></legend>
                    <label for="username">Username:</label>
                    <input type="text" class = "reqin" id="username" name="username" required /><br><br>

                    <label for="email">Email:</label>
                    <input type="email" class = "reqin" id="email" name="email" required /><br><br>

                    <label for="password">Password:</label>
                    <input type="password" class = "reqin" id="password" name="password" required /><br><br>

                    <label for="confirm-password">Confirm PW:</label>
                    <input type="password" class = "reqin" id="confirm-password" name="confirm-password" required />

                    <button type="submit">Register</button>
                    </fieldset>
                </form>
                </div>
                <div class = "welform">
                <form id="login-form" action="login.php" method="POST">
                
                <fieldset>
                <legend><strong>Login</strong></legend>
                    <label for="login-email">Email:</label>
                    <input type="email" class = "reqin" id="login-email" name="login-email" required /><br><br>

                    <label for="login-password">Password:</label>
                    <input type="password" class = "reqin" id="login-password" name="login-password" required />

                    <button type="submit">Login</button>
                    </fieldset>
                </form>
                </div>
                ';
            }
            ?>
        </main>
    </div>

    <footer>
        <img src="smaller-logo.png" alt="Smaller Logo" id="flogo" />
        <section>
            <p>Ramallah, ashrafs@gmail.com, +970-59999999</p>
            <a href="contact.html">Contact Us</a>
            <p>&copy; 2023 Kickball League. All rights reserved.</p>
        </section>
    </footer>
</body>
</html>