<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

include 'config.php';

$note_title = $_POST['noteTitle'];
$note = $_POST['note'];
$user_id = $_SESSION['user']['user_id'];
mysqli_query($connection, "INSERT INTO notes VALUES ('','$user_id', '$note_title', '$note')");
header("Location: pomodoro.php");

?>