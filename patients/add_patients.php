<?php
include("../config/database.php");

if(isset($_POST['save'])){

    $name = $_POST['full_name'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $sql = "INSERT INTO patients(full_name, gender, age, phone, address)
            VALUES('$name','$gender','$age','$phone','$address')";

    mysqli_query($conn,$sql);

    echo "<script>alert('Patient Added Successfully!');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Patient</title>
</head>

<body>

<h2>Add New Patient</h2>

<form method="POST">

<label>Full Name</label><br>
<input type="text" name="full_name" required><br><br>

<label>Gender</label><br>
<select name="gender">
    <option>Male</option>
    <option>Female</option>
</select><br><br>

<label>Age</label><br>
<input type="number" name="age" required><br><br>

<label>Phone</label><br>
<input type="text" name="phone"><br><br>

<label>Address</label><br>
<textarea name="address"></textarea><br><br>

<button type="submit" name="save">Save Patient</button>

</form>

</body>
</html>