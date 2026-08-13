<?php
include("../config/database.php");

$patients = mysqli_query($conn, "SELECT * FROM patients");
$doctors = mysqli_query($conn, "SELECT * FROM doctors");

if(isset($_POST['save'])){

    $patient = $_POST['patient_id'];
    $doctor = $_POST['doctor_id'];
    $date = $_POST['appointment_date'];
    $time = $_POST['appointment_time'];

    $sql = "INSERT INTO appointments(patient_id, doctor_id, appointment_date, appointment_time)
            VALUES('$patient','$doctor','$date','$time')";

    mysqli_query($conn,$sql);

    echo "<script>
    alert('Appointment Added Successfully!');
    window.location='appointments.php';
    </script>";
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Add Appointment</title>

<link rel="stylesheet" href="../assets/css/dashboard.css">

</head>

<body>

<div class="main-content">

<div class="header">

<h1>Add Appointment</h1>

</div>

<form method="POST">

<label>Patient</label><br>

<select name="patient_id">

<?php while($row=mysqli_fetch_assoc($patients)){ ?>

<option value="<?php echo $row['id']; ?>">

<?php echo $row['full_name']; ?>

</option>

<?php } ?>

</select>

<br><br>

<label>Doctor</label><br>

<select name="doctor_id">

<?php while($row=mysqli_fetch_assoc($doctors)){ ?>

<option value="<?php echo $row['id']; ?>">

<?php echo $row['full_name']; ?>

</option>

<?php } ?>

</select>

<br><br>

<label>Date</label><br>

<input type="date" name="appointment_date" required>

<br><br>

<label>Time</label><br>

<input type="time" name="appointment_time" required>

<br><br>

<button type="submit" name="save">

Save Appointment

</button>

</form>

</div>

</body>
</html>