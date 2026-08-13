<?php
include("../includes/session.php");
include("../config/database.php");
include("../includes/header.php");
include("../includes/sidebar.php");
include("../includes/auth.php");
?>

<div class="main-content">

<?php include("../includes/topbar.php"); ?>

<div class="header">
    <h1>Add New Medicine</h1>
    <p>Enter medicine details below.</p>
</div>

<br>

<form action="save_medicine.php" method="POST">

<div class="form-group">
    <label>Medicine Name</label>
    <input type="text" name="medicine_name" class="form-control" required>
</div>

<br>

<div class="form-group">
    <label>Category</label>
    <input type="text" name="category" class="form-control" required>
</div>

<br>

<div class="form-group">
    <label>Quantity</label>
    <input type="number" name="quantity" class="form-control" required>
</div>

<br>

<div class="form-group">
    <label>Unit Price (GH₵)</label>
    <input type="number" step="0.01" name="unit_price" class="form-control" required>
</div>

<br>

<div class="form-group">
    <label>Expiry Date</label>
    <input type="date" name="expiry_date" class="form-control" required>
</div>

<br>

<div class="form-group">
    <label>Supplier</label>
    <input type="text" name="supplier" class="form-control">
</div>

<br>

<button type="submit" name="save" class="btn btn-success">
    Save Medicine
</button>

<a href="pharmacy.php" class="btn btn-secondary">
    Cancel
</a>

</form>

</div>

<?php include("../includes/footer.php"); ?>