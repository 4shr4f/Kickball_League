<?php
require_once 'db.inc';
include("connection.php");

if (isset($_POST['title']) && isset($_POST['user_email']) && isset($_POST['body'])) {
    $ti =$_POST['title'];
    $ue = $_POST['user_email'];
    $de = $_POST['description'];
    $bo = $_POST['body'];
    $k = $_POST['keywords'];
    $rf = $_POST['relevant_file'];
    
    
    $sql = "INSERT INTO article (title, description, body_text, keywords, relevant_file, user_email	) VALUES (:value1, :value2, :value3, :value4, :value5, :value6)";
    $statement = $pdo->prepare($sql);
    
    $statement->bindParam(':value1', $ti);
    $statement->bindParam(':value2', $de);
    $statement->bindParam(':value3', $bo);
    $statement->bindParam(':value4', $k);
    $statement->bindParam(':value5', $rf);
    $statement->bindParam(':value6', $ue);
    

    $statement->execute();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Knowledge Base</title>
</head>
<body>
    <h1>Create an Article</h1>
    <form action="" method="post">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        <br>
        <label for="user_email">Author:</label>
        <input type="text" id="user_email" name="user_email" required>
        <br>
        <label for="description">Description:</label>
        <input type="text" id="description" name="description" required>
        <br>
        <label for="keywords">Keywords:</label>
        <input type="text" id="keywords" name="keywords" required>
        <br>
        <label for="body">Body:</label>
        <textarea id="body" name="body" required></textarea>
        <br>
        <label for="relevant_file">Media (Image or Video):</label>
        <input type="file" id="relevant_file" name="relevant_file" accept="image/*,video/*">
        <br>
        <input type="submit" Name="add" value="Create Article">
    </form>
</body>
</html>