<?php
session_start();
include("config/database.php");

$message = "";

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";


    $result = mysqli_query($conn, $sql);

if (!$result) {
    die(mysqli_error($conn));
}



    if(mysqli_num_rows($result) == 1){

    $user = mysqli_fetch_assoc($result);


    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['full_name'] = $user['full_name'];
    $_SESSION['role'] = $user['role'];

    header("Location: dashboard.php");
    exit();

}

    }else{

        $message = "Invalid Username or Password";

    }

?>

<!DOCTYPE html>
<html>

<head>

<title>SMTH EPR Login</title>

<link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<div class="login-box">

<h1>Save Me Teaching Hospital</h1>

<h3>Electronic Patient Record System</h3>

<p style="color:red;"><?php echo $message; ?></p>

<form method="POST">

<input type="text" name="username" placeholder="Username" required>

<input type="password" name="password" placeholder="Password" required>

<button type="submit" name="login">Login</button>

</form>

</div>

</body>

</html>