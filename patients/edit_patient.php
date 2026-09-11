<?php
include("../includes/session.php");
include("../config/database.php");
include("../includes/auth.php");

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    die("Invalid patient ID.");
}

// Fetch patient using a prepared statement
$sql = "SELECT * FROM patients WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Unable to load patient.");
}

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (!$result || mysqli_num_rows($result) !== 1) {
    mysqli_stmt_close($stmt);
    die("Patient not found.");
}

$row = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);


// Handle patient update
if (isset($_POST['update'])) {

    $name = trim($_POST['full_name']);
    $gender = trim($_POST['gender']);
    $age = (int) $_POST['age'];
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);

    $update_sql = "UPDATE patients
                   SET full_name = ?,
                       gender = ?,
                       age = ?,
                       phone = ?,
                       address = ?
                   WHERE id = ?";

    $update_stmt = mysqli_prepare($conn, $update_sql);

    if ($update_stmt) {

        mysqli_stmt_bind_param(
            $update_stmt,
            "ssissi",
            $name,
            $gender,
            $age,
            $phone,
            $address,
            $id
        );

        if (mysqli_stmt_execute($update_stmt)) {

            echo "<script>
                    alert('Patient Updated Successfully!');
                    window.location='patients.php';
                  </script>";

        } else {

            echo "Unable to update patient.";
        }

        mysqli_stmt_close($update_stmt);

    } else {

        echo "Unable to process update request.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Patient</title>
</head>

<body>

<h2>Edit Patient</h2>

<form method="POST">

<label>Full Name</label><br>
<input type="text" name="full_name" value="<?php echo $row['full_name']; ?>" required><br><br>

<label>Gender</label><br>
<select name="gender">
    <option <?php if($row['gender']=="Male") echo "selected"; ?>>Male</option>
    <option <?php if($row['gender']=="Female") echo "selected"; ?>>Female</option>
</select><br><br>

<label>Age</label><br>
<input type="number" name="age" value="<?php echo $row['age']; ?>" required><br><br>

<label>Phone</label><br>
<input type="text" name="phone" value="<?php echo $row['phone']; ?>"><br><br>

<label>Address</label><br>
<textarea name="address"><?php echo $row['address']; ?></textarea><br><br>

<button type="submit" name="update">Update Patient</button>

</form>

</body>
</html>