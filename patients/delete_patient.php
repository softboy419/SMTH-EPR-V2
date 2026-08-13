<?php
include("../config/database.php");

$id = $_GET['id'];

$sql = "DELETE FROM patients WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
    echo "<script>
    alert('Patient Deleted Successfully!');
    window.location='patients.php';
    </script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>