<?php
include("../includes/session.php");
include("../config/database.php");

$id = $_GET['id'];

$query = "SELECT * FROM laboratory WHERE id='$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $patient = $_POST['patient_id'];
    $test = $_POST['test_name'];
    $lab_result = $_POST['test_result'];
    $date = $_POST['test_date'];
    $status = $_POST['status'];

    $sql = "UPDATE laboratory
            SET patient_id='$patient',
                test_name='$test',
                test_result='$lab_result',
                test_date='$date',
                status='$status'
            WHERE id='$id'";

    mysqli_query($conn, $sql);

    echo "<script>
            alert('Laboratory Record Updated Successfully!');
            window.location='laboratory.php';
          </script>";
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit Laboratory Test</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>

<body>

<?php
include("../includes/sidebar.php");
include("../includes/topbar.php");
?>

<div class="main-content">

<div class="header">
<h1>Edit Laboratory Test</h1>
</div>

<form method="POST">

<label>Patient</label><br>

<select name="patient_id">

<?php

$patients = mysqli_query($conn,"SELECT * FROM patients");

while($patient=mysqli_fetch_assoc($patients)){

?>

<option value="<?php echo $patient['id']; ?>"
<?php if($patient['id']==$row['patient_id']) echo "selected"; ?>>

<?php echo $patient['full_name']; ?>

</option>

<?php } ?>

</select>

<br><br>

<label>Test Name</label><br>

<input
type="text"
name="test_name"
value="<?php echo $row['test_name']; ?>"
required>

<br><br>

<label>Test Result</label><br>

<textarea
name="test_result"><?php echo $row['test_result']; ?></textarea>

<br><br>

<label>Test Date</label><br>

<input
type="date"
name="test_date"
value="<?php echo $row['test_date']; ?>"
required>

<br><br>

<label>Status</label><br>

<select name="status">

<option <?php if($row['status']=="Pending") echo "selected"; ?>>Pending</option>

<option <?php if($row['status']=="Completed") echo "selected"; ?>>Completed</option>

</select>

<br><br>

<button
class="btn btn-success"
type="submit"
name="update">

Update Laboratory Test

</button>

</form>

</div>

<?php include("../includes/footer.php"); ?>

</body>

</html>