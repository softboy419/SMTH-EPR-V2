<?php

include("../config/database.php");
include("../includes/auth.php");

if (isset($_POST['save'])) {

    $medicine_name = trim($_POST['medicine_name']);
    $category = trim($_POST['category']);
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
    $unit_price = filter_input(INPUT_POST, 'unit_price', FILTER_VALIDATE_FLOAT);
    $expiry_date = $_POST['expiry_date'];
    $supplier = trim($_POST['supplier']);

    if ($quantity === false || $quantity < 0) {
        die("Invalid quantity.");
    }

    if ($unit_price === false || $unit_price < 0) {
        die("Invalid unit price.");
    }

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO pharmacy
        (medicine_name, category, quantity, unit_price, expiry_date, supplier)
        VALUES (?, ?, ?, ?, ?, ?)"
    );

    if (!$stmt) {
        die("Unable to process request.");
    }

    mysqli_stmt_bind_param(
        $stmt,
        "ssidss",
        $medicine_name,
        $category,
        $quantity,
        $unit_price,
        $expiry_date,
        $supplier
    );

    if (mysqli_stmt_execute($stmt)) {

        echo "<script>
            alert('Medicine Added Successfully!');
            window.location='pharmacy.php';
        </script>";

    } else {

        error_log("Medicine insertion failed: " . mysqli_stmt_error($stmt));
        echo "Unable to add medicine.";
    }

    mysqli_stmt_close($stmt);
}
?>