<?php
include("../includes/session.php");
include("../config/database.php");
include("../includes/role_check.php");

checkRole(["Admin","Laboratory"]);
$sql = "SELECT laboratory.*, patients.full_name
        FROM laboratory
        INNER JOIN patients
        ON laboratory.patient_id = patients.id";

$result = mysqli_query($conn, $sql);
$highlight_id = isset($_GET['highlight']) ? (int)$_GET['highlight'] : 0;

include("../includes/header.php");
include("../includes/sidebar.php");
include("../includes/topbar.php");
?>
<div class="main-content">

<div class="header">
    <h1>Laboratory Management</h1>
    <p>Manage Laboratory Tests</p>
</div>

<a href="add_lab.php" class="btn btn-primary">
    ➕ Add Laboratory Test
</a>

<br><br>
<table class="table">
    <tr>
        <th>ID</th>
        <th>Patient</th>
        <th>Test Name</th>
        <th>Result</th>
        <th>Date</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr class="<?php echo ($row['id'] == $highlight_id) ? 'highlight-row' : ''; ?>">

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['full_name']; ?></td>

<td><?php echo $row['test_name']; ?></td>

<td><?php echo $row['test_result']; ?></td>

<td><?php echo $row['test_date']; ?></td>

<td><?php echo $row['status']; ?></td>

<td>

<a class="btn btn-success"
href="edit_lab.php?id=<?php echo $row['id']; ?>">
✏ Edit
</a>

<a class="btn btn-danger"
href="delete_lab.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete this laboratory record?');">
🗑 Delete
</a>

</td>

</tr>

<?php } ?>

</table>

</div>
<?php include("../includes/footer.php"); ?>