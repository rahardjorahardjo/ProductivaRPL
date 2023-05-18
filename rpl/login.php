<?php
session_start();

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

include 'config.php';

if(isset($_POST['signin'])){
    //ambil data
    $username = strtolower(htmlspecialchars($_POST['username']));
    $password = $_POST['password'];

    //buat query
    $q = mysqli_query($connection, "SELECT * FROM users WHERE username = '$username'");
    if(mysqli_num_rows($q) === 1){
        //cek pw
        $data = mysqli_fetch_assoc($q);
        if(password_verify($password, $data['password'])){
            //start session
            $_SESSION["user"] = $data;
            $_SESSION["login"] = true;

            header("Location: index.php");

            exit; //keluar fungsi if
        }
    }

    $error = true;
    if ( isset($error) ){
        echo "<script>alert('Username/Password salah!');
        document.location.href ='login.php'</script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
    <main class="form-signin">
  <form method="post">

    <div class="form-floating">
      <input type="text" class="form-control" name="username" id="floatingInput" placeholder="mirzahm">
      <label for="floatingInput">Username</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <div class="checkbox mb-3">
    </div>
    <button class="w-100 btn btn-lg" id="signin" type="submit" name="signin">Sign in</button>
  </form>
  <a href="register.php">dont have any account</a>
</main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
