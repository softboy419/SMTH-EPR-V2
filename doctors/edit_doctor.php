<?php

include("../config/database.php");

if (!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    die("Invalid doctor ID.");
}

$id = (int) $_GET['id'];

/* Get doctor information */
$stmt = mysqli_prepare(
    $conn,
    "SELECT * FROM doctors WHERE id = ?"
);

if (!$stmt) {
    die("Doctor information unavailable.");
}

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);

if (!$row) {
    die("Doctor not found.");
}


/* Update doctor */
if (isset($_POST['update'])) {

    $name = trim($_POST['full_name']);
    $specialization = trim($_POST['specialization']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);

    $stmt = mysqli_prepare(
        $conn,
        "UPDATE doctors
         SET full_name = ?,
             specialization = ?,
             phone = ?,
             email = ?
         WHERE id = ?"
    );

    if (!$stmt) {
        die("Doctor update unavailable.");
    }

    mysqli_stmt_bind_param(
        $stmt,
        "ssssi",
        $name,
        $specialization,
        $phone,
        $email,
        $id
    );

    if (mysqli_stmt_execute($stmt)) {

        mysqli_stmt_close($stmt);

        echo "<script>
                alert('Doctor Updated Successfully!');
                window.location='doctors.php';
              </script>";

        exit;

    } else {
        echo "Error: Doctor update failed.";
    }

    mysqli_stmt_close($stmt);
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Doctor</title>
<link rel="stylesheet" href="../assets/css/dashboard.css">
</head>

<body>

<div class="main-content">

<h2>Edit Doctor</h2>

<form method="POST">

<label>Full Name</label><br>
<input type="text" name="full_name"
value="<?php echo $row['full_name']; ?>" required><br><br>

<label>Specialization</label><br>
<input type="text" name="specialization"
value="<?php echo $row['specialization']; ?>" required><br><br>

<label>Phone</label><br>
<input type="text" name="phone"
value="<?php echo $row['phone']; ?>"><br><br>

<label>Email</label><br>
<input type="email" name="email"
value="<?php echo $row['email']; ?>"><br><br>

<button type="submit" name="update">
Update Doctor
</button>

</form>

</div>

</body>
</html>