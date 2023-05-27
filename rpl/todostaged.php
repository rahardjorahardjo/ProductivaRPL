<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

include 'config.php';

$user_id = $_SESSION['user']['user_id'];
$q = mysqli_query($connection, "SELECT * FROM tasks WHERE user_id = '$user_id'");
$row = mysqli_fetch_assoc($q);

$q2 = mysqli_query($connection, "SELECT * FROM categories");
$cnt = mysqli_num_rows($q2);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/todoo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title>Document</title>
</head>
<body>
    <div class="productiva">
        <div class="side-navbar">
            <div class="profile">
                <img src="units/background.svg" alt="">
            </div>
            <h1>Produktiva</h1>
            <div class="features">
                <li><a href="#">Home</a></li>
                <li><a href="#">Podomoro</a></li>
                <li><a href="#">Task-List</a></li>
            </div>
            <div class="logout">
                <img src="tabler_logout.png" alt="">
                <p>Logout</p>
            </div>
            <img src="walking.png" alt="" class="gambar">
        </div>
        <div class="kosong"></div>
        <div class="content-page">
            <div class="add-task">
                <form action="addCategory.php" method="post" class="add-task-box">
                    <button><i class="fas fa-plus"></i></button>
                    <input type="text" name="categoryname" placeholder="Add Task" required>
                </form>
            </div>
            <div class="task-list">
                <div class="task-list-box">
                    <div class="judul-box">
                        <p>
                        </p>
                        
                    </div>
                    <div class="konten-box">
                        <div class="isi-list">
                            <div class="isi-list-box">
                                <input type="checkbox">
                                <p>Tugas Pemprossman</p>
                            </div>
                        </div>
                        <div class="add-list-button">
                            <button>+ add new list</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
