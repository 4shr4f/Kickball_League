<?php
require_once 'db.inc';
include("connection.php");
?>
<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <form method="post" action="">
            <input name="search" type="text" placeholder="Search(Title,Keywords,Author">
            <button type="submit" name="button" >Submit</button>
        </form>
        <table border = 1>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $noRe = "";
            $found=false;
            if (isset($_POST['search'])) {
                    $sh = $_POST['search'];

                    $query = "SELECT * FROM article";
                    $stmt = $pdo->query($query);
                    
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        if(strtolower($sh) == strtolower($row['title']) || strtolower($sh) == strtolower($row['keywords']) || strtolower($sh) == strtolower($row['user_email'])){

                            echo "
                             <tr> 
                             <td><a href='body.html'> {$row['title']} </a></td>
                             <td> {$row['user_email']}</td> 
                             <td>{$row['description']}</td>";
                             $found = true;
                        }
                    }
                 if(!$found){
                    $noRe = "There is no result for your search";
                    }
            }
             ?>

            </tbody>
        </table>
        <?php
        echo $noRe;
        ?>
    </body>
</html>