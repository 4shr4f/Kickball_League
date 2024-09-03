<?php
session_start();

include("db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $teamName = $_POST['team-name'];
    $skillLevel = $_POST['team-skill'];
    $gameDay = $_POST['game-day'];
    
    if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
        $email = $_SESSION['email'];

        $sql = "INSERT INTO teams (team_name, skill_level, game_day, email) VALUES (?, ?, ?, ?)";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(1, $teamName);
        $statement->bindValue(2, $skillLevel);
        $statement->bindValue(3, $gameDay);
        $statement->bindValue(4, $email);
        $statement->execute();

        echo "Team Created Successfully.";      
    } else {
        echo '<p class = "error">Please LogIn First.</p>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Create New Team</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <img src="logo.png" alt="Logo" id="logo">
    <section>
      <h2>Kickball League</h2>
      <ul>
        <li><a href="about.html">About Us</a></li>
        <?php
         if (isset($_SESSION['username'])) {
          echo '<li><a href="logout.php">Logout</a></li>';
        }
        else { 
          echo ' <li><a href="index.php">Login</a></li>';
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
      <h1>Create New Team</h1>
      <form id="create-team-form" action="create-team.php" method="POST">
        <label for="team-name">Team Name:</label>
        <input type="text" class = "reqin" id="team-name" name="team-name" required><br><br>
        
        <label for="team-skill">Team Skill Level (1-5):</label>
        <input type="number" class = "nreqin" id="team-skill" name="team-skill" min="1" max="5" ><br><br>
        
        <label for="game-day">Game Day:</label>
        <input type="text" class = "reqin" id="game-day" name="game-day" required>
        
        <input class="bu" type="submit" value="Create">
      </form>
      
      <br>
      
      <a href="dashboard.php">Back to Dashboard</a>
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