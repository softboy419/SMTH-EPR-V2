<?php
include("../config/database.php");
include("../includes/role_check.php");

checkRole(["Admin"]);
$result=mysqli_query($conn,"SELECT * FROM doctors");
$highlight_id = isset($_GET['highlight']) ? (int)$_GET['highlight'] : 0;
?>

<!DOCTYPE html>
<html>

<head>
<title>Doctors</title>

<link rel="stylesheet" href="../assets/css/dashboard.css">

</head>

<body>

<div class="sidebar">

<h2>🏥 SMTH</h2>

<a href="../dashboard.php">🏠 Dashboard</a>

<a href="doctors.php">👨‍⚕️ Doctors</a>

<a href="../login.php">🚪 Logout</a>

</div>

<div class="main-content">

<div class="header">

<h1>Doctor Management</h1>

<p>Manage Doctors</p>

</div>

<a href="add_doctor.php">
<a href="add_doctor.php" class="btn">+ Add New Doctor</a>
</a>

<br><br>

<table border="1" cellpadding="10">

<tr>

<th>ID</th>

<th>Name</th>

<th>Specialization</th>

<th>Phone</th>

<th>Email</th>

<th>Action</th>

</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr class="<?php echo ($row['id'] == $highlight_id) ? 'highlight-row' : ''; ?>">

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['full_name']; ?></td>

<td><?php echo $row['specialization']; ?></td>

<td><?php echo $row['phone']; ?></td>

<td><?php echo $row['email']; ?></td>

<td>
<a href="edit_doctor.php?id=<?php echo $row['id']; ?>" class="edit-btn">
    <i class="fas fa-edit"></i> Edit
</a>

<a href="delete_doctor.php?id=<?php echo $row['id']; ?>"
class="delete-btn"
onclick="return confirm('Are you sure you want to delete this doctor?');">
    <i class="fas fa-trash"></i> Delete
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>

</html>