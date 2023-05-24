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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/pomodoro.css">
    <script src="https://kit.fontawesome.com/6f3103b13c.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<div class="pomodoro">
    <div>
        <span class="study">Study Time!</span>
        <span class="break hide">Break Time!</span>
    </div>
    <div id="timer" >
        <span class="minutes">25</span>
        <span>:</span>
        <span class="seconds">00</span>
    </div>
    <div id="controls">
        <button class="p-3 play" onclick="start()">Start</button>
        <button class="p-3 pause hide" onclick="pause()">Pause</button>
        <button class="p-3 stop" onclick="stop()">Stop</button>
        <button class="p-3 increase" onclick="increase()">Increase</button>
        <button class="p-3 decrease" onclick="decrease()">Decrease</button>
    </div>
</div>
<div class="pt-5 notes">
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
                            <label for="note">New Note</label>
                            <input type="text" class="note" name="note">
                            <button class="btn btn-secondary">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="noteDisplay">
        <?php $query = mysqli_query($connection, "SELECT * FROM notes WHERE user_id = '$user_id'") ?>
        <?php mysqli_data_seek($query, 0) ?>
        <?php while($note = mysqli_fetch_assoc($query)): ?>
            <div class="noteTitle"><h2><?= $note['note_title'] ?></h2></div>
            <div class="note"><p><?= $note['note'] ?></p></div>
        <?php endwhile; ?>
    </div>
<script type="text/javascript" src="js/pomodoro/test.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
