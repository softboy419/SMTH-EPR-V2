<?php
include("../includes/session.php");
include("../config/database.php");

if(isset($_POST['save'])){

    $patient = $_POST['patient_id'];
    $test = $_POST['test_name'];
    $result = $_POST['test_result'];
    $date = $_POST['test_date'];
    $status = $_POST['status'];

    $sql = "INSERT INTO laboratory(patient_id,test_name,test_result,test_date,status)
            VALUES('$patient','$test','$result','$date','$status')";

    mysqli_query($conn,$sql);

    echo "<script>
            alert('Laboratory Test Added Successfully!');
            window.location='laboratory.php';
          </script>";
}
?>
<!DOCTYPE html>
<html>
<head>

<title>Add Laboratory Test</title>

<link rel="stylesheet" href="../assets/css/dashboard.css">

</head>

<body>

<?php
include("../includes/sidebar.php");
include("../includes/topbar.php");
?>

<div class="main-content">

<div class="header">
<h1>Add Laboratory Test</h1>
<p>Create a new laboratory record</p>
</div>

<form method="POST">
    <label>Patient</label><br>

<select name="patient_id" required>

<option value="">Select Patient</option>

<?php

$query="SELECT * FROM patients";

$patients=mysqli_query($conn,$query);

while($row=mysqli_fetch_assoc($patients)){

?>

<option value="<?php echo $row['id']; ?>">

<?php echo $row['full_name']; ?>

</option>

<?php } ?>

</select>

<br><br>
<label>Test Name</label><br>

<input type="text"
name="test_name"
required>

<br><br>
<label>Test Result</label><br>

<textarea
name="test_result"
rows="4">
</textarea>

<br><br>
<label>Test Date</label><br>

<input
type="date"
name="test_date"
required>

<br><br>
<label>Status</label><br>

<select name="status">

<option>Pending</option>

<option>Completed</option>

</select>

<br><br>
<button
class="btn btn-primary"
type="submit"
name="save">

Save Laboratory Test

</button>

</form>

</div>

<?php include("../includes/footer.php"); ?>

</body>

</html>