<?php
include("../config/database.php");

$id = $_GET['id'];

$sql = "DELETE FROM doctors WHERE id='$id'";

if(mysqli_query($conn,$sql)){
    echo "<script>
    alert('Doctor Deleted Successfully!');
    window.location='doctors.php';
    </script>";
}else{
    echo mysqli_error($conn);
}
?>