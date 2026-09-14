<?php

include("../config/database.php");

if (isset($_POST['save'])) {

    $name = trim($_POST['full_name']);
    $specialization = trim($_POST['specialization']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO doctors (full_name, specialization, phone, email)
         VALUES (?, ?, ?, ?)"
    );

    if (!$stmt) {
        die("Doctor registration unavailable.");
    }

    mysqli_stmt_bind_param(
        $stmt,
        "ssss",
        $name,
        $specialization,
        $phone,
        $email
    );

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
                alert('Doctor Added Successfully!');
                window.location='doctors.php';
              </script>";
    } else {
        echo "Error: Doctor could not be added.";
    }

    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Doctor</title>
<link rel="stylesheet" href="../assets/css/dashboard.css">
</head>

<body>

<div class="main-content">

<div class="header">
<h1>Add New Doctor</h1>
<p>Fill in doctor's details</p>
</div>

<form method="POST">

<label>Full Name</label><br>
<input type="text" name="full_name" required><br><br>

<label>Specialization</label><br>
<input type="text" name="specialization" required><br><br>

<label>Phone</label><br>
<input type="text" name="phone"><br><br>

<label>Email</label><br>
<input type="email" name="email"><br><br>

<button type="submit" name="save">Save Doctor</button>

</form>

</div>

</body>
</html>