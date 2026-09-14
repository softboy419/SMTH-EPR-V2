<?php

include("../config/database.php");

if (!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    die("Invalid patient ID.");
}

$id = (int) $_GET['id'];

$stmt = mysqli_prepare($conn, "DELETE FROM patients WHERE id = ?");

if (!$stmt) {
    die("Delete operation unavailable.");
}

mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    echo "<script>
            alert('Patient Deleted Successfully!');
            window.location='patients.php';
          </script>";
} else {
    echo "Error: Delete operation failed.";
}

mysqli_stmt_close($stmt);