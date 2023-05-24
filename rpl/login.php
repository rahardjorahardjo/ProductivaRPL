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


<!-- <!DOCTYPE html>
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
</html> -->
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
                          <label for="input2" class="form-label" style="color: #FFF4E0">username</label>
                          <input type="text" class="form-control" name="username" style="background-color: #FFBF9B;" id="floatingInput"  placeholder="Your Username">
                        </div>
                      <div class="mb-5">
                          <label for="" class="form-label" style="color: #FFF4E0">password</label>
                          <input type="password" name="password" class="form-control" style="background-color: #FFBF9B;" id="floatingPassword" placeholder="Enter Password">
                      </div>
                      <div class="text-center">
                          <button class="btn" id="signin" type="submit" name="signin">Login </button>
                      </div>
                  </form>
                  <a href="register.php">dont have any account?</a>
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
