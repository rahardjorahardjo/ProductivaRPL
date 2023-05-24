<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

include 'config.php';

//ambil user id
$user_id = $_SESSION['user']['user_id'];

//ambil data notes
$query = mysqli_query($connection, "SELECT * FROM notes WHERE user_id = '$user_id'");
$notes = mysqli_fetch_assoc($query);
if(mysqli_num_rows($query) < 1){
    $note_title = "Notes";
    $note = "Notes";
} else {
    $note_title = $notes['note_title'];
    $note = $notes['note'];

}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pomodoro</title>
    <link rel="stylesheet" href="indexcss.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Mulish:wght@800&family=Zen+Kaku+Gothic+New:wght@700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- <nav>
      <ul>
        <li>
          <a href="#" class="logo">
            <img src="units/logo.png" alt="">
            <span class="nav-item">pomodoro</span>
          </a>
        </li>
        <li><a href="#">
          <i class="fas fa-home"></i>
          <span class="nav-home">home</span>
        </a></li>
          
        <li><a href="#">
          <i class="fas fa-user"></i>
          <span class="nav-user">Profile</span>
        </a></li>
        <li><a href="#">
          <i class="fas fa-user"></i>
          <span class="nav-user">Profile</span>
        </a></li>
        <li><a href="#">
          <i class="fas fa-user"></i>
          <span class="nav-user">Profile</span>
        </a></li>
        <li><a href="#" class="logout">
          <i class="fas fa-user"></i>
          <span class="nav-user">Profile</span>
        </a></li>

      </ul>
    </nav> -->
    

    <div class="backgrounds">
      <img src="units/background.svg" alt="" srcset="">
    </div>
    <div class="timerBox">
    </div>
    <h2 class="timerClock">10:11</h2>
    <a href="" class="spotifyBox">
      <!-- <h2 class="spotifyTexts">Connect to Spotify</h2>
      <img src="" alt="" srcset=""> -->
    </a>
    <div class="taskBox">

    </div>
    <div class="taskAdd">
    <div class="container datetime">
        <div class="date">Date</div>
        <div class="time">Time</div>
    </div>
    </div>
    
    <div class="navbar">
        <div class="navbarimg">
          <img src="units/walking.png" alt="">
        </div>
    
        <div class="profile"></div>
        <h1 class="navbartitle">Pomodoro</h1>
        <a href="Index.html" class="homebutton">
          <h2 class="homebuttondesc">Home</h2>
        </a>
    
        <a href="pomodoro.php" class="pomodorobutton">
          <h2 class="pomodorobuttondesc">Pomodoro</h2>
        </a>
    
        <a href="todo.php" class="task-listbutton">
          <h2 class="task-listdesc">Task-list</h2>
        </a>
    
        <a href="signout.php" class="logoutbuttons">
          <h2 class="logoutbuttondesc">Logout</h2>
        </a>
      </div>
    </body>
</html>