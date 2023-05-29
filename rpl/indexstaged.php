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
$query = mysqli_query($connection, "SELECT * FROM notes WHERE user_id = '$user_id' ORDER BY datetime_note DESC");
$notes = mysqli_fetch_assoc($query);
if (mysqli_num_rows($query) < 1) {
    $note_title = "Notes";
    $note = "Notes";
} else {
    $note_title = $notes['note_title'];
    $note = $notes['note'];

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <script src="js/index.js" defer></script>
    <title>Productiva. | Homepage</title>
    <title>Widget Waktu Lokal</title>
    <style>
        .clock {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            padding: 10px;
            background-color: #FFF4E0;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="productiva">
        <div class="side-navbar">
            <div class="profile">
            </div>
            <h1>Productiva.</h1>
            <div class="features">
                <li><a href="indexstaged.php">Home</a></li>
                <li><a href="pomodorostage1.php">Podomoro</a></li>
                <li><a href="todostaged.php">Task-List</a></li>
            </div>
            <div class="logout">
                <p class="icon"><i class="fa-solid fa-right-from-bracket"></i></p>
                <p><a href="signout.php" style="color:#FFF4E0;">Logout</a></p>
            </div>
            <img src="walking.png" alt="" class="gambar">
        </div>
        <div class="kosong"></div>
        <div class="content-page">
            <div class="backgroundsvg"></div>
            <div class="container datetime">
                <div class="date">Date</div>
                <div class="time">Time</div>
            </div>
            <div class="container p-3">
                <form action="" method="post">
                    <input type="text" name="title" value="<?= $note_title ?>" disabled>
                    <input type="text" name="notes" value="<?= $note ?>" disabled>
                </form>
            </div>
            <div class="clock">Loading...</div>

            <script>
        function updateClock() {
            var clockElement = document.querySelector('.clock');
            var currentTime = new Date();
            var hours = currentTime.getHours();
            var minutes = currentTime.getMinutes();
            var seconds = currentTime.getSeconds();
            var day = currentTime.getDate();
            var month = currentTime.getMonth() + 1; // Ditambahkan 1 karena Januari dimulai dari 0
            var year = currentTime.getFullYear();

            // Tambahkan angka 0 di depan jam, menit, dan detik jika hanya satu digit
            hours = (hours < 10 ? '0' : '') + hours;
            minutes = (minutes < 10 ? '0' : '') + minutes;
            seconds = (seconds < 10 ? '0' : '') + seconds;

            // Format waktu sebagai string HH:MM:SS
            var timeString = hours + ':' + minutes + ':' + seconds;

            // Format tanggal sebagai string DD/MM/YYYY
            var dateString = day + '/' + month + '/' + year;

            // Gabungkan waktu dan tanggal dalam satu string
            var dateTimeString = dateString + ' ' + timeString;

            // Perbarui elemen HTML dengan tanggal dan waktu lokal yang terbaru
            clockElement.textContent = dateTimeString;
        }

        // Panggil fungsi updateClock setiap detik
        setInterval(updateClock, 1000);
    </script>
        </div>

    </div>


</body>

</html>