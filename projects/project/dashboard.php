<?php
session_start();

include("db.php");

$sql = "SELECT * FROM teams";
$statement = $pdo->query($sql);
$teams = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <img src="logo.png" alt="Logo" id="logo">
    <section>
      <h2 id="web-app-name">Kickball League</h2>
      <ul>
        <?php
         if (isset($_SESSION['username'])) {
          echo '<li>Welcome, ' . $_SESSION['username'] . '</li>';
        }
        else {
          echo '<li>Welcome Guest</li>';
        }
        ?>
        <li><a href="index.php">Home</a></li>
      </ul>
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
      <h1>Dashboard</h1>
      <table id="team-table">
        <thead>
          <tr>
            <th>Team Name</th>
            <th>Skill Level</th>
            <th>Game Day</th>
            <th>Email</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($teams as $team) {
            $name = $team['team_name'];
            echo '<tr>';
            echo '<td><a href="team-details.php?name=' . $name . '">' . $team['team_name'] . '</a></td>';
            echo '<td>' . $team['skill_level'] . '</td>';
            echo '<td>' . $team['game_day'] . '</td>';
            echo '<td>' . $team['email'] . '</td>';
            echo '</tr>';
          }
          ?>
        </tbody>
      </table>
      <br>
      <button id="create-team-btn" onclick="location.href='create-team.php'">Create New Team</button>
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