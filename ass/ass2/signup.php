<!DOCTYPE html>
<html lang="en">    
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
</head>
<body>
    <h1>Create an e-account</h1>
    <form action="" method="POST">
        <label>Username:</label>
        <input type="email" name="email" placeholder="*enter your email">
        <br><br>
        <label>Password:</label>
        <input type="password" name="pas" placeholder="*at least 8 characters">
        <br><br>
        <button type="submit">Sign Up</button>
    </form>

    <?php
    require_once "db.inc";
    include("connection.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = "";
        $password = "";

        // Prepare the SQL query
        $sql = "INSERT INTO user (email, p) VALUES (?,?)";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(1, $_POST['email']);
        if (isset($_POST['pas'])) {
            $password = $_POST['pas'];
        
            if (!preg_match("/.{8,}$/", $password)) {
                echo "Invalid password";
                exit();
            } else {
                $statement->bindValue(2, $password);
            }
        }

        
        $statement->execute();

        echo "Registration successful. Redirecting to LogIn...";

        // Redirect to the login page after a delay
        header("Refresh: 2; URL=login.html");
        exit();
    }
    ?>
</body>
</html>