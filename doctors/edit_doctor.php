<?php
include("../config/database.php");

$id = $_GET['id'];

$sql = "SELECT * FROM doctors WHERE id='$id'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $name = $_POST['full_name'];
    $specialization = $_POST['specialization'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $update = "UPDATE doctors SET
               full_name='$name',
               specialization='$specialization',
               phone='$phone',
               email='$email'
               WHERE id='$id'";

    if(mysqli_query($conn,$update)){
        echo "<script>
        alert('Doctor Updated Successfully!');
        window.location='doctors.php';
        </script>";
    }else{
        echo mysqli_error($conn);
    }
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