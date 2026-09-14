<?php

include("../config/database.php");

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id === false || $id === null) {
    die("Invalid doctor ID.");
}

$stmt = mysqli_prepare($conn, "DELETE FROM doctors WHERE id = ?");

if (!$stmt) {
    die("Database error.");
}

mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {

    echo "<script>
        alert('Doctor Deleted Successfully!');
        window.location='doctors.php';
    </script>";

} else {

    echo "Error deleting doctor.";

}

mysqli_stmt_close($stmt);
?>