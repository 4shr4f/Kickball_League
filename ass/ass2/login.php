<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log In</title>
</head>
<body>
    <h1>Welcome To Community of Practice</h1>
    <form action="" method="POST">
        <label>Email:</label>
        <input type="email" name="email" required>
        <br><br>
        <label>Password:</label>
        <input type="password" name="pas" required>
        <br><br>
        <button type="submit">Login</button>
    </form>

    <?php
    require_once "db.inc";
    include("connection.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password = $_POST['pas'];

        $sql = "SELECT * FROM user WHERE email = ? AND p = ?";
        $statement = $pdo->prepare($sql);
        $statement->execute([$email, $password]);

        if ($statement->rowCount() > 0) {
            
            header("Location: index2.html");
            exit();
        } else {
            echo "Invalid email or password";
        }
    }
    ?>
</body>
</html>