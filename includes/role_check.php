<?php
include("auth.php");

function checkRole($allowedRoles)
{
    if (!in_array($_SESSION['role'], $allowedRoles)) {
        die("<h2 style='color:red;text-align:center;margin-top:50px;'>
        Access Denied! You do not have permission to view this page.
        </h2>");
    }
}
?>