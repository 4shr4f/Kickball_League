<?php
session_start();
include("db.php");

if (isset($_GET['name'])) {
  $teamName = $_GET['name'];
} else {
  echo '<p class = "error">No team chosen</p>';
}
$sql = "SELECT * FROM teams WHERE team_name = ?";
$statement = $pdo->prepare($sql);
$statement->execute([$teamName]);
$team = $statement->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $newTeamName = $_POST['team-name'];
  $newSkillLevel = $_POST['team-skill'];
  $newGameDay = $_POST['game-day'];

  $sql = "UPDATE teams SET team_name = ?, skill_level = ?, game_day = ? WHERE team_name = ?";
  $statement = $pdo->prepare($sql);
  $statement->execute([$newTeamName, $newSkillLevel, $newGameDay, $teamName]);
 
  header("Location: team-details.php?name=$teamName");
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Team</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <img src="smaller-logo.png" alt="Logo" id="logo">
    <section>
    <h2>Kickball League</h2>
    <ul>
      <li><a href="about.html">About Us</a></li>
      <li><a href="logout.php">Logout</a></li>
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
    <h1>Edit Team</h1>
    <form method="POST" action="">
        <label for="team-name">Team Name:</label>
        <input type="text" class="nreqin" id="team-name" name="team-name" value="<?php echo $team['team_name']; ?>" ><br><br>
        
        <label for="team-skill">Team Skill Level (1-5):</label>
        <input type="number" class="nreqin" id="team-skill" name="team-skill" min="1" max="5" value="<?php echo $team['skill_level']; ?>" ><br><br>
        
        <label for="game-day">Game Day:</label>
        <input type="text" class="nreqin" id="game-day" name="game-day" value="<?php echo $team['game_day']; ?>" >
        
        <input class="bu" type="submit" value="Update">
      </form>
    
    <br>
    
    <a href="dashboard.php">Back to Dashboard</a>
    
    <br><br>
    
    <a href="dashboard.php">Delete Team</a>
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