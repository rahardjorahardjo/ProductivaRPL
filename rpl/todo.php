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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/todo.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
    <h5><a href="index.php">back</a></h5>
    <h2>add category</h2>
    <form action="addCategory.php" method="post">
        <input type="text" name="categoryname">
        <button>Add</button>
    </form>
    <?php $cat = mysqli_query($connection, "SELECT * FROM categories WHERE user_id = '$user_id'");?>
    <?php $i = 1;?>
    <?php mysqli_data_seek($cat, 0);?>
    <?php while ($category = mysqli_fetch_assoc($cat)): ?>
    <?php $catid = $category['category_id']?>
    <div class="containe w-25 m-5">
        <h2 class="text-center"><?=$category['category_name']?></h2>
        <button><a href="deleteCategory.php?category_id=<?=$category['category_id']?>">delete category</a></button>
        <table class="table table-sm table-bordered table-dark ">
            <thead>
                <tr>
                <th scope="col" colspan="4" class="text-center">Task</th>
                </tr>
            </thead>
            <?php $ta = mysqli_query($connection, "SELECT * FROM tasks WHERE category_id = '$catid' AND user_id = '$user_id'");?>
            <?php $j = 1;?>
            <?php mysqli_data_seek($ta, 0);?>
            <?php while ($tasks = mysqli_fetch_assoc($ta)):
    if ($tasks['status'] == 1) {
        $isitask = '<s>' . $tasks['task'] . '</s>';
    } else {
        $isitask = $tasks['task'];
    }
    ?>
	            <tbody>
	                <tr>
	                <td><?=$isitask?></td>
	                <td class="text-center"><button"><a class="button-check" href="doneTask.php?task_id=<?=$tasks['task_id']?>"><i class="bi bi-check-square"></i></a></button></td>
	                <td class="text-center"><button"><a class="button-check" href="deleteTask.php?task_id=<?=$tasks['task_id']?>"><i class="bi bi-trash-fill"></i></a></button></td>
	                </tr>
	                <tr>
	            <?php $j++;?>
	            <?php endwhile;?>
            </tbody>
        </table>
        <form action="addTask.php?category_id=<?=$catid?>" method="post">
            <input type="text" name="task">
            <div">
                <button>Add task</button>
            </div>
        </form>
    </div>
    </div>
    <?php $i++;?>
    <?php endwhile;?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
