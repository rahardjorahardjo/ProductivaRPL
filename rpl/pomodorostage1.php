<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

include 'config.php';

//ambil data user
$user_id = $_SESSION['user']['user_id'];

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pomodoro</title>
    <link rel="stylesheet" href="css/indexcss.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Mulish:wght@800&family=Zen+Kaku+Gothic+New:wght@700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="backgrounds">
      <img src="units/background.svg" alt="" srcset="">
    </div>
    <div class="timerBox">
        <div class="pomodoro">
          <div class="Prompt">
              <h1 class="study">Study Time!</h1>
              <h1 class="break hide">Break Time!</h1>
          </div>
          <div class="PomodoroTimes" id="timer" >
              <span class="minutes">25</span>
              <span>:</span>
              <span class="seconds">00</span>
          </div>
          <div class="Controla" id="controls">
              <div class="playback">
                <button class="decrease" onclick="decrease()"><img src="units/minus.png" alt=""></button>
                <button class="play" onclick="start()"><img src="units/Vector.png" alt=""></button>
                <button class="pause hide" onclick="pause()"><img src="units/pause.png" alt=""></button>
                <button class="increase" onclick="increase()"><img src="units/plus.png" alt=""></button>
              </div>
              <button class="stop" onclick="stop()">Stop</button>
          </div>
      </div>
    </div>

    <a href="" class="spotifyBox">
      <!-- <h2 class="spotifyTexts">Connect to Spotify</h2>
      <img src="" alt="" srcset=""> -->
    </a>
    <div class="taskBox">
      <div class="notesHead" style="font-weight: 500;
    font-size: 35px;
    line-height: 23px;
    text-align: center;
    margin-top: 15px;
    margin-left: 15px;
    margin-bottom: 0px;
    padding-top: 10px;
    color: #FFF4E0;   
    text-decoration: none;">Your Notes</div>
    <div class="container p-3">
    <div class="noteDisplay">
        <?php $query = mysqli_query($connection, "SELECT * FROM notes WHERE user_id = '$user_id'") ?>
        <?php mysqli_data_seek($query, 0) ?>
        <?php while($note = mysqli_fetch_assoc($query)): ?>
            <div class="noteWrap"><a href="#" class="notetitle"><?= $note['note_title'] ?></a></div>
        <?php endwhile; ?>
    </div>
    </div>
    </div>
    <div class="taskAdd">
    <div class="addNote">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#noteModal" >Add Note</button>
        <div class="modal" id="noteModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Note</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="addNote.php" method="post">
                            <label for="noteTitle">New Title</label>
                            <input type="text" class="noteTitle" name="noteTitle">
                            <div class="bawah">
                              <label for="note">New Note</label>
                              <input type="text" class="note" name="note">
                            </div>
                            <button class="btn btn-secondary">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    
    <div class="navbar">
        <div class="navbarimg">
          <img src="units/walking.png" alt="">
        </div>
    
        <div class="profile"></div>
        <h1 class="navbartitle">Pomodoro</h1>
        <a href="Index.php" class="homebutton">
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
      <script type="text/javascript" src="js/pomodoro/test.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    </body>
</html>