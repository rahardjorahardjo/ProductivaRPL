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

//ambil data to-do
$queryTask = mysqli_query($connection, "SELECT * FROM tasks WHERE user_id = '$user_id' ORDER BY datetime ASC");
mysqli_data_seek($queryTask, 0);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="js/index.js" defer></script>
    <link rel="stylesheet" href="css/index.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <a href="signout.php">logout</a>
        <a href="todostaged.php">todolist</a>
        <a href="pomodorostage1.php">pomodoro</a>
    </div>
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
    <div class="container">
        <?php
        $total = mysqli_num_rows($queryTask);
        if($total == 0){
            echo '<p>No Task Available</p>';
        } else{
            if($total < 10){
                $cnt = $total;
            } else {
                $cnt = 10;
            }
            for($i = 0; $i<$cnt; $i++){
                $task = mysqli_fetch_assoc($queryTask);
                if ($task['status'] == 1) {
                    $isitask = '<s>' . $task['task'] . '</s>';
                } else {
                    $isitask = $task['task'];
                }
                echo '<p>'.$task['task'].'</p>';
            }
        }
        ?>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
