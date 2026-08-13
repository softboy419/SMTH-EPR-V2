<?php
include("../config/database.php");

$id = $_GET['id'];

$sql = "DELETE FROM appointments WHERE id='$id'";

if(mysqli_query($conn,$sql)){
    echo "<script>
    alert('Appointment Deleted Successfully!');
    window.location='appointments.php';
    </script>";
}else{
    echo mysqli_error($conn);
}
?>