<?php
include("../includes/session.php");
include("../config/database.php");

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $sql = "DELETE FROM laboratory WHERE id='$id'";

    if(mysqli_query($conn, $sql)){
        echo "<script>
                alert('Laboratory record deleted successfully!');
                window.location='laboratory.php';
              </script>";
    }else{
        echo "Error deleting record.";
    }
}
?>