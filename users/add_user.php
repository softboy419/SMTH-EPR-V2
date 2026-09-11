<?php
include("../includes/session.php");
include("../config/database.php");
include("../includes/header.php");
include("../includes/sidebar.php");
include("../includes/auth.php");

if(isset($_POST['save'])){

    $full_name = trim($_POST['full_name']);
$username = trim($_POST['username']);
$password = $_POST['password'];
$email = trim($_POST['email']);
$role = $_POST['role'];

// Securely hash the password
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Use a prepared statement
$sql = "INSERT INTO users (full_name, username, password, email, role)
        VALUES (?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {

    mysqli_stmt_bind_param(
        $stmt,
        "sssss",
        $full_name,
        $username,
        $password_hash,
        $email,
        $role
    );

    if (mysqli_stmt_execute($stmt)) {

        echo "<script>
                alert('User added successfully');
                window.location='users.php';
              </script>";

    } else {

        echo "Error: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);

} else {

    echo "Error preparing statement: " . mysqli_error($conn);
}
}
?>
<div class="main-content">

<?php include("../includes/topbar.php"); ?>

<div class="header">
    <h2>Add New User</h2>
</div>

<form method="POST">

<label>Full Name</label>
<input type="text" name="full_name" class="form-control" required><br>

<label>Username</label>
<input type="text" name="username" class="form-control" required><br>

<label>Password</label>
<input type="password" name="password" class="form-control" required><br>

<label>Email</label>
<input type="email" name="email" class="form-control" required><br>

<label>Role</label>

<select name="role" class="form-control">

<option value="Admin">Admin</option>
<option value="Doctor">Doctor</option>
<option value="Nurse">Nurse</option>
<option value="Receptionist">Receptionist</option>
<option value="Pharmacist">Pharmacist</option>
<option value="Laboratory">Laboratory</option>

</select>

<br>

<button class="btn btn-primary" name="save">
Save User
</button>

</form>

</div>