<?php
include("../includes/session.php");
include("../config/database.php");
include("../includes/header.php");
include("../includes/sidebar.php");
include("../includes/auth.php");

$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
$highlight_id = isset($_GET['highlight']) ? (int)$_GET['highlight'] : 0;
?>

<div class="main-content">

<?php include("../includes/topbar.php"); ?>

<div class="header">
    <h1>User Management</h1>
    <p>Manage hospital users</p>
</div>

<br>

<a href="add_user.php" class="btn btn-primary">
    Add New User
</a>

<br><br>

<div class="table-responsive">

<table class="table table-bordered table-hover table-striped">

<tr>
    <th>ID</th>
    <th>Full Name</th>
    <th>Username</th>
    <th>Email</th>
    <th>Role</th>
    <th>Status</th>
    <th>Action</th>
</tr>
<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr class="<?php echo ($row['id'] == $highlight_id) ? 'highlight-row' : ''; ?>">

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['full_name']; ?></td>

<td><?php echo $row['username']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['role']; ?></td>

<td><?php echo $row['status']; ?></td>

<td>

<a href="edit_user.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Edit</a>

<a href="delete_user.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete this user?');"
class="btn btn-danger btn-sm">Delete</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

<?php include("../includes/footer.php"); ?>