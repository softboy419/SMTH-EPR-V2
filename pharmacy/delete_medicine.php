<?php

include("../config/database.php");
include("../includes/auth.php");

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id === false || $id === null || $id <= 0) {
    die("Invalid medicine ID.");
}

$stmt = mysqli_prepare($conn, "DELETE FROM pharmacy WHERE id = ?");

if (!$stmt) {
    die("Unable to process request.");
}

mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {

    echo "<script>
        alert('Medicine Deleted Successfully!');
        window.location='pharmacy.php';
    </script>";

} else {

    error_log("Medicine deletion failed: " . mysqli_stmt_error($stmt));
    echo "Unable to delete medicine.";
}

mysqli_stmt_close($stmt);
?>