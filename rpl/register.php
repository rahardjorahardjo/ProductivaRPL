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
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Login Form</title>
  </head>

  <style>
    .creamcolor {
        background-color: #FFF4E0;
    }

    .card {
        background-color: #B46060;
    }

    .form {
        font-family: 'Gill Sans MT';
    }

    .btn{
        font-family: 'Gill Sans MT';
        font-size: 18px;
        font-weight: regular;
        background: #4D4D4D;
        width: 200px;
        padding: 10px;
        text-align: center;
        text-decoration: none;
        text-transform: uppercase;
        color: #FFBF9B;
        border-radius: 50px;
        cursor: pointer;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        -webkit-transition-duration: 0.3s;
        transition-duration: 0.3s;
        -webkit-transition-property: box-shadow, transform;
        transition-property: box-shadow, transform;
    }

    .btn:hover, .btn:focus, .btn:active {
        box-shadow: 0 0 20px rgba(0,0,0,0.5);
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }

</style>

  <body>
    <section>
      <main class = "form-signin">
        <div class="container-fluid creamcolor">
          <div class="row align-items-center" style="height: 100vh;">
            <div class="col-12 col-sm-5 col-md-4 m-auto">
              <div class="card border-0 shadow">
                <div class="card-body">
                  
                  <form method="post">
                      <div class="mb-1">
                          <label for="input2" class="form-label" style="color: #FFF4E0">Full Name</label>
                          <input type="text" class="form-control" name="fullname" style="background-color: #FFBF9B;" id="floatingInput"  placeholder="Your full name" required>
                      </div>
                      <div class="mb-1">
                          <label for="input2" class="form-label" style="color: #FFF4E0">Username</label>
                          <input type="text" class="form-control" name="username" style="background-color: #FFBF9B;" id="floatingInput"  placeholder="Your Username" required>
                      </div>
                      <div class="mb-1">
                          <label for="input2" class="form-label" style="color: #FFF4E0">Email</label>
                          <input type="email" class="form-control" name="email" style="background-color: #FFBF9B;" id="floatingInput"  placeholder="name@example.com" required>
                      </div>
                      <div class="mb-5">
                          <label for="" class="form-label" style="color: #FFF4E0">Password</label>
                          <input type="password" name="password" class="form-control" style="background-color: #FFBF9B;" id="floatingPassword" placeholder="Enter Password" required>
                      </div>
                      <div class="mb-5">
                          <label for="" class="form-label" style="color: #FFF4E0">Confirm Password</label>
                          <input type="password" name="password2" class="form-control" style="background-color: #FFBF9B;" id="floatingPassword" placeholder="Enter Password"required>
                      </div>
                      <div class="text-center">
                          <button class="btn" id="signin" type="submit" name="signup">Register</button>
                      </div>
                  </form>
                  <a href="login.php">Already have an account?</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
  </body>
</html>