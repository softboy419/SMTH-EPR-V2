<?php
include("../config/database.php");
include("../includes/auth.php");
$sql = "SELECT appointments.id,
               patients.full_name AS patient_name,
               doctors.full_name AS doctor_name,
               appointments.appointment_date,
               appointments.appointment_time,
               appointments.status
        FROM appointments
        JOIN patients ON appointments.patient_id = patients.id
        JOIN doctors ON appointments.doctor_id = doctors.id";

$result = mysqli_query($conn, $sql);
$highlight_id = isset($_GET['highlight']) ? (int)$_GET['highlight'] : 0;
?>

<!DOCTYPE html>
<html>

<head>

<title>Appointments</title>

<link rel="stylesheet" href="../assets/css/dashboard.css">

</head>

<body>

<div class="sidebar">

<h2>🏥 SMTH</h2>

<a href="../dashboard.php">🏠 Dashboard</a>
<a href="../patients/patients.php">🧑 Patients</a>
<a href="../doctors/doctors.php">👨‍⚕️ Doctors</a>
<a href="appointments.php">📅 Appointments</a>
<a href="../login.php">🚪 Logout</a>

</div>

<div class="main-content">

<div class="header">

<h1>Appointment Management</h1>

<p>Manage Hospital Appointments</p>

</div>

<a href="add_appointment.php">
<button>Add New Appointment</button>
</a>

<br><br>

<table border="1" cellpadding="10" cellspacing="0">

<tr>

<th>ID</th>
<th>Patient</th>
<th>Doctor</th>
<th>Date</th>
<th>Time</th>
<th>Status</th>
<th>Action</th>

</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr class="<?php echo ($row['id'] == $highlight_id) ? 'highlight-row' : ''; ?>">

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['patient_name']; ?></td>

<td><?php echo $row['doctor_name']; ?></td>

<td><?php echo $row['appointment_date']; ?></td>

<td><?php echo $row['appointment_time']; ?></td>

<td><?php echo $row['status']; ?></td>

<td>

<a href="edit_appointment.php?id=<?php echo $row['id']; ?>">Edit</a>

|

<a href="delete_appointment.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Are you sure you want to delete this appointment?');">
Delete
</a>
</td>

</tr>

<?php } ?>

</table>

</div>

</body>

</html>