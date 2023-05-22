<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

include 'config.php';

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
<div class="notes">
    
</div>
<script type="text/javascript" src="js/pomodoro/test.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
