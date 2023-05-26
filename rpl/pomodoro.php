<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

include 'config.php';

//ambil data user
$user_id = $_SESSION['user']['user_id'];

$query = mysqli_query($connection, "SELECT * FROM notes WHERE user_id = '$user_id'");
mysqli_data_seek($query, 0)

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
<a href="index.php" class="btn btn-primary">Back</a>
<div class="p-5 pomodoro">
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
        <button class="play" onclick="start()">Start</button>
        <button class="pause hide" onclick="pause()">Pause</button>
        <button class="stop" onclick="stopTime()">Stop</button>
        <button class="increase" onclick="increase()">Increase</button>
        <button class="decrease" onclick="decrease()">Decrease</button>
    </div>
</div>
<div class="p-5 notes">
    <div class="mb-2 addNote">
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
                        <div class="card">
                            <div class="card-body">
                                <form action="addNote.php" method="post">
                                    <label for="noteTitle" class="form-label">New Title</label>
                                    <input type="text" class="noteTitle form-control" name="noteTitle" required>
                                    <label for="note" class="form-label">New Note</label>
                                    <input type="text" class="note form-control" name="note" required>
                                    <button class="btn btn-primary">Add</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <?php while ($note = mysqli_fetch_assoc($query)): ?>
            <div class="mb-2 card" style="width: 24rem;">
                <div class="card-body">
                    <h5 class="card-title"><?=$note['note_title']?></h5>
                    <p class="card-text"><?=$note['note']?></p>
                    <a class="btn btn-primary" href="editNote.php?note_id=<?=$note['note_id']?>">Edit note</a>
                    <a class="btn btn-primary" href="deleteNote.php?note_id=<?=$note['note_id']?>">Delete note</a>
                </div>
            </div>
        <?php endwhile;?>
    </div>
</div>
<script type="text/javascript" src="js/pomodoro/test.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
