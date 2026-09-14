<?php
include("../includes/session.php");
include("../config/database.php");
include("../includes/header.php");
include("../includes/sidebar.php");
include("../includes/auth.php");

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id === false || $id === null || $id <= 0) {
    die("Invalid medicine ID.");
}

$stmt = mysqli_prepare($conn, "SELECT * FROM pharmacy WHERE id = ?");

if (!$stmt) {
    die("Unable to process request.");
}

mysqli_stmt_bind_param($stmt, "i", $id);

if (!mysqli_stmt_execute($stmt)) {
    die("Unable to retrieve medicine.");
}

$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    die("Medicine not found.");
}

mysqli_stmt_close($stmt);
?>

<div class="main-content">

<?php include("../includes/topbar.php"); ?>

<div class="header">
    <h1>Edit Medicine</h1>
    <p>Update medicine information.</p>
</div>

<br>

<form action="update_medicine.php" method="POST">

<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<div class="form-group">
    <label>Medicine Name</label>
    <input type="text" class="form-control"
           name="medicine_name"
           value="<?php echo $row['medicine_name']; ?>" required>
</div>

<br>

<div class="form-group">
    <label>Category</label>
    <input type="text" class="form-control"
           name="category"
           value="<?php echo $row['category']; ?>" required>
</div>

<br>

<div class="form-group">
    <label>Quantity</label>
    <input type="number" class="form-control"
           name="quantity"
           value="<?php echo $row['quantity']; ?>" required>
</div>

<br>

<div class="form-group">
    <label>Unit Price</label>
    <input type="number" step="0.01"
           class="form-control"
           name="unit_price"
           value="<?php echo $row['unit_price']; ?>" required>
</div>

<br>

<div class="form-group">
    <label>Expiry Date</label>
    <input type="date"
           class="form-control"
           name="expiry_date"
           value="<?php echo $row['expiry_date']; ?>" required>
</div>

<br>

<div class="form-group">
    <label>Supplier</label>
    <input type="text"
           class="form-control"
           name="supplier"
           value="<?php echo $row['supplier']; ?>">
</div>

<br>

<button type="submit" name="update" class="btn btn-success">
Update Medicine
</button>

<a href="pharmacy.php" class="btn btn-secondary">
Cancel
</a>

</form>

</div>

<?php include("../includes/footer.php"); ?>