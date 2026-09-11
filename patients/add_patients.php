<?php
include("../includes/session.php");
include("../config/database.php");
include("../includes/auth.php");

if (isset($_POST['save'])) {

    $name = trim($_POST['full_name']);
    $gender = trim($_POST['gender']);
    $age = (int) $_POST['age'];
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);

    // Prepared statement prevents SQL injection
    $sql = "INSERT INTO patients (full_name, gender, age, phone, address)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {

        mysqli_stmt_bind_param(
            $stmt,
            "ssiss",
            $name,
            $gender,
            $age,
            $phone,
            $address
        );

        if (mysqli_stmt_execute($stmt)) {

            echo "<script>
                    alert('Patient Added Successfully!');
                    window.location='patients.php';
                  </script>";

        } else {

            echo "Unable to add patient.";
        }

        mysqli_stmt_close($stmt);

    } else {

        echo "Unable to process request.";
    }
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