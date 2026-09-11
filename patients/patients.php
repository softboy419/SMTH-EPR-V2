<?php
include("../includes/session.php");
include("../config/database.php");
include("../includes/header.php");
include("../includes/sidebar.php");
include("../includes/auth.php");


$sql = "SELECT * FROM patients";
$result = mysqli_query($conn, $sql);

$highlight_id = isset($_GET['highlight']) ? intval($_GET['highlight']) : 0;

?>

<div class="main-content">

    <?php include("../includes/topbar.php"); ?>

    <div class="header">
        <h1>Patient Management</h1>
        <p>Manage all patients in the hospital</p>
    </div>

    <br>

    <a href="add_patients.php" class="btn btn-primary">
        Add New Patient
    </a>

    <br><br>

    <div class="table-responsive">

<table class="table table-bordered table-hover table-striped">
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Gender</th>
            <th>Age</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Action</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)){ ?>

        <tr id="patient-<?php echo $row['id']; ?>"
    class="<?php echo ($row['id'] == $highlight_id) ? 'highlight-row' : ''; ?>">
            <td><?php echo $row['id']; ?></td>

            <td><?php echo $row['full_name']; ?></td>

            <td><?php echo $row['gender']; ?></td>

            <td><?php echo $row['age']; ?></td>

            <td><?php echo $row['phone']; ?></td>

            <td><?php echo $row['address']; ?></td>

            <td>

                <a href="edit_patient.php?id=<?php echo $row['id']; ?>">Edit</a> |

                <a href="delete_patients.php?id=<?php echo $row['id']; ?>"
                onclick="return confirm('Delete this patient?');">
                Delete
                </a>

            </td>

        </tr>

        <?php } ?>

    </table>

</div>

<?php
include("../includes/footer.php");
?>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const highlighted = document.querySelector(".highlight-row");

    if (highlighted) {

        highlighted.scrollIntoView({
            behavior: "smooth",
            block: "center"
        });

    }

});
</script>