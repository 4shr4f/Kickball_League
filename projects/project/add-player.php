<?php
session_start();
include("db.php");

if (isset($_GET['name'])) {
  $teamName = $_GET['name'];
} else {
  echo 'No team chosen';
  exit();
}

$sql = "SELECT * FROM players WHERE team_name = ?";
$statement = $pdo->prepare($sql);
$statement->execute([$teamName]);
$players = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Player</title>
  <link rel="stylesheet" href="styles.css" />
</head>
<body>
  <header>
    <img src="logo.png" alt="Logo" id="logo" />
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
        <li><a href="add-player.php?name=<?php echo $teamName; ?>">Add Player</a></li>
      </ul>
    </nav>

    <main>
      <h1>Add Player</h1>
      <form method="POST" action="">
        <label for="player-name">Player Name:</label>
        <input type="text" class="reqin" id="player-name" name="player-name" required />
        <button type="submit">Add Player</button>
      </form>
      <?php 
      $num = 4;
      if (count($players) >= $num) {
        echo '<p class="error">The Team Is FULL, You cannot add more.</p>';
      } else {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $playerName = $_POST['player-name'];
        
          $sql = "INSERT INTO players (player_name, team_name) VALUES (?, ?)";
          $statement = $pdo->prepare($sql);
          $statement->bindValue(1, $playerName);
          $statement->bindValue(2, $teamName);
          $statement->execute();
        
          header("Location: team-details.php?name=$teamName");
          exit();
        }
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