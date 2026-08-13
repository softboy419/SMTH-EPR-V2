<?php

include("../config/database.php");

if(isset($_POST['update'])){

    $id = $_POST['id'];
    $medicine_name = $_POST['medicine_name'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
    $unit_price = $_POST['unit_price'];
    $expiry_date = $_POST['expiry_date'];
    $supplier = $_POST['supplier'];

    $sql = "UPDATE pharmacy SET
        medicine_name='$medicine_name',
        category='$category',
        quantity='$quantity',
        unit_price='$unit_price',
        expiry_date='$expiry_date',
        supplier='$supplier'
        WHERE id='$id'";

    mysqli_query($conn, $sql);

    header("Location: pharmacy.php");
    exit();
}