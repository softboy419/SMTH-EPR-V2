<?php
$role = $_SESSION['role'] ?? '';
?>

<div class="sidebar">

    <div class="logo">
        🏥 <span>SMTH</span>
    </div>

    <!-- Dashboard: Everyone -->
    <a href="/SMTH-EPR/dashboard.php">
        <i class="bi bi-speedometer2"></i>
        Dashboard
    </a>


    <!-- Patients: Admin + Doctor -->
    <?php if ($role === 'Admin' || $role === 'Doctor'): ?>
        <a href="/SMTH-EPR/patients/patients.php">
            <i class="bi bi-people-fill"></i>
            Patients
        </a>
    <?php endif; ?>


    <!-- Doctors: Admin only -->
    <?php if ($role === 'Admin'): ?>
        <a href="/SMTH-EPR/doctors/doctors.php">
            <i class="bi bi-person-badge-fill"></i>
            Doctors
        </a>
    <?php endif; ?>


    <!-- Appointments: Admin + Doctor -->
    <?php if ($role === 'Admin' || $role === 'Doctor'): ?>
        <a href="/SMTH-EPR/appointments/appointments.php">
            <i class="bi bi-calendar-check"></i>
            Appointments
        </a>
    <?php endif; ?>


    <!-- Pharmacy: Admin + Pharmacist -->
    <?php if ($role === 'Admin' || $role === 'Pharmacist'): ?>
        <a href="/SMTH-EPR/pharmacy/pharmacy.php">
            <i class="bi bi-capsule"></i>
            Pharmacy
        </a>
    <?php endif; ?>


    <!-- Laboratory: Admin + Laboratory -->
    <?php if ($role === 'Admin' || $role === 'Laboratory'): ?>
        <a href="/SMTH-EPR/laboratory/laboratory.php">
            <i class="bi bi-eyedropper"></i>
            Laboratory
        </a>
    <?php endif; ?>


    <!-- Billing: Admin only -->
    <?php if ($role === 'Admin'): ?>
        <a href="/SMTH-EPR/billing/billing.php">
            <i class="bi bi-receipt"></i>
            Billing
        </a>
    <?php endif; ?>


    <!-- Users: Admin only -->
    <?php if ($role === 'Admin'): ?>
        <a href="/SMTH-EPR/users/users.php">
            <i class="bi bi-people"></i>
            Users
        </a>
    <?php endif; ?>


    <!-- Logout: Everyone -->
    <a href="/SMTH-EPR/logout.php" class="logout">
        <i class="bi bi-box-arrow-right"></i>
        Logout
    </a>

</div>