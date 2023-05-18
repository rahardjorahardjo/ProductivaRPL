<?php
session_start();

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

include 'config.php';

if(isset($_POST['signup'])){
    //ambil data user
    $fullname = htmlspecialchars($_POST['fullname']);
    $username = strtolower(htmlspecialchars($_POST['username']));
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $password2 = htmlspecialchars($_POST['password2']);

    //query cek db
    $check = mysqli_query($connection, "SELECT * FROM users WHERE username = '$username'");
    $result = mysqli_fetch_assoc($check);

    if( $result['username'] ){
        echo "<script>alert(Username sudah terdaftar!);
                document.location.href = 'register.php'</script>";
        return false;
    }

    if($password !== $password2){
        echo "<script>alert('Password berbeda!');
                   document.location.href ='register.php'</script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    //query store db
    $q = mysqli_query($connection, "INSERT INTO users VALUES ('','$fullname','$username','$email','$password')");

    if($q){
        echo "<script>alert('Registrasi sukses!');
                document.location.href ='login.php'</script>";
    } else {
        echo "<script>alert('Registrasi gagal!');
                document.location.href ='register.php'</script>";
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
    <title>Document</title>
</head>
<body>
<div class="container">
    <main class="form-signin">
  <form method="post">
    <div class="form-floating">
      <input type="text" class="form-control" name="fullname" id="floatingInput" placeholder="Mirza Hafiz Muhammad" required>
      <label for="floatingInput">Full Name</label>
    </div>
    <div class="form-floating">
      <input type="text" class="form-control" name="username" id="floatingInput" placeholder="mirzahm" required>
      <label for="floatingInput">Username</label>
    </div>
    <div class="form-floating">
      <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com" required>
      <label for="floatingInput">Email</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password" required>
      <label for="floatingPassword">Password</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="password2" id="floatingPassword" placeholder="Password" required>
      <label for="floatingPassword"> Confirm Password</label>
    </div>

    <div class="checkbox mb-3">
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit" name="signup">Sign Up</button>
  </form>
  <a href="login.php">already have account</a>
</main>
    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
