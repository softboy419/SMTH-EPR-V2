<?php

include("../config/database.php");

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $sql = "DELETE FROM pharmacy WHERE id='$id'";

    mysqli_query($conn,$sql);

    header("Location: pharmacy.php");
    exit();
}