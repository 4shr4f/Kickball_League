<?php
session_start();
include("db.php");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Team Details</title>
  <link rel="stylesheet" href="styles.css"/>
</head>
<?php
if (isset($_GET['name'])) {
  $teamName = $_GET['name'];
} else {
  echo 'No team chosen';
}

$sql = "SELECT * FROM teams WHERE team_name = ?";
$statement = $pdo->prepare($sql);
$statement->execute([$teamName]);
$team = $statement->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM players WHERE team_name = ?";
$statement = $pdo->prepare($sql);
$statement->execute([$teamName]);
$players = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<body>
  <header>
    <img src="logo.png" alt="Logo" id="logo" />
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
        <?php
        echo '<li><a href="add-player.php?name=' . $teamName .'"> Add Player</a></li>';
        ?>
      </ul>
    </nav>

    <main>
      <h1>Team Details</h1>
      <h2>Team Name: <?php echo $team['team_name']; ?></h2>
      <p>Skill Level: <?php echo $team['skill_level']; ?></p>
      <p>Game Day: <?php echo $team['game_day']; ?></p>
      <h3>Players:</h3>
      <ul>
        <?php
        foreach ($players as $player) {
          echo '<li>' . $player['player_name'] . '</li>';
        }
        ?>
      </ul>
      <?php
       echo ' <p><a href="edit-team.php?name=' . $teamName .'">Edit Team</a></p>';
      ?>
      <p><a href="dashboard.php">Back to Dashboard</a></p>

      <?php 
      $num = 4;
      if (count($players) >= $num) {
        echo '<p class= "error">The Team Is FULL, You cannot add more.</p>';
        
      }else{
      
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $playerName = $_POST['player-name'];
      
        $sql = "INSERT INTO players (player_name, team_name) VALUES (?, ?)";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(1, $playerName);
        $statement->bindValue(2, $teamName);
        $statement->execute();
      
        header("Location: team-details.php?name=$teamName");
        exit();
      }}
      ?>

      <form method="POST" action="">
        <label for="player-name">Player Name:</label>
        <input type="text" class="reqin" id="player-name" name="player-name" required />
        <button type="submit">Add Player</button>
      </form>
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