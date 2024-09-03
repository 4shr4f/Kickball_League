<?php
session_start();

include("db.php");
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="styles.css" />
    <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['login-email'];
    $password = $_POST['login-password'];

    $sql = "SELECT * FROM users WHERE email = ? AND passwor = ?";
    $statement = $pdo->prepare($sql);
    $statement->execute([$email, $password]);

    if ($statement->rowCount() > 0) {
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];

        header('Location: dashboard.php');
        exit();
    } else {
        echo '<p class = "error">Invalid email or password.</p';
    }
}
?>
</html>