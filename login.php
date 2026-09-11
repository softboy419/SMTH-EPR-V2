<?php
session_start();
include("config/database.php");

$message = "";

if(isset($_POST['login'])){

   $username = trim($_POST['username']);
$password = $_POST['password'];

// Find the user using a prepared statement
$sql = "SELECT * FROM users WHERE username = ?";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Login system temporarily unavailable.");
}

mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) === 1) {

    $user = mysqli_fetch_assoc($result);

    $password_valid = false;

    // Modern password_hash() verification
    if (password_verify($password, $user['password'])) {

        $password_valid = true;

    // Temporary support for old MD5 passwords
    } elseif (
        strlen($user['password']) === 32 &&
        hash_equals($user['password'], md5($password))
    ) {

        $password_valid = true;

        // Upgrade the old MD5 password to a secure hash
        $new_password_hash = password_hash($password, PASSWORD_DEFAULT);

        $update_sql = "UPDATE users SET password = ? WHERE id = ?";
        $update_stmt = mysqli_prepare($conn, $update_sql);

        if ($update_stmt) {

            mysqli_stmt_bind_param(
                $update_stmt,
                "si",
                $new_password_hash,
                $user['id']
            );

            mysqli_stmt_execute($update_stmt);
            mysqli_stmt_close($update_stmt);
        }
    }

    if ($password_valid) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['role'] = $user['role'];

        // Prevent session fixation
        session_regenerate_id(true);

        header("Location: dashboard.php");
        exit();

    } else {

        $message = "Invalid Username or Password";
    }

} else {

    $message = "Invalid Username or Password";
}

mysqli_stmt_close($stmt);
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