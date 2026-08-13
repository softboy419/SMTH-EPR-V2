<?php

include("../config/database.php");

if(isset($_POST['save'])){

    $medicine_name = $_POST['medicine_name'];
    $category      = $_POST['category'];
    $quantity      = $_POST['quantity'];
    $unit_price    = $_POST['unit_price'];
    $expiry_date   = $_POST['expiry_date'];
    $supplier      = $_POST['supplier'];

    $sql = "INSERT INTO pharmacy
    (medicine_name, category, quantity, unit_price, expiry_date, supplier)
    VALUES
    ('$medicine_name','$category','$quantity','$unit_price','$expiry_date','$supplier')";

    mysqli_query($conn, $sql);

    header("Location: pharmacy.php");
    exit();
}