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
<section>
        <div class="container">
            <h1>pomodoro</h1>

            <div class="painel">
                <p id="work">work</p>
                <p id="break">break</p>
            </div>

            <div class="timer">
                <div class="circle">
                    <div class="time">
                        <p id="minutes"></p>
                        <p>:</p>
                        <p id="seconds"></p>
                    </div>
                </div>
            </div>

            <div class="controls">
                <button id="start" onclick="start()"><i class="fa-solid fa-play"></i></button>
                <button onclick="start()" class=""></button>
                <button id="reset" onclick="start()"><i class="fa-solid fa-arrow-rotate-left"></i></button>
            </div>
        </div>
    </section>

    <!-- SCRIPT -->
    <script>
    let workTittle = document.getElementById('work');
    let breakTittle = document.getElementById('break');

    let workTime = 1;
    let breakTime = 5;

    let seconds = "00"

    // display
    window.onload = () => {
        document.getElementById('minutes').innerHTML = workTime;
        document.getElementById('seconds').innerHTML = seconds;

        workTittle.classList.add('active');
    }

    // start timer
    function start() {
        // change button
        document.getElementById('start').style.display = "none";
        document.getElementById('reset').style.display = "block";

        // change the time
        seconds = 59;

        let workMinutes = workTime - 1;
        let breakMinutes = breakTime - 1;

        breakCount = 0;

        // countdown
        let timerFunction = () => {
            //change the display
            document.getElementById('minutes').innerHTML = workMinutes;
            document.getElementById('seconds').innerHTML = seconds;

            // start
            seconds = seconds - 1;

            if(seconds === 0) {
                workMinutes = workMinutes - 1;
                if(workMinutes === -1 ){
                    if(breakCount % 2 === 0) {
                        // start break
                        workMinutes = breakMinutes;
                        breakCount++

                        // change the painel
                        workTittle.classList.remove('active');
                        breakTittle.classList.add('active');
                    }else {
                        // continue work
                        workMinutes = workTime;
                        breakCount++

                        // change the painel
                        breakTittle.classList.remove('active');
                        workTittle.classList.add('active');
                    }
                }
                seconds = 59;
            }
        }

        // start countdown
        setInterval(timerFunction, 1020); // 1000 = 1s
    }
    </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
