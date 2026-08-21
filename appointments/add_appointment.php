<?php

session_start();

include("../config/database.php");

$patients = mysqli_query($conn, "SELECT * FROM patients");

$role = $_SESSION['role'] ?? '';
$userFullName = $_SESSION['full_name'] ?? '';

$doctor = null;

/*
|--------------------------------------------------------------------------
| If logged-in user is a Doctor
|--------------------------------------------------------------------------
| Find that Doctor's record using the user's full name.
*/

if ($role === 'Doctor') {

    $doctorQuery = mysqli_query(
        $conn,
        "SELECT * FROM doctors WHERE full_name = '$userFullName' LIMIT 1"
    );

    if ($doctorQuery && mysqli_num_rows($doctorQuery) === 1) {

        $doctor = mysqli_fetch_assoc($doctorQuery);

    } else {

        die("
            <h2 style='color:red;text-align:center;margin-top:50px;'>
                Doctor profile not found.
            </h2>
            <p style='text-align:center;'>
                Your user account is not linked to a Doctor record.
            </p>
        ");
    }
}


/*
|--------------------------------------------------------------------------
| Save Appointment
|--------------------------------------------------------------------------
*/

if (isset($_POST['save'])) {

    $patient = $_POST['patient_id'];
    $date = $_POST['appointment_date'];
    $time = $_POST['appointment_time'];

    /*
    | Admin chooses the doctor.
    | Doctor automatically uses their own doctor ID.
    */

    if ($role === 'Doctor') {

        $doctorId = $doctor['id'];

    } else {

        $doctorId = $_POST['doctor_id'];

    }


    $sql = "INSERT INTO appointments
            (patient_id, doctor_id, appointment_date, appointment_time)
            VALUES
            ('$patient', '$doctorId', '$date', '$time')";


    if (mysqli_query($conn, $sql)) {

        echo "<script>
            alert('Appointment Added Successfully!');
            window.location='appointments.php';
        </script>";

    } else {

        echo "Error: " . mysqli_error($conn);

    }
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

<?php if ($role === 'Doctor'): ?>

    <input 
        type="text" 
        value="<?php echo htmlspecialchars($doctor['full_name']); ?>" 
        readonly
    >

    <input 
        type="hidden" 
        name="doctor_id" 
        value="<?php echo $doctor['id']; ?>"
    >

<?php else: ?>

    <select name="doctor_id" required>

        <?php

        $doctors = mysqli_query($conn, "SELECT * FROM doctors");

        while ($row = mysqli_fetch_assoc($doctors)) {

        ?>

            <option value="<?php echo $row['id']; ?>">
                <?php echo htmlspecialchars($row['full_name']); ?>
            </option>

        <?php } ?>

    </select>

<?php endif; ?>

<br><br>


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