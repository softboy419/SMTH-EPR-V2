<?php
include("../config/database.php");

if(isset($_POST['save'])){

    $name = $_POST['full_name'];
    $specialization = $_POST['specialization'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $sql = "INSERT INTO doctors(full_name, specialization, phone, email)
            VALUES('$name','$specialization','$phone','$email')";

    mysqli_query($conn,$sql);

    echo "<script>
            alert('Doctor Added Successfully!');
            window.location='doctors.php';
          </script>";
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