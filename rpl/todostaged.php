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
                <?php $cat = mysqli_query($connection, "SELECT * FROM categories WHERE user_id = '$user_id'");?>
                <?php mysqli_data_seek($cat, 0);?>
                <?php while ($category = mysqli_fetch_assoc($cat)): ?>
                <?php $catid = $category['category_id']?>
                <div class="task-list-box">
                    <div class="judul-box">
                        <h2 class="text-center"><?= $category['category_name'] ?></h2>
                    </div>
                    <div class="konten-box">
                        <div class="isi-list">
                            <?php
                            $ta = mysqli_query($connection, "SELECT * FROM tasks WHERE category_id = '$catid' AND user_id = '$user_id'");
                            while ($tasks = mysqli_fetch_assoc($ta)) {
                                if ($tasks['status'] == 1) {
                                    $isitask = '<s>' . $tasks['task'] . '</s>';
                                } else {
                                    $isitask = $tasks['task'];
                                }
                            ?>
                                <div class="isi-list-box">
                                    <input type="checkbox">
                                    <p><?= $isitask ?></p>
                                    <a href="deleteTask.php?task_id=<?=$tasks['task_id']?>">ss</a>
                                </div>
                            <?php } ?>

                        </div>
                        <div class="add-list-button">
                            <button>+ add new list</button>
                        </div>
                        <div class="add-list-button">
                            <button><a href="deleteCategory.php?category_id=<?=$category['category_id']?>">delete category</a></button>
                        </div>
                    </div>
                </div>
                <?php endwhile;?>
            </div>

        </div>
        
    </div>
</body>
</html>
