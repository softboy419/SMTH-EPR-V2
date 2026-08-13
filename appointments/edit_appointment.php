<?php
include("../config/database.php");

$id = $_GET['id'];

$patients = mysqli_query($conn,"SELECT * FROM patients");
$doctors = mysqli_query($conn,"SELECT * FROM doctors");

$sql = "SELECT * FROM appointments WHERE id='$id'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $patient = $_POST['patient_id'];
    $doctor = $_POST['doctor_id'];
    $date = $_POST['appointment_date'];
    $time = $_POST['appointment_time'];
    $status = $_POST['status'];

    $update = "UPDATE appointments SET
               patient_id='$patient',
               doctor_id='$doctor',
               appointment_date='$date',
               appointment_time='$time',
               status='$status'
               WHERE id='$id'";

    if(mysqli_query($conn,$update)){
        echo "<script>
        alert('Appointment Updated Successfully!');
        window.location='appointments.php';
        </script>";
    }else{
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Appointment</title>
<link rel="stylesheet" href="../assets/css/dashboard.css">
</head>
<body>

<div class="main-content">

<h2>Edit Appointment</h2>

<form method="POST">

<label>Patient</label><br>
<select name="patient_id">
<?php while($p=mysqli_fetch_assoc($patients)){ ?>
<option value="<?php echo $p['id']; ?>"
<?php if($p['id']==$row['patient_id']) echo "selected"; ?>>
<?php echo $p['full_name']; ?>
</option>
<?php } ?>
</select>

<br><br>

<label>Doctor</label><br>
<select name="doctor_id">
<?php while($d=mysqli_fetch_assoc($doctors)){ ?>
<option value="<?php echo $d['id']; ?>"
<?php if($d['id']==$row['doctor_id']) echo "selected"; ?>>
<?php echo $d['full_name']; ?>
</option>
<?php } ?>
</select>

<br><br>

<label>Date</label><br>
<input type="date" name="appointment_date"
value="<?php echo $row['appointment_date']; ?>">

<br><br>

<label>Time</label><br>
<input type="time" name="appointment_time"
value="<?php echo $row['appointment_time']; ?>">

<br><br>

<label>Status</label><br>

<select name="status">

<option <?php if($row['status']=="Pending") echo "selected"; ?>>
Pending
</option>

<option <?php if($row['status']=="Completed") echo "selected"; ?>>
Completed
</option>

<option <?php if($row['status']=="Cancelled") echo "selected"; ?>>
Cancelled
</option>

</select>

<br><br>

<button type="submit" name="update">
Update Appointment
</button>

</form>

</div>

</body>
</html>