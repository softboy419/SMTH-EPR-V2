<?php
include("../config/database.php");

/*
 * Validate appointment ID
 */
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    die("Invalid appointment ID.");
}

/*
 * Load patients and doctors for the form
 */
$patients = mysqli_query($conn, "SELECT * FROM patients");
$doctors = mysqli_query($conn, "SELECT * FROM doctors");

/*
 * Get the appointment being edited
 */
$stmt = mysqli_prepare(
    $conn,
    "SELECT * FROM appointments WHERE id = ?"
);

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);

if (!$row) {
    die("Appointment not found.");
}

/*
 * Update appointment
 */
if (isset($_POST['update'])) {

    $patient = filter_input(
        INPUT_POST,
        'patient_id',
        FILTER_VALIDATE_INT
    );

    $doctor = filter_input(
        INPUT_POST,
        'doctor_id',
        FILTER_VALIDATE_INT
    );

    $date = $_POST['appointment_date'] ?? '';
    $time = $_POST['appointment_time'] ?? '';
    $status = $_POST['status'] ?? '';

    /*
     * Basic validation
     */
    if (!$patient || !$doctor || empty($date) || empty($time) || empty($status)) {

        die("Invalid appointment information.");

    }

    /*
     * Update using a prepared statement
     */
    $stmt = mysqli_prepare(
        $conn,
        "UPDATE appointments
         SET patient_id = ?,
             doctor_id = ?,
             appointment_date = ?,
             appointment_time = ?,
             status = ?
         WHERE id = ?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "iisssi",
        $patient,
        $doctor,
        $date,
        $time,
        $status,
        $id
    );

    if (mysqli_stmt_execute($stmt)) {

        echo "<script>
            alert('Appointment Updated Successfully!');
            window.location='appointments.php';
        </script>";

    } else {

        echo "Error updating appointment.";

    }

    mysqli_stmt_close($stmt);
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