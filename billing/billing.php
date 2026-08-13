<?php
include("../includes/session.php");
include("../config/database.php");
include("../includes/role_check.php");

checkRole(["Admin","Accountant"]);
$sql = "SELECT * FROM billing";
$result = mysqli_query($conn, $sql);
$sql= "SELECT billing.*, patients.full_name
        FROM billing
        INNER JOIN patients
        ON billing.patient_id = patients.id";
$result = mysqli_query($conn, $sql);
$highlight_id = isset($_GET['highlight']) ? (int)$_GET['highlight'] : 0;

include("../includes/header.php");
include("../includes/sidebar.php");
?>

<div class="main-content">
    <?
php include("../includes/topbar.php"); ?>
    <div class="header">
        <h1>Billing Management</h1>
        <p>Manage Billing Records</p>
    </div>

    <a href="add_billing.php" class="btn btn-primary">
        ➕ Add Billing Record  

    </a>

    <br><br>
    <table class="table">

        <tr>
            <th>ID</th>
            <th>Patient</th>
            <th>Amount (GH₵)</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php while($row=mysqli_fetch_assoc($result)){ ?>

        <tr class="<?php echo ($row['id'] == $highlight_id) ? 'highlight-row' : ''; ?>">

            <td><?php echo $row['id']; ?></td>

            <td><?php echo $row['full_name']; ?></td>

            <td><?php echo $row['service']; ?></td>

            <td><?php echo $row['amount']; ?></td>

            <td><?php echo $row['billing_date']; ?></td>

            <td><?php echo $row['payment_status']; ?></td>

            <td>

                <a class="btn btn-success"
                href="edit_billing.php?id=<?php echo $row['id']; ?>"
                ✏ Edit
                </a>

                <a class="btn btn-danger"
                href="delete_billing.php?id=<?php echo $row['id']; ?>"
                onclick="return confirm('Are you sure you want to delete this billing record?');">
                🗑 Delete
                </a>

            </td>

        </tr>

        <?php } ?>

    </table>


</div>

<a href="../billing/billing.php">
    <i class=bi bi-receipt"></i>
    Billing
</a>