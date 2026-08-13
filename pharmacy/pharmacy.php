<?php
include("../includes/session.php");
include("../config/database.php");
include("../includes/header.php");
include("../includes/sidebar.php");
include("../includes/auth.php");

$sql = "SELECT * FROM pharmacy ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
$highlight_id = isset($_GET['highlight']) ? (int)$_GET['highlight'] : 0;
?>

<div class="main-content">

<?php include("../includes/topbar.php"); ?>

<div class="header">
    <h1>Pharmacy Management</h1>
    <p>Manage medicines available in the hospital.</p>
</div>

<br>

<a href="add_medicine.php" class="btn btn-primary">
    Add Medicine
</a>

<br><br>

<table class="table table-bordered table-hover table-striped">

<tr>
    <th>ID</th>
    <th>Medicine</th>
    <th>Category</th>
    <th>Quantity</th>
    <th>Price (GH₵)</th>
    <th>Expiry</th>
    <th>Supplier</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr class="<?php echo ($row['id'] == $highlight_id) ? 'highlight-row' : ''; ?>">

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['medicine_name']; ?></td>

<td><?php echo $row['category']; ?></td>

<td><?php echo $row['quantity']; ?></td>

<td><?php echo number_format($row['unit_price'],2); ?></td>

<td><?php echo $row['expiry_date']; ?></td>

<td><?php echo $row['supplier']; ?></td>

<td>
<?php
if($row['quantity'] < 10){
    echo "<span style='color:red;font-weight:bold;'>Low Stock</span>";
}else{
    echo "<span style='color:green;'>Available</span>";
}
?>
</td>

<td>

<a href="edit_medicine.php?id=<?php echo $row['id']; ?>">
Edit
</a>

|

<a href="delete_medicine.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete this medicine?');">
Delete
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

<?php include("../includes/footer.php"); ?>