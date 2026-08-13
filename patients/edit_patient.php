<?php
include("../config/database.php");

$id = $_GET['id'];

$sql = "SELECT * FROM patients WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $name = $_POST['full_name'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $update = "UPDATE patients
               SET full_name='$name',
                   gender='$gender',
                   age='$age',
                   phone='$phone',
                   address='$address'
               WHERE id='$id'";

    mysqli_query($conn, $update);

    echo "<script>
    alert('Patient Updated Successfully!');
    window.location='patients.php';
    </script>";
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