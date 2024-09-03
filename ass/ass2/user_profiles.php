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
    <title>User Profiles</title>
</head>
<body>
    <h1>Create Your User Profile</h1>
    <form action="http://comp334.studentswebprojects.ritaj.ps/util/process.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="photo">Photo:</label>
        <input type="file" id="photo" name="photo" accept="image/*">
        <br>
        <label for="cv">Photo:</label>
        <input type="file" id="cv" name="cv" accept="pdf/*">
        <br>
        <label for="bio">Bio:</label>
        <textarea id="bio" name="bio" required></textarea>
        <br>
        <input type="submit" value="Create Profile">
    </form>
</body>
</html>