
<?php
    $server = "localhost";
    $user = "root";
    $password ="";
    $database = "rpl";

    $connection = mysqli_connect($server,$user,$password,$database) or die(mysqli_error($koneksi));
?>